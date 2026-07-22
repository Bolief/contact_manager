<?php $page_title = 'My Account'; include __DIR__ . '/../shared/header.php'; ?>
<section class="card">
    <h2>My Account</h2>

    <dl class="details">
        <dt>Name</dt>
        <dd><?= e($user['first_name'] . ' ' . $user['last_name']) ?></dd>

        <dt>Email</dt>
        <dd><?= e($user['email']) ?></dd>

        <dt>Account Created</dt>
        <dd><?= e($user['created_at']) ?></dd>
    </dl>

    <div class="actions">
        <a class="button" href="index.php?controller=account&action=edit_profile_form">Edit Profile</a>
        <a class="button secondary" href="index.php?controller=account&action=change_password_form">Change Password</a>
    </div>
</section>
<?php include __DIR__ . '/../shared/footer.php'; ?>
