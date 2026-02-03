# Extra Credit: Browser Fingerprinting Demo

## Team Members
* **Phyo Thant**
* **Sithu Soe**

---

## Overview

This document describes our implementation of browser fingerprinting for user identification, demonstrating how users can be recognized even after clearing their cookies.

**Demo URL:** https://cse135phyosithu.site/fingerprint-demo.html

---

## What is Browser Fingerprinting?

Browser fingerprinting is a technique that identifies users based on their browser and device characteristics rather than cookies. It collects information such as:

- Screen resolution and color depth
- Installed fonts
- Browser plugins
- Timezone
- Language settings
- Canvas rendering patterns
- WebGL renderer information
- Audio context properties
- And many more attributes...

When combined, these attributes create a unique "fingerprint" that can identify a browser with high accuracy.

---

## Implementation

### Technology Used

We used **FingerprintJS** (open-source version 3.x), a popular browser fingerprinting library that:
- Is lightweight (~15KB gzipped)
- Achieves ~60% unique identification rate
- Works across all modern browsers
- Is GDPR-compliant when used properly

**CDN Source:** `https://cdn.jsdelivr.net/npm/@fingerprintjs/fingerprintjs@3/dist/fp.min.js`

### Architecture

```
┌─────────────────────────────────────────────────────────────────┐
│                      Browser (Client)                            │
│  ┌─────────────────┐    ┌─────────────────────────────────────┐ │
│  │  FingerprintJS  │───>│  fingerprint-demo.html              │ │
│  │  (generates ID) │    │  - Displays fingerprint             │ │
│  └─────────────────┘    │  - Shows recognition status         │ │
│                         │  - Save/Clear data forms            │ │
│                         └─────────────────────────────────────┘ │
└───────────────────────────────┬─────────────────────────────────┘
                                │ AJAX (JSON)
                                ▼
┌─────────────────────────────────────────────────────────────────┐
│                      Server (PHP)                                │
│  ┌─────────────────────────────────────────────────────────────┐│
│  │  fingerprint-api.php                                        ││
│  │  - Receives fingerprint + action                            ││
│  │  - Checks session cookie                                    ││
│  │  - Looks up fingerprint in storage                          ││
│  │  - Performs reassociation if needed                         ││
│  │  - Returns recognition status                               ││
│  └─────────────────────────────────────────────────────────────┘│
│                              │                                   │
│                              ▼                                   │
│  ┌─────────────────────────────────────────────────────────────┐│
│  │  fingerprint-data.json (Storage)                            ││
│  │  - Maps fingerprints to user data                           ││
│  │  - Stores visit history                                     ││
│  │  - Persists across sessions                                 ││
│  └─────────────────────────────────────────────────────────────┘│
└─────────────────────────────────────────────────────────────────┘
```

### Files Created

| File | Purpose |
|------|---------|
| `fingerprint-demo.html` | Frontend demo page with UI |
| `phpcode/fingerprint-api.php` | Backend API for fingerprint storage and reassociation |
| `phpcode/fingerprint-data.json` | JSON storage for fingerprint mappings (auto-created) |

---

## How the Demo Works

### Step 1: Initial Visit (New User)
1. User visits `fingerprint-demo.html`
2. FingerprintJS generates a unique visitor ID
3. Frontend sends fingerprint to server
4. Server checks:
   - Is there a session cookie? → NO
   - Is this fingerprint in storage? → NO
5. Server creates new record and returns "New Visitor" status

### Step 2: Return Visit (With Cookies)
1. User revisits the page
2. Browser sends session cookie automatically
3. Frontend sends fingerprint to server
4. Server checks:
   - Is there a session cookie? → YES
   - Does session fingerprint match? → YES
5. Server returns "Recognized via Session Cookie" status

### Step 3: Reassociation (Cookies Cleared)
1. User clears cookies and revisits
2. Browser has NO session cookie
3. Frontend sends fingerprint to server
4. Server checks:
   - Is there a session cookie? → NO
   - Is this fingerprint in storage? → YES!
5. Server restores user data from fingerprint storage
6. Server returns "Reassociated via Fingerprint" status

