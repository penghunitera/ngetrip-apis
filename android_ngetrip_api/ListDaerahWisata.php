<?php

/**
 * @author Ravi Tamada
 * @link http://www.androidhive.info/2012/01/android-login-and-registration-with-php-mysql-and-sqlite/ Complete tutorial
 */

require_once 'include/DB_Functions.php';
$db = new DB_Functions();

// json response array
$response = array("error" => FALSE);

    // get the user by email and password
    $post = $db->getAllDaerahWisata();

    if ($post != false) {
        // use is found
        $response["error"] = FALSE;
            $response["user"]["nama_daerah"] = $post['nama_daerah'];
            $response["user"]["description"] = $post['description'];
            $response["user"]["longitude"] = $post['longitude'];     
            $response["user"]["langitude"] = $post['langitude'];
        echo json_encode($response);
    } else {
        // user is not found with the credentials
        $response["error"] = TRUE;
        $response["error_msg"] = "Null!";
        echo json_encode($response);
    }
 

?>

