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
- **Endpoint Security:** The root directory and individual scripts are hardened against direct browser access via `.htaccess` (`Options -Indexes`).
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
We used Gemini and Claude as a coding assistant throughout this project, including debugging PHP auth logic, fixing SQL queries, building consistent UI components, and configuring Apache. It was useful for moving quickly and catching bugs, though it occasionally needed correction, specifically regarding the handling of $_SERVER variables in our specific Apache environment. Overall, it was a net positive for productivity, but understanding the code it produces is still necessary.

## Roadmap (Future Work)

### Data & Scaling
- **Time-Range Filtering:** Implementing a date-range picker to allow analysts to compare week-over-week performance and identify seasonal trends.
- **Server-Side Pagination:** Transitioning the Data Grid to use SQL `LIMIT` and `OFFSET` to maintain 400ms load times as the log volume exceeds 10,000+ entries.
- **Real-time WebSocket Updates:** Moving from periodic refreshes to a "Live Stream" mode for the Data Grid to show events the millisecond they are captured by the collector.

### Administrative & Lifecycle
- **Enhanced CRUD for Reports:** Adding `DELETE` and `UPDATE` functionality to the `reports` table to allow for content moderation and the removal of stale data by the `super_admin` or original author.
- **Automated Data Pruning:** Implementation of a scheduled "Cleanup" task (Cron Job) to archive or delete raw logs older than 90 days. This ensures the database remains performant and prevents storage overages while adhering to standard data retention policies.

### Accessibility & Sharing
- **Report Persistence (Accessible URLs):** Moving to server-side PDF storage. This would generate unique, shareable URLs for reports, enabling easier collaboration without requiring a direct login for every stakeholder.
- **CSV/Excel Export:** Adding raw data export options for the Data Grid to support analysts who require external statistical modeling tools.