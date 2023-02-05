<!DOCTYPE html>
<html>
<head>
	<title>ZOMATO</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

</head>
<body>
	<nav class="navbar bg-nav" style="background-color: #E23744;color: white">

		<a href="zomato_index.php"><h1 class="navbar-brand" style="color: white;"><b>Zomato</b></h1></a>
		<?php
			if($is_logged_in){
					echo '<div class="dropdown mr-5">
							  <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							    '."Hi ".$_SESSION['name'].'
							  </button>
							  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                              <a class="dropdown-item" href="zomato_index.php"><i class="fas fa-house-user"></i> Home </a>
							  	<a class="dropdown-item" href="Profile.php"><i class="fas fa-user-circle"></i> Profile</a>
							    <a class="dropdown-item" href="cart.php"><i class="fas fa-shopping-cart"></i> Cart</a>
							    <a class="dropdown-item" href="orders.php"><i class="fas fa-utensils"></i> Orders</a>
							    <a class="dropdown-item" href="zom_logout.php"><i class="fas fa-sign-out-alt"></i> Logout </a>
							  </div>
							</div>';

			}else{
				echo '
                <div class="d-flex">
                <a class="px-3" href="zom_registration.php"><h5 class="text-white">Sign Up</h5></a>
                <a class="px-3" href="zom_login.php"><h5 class="text-white mr-1">Login</h5></a>
                </div>
					 ';
			}
		?>

	</nav>

</body>
</html>
