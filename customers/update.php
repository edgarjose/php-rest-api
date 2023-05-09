<?php

error_reporting(0);

    // The first thing we do before creating the APi is to create the headers
    header('Access-Control-Allow-Origin:*'); // Access controll allowed origin
    header('Content-Type: Application/json'); // content type will be in json format, whatever data is sent from backend database 
                                              // it will be transformed and sent in the json format to the customer 
    header('Access-Control-Allow-Method: PUT'); // The read.php file will only be accessible via get method and no other
    header('Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Request-with');

    include('function.php');

    $requestMethod = $_SERVER["REQUEST_METHOD"];

    if ($requestMethod == 'PUT') {
        
        $inputData = json_decode(file_get_contents("php://input"), true);  
          $updateCustomer = updateCustomer($inputData, $_GET);
          echo $updateCustomer;

    } else {

        $data = [
            'status'   => 405,
            'message'  => $requestMethod . ' Method Not Allowed',
        ];
        header("HTTP/1.0 405 Method Not Allowed");
        echo json_encode($data);  
    }
