<!DOCTYPE html>
<html lang="en">
<head><meta charset="UTF-8"><title>Database Error</title></head>
<body>
    <h1>Database Error</h1>
    <p><?= htmlspecialchars($error_message ?? 'A database error occurred.', ENT_QUOTES, 'UTF-8') ?></p>
</body>
</html>
