<?php

error_reporting(E_ALL);
ini_set("display_errors", 1);
include_once "models/Page_Data.class.php";

$pageData = new Page_Data();

$pageData->title = "My favorite recipes";
$pageData->addCSS("css/styles.css");

$dbInfo = "mysql:host=localhost;dbname=recipes";
$dbUser = "root";
$dbPassword = "";
$db = new PDO($dbInfo, $dbUser, $dbPassword);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$pageData->content .=
"    <form action='search.php' method='GET'>
        <div style='text-align: center'>
            <h1> Search for Recipes or Chefs</h1>
            <input class='text-box' type='text' size='90' name='search'>
            <input class='search-button' type='submit' name='submit' value='Search'>
        </div>
    </form>
";
$pageData->content .= include_once "controllers/all_content.php";

$page = include_once "views/page.php";
echo $page;
