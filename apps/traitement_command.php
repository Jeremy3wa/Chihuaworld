<?php
if (isset($_POST['id_item'], $_POST['quantity'], $_SESSION['id'], $_POST['color'], $_POST['size']))
{
	$manager = new CommandManager($db);
	$userManager = new UserManager($db);
	$customer = $userManager->findById($_SESSION['id']);
	$itemManager = new ItemManager($db);
	$item = $itemManager->findById($_POST['id_item']);
	$stock =intval($_POST['quantity']);
	if ($stock <= 0)
	{
		$errors[] = 'Quantite invalide';
	}
	else
	{
		$cart = $customer->getCart();
		try
		{
			if (!$cart)
			{
				$cart = $manager->create($customer);
			}
			if($item->getStock()>=$stock)
			{
				$count=0;
				while($count < $stock)
				{
					$cart->addItem($item);
					$count++;

				}
				$manager->save($cart);
				header('Location: index.php?page=command&id='.$cart->getId());
				exit;
			}
			else
			{
				$errors[] = "Quantity superieur au stock";
			}
		}
		catch (Exceptions $e)
		{
			$errors = $e->getErrors();
		}
	}
}

?>