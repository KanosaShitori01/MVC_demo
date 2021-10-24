<?php 
    class Database{
        const HOST = "localhost";
        const USERNAME = "root";
        const PASSWORD = "";

        public function Connect($db){
            $connect = mysqli_connect(self::HOST, self::USERNAME, self::PASSWORD, $db);
            mysqli_set_charset($connect, "utf-8");
            if (!$connect) {
                return false;
            }
            return $connect;
        }
    }
?>