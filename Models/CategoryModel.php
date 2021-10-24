<?php 
    class CategoryModel extends BaseModel{
        const TABLE = 'categories';

        public function getAll($select = ["*"], $orderby = []){
            return $this->All(self::TABLE, $select, $orderby);
        }
        public function findById($id){
            return $this->Find(self::TABLE, $id);
        }
    }
?>