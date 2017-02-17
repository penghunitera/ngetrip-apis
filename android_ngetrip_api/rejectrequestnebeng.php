<?php

/*
 * Following code will update a product information
 * A product is identified by product id (pid)
 */

// array for JSON response
$response = array();

// check for required fields
if (isset($_POST['user_id']) && isset($_POST['post_id'])) {
    
    $uid = $_POST['user_id'];
    $pid = $_POST['post_id'];

    // include db connect class
    require_once 'include/DB_CONNECT.php';

    // var_dump($pid);die();

    // mysql update row with matched pid
    $result = mysql_query("UPDATE ngetrip_tripmember SET status = 3 WHERE post_id=".$pid." and user_id=".$uid);

    var_dump($result);die();

    // check if row inserted or not
    if ($result) {
        // successfully updated
        $response["success"] = 1;
        $response["message"] = "Product successfully updated.";
        
        // echoing JSON response
        echo json_encode($response);
    } else {
         $response["message"] = "gagal";
         echo json_encode($response);
    }
} else {
    // required field is missing
    $response["success"] = 0;
    $response["message"] = "Required field(s) is missing";

    // echoing JSON response
    echo json_encode($response);
}
?>
