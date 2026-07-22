<?php
function get_user_by_email(string $email): array|false
{
    global $db;

    $query = 'SELECT * FROM users WHERE email = :email';
    $statement = $db->prepare($query);
    $statement->bindValue(':email', $email);
    $statement->execute();
    $user = $statement->fetch();
    $statement->closeCursor();

    return $user;
}

function get_user_by_id(int $user_id): array|false
{
    global $db;

    $query = 'SELECT user_id, first_name, last_name, email, created_at
              FROM users
              WHERE user_id = :user_id';
    $statement = $db->prepare($query);
    $statement->bindValue(':user_id', $user_id, PDO::PARAM_INT);
    $statement->execute();
    $user = $statement->fetch();
    $statement->closeCursor();

    return $user;
}

function add_user(string $first_name, string $last_name, string $email, string $password_hash): bool
{
    global $db;

    $query = 'INSERT INTO users (first_name, last_name, email, password_hash)
              VALUES (:first_name, :last_name, :email, :password_hash)';
    $statement = $db->prepare($query);
    $statement->bindValue(':first_name', $first_name);
    $statement->bindValue(':last_name', $last_name);
    $statement->bindValue(':email', $email);
    $statement->bindValue(':password_hash', $password_hash);

    return $statement->execute();
}

function update_user(int $user_id, string $first_name, string $last_name, string $email): bool
{
    global $db;

    $query = 'UPDATE users
              SET first_name = :first_name,
                  last_name = :last_name,
                  email = :email
              WHERE user_id = :user_id';
    $statement = $db->prepare($query);
    $statement->bindValue(':first_name', $first_name);
    $statement->bindValue(':last_name', $last_name);
    $statement->bindValue(':email', $email);
    $statement->bindValue(':user_id', $user_id, PDO::PARAM_INT);

    return $statement->execute();
}

function update_password(int $user_id, string $password_hash): bool
{
    global $db;

    $query = 'UPDATE users
              SET password_hash = :password_hash
              WHERE user_id = :user_id';
    $statement = $db->prepare($query);
    $statement->bindValue(':password_hash', $password_hash);
    $statement->bindValue(':user_id', $user_id, PDO::PARAM_INT);

    return $statement->execute();
}
