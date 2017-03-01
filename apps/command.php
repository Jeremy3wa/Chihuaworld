<?php
if (isset($_SESSION['id']))
{
	require('views/command.phtml');
}
else
{
	$errors[]="Vous devez etre connecté pour pouvoir accés au panier";	
}
?>