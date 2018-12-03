<?php
function getLeaders($database) {
    $sql = file_get_contents('sql/getLeaders.sql');
    $statement = $database->prepare($sql);
    $statement->execute();
    $leaders = $statement->fetchAll(PDO::FETCH_ASSOC);
    return $leaders;
}