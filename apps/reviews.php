<?php
// $res = mysqli_query($db, "SELECT comments.*, users.login FROM comments, users WHERE users.id=comments.id_author AND comments.id_article=".$article['id']);
// while ($comment = mysqli_fetch_assoc($res))
// {
// 	require('views/comment.phtml');
// }
// $manager = new CommentManager($db);
// $list = $manager->findByArticle($article);
$list = $item->getReview();
$count = 0;
while ($count < count($list))// list.length
{
	$review = $list[$count];
	require('views/reviews.phtml');
	$count++;
}
?>