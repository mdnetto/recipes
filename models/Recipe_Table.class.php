<?php

include_once "models/Tables.class.php";

class recipe_Table extends Tables {

    public function getAllRecipes() {
        $sql = "SELECT recipe_id, title, description
                FROM recipes";
        $statement = $this->makeStatement($sql);
        return $statement;
    }

    public function getRecipe($recipe_id) {
        $sql = "SELECT recipe_id, title, description, time, serves, ingredients, method, chef_id
                FROM recipes
                WHERE recipe_id = ?";
        $data = array($recipe_id);
        $statement = $this->makeStatement($sql, $data);
        $model = $statement->fetchObject();
        return $model;
    }

    public function getAllByChefId($chef_id) {
        $sql = "SELECT recipe_id, title, description
                FROM recipes
                WHERE chef_id = ?";
        $data = array($chef_id);
        $statement = $this->makeStatement($sql, $data);
        return $statement;
    }

    public function addRecipe($title, $description, $ingredients, $method, $time, $serves, $chef_id) {
        $sql = "INSERT INTO recipes (title, description, ingredients, method, time, serves, chef_id)
                VALUES (?,?,?,?,?,?,?)";
        $data = array($title, $description, $ingredients, $method, $time, $serves, $chef_id);
        $statement = $this->makeStatment($sql, $data);
        return $this->db->lastInsertId();
    }
}