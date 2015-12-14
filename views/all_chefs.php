<?php

$chefsFound = isset($allChefs);
if ($chefsFound === false) {
	trigger_error('views/all_chefs_page.php needs $allChefs');
}

// $all_chefs_href = "index.php?page=all_chefs&amp;all_chefs=true";
$chefsHTML = "<ul id='chefs'><h2>Chefs</h2>";

while ($chef = $allChefs->fetchObject()) {
	$href = "index.php?page=all_chefs&amp;chef_id=$chef->chef_id";
	$chefsHTML .= "	<li>
						<p><a href='$href'>$chef->first_name $chef->last_name</a>
						</p>
					</li>";
}
$chefsHTML .= "</ul>";
return $chefsHTML;