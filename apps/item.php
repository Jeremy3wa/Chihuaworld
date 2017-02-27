<?php
if (isset($_GET['id']))
{
	$manager = new ItemManager($db);
	$item = $manager->findById($_GET['id']);
	// $id = intval($_GET['id']);
	// $res = mysqli_query($db, "SELECT articles.*,users.login FROM articles, users WHERE users.id=articles.id_author AND articles.id=".$id);
	// $article = mysqli_fetch_assoc($res);
	if ($item)
	{
		require('views/item.phtml');
	}
	else
	{
		$errors[] = "Le produit n'existe pas";
		require('apps/errors.php');
	}
}
else
{
	$errors[] = "Le produit n'existe pas";
	require('apps/errors.php');
}
?>
