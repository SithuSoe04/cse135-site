# GRADER.md - CSE 135 HW5

## Credentials

| Role | Username | Password | Notes |
|------|----------|----------|-------|
| Super Admin | `boss` | `superPassword123` | Full access, user management |
| Analyst (all sections) | `sally` | `analystPassword456` | Can view all 3 sections, save reports |
| Analyst (performance only) | `sam` | `samPass123` | Restricted to performance section only |
| Analyst (static + behavioral) | `tom` | `tomPass123` | Restricted to demographic + behavioral sections |
| Viewer | `bob` | `viewerPassword789` | Read-only access to saved reports |

---

## Grader Walkthrough Scenario

**Step 1 — View as a Viewer**
Go to https://reporting.cse135phyosithu.site/. Log in as `bob` / `viewerPassword789`. You will be redirected to Saved Reports automatically. Verify that attempting to navigate to `/dashboard.php` or `/charts.php` shows a 403 page.

**Step 2 — Log in as a restricted Analyst**
Log out, then log in as `sam` / `samPass123`. Navigate to Reporting (`charts.php`). You should only see the Performance section (Infrastructure Health Metrics). The Demographic and Behavioral sections should not be visible.

**Step 3 — Log in as a full Analyst**
Log out, then log in as `sally` / `analystPassword456`. Navigate to Reporting. All three sections should be visible: Demographic, Behavioral, and Performance. Scroll down to "Save a Report" — fill in a title, select a section, add an analyst comment, and click Save. Navigate to Saved Reports to confirm it appears there.

**Step 4 — Export a PDF**
While logged in as `sally`, go to Reporting and click "Download PDF Report" in the top right. A PDF file will be generated client-side using jsPDF + html2canvas and downloaded automatically. Charts and tables are included.

**Step 5 — Log in as Super Admin**
Log out, then log in as `boss` / `superPassword123`. Verify the Dashboard shows live stats (total logs, sessions, reports, users). Navigate to Users — you can add a new user with any role and optional section restrictions, or delete existing users. Verify the Data Grid shows raw log events.

**Step 6 — Error pages**
- Visit `/doesnotexist.php` → custom 404 page
- Log in as `bob`, then manually navigate to `/dashboard.php` → custom 403 page
- Visit `/500.php` directly → custom 500 page

**Step 7 — Script-off handling**
Disable JavaScript in browser settings (DevTools → Rendering → Disable JavaScript). Reload any reporting page — an amber warning banner should appear indicating charts will not work.

**Step 8 — Collector 405**
Visit `https://collector.cse135phyosithu.site/log.php` directly in the browser (GET request). Should return HTTP 405 Method Not Allowed.

---

## Known Bugs and Concerns

- **PDF export — "Save a Report" form appears on page 1 of the PDF.** The html2canvas capture includes the save form since it is inside `#printable-content`. As such, the form is currently part of the DOM tree inside the printable container. In a future iteration, I would apply a .no-print CSS class and configure html2canvas to ignore that class during the capture process..

- **Section access enforcement is UI-only on charts.php.** The PHP checks `$_SESSION['allowed_sections']` to conditionally render sections, which is correct. However, the raw SQL queries for all sections still run on the server regardless — only the output is gated. This is not a security issue (data is not exposed) but is slightly inefficient.

- **No CSRF protection on forms.** The save report form and user management forms use plain POST without CSRF tokens. For a production system this would need to be addressed.

- **Lack of Report Lifecycle Management (CRUD).** Currently, the system only supports the "Create" and "Read" operations for Analyst reports. There is no administrative interface to update or delete reports once they are committed to the database. A future iteration would include a DELETE endpoint restricted to super_admin users or the original author to maintain the integrity and relevance of the Saved Reports feed.