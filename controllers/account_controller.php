<?php
$action = filter_input(INPUT_POST, 'action')
    ?? filter_input(INPUT_GET, 'action')
    ?? (is_logged_in() ? 'profile' : 'login_form');

switch ($action) {
    case 'register_form':
        $errors = [];
        include __DIR__ . '/../views/account/register.php';
        break;

    case 'register':
        $first_name = post_value('first_name');
        $last_name = post_value('last_name');
        $email = strtolower(post_value('email'));
        $password = post_value('password');
        $confirm_password = post_value('confirm_password');

        $errors = [];
        if ($message = validate_name($first_name, 'First name')) $errors['first_name'] = $message;
        if ($message = validate_name($last_name, 'Last name')) $errors['last_name'] = $message;
        if ($message = validate_email($email)) $errors['email'] = $message;
        if ($message = validate_password($password)) $errors['password'] = $message;

        if ($password !== $confirm_password) {
            $errors['confirm_password'] = 'Passwords do not match.';
        }

        if (!$errors && get_user_by_email($email)) {
            $errors['email'] = 'That email address is already registered.';
        }

        if ($errors) {
            include __DIR__ . '/../views/account/register.php';
            break;
        }

        $password_hash = password_hash($password, PASSWORD_DEFAULT);
        add_user($first_name, $last_name, $email, $password_hash);

        $_SESSION['flash_success'] = 'Account created. You may now log in.';
        redirect('index.php?controller=account&action=login_form');

    case 'login_form':
        $errors = [];
        include __DIR__ . '/../views/account/login.php';
        break;

    case 'login':
        $email = strtolower(post_value('email'));
        $password = post_value('password');
        $errors = [];

        if ($message = validate_email($email)) $errors['email'] = $message;
        if ($password === '') $errors['password'] = 'Password is required.';

        $user = !$errors ? get_user_by_email($email) : false;

        if (!$user || !password_verify($password, $user['password_hash'])) {
            $errors['login'] = 'The email or password is incorrect.';
        }

        if ($errors) {
            include __DIR__ . '/../views/account/login.php';
            break;
        }

        session_regenerate_id(true);
        $_SESSION['user_id'] = (int) $user['user_id'];
        $_SESSION['user_name'] = $user['first_name'];

        redirect('index.php?controller=contacts&action=list');

    case 'profile':
        require_login();
        $user = get_user_by_id((int) $_SESSION['user_id']);
        include __DIR__ . '/../views/account/profile.php';
        break;

    case 'edit_profile_form':
        require_login();
        $user = get_user_by_id((int) $_SESSION['user_id']);
        $first_name = $user['first_name'];
        $last_name = $user['last_name'];
        $email = $user['email'];
        $errors = [];
        include __DIR__ . '/../views/account/edit_profile.php';
        break;

    case 'update_profile':
        require_login();

        $first_name = post_value('first_name');
        $last_name = post_value('last_name');
        $email = strtolower(post_value('email'));
        $errors = [];

        if ($message = validate_name($first_name, 'First name')) $errors['first_name'] = $message;
        if ($message = validate_name($last_name, 'Last name')) $errors['last_name'] = $message;
        if ($message = validate_email($email)) $errors['email'] = $message;

        $existing = get_user_by_email($email);
        if ($existing && (int) $existing['user_id'] !== (int) $_SESSION['user_id']) {
            $errors['email'] = 'That email address is already in use.';
        }

        if ($errors) {
            include __DIR__ . '/../views/account/edit_profile.php';
            break;
        }

        update_user((int) $_SESSION['user_id'], $first_name, $last_name, $email);
        $_SESSION['user_name'] = $first_name;
        $_SESSION['flash_success'] = 'Profile updated.';
        redirect('index.php?controller=account&action=profile');

    case 'change_password_form':
        require_login();
        $errors = [];
        include __DIR__ . '/../views/account/change_password.php';
        break;

    case 'change_password':
        require_login();

        $current_password = post_value('current_password');
        $new_password = post_value('new_password');
        $confirm_password = post_value('confirm_password');
        $errors = [];

        $user = get_user_by_email(get_user_by_id((int) $_SESSION['user_id'])['email']);

        if (!password_verify($current_password, $user['password_hash'])) {
            $errors['current_password'] = 'Current password is incorrect.';
        }

        if ($message = validate_password($new_password)) {
            $errors['new_password'] = $message;
        }

        if ($new_password !== $confirm_password) {
            $errors['confirm_password'] = 'Passwords do not match.';
        }

        if ($errors) {
            include __DIR__ . '/../views/account/change_password.php';
            break;
        }

        update_password((int) $_SESSION['user_id'], password_hash($new_password, PASSWORD_DEFAULT));
        $_SESSION['flash_success'] = 'Password changed successfully.';
        redirect('index.php?controller=account&action=profile');

    case 'logout':
        $_SESSION = [];
        if (ini_get('session.use_cookies')) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000, $params['path'], $params['domain'], $params['secure'], $params['httponly']);
        }
        session_destroy();
        redirect('index.php?controller=account&action=login_form');

    default:
        http_response_code(404);
        include __DIR__ . '/../views/errors/404.php';
}
