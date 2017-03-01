<?php
if (isset($_POST['id_item'], $_POST['quantity'], $_SESSION['id'], $_POST['color'], $_POST['size']))
{
	$manager = new CommandManager($db);
	$userManager = new UserManager($db);
	$customer = $userManager->findById($_SESSION['id']);
	$itemManager = new ItemManager($db);
	$item = $itemManager->findById($_POST['id_item']);
	$cart = $customer->getCart();
	try
	{
		if (!$cart)
		{
			$cart = $manager->create($customer);
		}
		$cart->addItem($item);
		$manager->save($cart);
		header('Location: index.php?page=command&id='.$cart->getId());
		exit;
	}
	catch (Exceptions $e)
	{
		$errors = $e->getErrors();
	}
}
?>