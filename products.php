<?php
    require('opencon.php');
    $strsql = "SELECT * FROM tbl_products";
    function viewRS($con, $strsql){
        $rs = [];
        $i = 0;
        if($stmt = mysqli_query($con, $strsql)){
            // specific
            if(mysqli_num_rows($stmt) == 1){
                $record = mysqli_fetch_array($stmt);
                foreach($record as $key => $value){
                    $rs[$key] = $value;
                }
            }
            elseif(mysqli_num_rows($stmt) > 1){
                while($record = mysqli_fetch_array($stmt)){
                    foreach($record as $key => $value){
                        $rs[$i][$key] = $value;
                    }
                    $i++;
                }
            }
            mysqli_free_result($stmt);
        }
        return $rs;
    }
    
    $arrProducts = viewRS($con,$strsql);


    

    require('closecon.php');

 
    $arrProducts = array(
        array(
            'item'          => "Blouson Dress",
            'description'   => "Classy and understated, our dress ensures you feel at your best – ready to show off and turn some heads. Made from premium silk, the delicate and flowing construction gives you space to move freely without compromising on elegance.",
            'price'         => "470",
            'img1'        => "A1.jpg",
            'img2'        => "B1.jpg"
        ),
        array(
            'item'          => "Empire line Dress",
            'description'   => "Classy and understated, our dress ensures you feel at your best – ready to show off and turn some heads. Made from premium silk, the delicate and flowing construction gives you space to move freely without compromising on elegance.",
            'price'         => "950",
            'img1'        => "A2.jpg",
            'img2'        => "B2.jpg",
        ),
        array(
            'item'          => "Halterneck Dress",
            'description'   => "Classy and understated, our dress ensures you feel at your best – ready to show off and turn some heads. Made from premium silk, the delicate and flowing construction gives you space to move freely without compromising on elegance.",
            'price'         => "699",
            'img1'        => "A3.jpg",
            'img2'        => "B3.jpg",
        ),
        array(
            'item'          => "Handkerchief hem Dress",
            'description'   => "Classy and understated, our dress ensures you feel at your best – ready to show off and turn some heads. Made from premium silk, the delicate and flowing construction gives you space to move freely without compromising on elegance.",
            'price'         => "750",
            'img1'        => "A4.jpg",
            'img2'        => "B4.jpg",
        ),
        array(
            'item'          => "Gathered Dress",
            'description'   => "Classy and understated, our dress ensures you feel at your best – ready to show off and turn some heads. Made from premium silk, the delicate and flowing construction gives you space to move freely without compromising on elegance.",
            'price'         => "900",
            'img1'        => "A5.jpg",
            'img2'        => "B5.jpg",
        ),
        array(
            'item'          => "Camisole dress",
            'description'   => "Classy and understated, our dress ensures you feel at your best – ready to show off and turn some heads. Made from premium silk, the delicate and flowing construction gives you space to move freely without compromising on elegance. ",
            'price'         => "600",
            'img1'        => "A6.jpg",
            'img2'        => "B6.jpg",
        ),
        array(
            'item'          => "Peasant Dress",
            'description'   => "Classy and understated, our dress ensures you feel at your best – ready to show off and turn some heads. Made from premium silk, the delicate and flowing construction gives you space to move freely without compromising on elegance.",
            'price'         => "500",
            'img1'        => "A7.jpg",
            'img2'        => "B7.jpg",
        ), 
        array(
            'item'          => " Pinafore Dress",
            'description'   => "Classy and understated, our dress ensures you feel at your best – ready to show off and turn some heads. Made from premium silk, the delicate and flowing construction gives you space to move freely without compromising on elegance.",
            'price'         => "300",
            'img1'        => "A8.jpg",
            'img2'        => "B8.jpg",
        )
    );
?>
