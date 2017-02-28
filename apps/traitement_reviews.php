<?php

if (isset($_POST['content'], $_POST['id_item'], $_SESSION['id']))
{
	// Etape 2
	$userManager = new UserManager($db);
	$customer = $userManager->findById($_SESSION['id']);
	$itemManager = new ItemManager($db);
	$item = $itemManager->findById($_POST['id_item']);
	$manager = new ReviewManager($db);
	try
	{
		// Etape 3
		//           public function create($content, $id_author, $id_article) -> CommentManager.class.php ligne 47
		//           public function create($content, User $author, $id_article) -> CommentManager.class.php ligne 47
		// $comment = $manager->create($_POST['content'], $_SESSION['id'], $_POST['id_article']);
		$review = $manager->create($_POST['content'], $customer, $item);
		if ($review)
		{
			// Etape 4
			header('Location: index.php?page=item&id='.$review->getItem()->getId());
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