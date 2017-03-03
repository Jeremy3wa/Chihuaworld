<?php
if (isset($_GET['id']))
{
	$manager = new CommandManager($db);
	$command = $manager->findById($_GET['id']);
	if ($command)
	{
		$list = $command->getItemNbr();
		foreach ($list AS $item)
		{
			require('views/command_elem.phtml');
		}
	}
}
?>