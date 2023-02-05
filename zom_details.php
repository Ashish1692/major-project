<?php
   session_start();
   $conn = mysqli_connect("localhost","ashishAdmin","ashishdb","zomato");

   if(!empty($_SESSION)){
   	$is_logged_in = 1;
   }else{
   	$is_logged_in = 0;
   }

   $product_id = $_GET['id'];

   $query = "SELECT * FROM products WHERE product_id = $product_id";
   $result = mysqli_query($conn,$query);
   $result = mysqli_fetch_assoc($result);

   $user_id = $_SESSION['user_id'];

   $img_path = $result['bg'];

   $query2 = "SELECT * FROM bookmark WHERE user_id = $user_id AND product_id = $product_id";
   $result2 = mysqli_query($conn,$query2);
   $num_rows = mysqli_num_rows($result2);

   $query3 = "SELECT * FROM cart WHERE user_id = $user_id AND product_id = $product_id";
   $result3 = mysqli_query($conn, $query3);
   $num_rows2 = mysqli_num_rows($result3);

?>

<?php include("head.php");?>

<html>
<head>
  <title>ZOMATO</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" rel="stylesheet"/>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
</head>

<style type="text/css">

  .form{
    float: right!important;
    margin-left: 320px;
    margin-top: -350px;
    width: 250px;
    height: 200px;
    font-size: 35px;
  }

</style>


<body>

  <div class="container mt-5">
    <div class="row">
      <div col-6>
        <img style="width: 109%;height: 400px;" src="<?php echo $result['bg']; ?>">
      </div>
      <div class="col-6">
        <h1 class="mt-3" style="font-size: 40px;"><?php echo $result['name']; ?> <small><button class="btn-danger"> <i class="fas fa-star" style="color: #FFCC00;border-radius: 5px;"></i> <?php echo $result['rating']; ?></button></small></h1>
        <h5 style="font-size: 25px;"><?php echo $result['details']; ?></h5>
        <p style="font-size: 20px;">Rs <?php echo $result['price']; ?> for one</p>
        <p style="font-size: 20px;"><?php echo $result['delivery']; ?> min</p>
        <?php

          if ($num_rows2) {
            echo '<small><button>-</button></small> <button class="btn btn-danger btn-lg">Added to Cart <i class="fas fa-shopping-cart"></i></button> <small><button>+</button></small>';
          } else {
            echo ' <small><button>-</button></small> <button id="cart-btn" class="btn btn-danger btn-lg">ADD</button> <small><button>+</button></small>';
          }


        ?>
        <hr>

      </div>
      <div class="form" style="float: right !important;">
        <label><b>Filter :</b></label><br>
        <input type="radio" name="x"> Veg <br>
        <input type="radio" name="x"> Nonveg <br>
        <input type="radio" name="x"> Contains Egg <br>

        <hr>

        <a href="cart.php"><button class="btn btn-danger btn-lg">order</button></a>

      </div>

      <span class="mt-3">
        <?php
        if($num_rows){
          echo '<button class="btn btn-danger btn-lg"><i class="fas fa-bookmark"></i> Bookmarked</button>';
        }else{
          echo '<button id="bookmark-btn" class="btn btn-danger btn-lg"><i class="fas fa-bookmark"></i> Bookmark</button>';
        }

        ?>
        <!-- <a href="review.php"><button class="btn btn-danger btn-lg"><i class="fas fa-star" style="color: white"></i> Add Review</button></a> -->
        <button class="btn btn-danger btn-lg"><i class="fas fa-directions"></i> Directions</button>
        <button class="btn btn-danger btn-lg"><i class="fas fa-share"></i> Share</button>

        <hr>
      </span>

    </div>
  </div>


<script type="text/javascript">
$(document).ready(function(){
  $('#bookmark-btn').click(function(){
     //if else not working here
      $.ajax({
        url: 'add_bookmark.php?product_id=' + <?php echo $product_id; ?>,
        method: 'GET',
        success: function(data) {
          $('#bookmark-btn').text('Bookmarked');
          console.log(data);

        },
        error: function(error) {
          console.log(error);
        }
      })
    })
  $('#cart-btn').click(function(){
      // ajax -> to insert into cart table
      if($('#cart-btn').text() === 'ADD'){
        $.ajax({
          url: 'add_to_cart.php?product_id=' + <?php echo $product_id; ?>,
          method: 'GET',
          success: function(data){
            $('#cart-btn').text('Added to Cart');
          },
          error: function(error){
            console.log(error);
          }
      })

    }

  })

})
</script>

</body>
</html>
