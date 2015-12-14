<?php

$recipesFound = isset($allRecipes);
if ($recipesFound === false) {
	trigger_error('views/all_recipes_page.php needs $allRecipes');
}
$recipesHTML = "<ul id='recipes'><h2>Recipes</h2>";

while ($recipe = $allRecipes->fetchObject()) {
	$href = "index.php?page=all_content&amp;recipe_id=$recipe->recipe_id";
	$recipesHTML .= "	<li>
							<p><a href='$href'>$recipe->title</a>
							</p>
						<p>$recipe->description</p>
					</li>";
}
$recipesHTML .= "</ul>";
return $recipesHTML;