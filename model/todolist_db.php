<?php

function get_items()
{
    global $db;
    $query = 'SELECT * FROM todoitems ORDER BY ItemNum';
    $statement = $db->prepare($query);
    $statement->execute();
    $items = $statement->fetchAll();
    $statement->closeCursor();
    return $items;
}

function get_item_name($item_title)
{
    if (!$item_title) {
        return "All Items";
    }
    global $db;
    $query = 'SELECT * FROM todoitems WHERE Title = :item_title';
    $statement = $db->prepare($query);
    $statement->bindValue(':item_title', $item_title);
    $statement->execute();
    $item = $statement->fetch();
    $statement->closeCursor();
    $itemTitle = $item['itemTitle'];
    return $itemTitle;
}

function delete_item($item_num){
    global  $db;

    $query = 'DELETE FROM todoitems WHERE ItemNum = :item_num';

    $statement = $db->prepare($query);
    $statement->bindValue(':item_num', $item_num);
    
    $statement->execute();
    $statement->closeCursor();
}

function add_item($item_title, $description){
    global  $db;

    $query = 'INSERT INTO todoitems (Description, Title) VALUES (:descr, :title)';

    $statement = $db->prepare($query);
    $statement->bindValue(':descr', $description);
    $statement->bindValue(':title', $item_title);
    
    $statement->execute();
    $statement->closeCursor();
}
?>