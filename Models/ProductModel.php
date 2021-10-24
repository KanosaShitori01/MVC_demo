<?php 
    class ProductModel extends BaseModel{
        const TABLE = 'products';

        public function getAll($select = ["*"], $orderby = []){
            return $this->All(self::TABLE, $select, $orderby);
        }
        public function findById($id){
            return $this->Find(self::TABLE, $id) ?? "NO RESULT";
        }
        public function findByCate($id){
            return $this->FindQuery(self::TABLE, "id_category", $id);
        }
        public function store($data){
            return $this->Create(self::TABLE, $data);
        }
        public function updateData($id, $data){
            return $this->Update(self::TABLE, $id, $data);
        }
        public function deleteData($id){
            return $this->Delete(self::TABLE, $id);
        }
    }
?>