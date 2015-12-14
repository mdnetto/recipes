<?php

$chefDataFound = isset($chefData);

if ($chefDataFound === false) {
	trigger_error('views/single-chef-page.php needs an $chefData object');
}

$content = "<article>
			<h1>$chefData->first_name $chefData->last_name </h1>
			</article>";

if ($recipesByChef->rowCount() <= 0) {
	$content .= "<ul>There are no recipes for this Chef<ul>";
} else {
	$content .= "<ul id='recipes'><h3>Recipes</h3>";
	while ($recipe = $recipesByChef->fetchObject()) {
		$href = "index.php?recipe_id=$recipe->recipe_id";
		$content .= "<li>
						<p><a href='$href'>$recipe->title </a>
						</p><p>$recipe->description</p>
					</li>";
	}
	$content .= "</ul>";
}

return $content;