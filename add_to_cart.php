<?php
    require 'config.php';
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $response = array();
        $id_user = $_POST['id_user'];
        $id_product = $_POST['id_product'];

        $cekCart = mysqli_query($connection, "SELECT * FROM cart WHERE id_user = '$id_user' AND id_product = '$id_product'");
        $resultCekCart = mysqli_fetch_array($cekCart);

        if($resultCekCart){
            $response['value'] = 2;
            $response['message'] = "Sorry, this product is already in the cart";
            echo json_encode($response);
        }else{
            $cekProduct = mysqli_query($connection, "SELECT * FROM product WHERE id_product = '$id_product'");
            $fetchProduct = mysqli_fetch_array($cekProduct);
            $fetchPrice = $fetchProduct['price'];
            $insertToCart = "INSERT INTO cart VALUE('', '$id_user', '$id_product', 1, '$fetchPrice', NOW())";

            if(mysqli_query($connection, $insertToCart)){
                $response['value'] = 1;
                $response['message'] = "Yes, the product has been successfully added to the cart";
                echo json_encode($response);
            }else{
                $response['value'] = 0;
                $response['message'] = "Sorry, Added Product Failed";
                echo json_encode($response);
            }
        }
    }
?>