<?php
require_login();

$action = filter_input(INPUT_POST, 'action')
    ?? filter_input(INPUT_GET, 'action')
    ?? 'list';

function contact_form_data(): array
{
    return [
        'first_name' => post_value('first_name'),
        'last_name' => post_value('last_name'),
        'email' => strtolower(post_value('email')),
        'phone' => post_value('phone'),
        'address' => post_value('address'),
        'city' => post_value('city'),
        'state' => post_value('state'),
        'zip_code' => post_value('zip_code'),
        'notes' => post_value('notes')
    ];
}
function contact_errors(array $contact): array
{
    $errors = [];

    if ($message = validate_name($contact['first_name'], 'First name')) $errors['first_name'] = $message;
    if ($message = validate_name($contact['last_name'], 'Last name')) $errors['last_name'] = $message;
    if ($message = validate_email($contact['email'], false)) $errors['email'] = $message;
    if ($message = validate_phone($contact['phone'])) $errors['phone'] = $message;
    if ($message = validate_zip($contact['zip_code'])) $errors['zip_code'] = $message;

    return $errors;
}

switch ($action) {
    case 'list':
        $contacts = get_contacts_by_user((int) $_SESSION['user_id']);
        include __DIR__ . '/../views/contacts/contact_list.php';
        break;

    case 'view':
        $contact_id = get_int('contact_id');
        $contact = $contact_id ? get_contact($contact_id, (int) $_SESSION['user_id']) : false;

        if (!$contact) {
            $_SESSION['flash_error'] = 'Contact not found.';
            redirect('index.php?controller=contacts&action=list');
        }

        include __DIR__ . '/../views/contacts/contact_details.php';
        break;

    case 'add_form':
        $contact = [
            'first_name' => '', 'last_name' => '', 'email' => '', 'phone' => '',
            'address' => '', 'city' => '', 'state' => '', 'zip_code' => '', 'notes' => ''
        ];
        $errors = [];
        include __DIR__ . '/../views/contacts/contact_add.php';
        break;

    case 'add':
        $contact = contact_form_data();
        $errors = contact_errors($contact);

        if ($errors) {
            include __DIR__ . '/../views/contacts/contact_add.php';
            break;
        }

        $contact['user_id'] = (int) $_SESSION['user_id'];
        add_contact($contact);
        $_SESSION['flash_success'] = 'Contact added.';
        redirect('index.php?controller=contacts&action=list');

    case 'edit_form':
        $contact_id = get_int('contact_id');
        $contact = $contact_id ? get_contact($contact_id, (int) $_SESSION['user_id']) : false;

        if (!$contact) {
            $_SESSION['flash_error'] = 'Contact not found.';
            redirect('index.php?controller=contacts&action=list');
        }

        $errors = [];
        include __DIR__ . '/../views/contacts/contact_edit.php';
        break;

    case 'update':
        $contact_id = filter_input(INPUT_POST, 'contact_id', FILTER_VALIDATE_INT);

        if (!$contact_id || !get_contact($contact_id, (int) $_SESSION['user_id'])) {
            $_SESSION['flash_error'] = 'Contact not found.';
            redirect('index.php?controller=contacts&action=list');
        }

        $contact = contact_form_data();
        $contact['contact_id'] = (int) $contact_id;
        $errors = contact_errors($contact);

        if ($errors) {
            include __DIR__ . '/../views/contacts/contact_edit.php';
            break;
        }

        $contact['user_id'] = (int) $_SESSION['user_id'];
        update_contact($contact);
        $_SESSION['flash_success'] = 'Contact updated.';
        redirect('index.php?controller=contacts&action=list');

    case 'delete':
        $contact_id = filter_input(INPUT_POST, 'contact_id', FILTER_VALIDATE_INT);

        if ($contact_id) {
            delete_contact((int) $contact_id, (int) $_SESSION['user_id']);
            $_SESSION['flash_success'] = 'Contact deleted.';
        }

        redirect('index.php?controller=contacts&action=list');

    default:
        http_response_code(404);
        include __DIR__ . '/../views/errors/404.php';
}
