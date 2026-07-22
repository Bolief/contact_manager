<?php $page_title = 'Change Password'; include __DIR__ . '/../shared/header.php'; ?>
<section class="card narrow">
    <h2>Change Password</h2>

    <form method="post" action="index.php?controller=account">
        <input type="hidden" name="action" value="change_password">

        <label for="current_password">Current Password</label>
        <input id="current_password" name="current_password" type="password">
        <span class="field-error"><?= e($errors['current_password'] ?? '') ?></span>

        <label for="new_password">New Password</label>
        <input id="new_password" name="new_password" type="password">
        <span class="field-error"><?= e($errors['new_password'] ?? '') ?></span>

        <label for="confirm_password">Confirm New Password</label>
        <input id="confirm_password" name="confirm_password" type="password">
        <span class="field-error"><?= e($errors['confirm_password'] ?? '') ?></span>

        <button type="submit">Change Password</button>
    </form>
</section>
<?php include __DIR__ . '/../shared/footer.php'; ?>
