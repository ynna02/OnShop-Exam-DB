<?php
    session_start();
    require'products.php';

    $_SESSION['totalAmount'] = 0;

    if(isset($_POST['btnUpdate'])) {
        if(isset($_POST['hdnKey'])&&isset($_POST['hdnColor'])&& isset( $_POST['txtQuantity'])) {
            $cartKeys = $_POST['hdnKey'];
            $cartColor = $_POST['hdnColor'];
            $cartQuantities = $_POST['txtQuantity'];
        }
        if(isset($cartKeys) && isset($cartColor) && isset($cartQuantities)) {
            
            $_SESSION['totalQuantity'] = 0;

            foreach($cartKeys as $index => $key) {
                print_r($_SESSION['cartItems']);
                $_SESSION['cartItems'][$key][$cartColor[$index]] = $cartQuantities[$index];
                $_SESSION['totalQuantity'] += $cartQuantities[$index];
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/css/bootstrap.min.css" integrity="sha512-P5MgMn1jBN01asBgU0z60Qk4QxiXo86+wlFahKrsQf37c9cro517WzVSPPV1tDKzhku2iJ2FVgL67wG03SGnNA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link rel="stylesheet" href="css/styles.css">
        <title>Cart | ArmYourSelf</title>
    </head>
    <body>
        <form method="post">
            <div class="container">
                <div class="row mt-5">
                    <div class="col-10">
                        <h1><i class="fa-solid fa-gun"></i>ArmYouSelf</h1>
                    </div>
                    <div class="col-2 text-right">
                        <a href="cart.php" class="btn btn-primary">
                            <i class="fa fa-shopping-cart"></i> Cart
                            <span class="badge badge-light">
                                <?php echo (isset($_SESSION['totalQuantity']) ? $_SESSION['totalQuantity'] : "0"); ?>
                            </span>
                        </a>
                    </div>            
                </div>
                <hr>

                <div class="row">
                    <div class="col-12">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col-1"> </th>
                                    <th scope="col-3">Product</th>
                                    <th scope="col-1">Size</th>
                                    <th scope="col-2">Quantity</th>
                                    <th scope="col-2">Price</th>
                                    <th scope="col-2">Total</th>
                                    <th scope="col-1"> </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(isset($_SESSION['cartItems'])): ?>
                                    <?php foreach($_SESSION['cartItems'] as $key => $value): ?>
                                        <?php foreach($value as $color => $quantity): ?>
                                            <?php $_SESSION['totalAmount'] += $arrProducts[$key]['price'] * $quantity; ?>                                       
                                            <tr>                                        
                                                <td><img src="img/<?php echo $arrProducts[$key]['photo1']; ?>" class="img-thumbnail" style="height: 50px;"></td>
                                                <td><?php echo $arrProducts[$key]['name']; ?></td>
                                                <td><?php echo $color; ?></td>
                                                <td>
                                                    <input type="hidden" name="hdnKey[]" value="<?php echo $key; ?>">
                                                    <input type="hidden" name="hdnColor[]" value="<?php echo $color; ?>">
                                                    <input type="number" name="txtQuantity[]" value="<?php echo $quantity; ?>" class="form-control text-center" min="1" max="100" required style="width: 150px;">
                                                </td>
                                                <td>₱ <?php echo number_format($arrProducts[$key]['price'], 2); ?></td>
                                                <td>₱ <?php echo number_format($arrProducts[$key]['price'] * $quantity, 2); ?></td>
                                                <td><a href="remove_confirm.php?<?php echo 'delkey=' . $key . '&c=' . $color . '&q=' . $quantity; ?>" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php endforeach; ?>
                                    <?php if($_SESSION['totalQuantity'] == 0){ ?>
                                            <tr>
                                                <td colspan="7"> Cart is Empty!</td>
                                            </tr>
                                    <?php }else{ ?>
                                            <tr>
                                                <td colspan="2"> </td>
                                                <td><b>Total</b></td>
                                                <td><?php echo $_SESSION['totalQuantity']; ?></td>
                                                <td>----</td>
                                                <td><b>₱ <?php echo number_format($_SESSION['totalAmount'], 2); ?><b></td>
                                                <td>----</td>
                                            </tr>
                                    <?php  }
                                        ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="7" class="text-center">Cart is still Empty</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>                
                    </div>            
                </div>

                <div class="row">
                    <div class="col-12 col-sm-12 col-md-4 col-lg-4">
                        <a href="index.php" class="btn btn-danger btn-lg btn-block"><i class="fa fa-shopping-bag"></i> Continue Shopping</a>
                    </div>
                    <?php if(isset($_SESSION['cartItems'])): ?>
                        <div class="col-12 col-sm-12 col-md-4 col-lg-4">
                            <button type="submit" name="btnUpdate" class="btn btn-success btn-lg btn-block"><i class="fa fa-edit"></i> Update Cart</button>
                        </div>
                        <div class="col-12 col-sm-12 col-md-4 col-lg-4">
                            <a href="checkout.php" class="btn btn-primary btn-lg btn-block"><i class="fa fa-sign-out-alt"></i> Checkout</a>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </form>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.bundle.min.js" integrity="sha512-wV7Yj1alIZDqZFCUQJy85VN+qvEIly93fIQAN7iqDFCPEucLCeNFz4r35FCo9s6WrpdDQPi80xbljXB8Bjtvcg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    </body>
</html>