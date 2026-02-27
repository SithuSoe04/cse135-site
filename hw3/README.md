# HW 3 - Data Collection and Storage

## 1. Link to Site
* **Main Test Site:** [https://test.cse135phyosithu.site](https://test.cse135phyosithu.site)
* **Collector Script:** [https://collector.cse135phyosithu.site/collector.js](https://collector.cse135phyosithu.site/collector.js)
* **Reporting API:** [https://reporting.cse135phyosithu.site/api/static](https://reporting.cse135phyosithu.site/api/static)

---

## 2. Team Member Names
* **Phyo Thant**
* **Sithu Soe**

---

## 3. Server & Access Information
* **IP Address:** 143.110.204.36
* **Grader SSH Account:** * **Username:** `grader`
    * **Password:** `cse135Password`
* **Grader Site Login (Basic Auth):** * **Username:** `sithu`
    * **Password:** `cse135Password`

---

## 4. Notes to Graders
* **Data Ingestion**: Our `/log` endpoint uses a PHP script (`log.php`) combined with an `.htaccess` rewrite rule to handle incoming `sendBeacon` requests from the collector script.
* **Database Security**: Database credentials are kept in `db_config.php`, which is located at `/var/www/cse135phyosithu.site/db_config.php`—one level above the public document root for security.
* **Enhanced Logging**: Part 2 logging is active on the `test` vhost. We are specifically capturing Client Hints (`UA`, `Platform`, `Architecture`, `Model`, `Mobile`, `Viewport-Width`) in our `test_access.log` using the `combined_hints` log format.
* **REST API**: The reporting vhost provides a RESTful interface for the stored data. Please refer to `example-routes.pdf` for the full API documentation.

---

## 5. Changes to collector.js (Customizations)
Beyond the standard tutorial from CSE135.site, we implemented the following:
* **Custom CSS Detection**: Implemented a DOM-based check that creates a temporary element to verify if external CSS is active by checking computed styles.
* **Image Support Logic**: Added an asynchronous image-loading check using a Base64 tracking pixel to determine if the user's browser allows image rendering.
* **Event Throttling**: Implemented a `sampleRate` (200ms) to throttle `mousemove` events, reducing unnecessary server load while still capturing accurate cursor trends.
* **Session Management**: Used `crypto.randomUUID()` and `sessionStorage` to maintain a consistent `s_id` across the session, allowing us to tie disparate activity events back to a single user.