---

## Demo Instructions

### Testing the Fingerprint Reassociation

1. **Visit the demo page:**
   https://cse135phyosithu.site/fingerprint-demo.html

2. **Save some data:**
   - Enter your name in the text field
   - Click "Save Data"
   - Note your fingerprint ID displayed

3. **Clear cookies only:**
   - Click "Clear Cookies Only" button
   - This simulates a user clearing browser cookies

4. **Observe reassociation:**
   - Page will refresh
   - You should see: "Welcome back! You cleared your cookies, but we recognized you by your fingerprint!"
   - Your saved data should still be displayed

5. **Full reset:**
   - Click "Clear Everything" to delete all server data
   - You will appear as a new visitor

---

## API Endpoints

### POST /phpcode/fingerprint-api.php

**Request Body (JSON):**

```json
{
    "action": "check|save|clear",
    "fingerprint": "abc123...",
    "data": "optional user data for save action"
}
```

**Actions:**

| Action | Description |
|--------|-------------|
| `check` | Check if fingerprint is known, perform reassociation if needed |
| `save` | Save user data associated with fingerprint |
| `clear` | Delete all data for this fingerprint |

**Response (JSON):**

```json
{
    "success": true,
    "has_cookie": false,
    "session_id": "abc123",
    "fingerprint": "xyz789",
    "is_new": false,
    "reassociated": true,
    "recognition_method": "Fingerprint (cookies were cleared)",
    "stored_data": "User's saved data",
    "visit_count": 5,
    "visit_history": [...]
}
```

---

## Limitations

### Technical Limitations

1. **Fingerprint Stability:** Browser updates, plugin changes, or hardware changes can alter the fingerprint
2. **Cross-Browser:** Fingerprints are unique per browser, not per person (same person on Chrome vs Firefox = different fingerprints)
3. **Incognito Mode:** Some browsers return different fingerprints in incognito mode
4. **Browser Extensions:** Privacy extensions like Privacy Badger can interfere with fingerprinting

### Accuracy Limitations

| Scenario | Success Rate |
|----------|--------------|
| Same browser, same device | ~99% |
| Same browser after update | ~70-80% |
| Different browser, same device | 0% (different fingerprint) |
| Mobile vs Desktop | 0% (different fingerprint) |

### Privacy/Legal Considerations

1. **GDPR Compliance:** Fingerprinting is considered personal data under GDPR
2. **User Consent:** Should inform users about fingerprinting
3. **Opt-out:** Should provide mechanism to opt out
4. **Data Retention:** Should have clear data retention policies

---

## Comparison with Cookies

| Feature | Cookies | Fingerprinting |
|---------|---------|----------------|
| User can clear | Yes (easily) | No |
| Works cross-browser | No | No |
| Works cross-device | No | No |
| Requires JavaScript | No | Yes |
| GDPR consent needed | Yes | Yes |
| Accuracy | 100% (if not cleared) | ~60-99% |
| User awareness | High | Low |

---

## Production Considerations

If implementing fingerprinting in a production environment:

1. **Use a database** instead of JSON file storage
2. **Hash fingerprints** before storing for additional privacy
3. **Implement rate limiting** to prevent abuse
4. **Add consent mechanism** for GDPR compliance
5. **Consider using FingerprintJS Pro** for higher accuracy (~99.5%)
6. **Combine with other signals** (IP address, user agent) for better accuracy
7. **Set expiration** on fingerprint records

---

## Conclusion

This demo successfully demonstrates how browser fingerprinting can be used to identify users even after they clear their cookies. The implementation shows:

1. How FingerprintJS generates unique browser identifiers
2. Server-side storage of fingerprint-to-data mappings
3. Automatic reassociation when cookies are cleared
4. The limitations and considerations of this approach

While powerful, fingerprinting should be used responsibly with proper user consent and clear privacy policies.

---

## References

- FingerprintJS Documentation: https://fingerprint.com/github/
- FingerprintJS GitHub: https://github.com/fingerprintjs/fingerprintjs
- Browser Fingerprinting Explained: https://coveryourtracks.eff.org/
