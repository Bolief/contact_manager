<?php $page_title = 'Login'; include __DIR__ . '/../shared/header.php'; ?>
<section class="card narrow">
    <h2>Login</h2>

    <?php if (!empty($errors['login'])) : ?>
        <div class="message error"><?= e($errors['login']) ?></div>
    <?php endif; ?>

    <form method="post" action="index.php?controller=account">
        <input type="hidden" name="action" value="login">

        <label for="email">Email</label>
        <input id="email" name="email" type="email" value="<?= e($email ?? '') ?>">
        <span class="field-error"><?= e($errors['email'] ?? '') ?></span>

        <label for="password">Password</label>
        <input id="password" name="password" type="password">
        <span class="field-error"><?= e($errors['password'] ?? '') ?></span>

        <button type="submit">Login</button>
    </form>

    <p>Do not have an account? <a href="index.php?controller=account&action=register_form">Register</a>.</p>
</section>
<?php include __DIR__ . '/../shared/footer.php'; ?>
