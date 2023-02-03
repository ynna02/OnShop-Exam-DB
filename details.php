<?php
    session_start();    
    require'products.php';

    if(isset($_POST['Process'])){
        if(isset($_SESSION['cartItems'][$_POST['cartkey']][$_POST['radColor']]))
            $_SESSION['cartItems'][$_POST['cartkey']][$_POST['radColor']] += $_POST['qty']; 
        else
            $_SESSION['cartItems'][$_POST['cartkey']][$_POST['radColor']] = $_POST['qty']; 

        $_SESSION['totalQuantity'] += $_POST['qty'];
        header("location: confirm.php");
    }
   


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
        <title>Details | Ynna's Online Shop</title>
    </head>
    <body>
        <form method="post">
            <div class="container">
                <div class="row mt-3">
                    <div class="col-10">
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
                </div>
                <hr>
                <div class="row">
                    <?php   if(isset($_GET['itemkey']) && isset($arrProducts[$_GET['itemkey']])):  ?>
                                <div class="col-md-4 col-sm-6">
                                    <div class="product-grid2">
                                        <div class="product-image2 h-100">
                                            <img class="pic-1 h-100" src="img/<?php echo $arrProducts[$_GET['itemkey']]['img1']; ?>">
                                            <img class="pic-2 h-100" src="img/<?php echo $arrProducts[$_GET['itemkey']]['img2']; ?>">
                                        </div>            
                                    </div>
                                </div>
                                <div class="col-8">
                                    <div class="col-12">
                                        <h1>
                                            <?php 
                                                echo $arrProducts[$_GET['itemkey']]['item']; 
                                            ?>
                                            <span class="badge bg-dark">₱ <?php echo $arrProducts[$_GET['itemkey']]['price']; ?></span>
                                        </h1>
                                        <p>
                                            <?php echo $arrProducts[$_GET['itemkey']]['description']; ?>
                                        </p>
                                         <h3 class="title">Select Size:</h3>
                                          <input type="radio" name="radSize" id="radXS" value="XS" checked>
                                          <label for="radXS" class="pr-3">XS</label>&nbsp;&nbsp;
                                          <input type="radio" name="radSize" id="radSM" value="SM">
                                          <label for="radSM" class="pr-3">SM</label>&nbsp;&nbsp;
                                          <input type="radio" name="radSize" id="radMD" value="MD">
                                          <label for="radMD" class="pr-3">MD</label>&nbsp;&nbsp;
                                          <input type="radio" name="radSize" id="radLG" value="LG">
                                          <label for="radLG" class="pr-3">LG</label>&nbsp;&nbsp;
                                          <input type="radio" name="radSize" id="radXL" value="XL">
                                          <label for="radXL" class="pr-3">XL</label>  &nbsp;&nbsp;                      
                                         <hr>

                          
                                        <label for=""><h3>Enter Quantity:</h3></label><br>
                                        <input type="number" name="qty" id="qty" placeholder="0" min="1" max="100" class="form-control" required><br>
                                        <button class="btn btn-dark btn-lg" type="submit" name="Process">Confirm Product Purchase</button>&nbsp;&nbsp;&nbsp;&nbsp;
                                        <a href="index.php" class="btn btn-danger btn-lg"><i class="fa fa-arrow-left"></i> Cancel / Go Back</a>
                                    </div>
                                </div>
                    <?php  
                        else: ?>
                            <div class="col-12 card p-5">
                            echo "No Product Found!";
                       <?php endif; ?>
                    ?>
                </div>
            </div>  
        </form>
        
        

    </body>
</html>