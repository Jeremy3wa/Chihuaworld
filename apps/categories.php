

<?php
$list = $category->getCategory();
$count = 0;
while ($count < count($list))// list.length
{
	$review = $list[$count];
	require('views/categories.phtml');
	$count++;
}
?>