<?php
// Etape 1
if (isset($_POST['title'], $_POST['content'], $_SESSION['id']))
{
	// Etape 2
	$manager = new ArticleManager($db);
	$userManager = new UserManager($db);
	$author = $userManager->findById($_SESSION['id']);
	// Etape 3
	try
	{
		$article = $manager->create($_POST['content'], $_POST['title'], $author);
		if ($article)
		{
			// Etape 4
			header('Location: index.php?page=article&id='.$article->getId());
			exit;
		}
		else
		{
			$errors[] = "Erreur interne";
		}
	}
	catch (Exceptions $e)// ExceptionS
	{
		$errors = $e->getErrors();// ->getMessage() => ->getErrors()
	}
}
?>