<?php

/**
 * Escapes HTML output to prevent XSS.
 * 
 * @param string|null $data The string to escape.
 * @return string The escaped string.
 */
function e($data) {
    return htmlspecialchars($data ?? '', ENT_QUOTES, 'UTF-8');
}

/**
 * Sanitize input data (if needed beyond prepared statements).
 * This can be expanded as needed.
 */
function sanitize($connection, $data) {
    return mysqli_real_escape_string($connection, filter_var($data, FILTER_SANITIZE_FULL_SPECIAL_CHARS));
}
