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
    $post = $db->getAllPostAjakanNebeng();

    if ($post != false) {
        // use is found
        $response["error"] = FALSE;
            $response["user"]["kriteria_postingan"] = $post['kriteria_postingan'];
            $response["user"]["title"] = $post['title'];
            $response["user"]["description"] = $post['description'];
            $response["user"]["created_by"] = $post['created_by'];     
            $response["user"]["daerah_asal"] = $post['daerah_asal'];
            $response["user"]["daerah_tujuan"] = $post['daerah_tujuan'];
            $response["user"]["jumlah_orang"] = $post['jumlah_orang'];
        echo json_encode($response);
    } else {
        // user is not found with the credentials
        $response["error"] = TRUE;
        $response["error_msg"] = "Null !";
        echo json_encode($response);
    }
 

?>

