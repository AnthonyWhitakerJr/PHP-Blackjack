<?php
function isUsernameAvailable($username, $database) {
    $sql = file_get_contents('sql/usernameCount.sql');
    $params = array(
        'username' => $username
    );
    $statement = $database->prepare($sql);
    $statement->execute($params);
    $result = $statement->fetch(PDO::FETCH_ASSOC);
    return $result["count(*)"] == 0;
}

function createUser($username, $password, $displayName, $database) {
    $sql = file_get_contents('sql/createUser.sql');
    $params = array(
        'username' => $username,
        'password' => $password,
        'displayName' => $displayName
    );

    $statement = $database->prepare($sql);
    $statement->execute($params);
}