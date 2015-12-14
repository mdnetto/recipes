<?php

include_once "models/Chef_Table.class.php";
include_once "models/Recipe_Table.class.php";

$chefTable = new Chef_Table($db);
$recipeTable = new Recipe_Table($db);

$isChefClicked = isset($_GET['chef_id']);
$isRecipeClicked = isset($_GET['recipe_id']);

if ($isChefClicked){
	$chefId = $_GET['chef_id'];
	$chefData = $chefTable->getChef($chefId);
	$recipesByChef = $recipeTable->getAllByChefId($chefId);
	$displayPage = include_once "views/single_chef.php";
} elseif ($isRecipeClicked) {
	$recipeId = $_GET['recipe_id'];
	$recipeData = $recipeTable->getRecipe($recipeId);
	$chefOfRecipe = $chefTable->getChefOfRecipe($recipeId);
	$displayPage = include_once "views/single_recipe.php";
} else {
	$allChefs = $chefTable->getAllChefs();
	$allRecipes = $recipeTable->getAllRecipes();
	$displayPage = include_once "views/all_chefs.php";
	$displayPage .= include_once "views/all_recipes.php";
}

return $displayPage;