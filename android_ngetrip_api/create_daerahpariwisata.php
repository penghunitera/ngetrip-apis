<?php

/**
 * @author Ravi Tamada
 * @link http://www.androidhive.info/2012/01/android-login-and-registration-with-php-mysql-and-sqlite/ Complete tutorial
 */

require_once 'include/DB_Functions.php';
$db = new DB_Functions();

// json response array
$response = array("error" => FALSE);



if (isset($_POST['nama_daerah']) && isset($_POST['description']) && isset($_POST['longitude']) && isset($_POST['langitude']) && isset($_POST['created_by'])) {

    // receiving the post params

        $nama_daerah = $_POST['nama_daerah'];
        $description = $_POST['description'];
        $longitude =  $_POST['longitude'];
        $langitude = $_POST['langitude'];
        $created_by = $_POST['created_by'];

       // create a new user
    $daerahwisata = $db->create_daerahpariwisata($nama_daerah, $description, $longitude, $langitude,  $created_by);

        if ($daerahwisata) {
            // user stored successfully
            $response["error"] = FALSE;

            $response["user"]["nama_daerah"] = $daerahwisata['nama_daerah'];
            $response["user"]["description"] = $daerahwisata['description'];
            $response["user"]["longitude"] = $daerahwisata['longitude'];
            $response["user"]["langitude"] = $daerahwisata['langitude'];     
            $response["user"]["created_by"] = $daerahwisata['created_by'];

            echo json_encode($response);
        } else {
            // user failed to store
            $response["error"] = TRUE;
            $response["error_msg"] = "Unknown error occurred in creating daerahwisata!";
            echo json_encode($response);
        }
    
} else {
    $response["error"] = TRUE;
    $response["error_msg"] = "Required parameters  is missing!";
    echo json_encode($response);
}
?>

