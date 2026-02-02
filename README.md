# CSE 135 - HW 2: Server-Side Basics and Analytics 3 Ways

## Team Members
* **Phyo Thant**
* **Sithu Soe**

---

## Server Information

**Droplet IP:** 143.110.204.36
**Domain:** https://cse135phyosithu.site

### Grader Account (SSH)
* **Username:** grader
* **Password:** cse135Password

### Site Credentials (HTTP Basic Auth)
* **Username:** sithu
* **Password:** cse135Password

---

## Part 1: Perl CGI Demos

The following Perl CGI programs were downloaded from cse135.site and configured to run on our server:

* [Hello HTML World (Perl)](https://cse135phyosithu.site/perlcode/perl-hello-html-world.pl)
* [Hello JSON World (Perl)](https://cse135phyosithu.site/perlcode/perl-hello-json-world.pl)
* [Environment (Perl)](https://cse135phyosithu.site/perlcode/perl-env.pl)
* [Echo (Perl)](https://cse135phyosithu.site/perlcode/perl-general-echo.pl)
* [Session (Perl)](https://cse135phyosithu.site/perlcode/perl-session-1.pl)

---

## Part 2: CGI Programs in 3 Languages

We implemented the required CGI programs in **PHP**, **Python**, and **Node.js**.

### PHP
* [Hello HTML (PHP)](https://cse135phyosithu.site/phpcode/hello-html-php.php)
* [Hello JSON (PHP)](https://cse135phyosithu.site/phpcode/hello-json-php.php)
* [Environment (PHP)](https://cse135phyosithu.site/phpcode/environment-php.php)
* [Echo (PHP)](https://cse135phyosithu.site/phpcode/echo-php.php)
* [State (PHP)](https://cse135phyosithu.site/phpcode/state-php.php)

### Python
* [Hello HTML (Python)](https://cse135phyosithu.site/pythoncode/hello-html-python.py)
* [Hello JSON (Python)](https://cse135phyosithu.site/pythoncode/hello-json-python.py)
* [Environment (Python)](https://cse135phyosithu.site/pythoncode/environment-python.py)
* [Echo (Python)](https://cse135phyosithu.site/pythoncode/echo-python.py)
* [State (Python)](https://cse135phyosithu.site/pythoncode/state-python.py)

### Node.js (without Express, proxied by Apache)
* [Hello HTML (Node.js)](https://cse135phyosithu.site/nodejscode/hello-html-node.js)
* [Hello JSON (Node.js)](https://cse135phyosithu.site/nodejscode/hello-json-node.js)
* [Environment (Node.js)](https://cse135phyosithu.site/nodejscode/environment-node.js)
* [Echo (Node.js)](https://cse135phyosithu.site/nodejscode/echo-node.js)
* [State (Node.js)](https://cse135phyosithu.site/nodejscode/state-node.js)

### Echo Form
* [Echo Form Test Page](https://cse135phyosithu.site/echo-form.html) - Interactive form to test all echo endpoints with different HTTP methods (GET, POST, PUT, DELETE) and encodings (x-www-form-urlencoded, application/json)

---

## Part 3: Third-Party Analytics

### Approach 3: Cloudflare Web Analytics (Free Choice)

#### What We Considered
We evaluated several third-party analytics platforms for our free choice:

1. **Plausible Analytics** - Privacy-focused, simple dashboard, but requires paid subscription after 30-day trial
2. **Fathom Analytics** - Similar to Plausible, privacy-first approach, also paid
3. **Umami** - Open-source and self-hosted, but requires additional server setup with Docker
4. **GoatCounter** - Free for non-commercial use, lightweight
5. **Cloudflare Web Analytics** - Completely free, privacy-focused, backed by major infrastructure company

#### Why We Chose Cloudflare Web Analytics
We selected **Cloudflare Web Analytics** for the following reasons:

1. **Completely Free**: Unlike Plausible or Fathom which require paid subscriptions, Cloudflare Web Analytics is 100% free with no usage limits or trial periods.

2. **Privacy-Focused**: Cloudflare does not track individual visitors or use cookies. This makes it GDPR-compliant out of the box and respects user privacy, which aligns with modern web standards and regulations.

3. **Lightweight**: The tracking script is minimal (~5KB) and does not impact page load performance, unlike heavier analytics solutions.

4. **Reliable Infrastructure**: Backed by Cloudflare's global network, ensuring high availability and fast script delivery.

5. **Simple Setup**: Only requires adding a single script tag to our HTML pages - no complex configuration or account setup beyond creating a free Cloudflare account.

#### Analysis and Comparison

| Feature | Google Analytics | LogRocket | Cloudflare Web Analytics |
|---------|------------------|-----------|--------------------------|
| **Cost** | Free | Free tier (limited) | Free |
| **Privacy** | Tracks individuals, uses cookies | Records sessions | No individual tracking, no cookies |
| **Data Depth** | Very detailed | Session replays | Aggregate metrics only |
| **Setup Complexity** | Medium | Medium | Very Simple |
| **GDPR Compliance** | Requires consent banner | Requires consent | Compliant by default |
| **Script Size** | ~45KB | ~100KB+ | ~5KB |

**Trade-offs Observed:**
- Cloudflare Web Analytics provides less granular data than Google Analytics (no user-level tracking, no conversion funnels)
- Cannot replay sessions like LogRocket
- However, for basic traffic analysis and page view metrics, it provides sufficient insights while maintaining user privacy
- The simplicity and zero-cost make it an excellent choice for projects where detailed individual user tracking is not required

#### Implementation Notes
Setup was straightforward:
1. Created a free Cloudflare account
2. Added our domain (cse135phyosithu.site) to Web Analytics
3. Copied the provided script snippet
4. Added the script to our HTML pages

The dashboard immediately began showing page views, unique visitors, and traffic sources after we visited the site.

---

## Additional Notes for Graders

- All CGI programs are accessible via links on the main homepage under "Homework 2"
- The echo form supports JavaScript-enabled mode with full functionality (method/encoding switching) and a fallback mode for JavaScript-disabled browsers
- Node.js endpoints are proxied through Apache as required
- State management is implemented server-side using sessions (not localStorage)
- All vanilla JavaScript is used - no frameworks

---