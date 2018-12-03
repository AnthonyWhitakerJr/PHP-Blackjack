<?php

function get($key) {
    if(isset($_GET[$key])) {
        return $_GET[$key];
    }

    else {
        return '';
    }
}

function getUser($userId, $database){
    $sql = file_get_contents('sql/getUser.sql');
    $params = array(
        'userId' => $userId
    );
    $statement = $database->prepare($sql);
    $statement->execute($params);
    $user = $statement->fetch(PDO::FETCH_ASSOC);
    return $user;
}