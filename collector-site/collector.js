(function() {
    const CONFIG = {
        endpoint: 'https://collector.cse135phyosithu.site/log',
        idleThreshold: 2000, // 2 seconds
        sampleRate: 100      // Capture mouse every 100ms
    };

    // --- Session Management ---
    if (!sessionStorage.getItem('cse135_sid')) {
        sessionStorage.setItem('cse135_sid', crypto.randomUUID());
    }
    const sessionId = sessionStorage.getItem('cse135_sid');

    // --- Data Transmission ---
    const send = (type, data) => {
        const payload = JSON.stringify({
            s_id: sessionId,
            type: type,
            page: window.location.pathname,
            timestamp: Date.now(),
            data: data
        });
        // sendBeacon is suggested for reliability during page unloads
        navigator.sendBeacon(CONFIG.endpoint, payload);
    };

    // --- 1. STATIC DATA ---
    const collectStatic = () => {
        // Manual check for CSS: inject a known CSS variable, then read it back
        const styleTag = document.createElement('style');
        styleTag.textContent = ':root { --cse135-css-check: 1; }';
        document.head.appendChild(styleTag);
        const cssAllowed = getComputedStyle(document.documentElement)
            .getPropertyValue('--cse135-css-check').trim() === '1';
        document.head.removeChild(styleTag);

        // Manual check for Images
        const img = new Image();
        img.src = "data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7";
        const imagesAllowed = img.complete || img.width > 0;

        send('static', {
            ua: navigator.userAgent,
            lang: navigator.language,
            cookies: navigator.cookieEnabled,
            js: true, 
            images: imagesAllowed,
            css: cssAllowed,
            screen: `${screen.width}x${screen.height}`,
            window: `${window.innerWidth}x${window.innerHeight}`,
            net: navigator.connection ? navigator.connection.effectiveType : 'unknown'
        });
    };

    // --- 2. PERFORMANCE DATA ---
    const collectPerformance = () => {
        const [nav] = performance.getEntriesByType('navigation');
        if (nav) {
            send('performance', {
                raw: nav,
                start: nav.fetchStart,
                end: nav.loadEventEnd,
                totalLoadMs: nav.loadEventEnd - nav.startTime
            });
        }
    };

    // --- 3. ACTIVITY DATA ---
    let lastActivity = Date.now();
    let isIdle = false;
    let idleStart = null;
    let lastMouseSend = 0;

    // Mouse & Keyboard
    window.addEventListener('mousemove', (e) => trackActivity('mouse', { x: e.clientX, y: e.clientY }));
    window.addEventListener('mousedown', (e) => trackActivity('click', { button: e.button, x: e.clientX, y: e.clientY }));
    window.addEventListener('keydown', (e) => trackActivity('keyboard', { key: e.key }));
    window.addEventListener('scroll', () => trackActivity('scroll', { x: window.scrollX, y: window.scrollY }));

    function trackActivity(action, detail) {
        checkIdleEnd();
        // Throttle high-frequency mousemove events using timestamp comparison
        if (action === 'mouse') {
            const now = Date.now();
            if (now - lastMouseSend < CONFIG.sampleRate) return;
            lastMouseSend = now;
        }
        send('activity', { action, detail });
    }

    // Idle Logic
    function checkIdleEnd() {
        if (isIdle) {
            const duration = Date.now() - idleStart;
            send('activity', { action: 'idle_end', durationMs: duration, endedAt: Date.now() });
            isIdle = false;
        }
        lastActivity = Date.now();
    }

    setInterval(() => {
        if (!isIdle && (Date.now() - lastActivity) > CONFIG.idleThreshold) {
            isIdle = true;
            idleStart = Date.now();
            send('activity', { action: 'idle_start', startedAt: idleStart });
        }
    }, 500);

    // Errors
    window.onerror = (msg, url, line) => send('activity', { action: 'error', msg, url, line });

    // Entry/Exit
    window.addEventListener('pageshow', () => send('activity', { action: 'enter' }));
    window.addEventListener('pagehide', () => send('activity', { action: 'exit' }));

    // Initialize
    window.addEventListener('load', () => {
        collectStatic();
        collectPerformance();
    });
})();