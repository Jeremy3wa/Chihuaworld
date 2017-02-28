<?php
$errors = [];
// try
// {
// 	throw new Exception("Mon message d'erreur YOLO \o/");
// }
// catch(Exception $exception)
// {
// 	$errors[] = $exception->getMessage();
// }
$db = mysqli_connect("192.168.1.52", "e-commerce", "e-commerce", "e-commerce");
session_start();// http://php.net/manual/fr/function.session-start.php
$access = ["items", "login", "register", "item", "edit_item", "command", "create_item"];
$page = "items";
if (isset($_GET['page']) && in_array($_GET['page'], $access)) // http://php.net/manual/fr/function.in-array.php
{
    $page = $_GET['page'];
}
require('models/Exceptions.class.php');
require('models/User.class.php');
require('models/Review.class.php');
require('models/Command.class.php');
require('models/Item.class.php');
require('models/Category.class.php');
require('models/UserManager.class.php');
require('models/ReviewManager.class.php');
require('models/CommandManager.class.php');
require('models/ItemManager.class.php');
require('models/CategoryManager.class.php');
require('apps/traitement_users.php');
require('apps/traitement_reviews.php');
require('apps/traitement_category.php');
require('apps/traitement_items.php');
require('apps/traitement_command.php');






require('apps/skel.php');

?>