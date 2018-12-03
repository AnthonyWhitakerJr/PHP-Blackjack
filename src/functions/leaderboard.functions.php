<?php
function getLeaders($database) {
    $sql = file_get_contents('sql/getLeadersPart1.sql');
    $statement = $database->prepare($sql);
    $statement->execute();
    $statement->fetch(PDO::FETCH_ASSOC);

    $sql = file_get_contents('sql/getLeadersPart2.sql');
    $statement = $database->prepare($sql);
    $statement->execute();
    $leaders = $statement->fetchAll(PDO::FETCH_ASSOC);
    return $leaders;
}