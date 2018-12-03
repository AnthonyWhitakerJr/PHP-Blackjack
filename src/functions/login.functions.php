<?php

/**
 * Query records that have usernames and passwords that match those in the users table.
 * @param $username
 * @param $password
 * @param PDO $database
 * @return int |null User id if match is found; null otherwise.
 */
function attemptLogin($username, $password, PDO $database) {
    $sql = file_get_contents('sql/attemptLogin.sql');
    $params = array(
        'username' => $username,
        'password' => $password
    );
    $statement = $database->prepare($sql);
    $statement->execute($params);
    $users = $statement->fetchAll(PDO::FETCH_ASSOC);

    if (!empty($users)) {
        $user = $users[0];

        return $user['id'];
    }

    return null;
}