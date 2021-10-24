<?php 
    class BaseController{
        const VIEW_FOLDER_NAME = 'Views';
        const MODEL_FOLDER_NAME = 'Models';
        public $Router = ["CategoryController", "ProductController", "CartController"];
        /*
            Descrtiption: 
            + Path name : folderName.fileName
            + Lấy từ sau thư mục View 
        */
        protected function loadView($viewPath, array $data = []){
            foreach($data as $key => $value){
                $$key = $value;
            }
         
            return require (self::VIEW_FOLDER_NAME.'/'.str_replace('.', '/', $viewPath).'.php');
        }
        protected function loadModel($modelPath){
            return require (self::MODEL_FOLDER_NAME.'/'.$modelPath.'.php');
        }

        // public function CheckUrl($text){
        //     if($this->$text())
        //     var_dump($this->$text());
        // }
        public function check($text){
            if(($this->$text())){
                return true;
            } else echo "VV";
        }
    }
?>