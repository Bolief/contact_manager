<?php
function get_contacts_by_user(int $user_id): array
{
    global $db;

    $query = 'SELECT *
              FROM contacts
              WHERE user_id = :user_id
              ORDER BY last_name, first_name';
    $statement = $db->prepare($query);
    $statement->bindValue(':user_id', $user_id, PDO::PARAM_INT);
    $statement->execute();
    $contacts = $statement->fetchAll();
    $statement->closeCursor();

    return $contacts;
}

function get_contact(int $contact_id, int $user_id): array|false
{
    global $db;

    $query = 'SELECT *
              FROM contacts
              WHERE contact_id = :contact_id
                AND user_id = :user_id';
    $statement = $db->prepare($query);
    $statement->bindValue(':contact_id', $contact_id, PDO::PARAM_INT);
    $statement->bindValue(':user_id', $user_id, PDO::PARAM_INT);
    $statement->execute();
    $contact = $statement->fetch();
    $statement->closeCursor();

    return $contact;
}

function add_contact(array $data): bool
{
    global $db;

    $query = 'INSERT INTO contacts
              (user_id, first_name, last_name, email, phone, address, city, state, zip_code, notes)
              VALUES
              (:user_id, :first_name, :last_name, :email, :phone, :address, :city, :state, :zip_code, :notes)';
    $statement = $db->prepare($query);

    foreach ($data as $key => $value) {
        if ($key === 'user_id') {
            $statement->bindValue(':' . $key, $value, PDO::PARAM_INT);
        } else {
            $statement->bindValue(':' . $key, $value);
        }
    }

    return $statement->execute();
}

function update_contact(array $data): bool
{
    global $db;

    $query = 'UPDATE contacts
              SET first_name = :first_name,
                  last_name = :last_name,
                  email = :email,
                  phone = :phone,
                  address = :address,
                  city = :city,
                  state = :state,
                  zip_code = :zip_code,
                  notes = :notes
              WHERE contact_id = :contact_id
                AND user_id = :user_id';
    $statement = $db->prepare($query);

    foreach ($data as $key => $value) {
        $type = in_array($key, ['contact_id', 'user_id'], true)
            ? PDO::PARAM_INT
            : PDO::PARAM_STR;
        $statement->bindValue(':' . $key, $value, $type);
    }

    return $statement->execute();
}

function delete_contact(int $contact_id, int $user_id): bool
{
    global $db;

    $query = 'DELETE FROM contacts
              WHERE contact_id = :contact_id
                AND user_id = :user_id';
    $statement = $db->prepare($query);
    $statement->bindValue(':contact_id', $contact_id, PDO::PARAM_INT);
    $statement->bindValue(':user_id', $user_id, PDO::PARAM_INT);

    return $statement->execute();
}
