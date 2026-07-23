<?php
function validate_name(string $name, string $label): ?string
{
    if ($name === '') {
        return "$label is required.";
    }

    if (!preg_match("/^[a-zA-Z\s'-]+$/", $name)) {
        return "$label may contain only letters, spaces, apostrophes, and hyphens.";
    }

    return null;
}

function validate_email(string $email, bool $required = true): ?string
{
    if ($email === '') {
        return $required ? 'Email is required.' : null;
    }

    return filter_var($email, FILTER_VALIDATE_EMAIL)
        ? null
        : 'Enter a valid email address.';
}

function validate_password(string $password): ?string
{
    if ($password === '') {
        return 'Password is required.';
    }

    $pattern = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,}$/';

    if (!preg_match($pattern, $password)) {
        return 'Password must be at least 8 characters and include one uppercase letter, one lowercase letter, and one number.';
    }

    return null;
}

function validate_phone(string $phone): ?string
{
    if ($phone === '') {
        return null;
    }

    return preg_match('/^\d{3}-\d{3}-\d{4}$/', $phone)
        ? null
        : 'Phone must use the format 555-555-5555.';
}

function validate_zip(string $zip): ?string
{
    if ($zip === '') {
        return null;
    }

    return preg_match('/^\d{5}(-\d{4})?$/', $zip)
        ? null
        : 'ZIP code must use 12345 or 12345-6789.';
}
