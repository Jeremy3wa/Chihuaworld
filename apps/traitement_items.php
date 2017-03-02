<?php
var_dump($_POST);
if(isset($_POST['description'], $_POST['name'], $_POST['id_category'], $_POST['stock'], $_POST['size'], $_POST['price'], $_SESSION['id']))
{
	$manager = new ItemManager($db);
	$categoryManager = new CategoryManager($db);
	$category = $categoryManager->findById($_POST['id_category']);

	try
	{
		$item = $manager->create($_POST['description'], $_POST['name'], $category, $_POST['stock'], $_POST['size'], $_POST['price']);
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
	catch(Exceptions $e)
	{
		$errors = $e->getErrors();
	}
}

?>