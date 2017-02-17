<?php

/**
 * @author Ravi Tamada
 * @link http://www.androidhive.info/2012/01/android-login-and-registration-with-php-mysql-and-sqlite/ Complete tutorial
 */

require_once 'include/DB_Functions.php';
$db = new DB_Functions();

// json response array
$response = array("error" => FALSE);



if (isset($_POST['user_id']) && isset($_POST['post_id']) && isset($_POST['status'])) {

    // receiving the post params

        $userid = $_POST['user_id'];
        $postid = $_POST['post_id'];
        $status =  $_POST['status'];

       // create a new user
    $post = $db->joinpostinganajakannebeng($userid, $postid, $status);

        if ($post) {
            // user stored successfully
            $response["error"] = FALSE;

            $response["user"]["user_id"] = $post['user_id'];
            $response["user"]["post_id"] = $post['post_id'];
            $response["user"]["status"] = $post['status'];

            echo json_encode($response);
        } else {
            // user failed to store
            $response["error"] = TRUE;
            $response["error_msg"] = "Unknown error occurred in joining ajakan nebeng!";
            echo json_encode($response);
        }
    
} else {
    $response["error"] = TRUE;
    $response["error_msg"] = "Required parameters  is missing!";
    echo json_encode($response);
}

?>