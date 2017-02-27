<?php
// Etape 1
if (isset($_POST['name'], $_POST['description'], $_SESSION['id']))
{
	// Etape 2
	$manager = new CategoryManager($db);
	// Etape 3
	try
	{
		$article = $manager->create($_POST['name'], $_POST['description']);
		if ($article)
		{
			// Etape 4
			header('Location: index.php?page=category&id='.$article->getId());
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