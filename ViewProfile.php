<?php

/**
 * @author Ravi Tamada
 * @link http://www.androidhive.info/2012/01/android-login-and-registration-with-php-mysql-and-sqlite/ Complete tutorial
 */

require_once 'include/DB_Functions.php';
$db = new DB_Functions();

// json response array
$response = array("error" => FALSE);

if (isset($_POST['user_id'])) {

    // get the user by email and password
    $userid = $_POST['user_id'];
    // get the user by email and password
    $post = $db->ViewProfile($userid);

    if ($post != false) {
        // use is found
        $response["error"] = FALSE;
            $response["user"]["name"] = $post['name'];
            $response["user"]["email"] = $post['email'];
        echo json_encode($response);
    } else {
        // user is not found with the credentials
        $response["error"] = TRUE;
        $response["error_msg"] = "Null!";
        echo json_encode($response);
    }
}
else {
    $response["error"] = TRUE;
    $response["error_msg"] = "Required parameters  is missing!";
    echo json_encode($response);
}

?>

