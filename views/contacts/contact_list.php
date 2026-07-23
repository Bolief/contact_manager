<?php $page_title = 'Contacts'; include __DIR__ . '/../shared/header.php'; ?>
<div class="page-heading">
    <h2>My Contacts</h2>
    <a class="button" href="index.php?controller=contacts&action=add_form">Add Contact</a>
</div>

<?php if (!$contacts) : ?>
    <section class="card">
        <p>No contacts have been added yet.</p>
    </section>
<?php else : ?>
    <section class="card table-wrap">
        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($contacts as $contact) : ?>
                <tr>
                    <td><?= e($contact['first_name'] . ' ' . $contact['last_name']) ?></td>
                    <td><?= e($contact['email']) ?></td>
                    <td><?= e($contact['phone']) ?></td>
                    <td class="actions">
                        <a href="index.php?controller=contacts&action=view&contact_id=<?= (int) $contact['contact_id'] ?>">View</a>
                        <a href="index.php?controller=contacts&action=edit_form&contact_id=<?= (int) $contact['contact_id'] ?>">Edit</a>
                        <form class="inline" method="post" action="index.php?controller=contacts">
                            <input type="hidden" name="action" value="delete">
                            <input type="hidden" name="contact_id" value="<?= (int) $contact['contact_id'] ?>">
                            <button class="link-button danger" type="submit">Delete</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </section>
<?php endif; ?>
<?php include __DIR__ . '/../shared/footer.php'; ?>
