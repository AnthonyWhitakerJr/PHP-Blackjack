<?php

function get($key) {
    if (isset($_GET[$key])) {
        return $_GET[$key];
    } else {
        return '';
    }
}

function getUser($userId, $database) {
    $sql = file_get_contents('sql/getUser.sql');
    $params = array(
        'userId' => $userId
    );
    $statement = $database->prepare($sql);
    $statement->execute($params);
    $user = $statement->fetch(PDO::FETCH_ASSOC);
    return new User(
        $user['id'],
        $user['username'],
        $user['display_name'],
        $user['profile_pic_uri'],
        $user['bank'],
        $user['net_earnings'],
        $user['last_borrow'],
        $user['last_active']
    );
}