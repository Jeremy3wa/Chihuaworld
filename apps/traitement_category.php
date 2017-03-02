<?php
// Etape 1
if (isset($_POST['action']))
{
	$action = $_POST['action'];
	if ($action == "create_category")
	{
		if (isset($_POST['name'], $_POST['description'], $_SESSION['id']))
		{
			// Etape 2
			$manager = new CategoryManager($db);
			// Etape 3
			try
			{
				$category = $manager->create($_POST['description'], $_POST['name']);
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
	}
}

?>