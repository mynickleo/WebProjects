<!DOCTYPE html>
<html lang = "eng">
<head>
    <meta charset = "UTF-8">
    <meta name = "viewport" content="width=device-width, initial-scale = 1.0">
    <link rel = "stylesheet" href = "basket.css">
    <title>Категории товаров</title>
</head>
<body>
    <header>
        <div class = "info">
            <div class = "nordfjord">
                NORDFJORD
            </div>
            <a href = "https://vk.com/krug_chesti" class = "other_info">О нас</a>
            <a href = "https://vk.com/krug_chesti" class = "other_info">Контакты</a>
            <a href = "\" class = "other_info">Товары</a>
            <a href = "basket.php" class = "products">Корзина</a>
        </div>
    </header>

    <div class = "container" id = "main">
    <div class = "main_header">Ваша корзина</div>

    <?php
    include("connect.php");

    if($_COOKIE){
        if($_GET['product_id']){ //Если нажал кнопку купить, то записывается №товара
            $basket_id = $_COOKIE['basket_id'];
            $product_id = $_GET['product_id'];
            $basket_product_operation_type = $_GET['operation_type'];
            $sql = "SELECT * FROM basket_table";

            if($result = mysqli_query($link, $sql)){ //проверка на подключение
                if($basket_product_operation_type == 1){
                    $query = "UPDATE `basket_table` SET `count_product` = `count_product`+1  WHERE `id_basket` = '$basket_id' AND `id_product` = '$product_id'";
                }
                else if($basket_product_operation_type == 0){
                    $count_product = 0;
                    foreach($result as $row){
                        if($row["id_basket"] == $basket_id && $row["id_product"] == $product_id){
                            $count_product = $row['count_product'];
                            break;
                        }
                    }
                    if($count_product - 1 <= 0){
                        $query = "DELETE FROM `basket_table` WHERE `id_basket` = '$basket_id' AND `id_product` = '$product_id'";
                    }
                    else{
                        $query = "UPDATE `basket_table` SET `count_product` = `count_product`-1  WHERE `id_basket` = '$basket_id' AND `id_product` = '$product_id'";
                    }
                }
                mysqli_query($link, $query) or die(mysqli_error($link));

                header("Location: basket.php");
                die();

            }
        }
        else{
            $basket_id = $_COOKIE['basket_id'];
            $sql = "SELECT * FROM basket_table";

            if($result = mysqli_query($link, $sql)){
                $product_name = "";
                foreach($result as $row){
                    if($row["id_basket"] == $basket_id){
                        echo "<div class = 'block'>";
                        if($row['id_product'] == 1) $product_name = "Курс по телу";
                        else if($row['id_product'] == 2) $product_name = "Гантели";
                        else if($row['id_product'] == 3) $product_name = "Штанга";
                        else if($row['id_product'] == 4) $product_name = "Спортивное питание";

                        echo "<div class = info_about_block><div class = 'header_1'>".$product_name."</div></div>";
                        echo "<div class = 'func_block'>";
                        echo "<button class = 'button_minus' onclick = window.location='?product_id=".$row['id_product']."&operation_type=0',modal_.style.display='flex'>-</button><div class = 'text'>".$row['count_product']."</div>";
                        echo "<button class = 'button_plus'onclick = window.location='?product_id=".$row['id_product']."&operation_type=1',modal.style.display='flex'>+</button>";
                        echo "</div></div>";
                    }
                }
            }
        }
    }
    else{
        $random_id = uniqid();
        setcookie('basket_id', $random_id, time() + 259200, '/');
    }
?>
</div>

    <div class = "modal" id = "modal">
        <div class = "modal-window">
            <h1 class = "text_modal">Кол-во товара увеличено</h1>
        </div>

        <div class = "overlay"></div>
    </div>

    <div class = "modal_" id = "modal_">
        <div class = "modal-window">
            <h1 class = "text_modal">Кол-во товара уменьшено</h1>
        </div>

        <div class = "overlay"></div>
    </div>

    <footer>
    <div class = "info">
            <div class = "nordfjord">
                NORDFJORD
            </div>
        </div>
    </footer>
</body>
</html>