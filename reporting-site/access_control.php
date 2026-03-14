<?php
/**
 * Check if the current user can access a given report section.
 *
 * - super_admin: always yes
 * - analyst with null allowed_sections: yes (full access)
 * - analyst with allowed_sections list: only if section is in the list
 * - viewer: never (they only see saved_reports.php)
 *
 * Call this AFTER including auth_check.php.
 * Pass $redirect=true to auto-send a 403 and die, or false to just return bool.
 */
function can_access_section(string $section, bool $redirect = true): bool {
    $role     = $_SESSION['role'] ?? '';
    $sections = $_SESSION['allowed_sections'] ?? null; // null = all

    if ($role === 'super_admin') return true;

    if ($role === 'analyst') {
        if ($sections === null || in_array($section, $sections)) return true;
    }

    // Access denied
    if ($redirect) {
        http_response_code(403);
        include __DIR__ . '/403.php';
        exit;
    }
    return false;
}
