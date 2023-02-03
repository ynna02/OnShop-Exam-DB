<?php
    session_start();
    require'products.php';


?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link rel="stylesheet" href="css/shoppingcart.css">
        <title>Little Bo-Tique | Ynna's Online Shop</title>
    </head>
    <body>
        <div class="container">
            <div class="row mt-3">
                <div class="col-8">
                    <h1><i class="fa-solid fa-person-dress"></i>&nbsp;</i>Little Bo-Tique</h1>
                </div>
                <div class="col-2 text-right">
                    <a href="cart.php" class="btn btn-primary">
                        <i class="fa fa-shopping-cart"></i> Cart
                        <span class="badge bg-light text-dark">
                            <?php echo (isset($_SESSION['totalQuantity']) ? $_SESSION['totalQuantity'] : "0"); ?>
                        </span>
                    </a>
                            
                </div>        
                <div class="col-2 text-right">
                    <a href="login-admin.php" class="btn btn-secondary">
                        <i class="fa-solid fa-right-to-bracket"></i> Login
                    </a>
                            
                </div>          
            </div>
            <hr> 
            <div class="row">
                    <?php
                        if(isset($arrProducts))
                            foreach($arrProducts as $key => $product) {
                    ?>
                                <div class="col-md-3 col-sm-6">
                                    <div class="product-grid2">
                                        <div class="product-image2">
                                            <a href="details.php?itemkey=<?php echo $key; ?>">
                                                <img class="pic-1" src="img/<?php echo $product['img1']; ?>">
                                                <img class="pic-2" src="img/<?php echo $product['img2']; ?>">
                                            </a>
                                            <a class="add-to-cart" href="details.php?itemkey=<?php echo $key; ?>">
                                                <i class="fa-solid fa-cart-shopping"></i>
                                                Add to cart
                                            </a>
                                        </div>
                                        <div class="product-content">
                                            <h3 class="title">
                                                <?php echo $product['item']; ?>
                                                <span class="badge bg-dark">₱<?php echo $product['price']; ?></span>
                                            </h3>
                                            
                                        </div>
                                    </div>
                                </div>
                        <?php
                            }else{
                                echo ('No Product Detected!');
                            }
                        ?>
        </div>

        <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
        <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    </body>
</html>