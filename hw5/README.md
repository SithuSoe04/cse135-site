# CSE 135 HW5 - Analytics Platform

## Team
- Phyo Thant
- Sithu Soe

## Links
- **Repository:** https://github.com/SithuSoe04/cse135-site
- **Collector site:** https://collector.cse135phyosithu.site
- **Reporting site:** https://reporting.cse135phyosithu.site
- **Tracked site:** https://test.cse135phyosithu.site

## Project Overview
A full-stack web analytics platform. A JavaScript snippet embedded on the tracked site sends event data (demographic, behavioral, performance) to the collector, which stores it in MySQL. The reporting site provides a role-gated dashboard with charts, raw data logs, and analyst-authored reports.

## Technical Stack
- **Backend:** PHP 8, MySQL, Apache with `.htaccess`
- **Frontend:** Vanilla JS, Chart.js
- **Auth:** PHP sessions, bcrypt password hashing
- **PDF Export:** jsPDF + html2canvas (client-side, no server required)

## Architecture

### Collector (`collector-site/`)
- `log.php` — accepts POST requests with JSON event payloads, inserts into `logs` table. Returns 405 for non-POST methods.

### Reporting (`reporting-site/`)
- Session-based auth with three roles enforced server-side: `super_admin`, `analyst`, `viewer`
- Analysts have per-section access restrictions stored as JSON in the `users` table
- Custom error pages: 403, 404, 500
- `<noscript>` warnings on all pages requiring JS

### Database Tables
- `logs` — raw event data (session_id, event_type, page_url, payload JSON, created_at)
- `users` — accounts with role and allowed_sections JSON
- `reports` — analyst-saved reports (title, section, analyst_comment, created_by FK, created_at)

## Use of AI
We used Claude as a coding assistant throughout this project, including debugging PHP auth logic, fixing SQL queries, building consistent UI components, and configurnig Apache. It was useful for moving quickly and catching bugs, though it occasionally needed correction based on the actual server environment. Overall it was a net positive for productivity, but understanding the code it produces is still necessary.

## Roadmap (Future Work)
- Email delivery of saved reports
- Deleting the saved reports as SUPERADMIN and reporter
- Time-range filtering on charts and data grid
- Pagination on the data grid for large log volumes
- Accessible URL for saved PDFs