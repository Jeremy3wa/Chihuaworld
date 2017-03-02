<?php
// Etape 1
var_dump($_POST);
if (isset($_POST['name_cat'], $_POST['description_cat'], $_SESSION['id']))
{
	// Etape 2
	$manager = new CategoryManager($db);
	// Etape 3
	try
	{
		$category = $manager->create($_POST['name_cat'], $_POST['description_cat']);
		if ($category)
		{
			// Etape 4
			header('Location: index.php?page=category&id='.$category->getId());
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