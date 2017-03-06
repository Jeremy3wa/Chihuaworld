<div class="container">
	<div class="main-content">
		<div class="online-strip">
			
			<div class="products-grid">
				<header>
					<h3 class="head text-center">Nos produits</h3>
				</header>
				

				<?php
				if(isset($_GET['recherche']))
				{
					$recherche = mysqli_real_escape_string($db, $_GET["mot"]);
					$res= mysqli_query($db, "SELECT * FROM items WHERE name COLLATE utf8_unicode_ci LIKE '%$recherche%'");
					while($item = mysqli_fetch_object($res, 'Item', [$db])) 
					{  
						require ("views/result.phtml");
					} 
				}
				?>



			</div>

			<br>
			<div class="clearfix"></div>
		</div>

	</div>
	<div>