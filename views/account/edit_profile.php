<?php $page_title = 'Edit Profile'; include __DIR__ . '/../shared/header.php'; ?>
<section class="card narrow">
    <h2>Edit Profile</h2>

    <form method="post" action="index.php?controller=account">
        <input type="hidden" name="action" value="update_profile">

        <label for="first_name">First Name</label>
        <input id="first_name" name="first_name" value="<?= e($first_name) ?>">
        <span class="field-error"><?= e($errors['first_name'] ?? '') ?></span>

        <label for="last_name">Last Name</label>
        <input id="last_name" name="last_name" value="<?= e($last_name) ?>">
        <span class="field-error"><?= e($errors['last_name'] ?? '') ?></span>

        <label for="email">Email</label>
        <input id="email" name="email" type="email" value="<?= e($email) ?>">
        <span class="field-error"><?= e($errors['email'] ?? '') ?></span>

        <button type="submit">Save Changes</button>
    </form>
</section>
<?php include __DIR__ . '/../shared/footer.php'; ?>
