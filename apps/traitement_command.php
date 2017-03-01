<?php
if (isset($_POST['price'], $_POST['status'], $_SESSION['id']))
{
	// Etape 2
	$userManager = new UserManager($db);
	$customer = $userManager->findById($_SESSION['id']);
	$manager = new CommentManager($db);
	try
	{
		// Etape 3
		//           public function create($price, $id_author, $status) -> CommentManager.class.php ligne 47
		//           public function create($price, User $author, $status) -> CommentManager.class.php ligne 47
		// $command = $manager->create($_POST['price'], $_SESSION['id'], $_POST['status']);
		$command = $manager->create($_POST['price'], $author, $_POST['status']);
		if ($command)
		{
			// Etape 4
			header('Location: index.php?page=command&id='.$command->getId());
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