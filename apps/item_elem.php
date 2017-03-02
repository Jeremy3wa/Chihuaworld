<?php
$count = 0;
while ($count < count($list))// list.length
{
	$item = $list[$count];
	require('views/item_elem.phtml');
	$count++;
}
?>