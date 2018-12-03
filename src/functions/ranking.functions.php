<?php

/**
 * @param $database PDO
 */
function updateRankings($database){
    $sql = file_get_contents('sql/dropRanks.sql');
    $statement = $database->prepare($sql);
    $statement->execute();

    $sql = file_get_contents('sql/createRanks.sql');
    $statement = $database->prepare($sql);
    $statement->execute();

    $sql = file_get_contents('sql/populateRanks.sql');
    $statement = $database->prepare($sql);
    $statement->execute();
}