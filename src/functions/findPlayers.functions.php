<?php

function searchPlayers($term, $database) {
    // Get list of books
    $term = '%' . $term . '%';
    $sql = file_get_contents('sql/findPlayers.sql');
    $params = array(
        'term' => $term
    );
    $statement = $database->prepare($sql);
    $statement->execute($params);
    $players = $statement->fetchAll(PDO::FETCH_ASSOC);
    return $players;
}