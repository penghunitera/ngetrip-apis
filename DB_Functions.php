<?php

/**
 * @author Ravi Tamada
 * @link http://www.androidhive.info/2012/01/android-login-and-registration-with-php-mysql-and-sqlite/ Complete tutorial
 */

class DB_Functions {

    private $conn;

    // constructor
    function __construct() {
        require_once 'DB_Connect.php';
        // connecting to database
        $db = new Db_Connect();
        $this->conn = $db->connect();
    }

    // destructor
    function __destruct() {
        
    }

    /**
     * Storing new user
     * returns user details
     */
    public function storeUser($name, $email, $password) {
        $uuid = uniqid('', true);
        $hash = $this->hashSSHA($password);
        $encrypted_password = $hash["encrypted"]; // encrypted password
        $salt = $hash["salt"]; // salt

        $stmt = $this->conn->prepare("INSERT INTO users(unique_id, name, email, encrypted_password, salt, created_at) VALUES(?, ?, ?, ?, ?, NOW())");
        $stmt->bind_param("sssss", $uuid, $name, $email, $encrypted_password, $salt);
        $result = $stmt->execute();
        $stmt->close();

        // check for successful store
        if ($result) {
            $stmt = $this->conn->prepare("SELECT * FROM users WHERE email = ?");
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $user = $stmt->get_result()->fetch_assoc();
            $stmt->close();

            return $user;
        } else {
            return false;
        }
    }

    public function create_post($kriteria_postingan, $title, $description, $created_by, $daerah_asal, $daerah_tujuan, $jumlah_orang, $url_gambar ) {

        $uuid = uniqid('', true);

        $stmt = $this->conn->prepare("INSERT INTO ngetrip_post(kriteria_postingan, title, description, created_by, created_at, daerah_asal, daerah_tujuan, jumlah_orang, uid) VALUES(?, ?, ?, ?, NOW(), ?, ?, ?, ?)");
        $stmt->bind_param("ississis", $kriteria_postingan, $title, $description, $created_by, $daerah_asal, $daerah_tujuan, $jumlah_orang, $uuid);

        $result = $stmt->execute();
        $stmt->close();

        if ($result) {

            $stmt1 = $this->conn->prepare("INSERT INTO ngetrip_gambar(url_gambar, id_postingan) VALUES(?,?)");
            $stmt1->bind_param("ss", $url_gambar, $uuid);

            $result1 = $stmt1->execute();
            $stmt1->close();

            // $stmt1 = $this->conn->prepare("SELECT * FROM ngetrip_post WHERE id_postingan = ?");
            // $stmt1->bind_param("s", $uuid);
            // $stmt1->execute();
            // $user = $stmt1->get_result()->fetch_assoc();
            // $stmt1->close();

            return true;
        } else {
            return false;
        }
    }

