<?php
function is_logged_in(): bool
{
    return isset($_SESSION['user_id']);
}

function require_login(): void
{
    if (!is_logged_in()) {
        $_SESSION['flash_error'] = 'Please log in to continue.';
        redirect('index.php?controller=account&action=login_form');
    }
}
