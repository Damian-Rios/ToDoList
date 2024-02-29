<?php

require('model/database.php');
require('model/todolist_db.php');

$description = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_SPECIAL_CHARS);
$item_title = filter_input(INPUT_POST, 'item_title', FILTER_SANITIZE_SPECIAL_CHARS);

$item_num = filter_input(INPUT_POST, 'item_num', FILTER_VALIDATE_INT);
if (!$item_num) {
    $item_num = filter_input(INPUT_GET, 'item_num', FILTER_VALIDATE_INT);
}

$action = filter_input(INPUT_POST, 'action', FILTER_UNSAFE_RAW);
if (!$action) {
    $action = filter_input(INPUT_GET, 'action', FILTER_UNSAFE_RAW);
    if (!$action) {
        $action = 'list_items';
    }
}

switch ($action) {
    case 'view_list':
        $items = get_items();
        include('view/item_list.php');
        break;

    case 'add_item':
        if ($item_title && !empty($description)) {
            add_item($item_title, $description);
            header("Location: .?action=list_items&item_title=" . $item_title);
            exit();
        } else {
            $error_message = "Invalid item data. Check all fields and try again.";
            include("view/error.php");
            exit();
        }
        break;

    case 'delete_item':
        if ($item_num) {
            try {
                delete_item($item_num);
                header("Location: .?action=list_items");
                exit();
            } catch (PDOException $e) {
                $error = "You cannot delete this item";
                include ('view/error.php');
                exit();
            }
        }
        break;
    
    default:
        $items = get_items();
        include("view/item_list.php");
}