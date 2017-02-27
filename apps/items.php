<?php
$manager = new ItemManager($db);
$list = $manager->findAll();
// $res = mysqli_query($db, "SELECT articles.*,users.login FROM  articles , users WHERE users.id=articles.id_author");
require('views/items.phtml');
?>