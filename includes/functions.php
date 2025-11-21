<?php
declare(strict_types=1);

/**
 * Helper Functions for Sailing Business Website
 * PHP 8.4 Compatible
 */

// Start session for language handling
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Available languages
const AVAILABLE_LANGUAGES = ['en', 'el', 'de', 'fr'];
const DEFAULT_LANGUAGE = 'en';

/**
 * Get current language from session, URL, or default
 */
function getCurrentLanguage(): string
{
    // Check URL parameter first
    if (isset($_GET['lang']) && in_array($_GET['lang'], AVAILABLE_LANGUAGES, true)) {
        $_SESSION['lang'] = $_GET['lang'];
        return $_GET['lang'];
    }

    // Check session
    if (isset($_SESSION['lang']) && in_array($_SESSION['lang'], AVAILABLE_LANGUAGES, true)) {
        return $_SESSION['lang'];
    }

    // Check browser preference
    if (isset($_SERVER['HTTP_ACCEPT_LANGUAGE'])) {
        $browserLang = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);
        if (in_array($browserLang, AVAILABLE_LANGUAGES, true)) {
            $_SESSION['lang'] = $browserLang;
            return $browserLang;
        }
    }

    // Default
    $_SESSION['lang'] = DEFAULT_LANGUAGE;
    return DEFAULT_LANGUAGE;
}

/**
 * Get translation for a specific key
 */
function t(string $key, ?string $lang = null): string|array
{
    global $translations;
    $lang ??= getCurrentLanguage();

    $keys = explode('.', $key);
    $value = $translations;

    foreach ($keys as $k) {
        if (!isset($value[$k])) {
            return $key; // Return key if translation not found
        }
        $value = $value[$k];
    }

    // If final value is an array with language keys
    if (is_array($value) && isset($value[$lang])) {
        return $value[$lang];
    }

    return is_string($value) ? $value : $key;
}

/**
 * Get translation array (for items like highlights)
 */
function tArray(string $key, ?string $lang = null): array
{
    $result = t($key, $lang);
    return is_array($result) ? $result : [$result];
}

/**
 * Generate URL with current language parameter
 */
function langUrl(string $page, ?string $lang = null): string
{
    $lang ??= getCurrentLanguage();
    $separator = str_contains($page, '?') ? '&' : '?';
    return $page . $separator . 'lang=' . $lang;
}

/**
 * Generate language switcher URLs
 */
function getLanguageSwitcherUrls(): array
{
    global $translations;
    $currentPage = basename($_SERVER['PHP_SELF']);
    $urls = [];

    foreach (AVAILABLE_LANGUAGES as $lang) {
        $urls[$lang] = [
            'url' => langUrl($currentPage, $lang),
            'name' => $translations['languages'][$lang],
            'active' => $lang === getCurrentLanguage()
        ];
    }

    return $urls;
}

/**
 * Get placeholder image URL
 */
function getPlaceholderImage(int $width = 800, int $height = 600, string $text = 'Sailing'): string
{
    return "https://placehold.co/{$width}x{$height}/0077b6/ffffff?text=" . urlencode($text);
}

/**
 * Get gallery images (placeholder)
 */
function getGalleryImages(string $type = 'general', int $count = 6): array
{
    $images = [];
    $captions = [
        'general' => ['Sailing Adventure', 'Crystal Waters', 'Dia Island', 'Sunset Cruise', 'Swimming Stop', 'On Board'],
        'private' => ['Private Charter', 'Exclusive Experience', 'Your Own Pace', 'Hidden Coves', 'Luxury Sailing', 'Personal Service'],
        'full_day' => ['Morning Departure', 'Dia Island Views', 'Swimming Break', 'Lunch on Board', 'Exploring Coast', 'Sunset Return'],
        'half_day' => ['Quick Getaway', 'Refreshing Swim', 'Beautiful Views', 'Perfect Escape', 'Sea Breeze', 'Memories']
    ];

    $typeCaptions = $captions[$type] ?? $captions['general'];

    for ($i = 0; $i < $count; $i++) {
        $caption = $typeCaptions[$i % count($typeCaptions)];
        $images[] = [
            'src' => getPlaceholderImage(800, 600, $caption),
            'thumb' => getPlaceholderImage(400, 300, $caption),
            'caption' => $caption
        ];
    }

    return $images;
}

/**
 * Sanitize input
 */
function sanitizeInput(string $input): string
{
    return htmlspecialchars(trim($input), ENT_QUOTES, 'UTF-8');
}

/**
 * Validate email
 */
function isValidEmail(string $email): bool
{
    return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
}

/**
 * Generate CSRF token
 */
function generateCsrfToken(): string
{
    if (!isset($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf_token'];
}

/**
 * Verify CSRF token
 */
function verifyCsrfToken(string $token): bool
{
    return isset($_SESSION['csrf_token']) && hash_equals($_SESSION['csrf_token'], $token);
}

/**
 * Check if current page
 */
function isCurrentPage(string $page): bool
{
    $currentPage = basename($_SERVER['PHP_SELF']);
    return $currentPage === $page;
}

/**
 * Get active class for navigation
 */
function getNavActiveClass(string $page): string
{
    return isCurrentPage($page) ? 'active' : '';
}
