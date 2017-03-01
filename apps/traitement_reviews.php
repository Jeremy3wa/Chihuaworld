<?php
if (isset($_POST['content'], $_SESSION['id'], $_POST['id_item'], $_POST['rate']))
{
	$manager = new ReviewManager($db);
	$userManager = new UserManager($db);
	$customer = $userManager->findById($_SESSION['id']);
	$itemManager = new ItemManager($db);
	$item = $itemManager->findById($_POST['id_item']);
	try
	{
		$review = $manager->create($_POST['content'], $customer, $item, $_POST['rate']);
		if ($review)
		{
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