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

    function add_category($categoryName){
        global $db;
        $query = 'INSERT INTO categories (categoryName) VALUES (:categoryName)';
        $statement = $db->prepare($query);
        $statement->execute(array('categoryName' => $categoryName));
        $statement->closeCursor();
    }

    function edit_category($category_id, $categoryName){
        global $db;
        $query = "UPDATE categories SET categoryName = :categoryName WHERE categoryID = :category_id";
        $statement = $db->prepare($query);
        $statement->execute(array('categoryName' => $categoryName, 'category_id' => $category_id));
        $statement->closeCursor();
    }

    function getCategoryName($categoryName){
        global $db;
        $query = "SELECT * FROM categories WHERE categoryName = :categoryName";
        $statement = $db->prepare($query);
        $statement->execute(array('categoryName' => $categoryName));
        $name = $statement->fetchAll();
        $statement->closeCursor();

        return $name;
    }
?>