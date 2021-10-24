<?php 
    class BaseModel extends Database{
        protected $connect;
        public function __construct(){
            $this->connect = $this->Connect("phpclass");
        }
        // Lấy tất cả dữ liệu
        public function All($tb, $select = ["*"], $orderby = []){
            $column = implode(",", $select);
            $orderByString = implode(" ", $orderby);
            if($orderByString)
            $sqli = "SELECT $column FROM $tb ORDER BY $orderByString";
            else 
            $sqli = "SELECT $column FROM $tb";
            $query = $this->Query($sqli);
            if(!$query) return "";
            $data = [];
                while($row = mysqli_fetch_assoc($query)){
                    array_push($data, $row);
                }
            
            return $data;
        }
        // Tìm kiếm dữ liệu bằng ID
        public function Find($tb, $id){
            $sqli = "SELECT * FROM $tb WHERE id=$id";
            $query = $this->Query($sqli);
            return mysqli_fetch_assoc($query);
        }
        public function FindQuery($tb, $key, $value){
            $sqli = "SELECT * FROM $tb WHERE $key=$value";
            $query = $this->Query($sqli);
            return mysqli_fetch_assoc($query);
        }
        // Thêm dữ liệu vào table
        public function Create($tb, $data = []){
            $column = implode(",", array_keys($data));
            $perVal = array_map(function($value){
                return "'".$value."'";
            },array_values($data));
            $perVal = implode(", ", array_values($data));
            $sqli = "INSERT INTO ${tb}(id, $column) VALUES(NULL, $perVal)";
            $this->Query($sqli);
            // $this->Query("TRUNCATE TABLE carts");
        }
        // Nâng cấp dữ liệu
        public function Update($tb, $id, $data){
            $setData = [];
            foreach($data as $keys => $values){
                array_push($setData, "$keys = '".$values."'");
            }
            $setData = implode(",", $setData);
            $sqli = "UPDATE $tb SET $setData WHERE id=$id";
            echo $sqli;
            $this->Query($sqli);
        }
        public function UpdateQuery($tb, $key, $value, $data){
            $setData = [];
            foreach($data as $keys => $values){
                array_push($setData, "$keys = '".$values."'");
            }
            $setData = implode(",", $setData);
            $sqli = "UPDATE $tb SET $setData WHERE $key=$value";
            echo $sqli;
            $this->Query($sqli);
        }
        // Xóa dữ liệu
        public function Delete($tb, $id){
            $sqli = "DELETE FROM $tb WHERE id=$id";
            $this->Query($sqli);
        }

        public function Query($sqli){  
           return mysqli_query($this->connect, $sqli);
        }
    }
?>