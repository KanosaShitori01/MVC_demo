<?php
    class CategoryController extends BaseController{
        private $categoryModel;
        public function __construct(){
            $this->loadModel("CategoryModel");
            $this->loadModel("ProductModel");
            $this->categoryModel = new CategoryModel;
            $this->productModel = new ProductModel;
        }
        public function index(){
            $Categories = $this->categoryModel->getAll();
            $this->loadView("FrontEnd.Categories.index", [
                'Categories' => $Categories,
                'pageTitle' => "Danh Mục Sản Phẩm"
            ]);
            return true;
        }
        public function show(){
            if(isset($_GET['id'])){
                $id = $_GET['id'];
                $category = $this->productModel->findByCate($id);
                echo "<pre>";
                print_r($category);
                echo "</pre>";
            }
            return true;
        }
    }
?>