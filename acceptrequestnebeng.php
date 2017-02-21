<?php

/**
 * @author Ravi Tamada
 * @link http://www.androidhive.info/2012/01/android-login-and-registration-with-php-mysql-and-sqlite/ Complete tutorial
 */

require_once 'include/DB_Functions.php';
$db = new DB_Functions();

// json response array
$response = array("error" => FALSE);

if (isset($_POST['user_id']) && isset($_POST['post_id'])) {

    $userid = $_POST['user_id'];
    $postid = $_POST['post_id'];

    $post = $db->acceptpermintaanjoin($userid, $postid);
    // var_dump($post);die();

    if ($post != false) {

        $response["error"] = FALSE;
        echo json_encode($response);
    } else {

        $response["error"] = TRUE;
        $response["error_msg"] = "Null !";
        echo json_encode($response);
    }
 }
else {
    $response["error"] = TRUE;
    $response["error_msg"] = "Required parameters  is missing!";
    echo json_encode($response);
}
?>

