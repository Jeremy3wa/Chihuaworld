<?php
$list = $item->getReview();
var_dump($_POST);
$count = 0;
while ($count < count($list))// list.length
{
	$review = $list[$count];
	require('views/reviews.phtml');
	$count++;
}
?>