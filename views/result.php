<?php
if(isset($_GET['recherche']))
{
  $recherche = $_GET["mot"];
  $res= mysqli_query($db, "SELECT * FROM items WHERE name COLLATE utf8_unicode_ci LIKE '%$recherche%'");
  while($item = mysqli_fetch_object($res, 'Item', [$db])) 
  {  
    require ("views/result.phtml");
  } 
}
?>