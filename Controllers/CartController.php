<?php
    class CartController extends BaseController{
        private $cartController;
        public function __construct()
        {
            $this->loadModel("CartModel");
            $this->cartController = new CartModel;
        }
        public function index(){
            $Carts = $this->cartController->getAll();
            // var_dump($Carts);
            return $this->loadView("FrontEnd.Cart.index", [
                "pageTitle" => "Giỏ hàng",
                "carts" => $Carts
            ]);
        }
        public function delete(){

        }
    }
?>