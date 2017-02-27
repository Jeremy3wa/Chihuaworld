<?php
// var_dump($_POST);
if (isset($_POST['content'], $_POST['id_article'], $_SESSION['id']))
{
	// Etape 2
	$userManager = new UserManager($db);
	$author = $userManager->findById($_SESSION['id']);
	$articleManager = new ArticleManager($db);
	$article = $articleManager->findById($_POST['id_article']);
	$manager = new CommentManager($db);
	try
	{
		// Etape 3
		//           public function create($content, $id_author, $id_article) -> CommentManager.class.php ligne 47
		//           public function create($content, User $author, $id_article) -> CommentManager.class.php ligne 47
		// $comment = $manager->create($_POST['content'], $_SESSION['id'], $_POST['id_article']);
		$comment = $manager->create($_POST['content'], $author, $article);
		if ($comment)
		{
			// Etape 4
			header('Location: index.php?page=article&id='.$comment->getArticle()->getId());
			exit;
		}
		else
		{
			$errors[] = "Erreur interne";
		}
	}
	catch (Exceptions $e)
	{
		$errors = $e->getErrors();
	}
}
?>