<?php

$recipeDataFound = isset($recipeData);

if ($recipeDataFound === False) {
	trigger_error('views/single-recipe-page.php needs an $recipeData object');
}

$href = "index.php?chef_id=$chefOfRecipe->chef_id";

return "<article>
			<h1>$recipeData->title</h1>
			<p>$recipeData->description</p>
			<p>Chef: <a href='$href'>$chefOfRecipe->first_name $chefOfRecipe->last_name</a>
			<p>Time: $recipeData->time minutes</p>
			<p>Serves $recipeData->serves people </p>
			<p>Ingredients: $recipeData->ingredients</p>
			<p>Method: $recipeData->method</p>
		</article>";