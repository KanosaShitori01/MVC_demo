<?php 
    class CartModel extends BaseModel{
        const TABLE = "carts";
        public function getAll($select = ["*"], $orderby = []){
            return $this->All(self::TABLE, $select, $orderby);
        }
        public function Add($id){
            $Product = $this->Find("products", $id);
            $setProductKey = [
                "name" => "'".$Product['name']."'",
                "price" => $Product['price'],
                "id_category" => $Product['id_category'],
                "id_products" => $id,
                "quantity" => 1,
                "received" => 'false'       
            ];
            // $this->Query("TRUNCATE TABLE carts");
            $Data = $this->FindQuery(self::TABLE, "id_products", $id);
            if($Data["quantity"] > 0){
                return $this->UpdateQuery(self::TABLE, "id_products", $id, 
                ["quantity" => $Data["quantity"]+=1]);
            }
            else {
                return $this->Create(self::TABLE, $setProductKey);
            }
        }
        public function findById($id){
            return $this->Find(self::TABLE, $id);
        }
        // public function CheckQuantity($tb){
        //     $query = $this->Query("SELECT name, COUNT(name) 
        //     FROM $tb GROUP BY name HAVING COUNT(name) > 1");
        //     $res = mysqli_fetch_assoc($query);
        //     return $res["COUNT(name)"];
        // }
    }
?>