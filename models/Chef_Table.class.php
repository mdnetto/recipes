<?php

include_once "models/Tables.class.php";

class chef_Table extends Tables {

    public function getAllChefs() {
        $sql = "SELECT chef_id, first_name, last_name
                FROM chefs";
        $statement = $this->makeStatement($sql);
        return $statement;
    }

    public function getChef($chef_id) {
        $sql = "SELECT chef_id, first_name, last_name
                FROM chefs
                WHERE chef_id = ?";
        $data = array($chef_id);
        $statement = $this->makeStatement($sql, $data);
        $model = $statement->fetchObject();
        return $model;
    }

    public function getChefOfRecipe($recipe_id) {
        $sql = "SELECT chefs.first_name, chefs.last_name, chefs.chef_id
                FROM chefs, recipes
                WHERE recipes.recipe_id = ?
                AND chefs.chef_id = recipes.chef_id";
        $data = array($recipe_id);
        $statement = $this->makeStatement($sql, $data);
        $model = $statement->fetchObject();
        return $model;
    }

    public function joinChefsToRecipes($search) {
        $sql = "SELECT recipes.title,  recipes.description, recipes.recipe_id, chefs.first_name, chefs.last_name, chefs.chef_id
                FROM recipes
                INNER JOIN chefs
                ON recipes.chef_id = chefs.chef_id
                WHERE recipes.title like '%$search%'
                OR recipes.description like '%$search%'
                OR recipes.ingredients like '%$search%'
                OR chefs.first_name like '%$search%'
                OR chefs.last_name like '%$search%'";
        $data = array($search);
        $statement = $this->makeStatement($sql, $data);
        return $statement;
    }
}