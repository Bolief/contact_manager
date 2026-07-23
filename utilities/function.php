<?php
function redirect(string $url): never
{
    header('Location: ' . $url);
    exit();
}

function e(?string $value): string
{
    return htmlspecialchars($value ?? '', ENT_QUOTES, 'UTF-8');
}

function post_value(string $name): string
{
    return trim((string) filter_input(INPUT_POST, $name));
}

function get_int(string $name): ?int
{
    $value = filter_input(INPUT_GET, $name, FILTER_VALIDATE_INT);
    return $value === false ? null : $value;
}
