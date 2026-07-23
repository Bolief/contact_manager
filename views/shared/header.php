<?php
$page_title = $page_title ?? 'Contact Manager';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= e($page_title) ?></title>
    <link rel="stylesheet" href="css/main.css">
</head>
<body>
<header>
    <div class="container header-row">
        <h1>Contact Manager</h1>
        <nav>
            <?php if (is_logged_in()) : ?>
                <a href="index.php?controller=contacts&action=list">Contacts</a>
                <a href="index.php?controller=contacts&action=add_form">Add Contact</a>
                <a href="index.php?controller=account&action=profile">My Account</a>
                <a href="index.php?controller=account&action=logout">Logout</a>
            <?php else : ?>
                <a href="index.php?controller=account&action=login_form">Login</a>
                <a href="index.php?controller=account&action=register_form">Register</a>
            <?php endif; ?>
        </nav>
    </div>
</header>
<main class="container">
<?php if (!empty($_SESSION['flash_success'])) : ?>
    <div class="message success"><?= e($_SESSION['flash_success']) ?></div>
    <?php unset($_SESSION['flash_success']); ?>
<?php endif; ?>

<?php if (!empty($_SESSION['flash_error'])) : ?>
    <div class="message error"><?= e($_SESSION['flash_error']) ?></div>
    <?php unset($_SESSION['flash_error']); ?>
<?php endif; ?>
