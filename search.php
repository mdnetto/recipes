<?php

error_reporting(E_ALL);
ini_set("display_errors", 1);

include_once "models/Page_Data.class.php";
include_once "models/Chef_Table.class.php";

$pageData = new Page_Data();
$pageData->title = "Search for recipes";
$pageData->addCSS("css/styles.css");

$page = include_once "views/page.php";
echo $page;

$button = ($_GET['submit']);
$search = ($_GET['search']);

$dbInfo = "mysql:host=localhost;dbname=recipes";
$dbUser = "root";
$dbPassword = "";
$db = new PDO($dbInfo, $dbUser, $dbPassword);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

if(!$button) {
    echo "you didn't submit a keyword";
} else {
    if (strlen($search) <= 1) {
        echo "Search term too short";
        } else {
        echo "You searched for <b> $search </b> <hr size='1' > </ br > ";
        $chefTable = new Chef_Table($db);
        $construct = $chefTable->joinChefsToRecipes($search);
        $rows = $construct->rowCount();

        if ($rows == 0) {
            echo "Sorry, there are no matching result for <b> $search </b>. </br> </br>
                    1. Try more general words. for example: 'chicken' or 'meat loaf' </br>
                    2. Try different words with similar  meaning </br>";
        } else {
            echo "<h2>$rows results found!</h2>";
            while($run = $construct->fetchObject()) {
                $title = $run->title;
                $desc = $run->description;
                $first_name = $run->first_name;
                $last_name = $run->last_name;
                $recipe_id = $run->recipe_id;
                $chef_id = $run->chef_id;
                $recipe_url = "index.php?recipe_id=$recipe_id";
                $chef_url = "index.php?chef_id=$chef_id";
                echo "
                <br>
                    <div>
                        <a href='$recipe_url'>
                            <b>$title</b>
                        </a>
                        <br>$desc<br>
                        <a href='$chef_url'>
                            <b> $first_name $last_name </b>
                        </a>
                    </div>";
            }
        }
    }
}


