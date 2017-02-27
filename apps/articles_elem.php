<?php
/*while ($article = mysqli_fetch_assoc($res))
{
	require('views/articles_elem.phtml');
}*/
$count = 0;
while ($count < count($list))// list.length
{
	$article = $list[$count];
	require('views/articles_elem.phtml');
	$count++;
}
?>