<?php

    /*This get customer by id method although is it in separate file
    * Can be incorporated into the read.php file.
    * The commented bit in the if statement illustrastes just that
    */ 

    // The first thing we do before creating the APi is to create the headers
    header('Access-Control-Allow-Origin:*'); // Access controll allowed origin
    header('Content-Type: Application/json'); // content type will be in json format, whatever data is sent from backend database 
                                              // it will be transformed and sent in the json format to the customer 
    header('Access-Control-Allow-Method: GET'); // The read.php file will only be accessible via get method and no other
    header('Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Request-with');

    include('function.php');

    $requestMethod = $_SERVER["REQUEST_METHOD"];


    if ($requestMethod == "GET") {
        
        if (isset($_GET['id'])) {
            
            $customer = getCustomer($_GET);
            echo $customer;

        } // else {

            //$customerList = getCustomerList();
            //echo $customerList;
        //}
        
    }
     else {
        
        $data = [
            'status'   => 405,
            'message'  => $requestMethod. ' Method Not Allowed',
        ];
        header("HTTP/1.0 405 Method Not Allowed");
        echo json_encode($data);    
     }
?>