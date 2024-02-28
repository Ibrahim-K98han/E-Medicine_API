<?php
    require 'config.php';
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $response = array();
        $email = $_POST['email'];
        $password = md5($_POST['password']);

        $query_cek_user = mysqli_query($connection, "SELECT * FROM user WHERE email = '$email'");
        $cke_user_result = mysqli_fetch_array($query_cek_user);

        if($cke_user_result){
           $query_login = mysqli_query($connection, "SELECT * FROM user WHERE email = '$email' && password = '$password'" );
           if($query_login){
            $response['value'] = 1;
            $response['message'] = 'Yes, Login is successful';
            echo json_encode($response);
        }else{
            $response['value'] = 2;
            $response['message'] = 'Oops, Login Failed';
            echo json_encode($response);
        }
        }else{
                $response['value'] = 2;
                $response['message'] = 'Oops, data is not registered';
                echo json_encode($response);
            
        }
    }
?>