<?php

function updateDisplayName($userId, $displayName, $database){
    $sql = file_get_contents('sql/updateDisplayName.sql');
    $params = array(
        'userId' => $userId,
        'display_name' => $displayName
    );
    $statement = $database->prepare($sql);
    $statement->execute($params);
}