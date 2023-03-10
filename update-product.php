<?php
    session_start();
    require_once('opencon.php');
    $strsql = "SELECT * FROM tbl_user";

    if($rsUser = mysqli_query($con,$strsql)){
        if(mysqli_num_rows($rsUser)>0){
            while($recUser = mysqli_fetch_array($rsUser)){
                $name = $recUser['name'];
            }
            mysqli_free_result($rsUser);
        }
        else
            echo 'No record found!';
    }
    else
        echo 'ERROR: Could not execute your request!';
    


    require_once('closecon.php');




?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="css/admin-panel.css">
    <title>Update | Little Bo-Tique</title>
</head>
<body>
    <div id="throbber" style="display:none; min-height:120px;"></div>
    <div id="noty-holder"></div>
    <div id="wrapper">
        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <a class="navbar-brand" href="#">
                    <i class="fa-solid fa-person-dress"></i>&nbsp;</i>
                    Little Bo-Tique
                </a>
            </div>
            <!-- Top Menu Items -->
            <ul class="nav navbar-right top-nav">           
                <li class="dropdown">
                    <a href="#" class="" data-toggle="dropdown">Hello, <?php echo $name; ?>!</a>
                </li>
            </ul>
            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav">
                    <li>
                        <a href="dashboard.php" ><i class="fa-solid fa-chart-line"></i> Dashboard </a>
                    </li>
                    <li>
                        <a href="change-password.php" ><i class="fa-solid fa-gear"></i>  Change Password</a>
                    </li>
                    <li>
                        <a href="addproducts.php"><i class="fa-solid fa-store"></i>Products</a>
                    </li>
                    <li>
                        <a href="logout-admin.php"><i class="fa-solid fa-right-from-bracket"></i>Log out</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </nav>

        <div id="page-wrapper">
            <div class="container-fluid">
                <!-- Page Heading -->
                <div class="row" id="main" >
                    <?php
                        if(isset($_GET['k'])){
                            $_SESSION['k'] = $_GET['k'];
                        }

                        require('opencon.php');
                            $strsql = "SELECT * FROM tbl_products WHERE id = ".$_SESSION['k'];
                            if($rsProducts = mysqli_query($con,$strsql)){
                                if(mysqli_num_rows($rsProducts)>0){
                                    $recProducts = mysqli_fetch_array($rsProducts);
                                    
                                    mysqli_free_result($rsProducts);
                                }
                            }

                        require('closecon.php');

                        
            
                        
                        require('opencon.php');
                        if(isset($_POST['btnUpdate'])){
                            $pname = $_POST['productname'];
                            $price = $_POST['productprice'];
                            $description = $_POST['productdescription'];

                            if(isset($_FILES['productphoto1'])){
                                $arrError1 = array();
                                $fileName1 = $_FILES['productphoto1']['name'];
                                $fileSize1 = $_FILES['productphoto1']['size'];
                                $fileTemp1 = $_FILES['productphoto1']['tmp_name'];
                                $fileType1 = $_FILES['productphoto1']['type'];

                                $fileExtTemp1 = explode('.', $fileName1);
                                $fileExt1 = strtolower(end($fileExtTemp1));
                                
                                $allowFiles1 = array('jpg','jpeg','png');
                                $uploadDir1 = 'Image1/';


                                if(in_array($fileExt1,$allowFiles1)=== false)
                                    $arrError1[] = "Extension is not allowed! please use only jpg,jpeg,and png";
                                
                                if($fileSize1 > 10000000)
                                    $arrError1[] = "File size is too big! 10mb is maximum!";
                                
                                if(empty($arrError1)){
                                    move_uploaded_file($fileTemp1, $uploadDir1 . $fileName1);
                                    echo 'file uploaded!';
                                }
                            }else
                                echo 'error';
                                foreach($arrError1 as $key => $value)
                                    echo $value . '<br>';
                                
                            if(isset($_FILES['productphoto2'])){
                                $arrError2 = array();
                                $fileName2 = $_FILES['productphoto2']['name'];
                                $fileSize2 = $_FILES['productphoto2']['size'];
                                $fileTemp2 = $_FILES['productphoto2']['tmp_name'];
                                $fileType2 = $_FILES['productphoto2']['type'];

                                $fileExtTemp2 = explode('.', $fileName2);
                                $fileExt2 = strtolower(end($fileExtTemp2));
                                
                                $allowFiles2 = array('jpg','jpeg','png');
                                $uploadDir2 = 'Image2/';


                                if(in_array($fileExt2,$allowFiles2)=== false)
                                    $arrError2[] = "Extension is not allowed! please use only jpg,jpeg,and png";
                                
                                if($fileSize2 > 10000000)
                                    $arrError2[] = "File size is too big! 10mb is maximum!";
                                
                                if(empty($arrError2)){
                                    move_uploaded_file($fileTemp2, $uploadDir2 . $fileName2);
                                    echo 'file uploaded!';
                                }
                            }else
                                echo 'error';
                                foreach($arrError2 as $key => $value)
                                    echo $value . '<br>';

                            $photo1 = $fileName1;
                            $photo2 = $fileName2;
                            $strsql = "UPDATE tbl_products SET name='$pname', 
                                                                price='$price',
                                                                description='$description',
                                                                photo1='$photo1',
                                                                photo2='$photo2'
                                                                WHERE id = ".$_SESSION['k'];
                            if(mysqli_query($con,$strsql)){
                                header("location:addproducts.php");
                            }
                        }
                        require('closecon.php');

                    ?>
                    <form method="post" enctype="multipart/form-data">
                        <label for="productname">Product Name</label>
                        <input type="text" name="productname" placeholder="Name" required value="<?php echo(isset($recProducts['name'])? $recProducts['name']:'');?>"><br>
                        <label for="productprice">Product Price</label>
                        <input type="number" name="productprice" placeholder="Price" required value="<?php echo(isset($recProducts['price'])? $recProducts['price']:'');?>"><br>
                        <label for="productdescription">Product Description</label>
                        <input type="text" style="width:500px; height:50px;" name="productdescription" placeholder="Description" required value="<?php echo(isset($recProducts['description'])? $recProducts['description']:'');?>"><br>
                        <label for="productphoto1">Photo 1</label>
                        <input type="file" name="productphoto1" id="productphoto1" ><br>
                        <label for="productphoto2">Photo 2</label>
                        <input type="file" name="productphoto2" id="productphoto2" ><br>
                        <button type="submit" name="btnUpdate">Update</button>
                        <a href="addproducts.php" class="btn btn-danger">Cancel</a>
                    </form>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->
    </div><!-- /#wrapper -->
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
</body>
</html>