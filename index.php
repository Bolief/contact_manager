
<?php
session_start();

require_once __DIR__ . '/config/database.php';
require_once __DIR__ . '/utilities/functions.php';
require_once __DIR__ . '/utilities/validation.php';
require_once __DIR__ . '/utilities/authentication.php';
require_once __DIR__ . '/models/user_db.php';
require_once __DIR__ . '/models/contact_db.php';

$controller = filter_input(INPUT_GET, 'controller') ?? 'account';

if ($controller === 'contacts') {
    require __DIR__ . '/controllers/contact_controller.php';
} else {
    require __DIR__ . '/controllers/account_controller.php';
}
