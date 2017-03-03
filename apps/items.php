<?php

if (isset($_GET['id_category']))
{
        $categoryManager = new CategoryManager($db);
        $category = $categoryManager->findById($_GET['id_category']);
        if ($category)
        {
        	$list = $category->getItems();
			require('views/items.phtml');
        }
        else
        {
        	$errors[] = "la catégorie n'existe pas";
        	require('apps/errors.php');
        }

}  
else
{
	$manager = new ItemManager($db);
	$list = $manager->findAll();
	require('views/items.phtml');
}
?>