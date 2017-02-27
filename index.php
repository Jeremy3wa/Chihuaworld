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
$db = mysqli_connect("localhost", "root", "troiswa", "blog");
session_start();// http://php.net/manual/fr/function.session-start.php
$access = ["articles", "login", "register", "create_article", "edit_article", "article"];
$page = "articles";
if (isset($_GET['page']) && in_array($_GET['page'], $access)) // http://php.net/manual/fr/function.in-array.php
{
    $page = $_GET['page'];
}
require('models/Exceptions.class.php');
require('models/User.class.php');
require('models/Comment.class.php');
require('models/Article.class.php');
require('models/UserManager.class.php');
require('models/CommentManager.class.php');
require('models/ArticleManager.class.php');

require('apps/traitement_articles.php');
require('apps/traitement_users.php');
require('apps/traitement_comments.php');

require('apps/skel.php');
?>