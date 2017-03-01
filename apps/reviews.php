<?php
$list = $item->getReview();
$count = 0;
while ($count < count($list))// list.length
{
	$review = $list[$count];
	require('views/reviews.phtml');
	$count++;
}
?>