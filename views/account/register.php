<?php $page_title = 'Register'; include __DIR__ . '/../shared/header.php'; ?>
<section class="card narrow">
    <h2>Create Account</h2>

    <form method="post" action="index.php?controller=account">
        <input type="hidden" name="action" value="register">

        <label for="first_name">First Name</label>
        <input id="first_name" name="first_name" value="<?= e($first_name ?? '') ?>">
        <span class="field-error"><?= e($errors['first_name'] ?? '') ?></span>

        <label for="last_name">Last Name</label>
        <input id="last_name" name="last_name" value="<?= e($last_name ?? '') ?>">
        <span class="field-error"><?= e($errors['last_name'] ?? '') ?></span>

        <label for="email">Email</label>
        <input id="email" name="email" type="email" value="<?= e($email ?? '') ?>">
        <span class="field-error"><?= e($errors['email'] ?? '') ?></span>

        <label for="password">Password</label>
        <input id="password" name="password" type="password">
        <small>At least 8 characters, with uppercase, lowercase, and a number.</small>
        <span class="field-error"><?= e($errors['password'] ?? '') ?></span>

        <label for="confirm_password">Confirm Password</label>
        <input id="confirm_password" name="confirm_password" type="password">
        <span class="field-error"><?= e($errors['confirm_password'] ?? '') ?></span>

        <button type="submit">Register</button>
    </form>
</section>
<?php include __DIR__ . '/../shared/footer.php'; ?>