    public function joinpostinganajakannebeng($userid, $postid, $status) {

        $stmt = $this->conn->prepare("INSERT INTO ngetrip_tripmember(user_id, post_id, status, created_at) VALUES(?, ?, ?, NOW())");
        $stmt->bind_param("iii", $userid, $postid, $status);

        $result = $stmt->execute();
        $stmt->close();

        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    public function create_daerahpariwisata($nama_daerah, $description, $longitude, $langitude,  $created_by) {

        $stmt = $this->conn->prepare("INSERT INTO ngetrip_daerahpariwisata(nama_daerah, description, langitude, longitude, created_by)
            VALUES(?, ?, ?, ?, ?)");

        $stmt->bind_param("ssssi", $nama_daerah, $description, $longitude, $langitude, $created_by);

        $result = $stmt->execute();
        $stmt->close();

        if ($result) {
            $stmt = $this->conn->prepare("SELECT * FROM ngetrip_daerahpariwisata WHERE nama_daerah = ?");
            $stmt->bind_param("s", $nama_daerah);
            $stmt->execute();
            $user = $stmt->get_result()->fetch_assoc();
            $stmt->close();

            return $user;
        } else {
            return false;
        }
    }

    public function acceptrequestnebeng($userid, $postid) {

           // var_dump($userid.$postid); die();

    $stmt = $this->conn->prepare("UPDATE ngetrip_tripmember SET status = 2 WHERE post_id=".$postid." AND user_id = ".$userid);

        // $stmt->bind_param("ii", $userid, $postid);

        $result = $stmt->execute();
        $stmt->close();

       }

    public function likepost($userid, $postid) {

        $stmt = $this->conn->prepare("INSERT INTO ngetrip_like(post_id, user_id, created_at)
            VALUES(?, ?, NOW())");

        $stmt->bind_param("ii", $postid, $userid);


        $result = $stmt->execute();
        $stmt->close();

        if ($result) {

            return true;
        } else {

            return false;
        }
    }

    public function commentpost($postid, $description, $userid) {

        $stmt = $this->conn->prepare("INSERT INTO ngetrip_comment(post_id, description, user_id, created_at)
            VALUES(?, ?, ?, NOW())");

        $stmt->bind_param("isi", $postid, $description, $userid);

        
        $result = $stmt->execute();

        
        $stmt->close();



        if ($result) {

            return true;
        } else {

            return false;
        }
    }

    public function getAllDaerahWisata() {

        $stmt = $this->conn->prepare("SELECT * FROM ngetrip_daerahpariwisata");

        if ($stmt->execute()) {
            $user = $stmt->get_result()->fetch_assoc();
            $stmt->close();
                return $user;
            
        } else {
            return NULL;
        }
    
    }

    public function getAllPostAjakanNebeng() {

        $stmt = $this->conn->prepare("SELECT * FROM ngetrip_post WHERE kriteria_postingan = 1");

        if ($stmt->execute()) {
            $user = $stmt->get_result()->fetch_assoc();
            $stmt->close();
                return $user;
            
        } else {
            return NULL;
        }
    
    }


    public function ViewProfile($userid) {

        $stmt = $this->conn->prepare("SELECT * FROM ngetrip_user WHERE id_user = ".$userid);

        if ($stmt->execute()) {
            $user = $stmt->get_result()->fetch_assoc();
            $stmt->close();
                return $user;
            
        } else {
            return NULL;
        }
    
    }

    public function getAllPostAjakanNebengbyUser($user_id) {

        $stmt = $this->conn->prepare("SELECT * FROM ngetrip_post WHERE kriteria_postingan = 1 and created_by =".$user_id);

        if ($stmt->execute()) {
            $user = $stmt->get_result()->fetch_assoc();
            $stmt->close();
                return $user;
            
        } else {
            return NULL;
        }
    
    }

    public function getAllPostTestimonibyUser($user_id) {

        $stmt = $this->conn->prepare("SELECT * FROM ngetrip_post WHERE kriteria_postingan = 2 and created_by =".$user_id);

        if ($stmt->execute()) {
            $user = $stmt->get_result()->fetch_assoc();
            $stmt->close();
                return $user;
            
        } else {
            return NULL;
        }
    
    }

    public function getDetailPost($postid) {

        $stmt = $this->conn->prepare("SELECT * FROM ngetrip_post WHERE id_post = ".$postid);

        if ($stmt->execute()) {
            $user = $stmt->get_result()->fetch_assoc();
            $stmt->close();
                return $user;
            
        } else {
            return NULL;
        }
    
    }

    public function getAllPostTestimoni() {

        $stmt = $this->conn->prepare("SELECT * FROM ngetrip_post WHERE kriteria_postingan = 2");

        if ($stmt->execute()) {
            $user = $stmt->get_result()->fetch_assoc();
            $stmt->close();
                return $user;
            
        } else {
            return NULL;
        }
    
    }

    /**
     * Get user by email and password
     */
    public function getUserByEmailAndPassword($email, $password) {

        $stmt = $this->conn->prepare("SELECT * FROM users WHERE email = ?");

        $stmt->bind_param("s", $email);

        if ($stmt->execute()) {
            $user = $stmt->get_result()->fetch_assoc();
            $stmt->close();

            // verifying user password
            $salt = $user['salt'];
            $encrypted_password = $user['encrypted_password'];
            $hash = $this->checkhashSSHA($salt, $password);
            // check for password equality
            if ($encrypted_password == $hash) {
                // user authentication details are correct
                return $user;
            }
        } else {
            return NULL;
        }
    }

    /**
     * Check user is existed or not
     */
    public function isUserExisted($email) {
        $stmt = $this->conn->prepare("SELECT email from users WHERE email = ?");

        $stmt->bind_param("s", $email);

        $stmt->execute();

        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            // user existed 
            $stmt->close();
            return true;
        } else {
            // user not existed
            $stmt->close();
            return false;
        }
    }

    /**
     * Encrypting password
     * @param password
     * returns salt and encrypted password
     */
    public function hashSSHA($password) {

        $salt = sha1(rand());
        $salt = substr($salt, 0, 10);
        $encrypted = base64_encode(sha1($password . $salt, true) . $salt);
        $hash = array("salt" => $salt, "encrypted" => $encrypted);
        return $hash;
    }

    /**
     * Decrypting password
     * @param salt, password
     * returns hash string
     */
    public function checkhashSSHA($salt, $password) {

        $hash = base64_encode(sha1($password . $salt, true) . $salt);

        return $hash;
    }

}

?>
