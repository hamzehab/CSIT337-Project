<?php
    function get_categories() {
        global $db;
        $query = 'SELECT * FROM categories ORDER BY categoryID';
        $statement = $db->prepare($query);
        $statement->execute();
        $categories = $statement->fetchAll();
        $statement->closeCursor();
        return $categories;
    }

    function get_category_name($category_id) {
        global $db;
        $query = 'SELECT * FROM categories
                WHERE categoryID = :category_id';    
        $statement = $db->prepare($query);
        $statement->bindValue(':category_id', $category_id);
        $statement->execute();    
        $category = $statement->fetch();
        $statement->closeCursor();    
        $category_name = $category['categoryName'];
        return $category_name;
    }

    function add_category(){
        global $db;
        $category_id = trim(htmlspecialchars(filter_input(INPUT_POST, 'categoryID')));
        $category_name = trim(htmlspecialchars(filter_input(INPUT_POST, 'categoryName')));
        $query = 'INSERT INTO categories VALUES (:categoryID, :categoryName)';
        $statement = $db->prepare($query);
        $statement->execute(array('categoryID' => $category_id, 'categoryName' => $category_name));
        $statement->closeCursor();
    }
?>