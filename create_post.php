<?php

/**
 * @author Ravi Tamada
 * @link http://www.androidhive.info/2012/01/android-login-and-registration-with-php-mysql-and-sqlite/ Complete tutorial
 */

require_once 'include/DB_Functions.php';
$db = new DB_Functions();

// json response array
$response = array("error" => FALSE);



if (isset($_POST['kriteria_postingan']) && isset($_POST['title']) && isset($_POST['description']) && isset($_POST['created_by']) && isset($_POST['daerah_asal']) && isset($_POST['daerah_tujuan']) && isset($_POST['jumlah_orang']) && isset($_POST['url_gambar'])) {

    // receiving the post params

        $kriteria_postingan = $_POST['kriteria_postingan'];
        $title = $_POST['title'];
        $description =  $_POST['description'];
        $created_by = $_POST['created_by'];
        $daerah_asal = $_POST['daerah_asal'];
        $daerah_tujuan = $_POST['daerah_tujuan'];
        $jumlah_orang = $_POST['jumlah_orang'];
        $url_gambar = $_POST['url_gambar'];
       // create a new user
    $post = $db->create_post($kriteria_postingan, $title, $description, $created_by, $daerah_asal, $daerah_tujuan, $jumlah_orang, $url_gambar);

        if ($post) {
            // user stored successfully
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
            // user failed to store
            $response["error"] = TRUE;
            $response["error_msg"] = "Unknown error occurred in creating post!";
            echo json_encode($response);
        }
    
} else {
    $response["error"] = TRUE;
    $response["error_msg"] = "Required parameters  is missing!";
    echo json_encode($response);
}
?>

