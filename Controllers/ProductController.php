<?php
    class ProductController extends BaseController{
        private $productModel;
        private $cartModel;
        public function __construct()
        {
            $this->loadModel('ProductModel');
            $this->productModel = new ProductModel;
            $this->loadModel("CartModel");
            $this->cartModel = new CartModel;
        }
        public function index(){
            $selectColumn =  ["id", "name", "price"];
            $orderBy =  ["column" => "name", "order" => "desc"];
            $products = $this->productModel->getAll($selectColumn, $orderBy);
            $this->loadView("FrontEnd.Products.index", [
                'titlePage' => 'Danh sách sản phẩm',
                'products' => $products,
            ]);
            return true;
        }
        public function store(){
            $data = [
                "name"          => "Iphone 1",
                "price"         => 250000,
                "image"         => NULL,
                "id_category"   => 2
            ];
            $this->productModel->store($data);
            return true;
        }
        public function update(){
            if(isset($_GET['id'])){
            $id = $_GET['id'];
            $data = [
                "name"          => "I2phone 1",
                "price"         => 250000,
                "image"         => NULL,
                "id_category"   => 1
            ];
            $this->productModel->updateData($id, $data);
            }
            return true;
        }
        public function delete(){
            if(isset($_GET['id'])){
                $id = $_GET['id'];
                $this->productModel->deleteData($id);
            }
            return true;
        }
        public function buy(){
            if(isset($_GET['id'])){
                $id = $_GET['id'];
                $this->cartModel->Add($id);
            }
            header("Location: ?controller=cart");
            return true;
        }
        public function show(){
            if(isset($_GET['id'])){
                $id = $_GET['id'];
                $product = $this->productModel->findbyId($id);
                 $this->loadView("FrontEnd.Products.show", [
                    'product' => $product    
                ]);
            }
            else $this->loadView("FrontEnd.Products.show", [
                'product' => "ERROR" 
            ]);
            return true;
        }
        
    }
?>