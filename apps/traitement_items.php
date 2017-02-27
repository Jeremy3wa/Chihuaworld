<?php
if(isset($_POST['name'], $_POST['id_category'], $_POST['stock'], $_POST['price'], $_POST['description'], $_SESSION['id']))
{
	$manager = new ItemManager($db);
	$categoryManager = new categoryManager($db);

	try
	{
		$item = $manager->create($_POST['description'], $_POST['name'], $_POST['id_category'], $_POST['stock'],  $_POST['price']);
		// $description, $name, $id_category, $stock, $price

		if($item)
		{
			header('Location: index.php?page=items&id='.$item->getId());
			exit;
		}
		else
		{
			$errors[] = "Erreur interne(items)";
		}
	}
	catch(Execptions $e)
	{
		$errors = $e->getErrors();
	}
}

?>