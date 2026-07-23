<?php $page_title = 'Edit Contact'; include __DIR__ . '/../shared/header.php'; ?>
<section class="card narrow">
    <h2>Edit Contact</h2>
    <form method="post" action="index.php?controller=contacts">
        <input type="hidden" name="action" value="update">
        <input type="hidden" name="contact_id" value="<?= (int) $contact['contact_id'] ?>">

        <label for="first_name">First Name</label>
        <input id="first_name" name="first_name" value="<?= e($contact['first_name']) ?>">
        <span class="field-error"><?= e($errors['first_name'] ?? '') ?></span>

        <label for="last_name">Last Name</label>
        <input id="last_name" name="last_name" value="<?= e($contact['last_name']) ?>">
        <span class="field-error"><?= e($errors['last_name'] ?? '') ?></span>

        <label for="email">Email</label>
        <input id="email" name="email" type="email" value="<?= e($contact['email']) ?>">
        <span class="field-error"><?= e($errors['email'] ?? '') ?></span>

        <label for="phone">Phone</label>
        <input id="phone" name="phone" placeholder="555-555-5555" value="<?= e($contact['phone']) ?>">
        <span class="field-error"><?= e($errors['phone'] ?? '') ?></span>

        <label for="address">Address</label>
        <input id="address" name="address" value="<?= e($contact['address']) ?>">

        <label for="city">City</label>
        <input id="city" name="city" value="<?= e($contact['city']) ?>">

        <label for="state">State</label>
        <input id="state" name="state" maxlength="30" value="<?= e($contact['state']) ?>">

        <label for="zip_code">ZIP Code</label>
        <input id="zip_code" name="zip_code" placeholder="12345" value="<?= e($contact['zip_code']) ?>">
        <span class="field-error"><?= e($errors['zip_code'] ?? '') ?></span>

        <label for="notes">Notes</label>
        <textarea id="notes" name="notes" rows="5"><?= e($contact['notes']) ?></textarea>

        <button type="submit">Save Changes</button>
    </form>
</section>
<?php include __DIR__ . '/../shared/footer.php'; ?>
