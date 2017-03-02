<?php

if (isset($_GET['id_category']))
{
        $categoryManager = new CategoryManager($db);
        $category = $categoryManager->findById($_GET['id_category']);
        $list = $category->getItems();
		require('views/items.phtml');        
}
else
{
	$manager = new ItemManager($db);
	$list = $manager->findAll();
	require('views/items.phtml');
}
?>