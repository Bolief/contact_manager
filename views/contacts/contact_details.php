<?php $page_title = 'Contact Details'; include __DIR__ . '/../shared/header.php'; ?>
<section class="card">
    <h2><?= e($contact['first_name'] . ' ' . $contact['last_name']) ?></h2>

    <dl class="details">
        <dt>Email</dt><dd><?= e($contact['email']) ?></dd>
        <dt>Phone</dt><dd><?= e($contact['phone']) ?></dd>
        <dt>Address</dt><dd><?= e($contact['address']) ?></dd>
        <dt>City</dt><dd><?= e($contact['city']) ?></dd>
        <dt>State</dt><dd><?= e($contact['state']) ?></dd>
        <dt>ZIP Code</dt><dd><?= e($contact['zip_code']) ?></dd>
        <dt>Notes</dt><dd><?= nl2br(e($contact['notes'])) ?></dd>
    </dl>

    <div class="actions">
        <a class="button" href="index.php?controller=contacts&action=edit_form&contact_id=<?= (int) $contact['contact_id'] ?>">Edit</a>
        <a class="button secondary" href="index.php?controller=contacts&action=list">Back</a>
    </div>
</section>
<?php include __DIR__ . '/../shared/footer.php'; ?>
