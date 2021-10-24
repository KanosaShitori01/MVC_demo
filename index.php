<?php
    require "./Core/database.php";
    require "./Models/BaseModel.php";
    require "./Controllers/BaseController.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="Public/assets/style.css">
</head>
<body>
    <header class="head">
        <h1>Welcome to my Web</h1>
    </header>
    <main class="main">
    <?php 
        $BaseFunc = new BaseController;
        if(isset($_GET['controller'])){
            $controllerName = ucfirst(strtolower($_REQUEST['controller'] ?? 'Welcome')).'Controller';
            $actionName = strtolower($_REQUEST['action'] ?? 'index');
            if(in_array($controllerName, $BaseFunc->Router))
                require "./Controllers/${controllerName}.php";
            else 
                header("location: ./");

            $controllerObj = new $controllerName;
            try {
                $controllerObj->check($actionName);
            } catch (Throwable $e) {
                header("refresh:0, url=./");
            }
           
        }
        else{
            $controllerObj = new BaseModel;
            $DataProducts = $controllerObj->All("products");
            $DataCategory = $controllerObj->All("categories");
            echo "
            <div class='category'> ";
                    echo "<ul>";
                foreach($DataCategory as $Cate){
                    echo "<li> <a href='?controller=category&action=show&id=${Cate['id']}'>
                    ${Cate['id']} | ${Cate['name']} </a> </li>
                    ";
                }
                echo "</ul>";
            echo "</div>";
            echo "<div class='product'>";
            echo "<a href='?controller=product'>Xem tất cả</a>";
            echo "<ul>";
            foreach($DataProducts as $Pro){
                echo "<li>
                <a href='?controller=product&action=show&id=${Pro['id']}'>${Pro['name']}</a>
                 : ${Pro['price']} 
                 <a href='?controller=product&action=buy&id=${Pro['id']}'>Mua</a> 
                 </li>";
            }
            echo "</ul>";
            echo "<a href='?controller=cart'>Cart</a>";
            echo `</div>`;
        }
    ?>
       
        
    </main>
</body>
</html>
