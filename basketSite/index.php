<?php
    include("connect.php");

    if(isset($_COOKIE['basket_id'])){
        if($_GET['product_id']){ //Если нажал кнопку купить, то записывается №товара
            $basket_id = $_COOKIE['basket_id'];
            $product_id = $_GET['product_id'];
            $sql = "SELECT * FROM basket_table";

            if($result = mysqli_query($link, $sql)){ //проверка на подключение
                $basket_id_exist = 0;
                foreach($result as $row){
                    if($row["id_basket"] == $basket_id && $row["id_product"] == $product_id){
                        $basket_id_exist = 1;
                        break;
                    }
                }
                if($basket_id_exist != 0){
                    $query = "UPDATE `basket_table` SET `count_product` = `count_product`+1  WHERE `id_basket` = '$basket_id' AND `id_product` = '$product_id'";
                    mysqli_query($link, $query) or die(mysqli_error($link));
                }
                else{
                    $query = "INSERT INTO `basket_table` (`id_basket`, `id_product`, `count_product`) VALUES ('$basket_id', '$product_id', 1)";
                    mysqli_query($link, $query) or die(mysqli_error($link));
                }
            }
        }
    }
    else{
        $random_id = uniqid();
        setcookie('basket_id', $random_id, time() + 259200, '/');
    }
?>
<!DOCTYPE html>
<html lang = "eng">
<head>
    <meta charset = "UTF-8">
    <meta name = "viewport" content="width=device-width, initial-scale = 1.0">
    <link rel = "stylesheet" href = "main.css">
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
            <a href = "\" class = "products">Товары</a>
            <a href = "basket.php" class = "basket">Корзина</a>
        </div>
    </header>

    <div class = "container" id = "main">

    <div class = "block">

        <div class = info_about_block>
            <div class = "header_1"> Построй тело мечты</div>
            <div class = "header_2"> Фундамент</div>
            <div class = "text_info_block">Основы основ. Информация по строительствую крепкого тела. Разберем все по кирпичикам</div>
            <div class = "text_info_block">Если вы ставите цель каждому своему действию, то любая деятельность даст вам результат - Грег Плитт</div>
        </div>

        <div class = "func_block">
        <div class = "product_" style = "background-image: url('block_1.jpg')">
            
        </div>
        <button class = "button_buy" onclick="window.location='?product_id=1', modal.style.display = 'flex'">Купить</button>
        <button class = "button_info">Подробнее</button>
        </div>

    </div>

    <div class = "block">

        <div class = info_about_block>
            <div class = "header_1">Гантели</div>
            <div class = "header_2">Тренажер для всех мышц</div>
            <div class = "text_info_block">Главное преимущество использования гантелей заключается в том, что вы можете свободно регулировать степень нагрузки</div>

            <div class = "func_block">
            <button class = "button_buy" onclick="window.location='?product_id=2', modal.style.display = 'flex'">Купить</button>
            </div>
        </div>

        <div class = "func_block">
        <div class = "product_" style = "background-image: url('block_2.jpg')">
            
        </div>
        </div>

    </div>

    <div class = "block">

        <div class = info_about_block>
            <div class = "header_1">Штанга</div>
            <div class = "header_2">Выбор для мышц</div>
            <div class = "text_info_block">Спортивный снаряд для поднятия веса в тяжёлой атлетике и пауэрлифтинге</div>

            <div class = "func_block">
            <button class = "button_buy" onclick="window.location='?product_id=3', modal.style.display = 'flex'">Купить</button>
            </div>
        </div>

        <div class = "func_block">
        <div class = "product_" style = "background-image: url('block_3.jpg')">
            
        </div>
        </div>

    </div>

    <div class = "block">

        <div class = info_about_block>
            <div class = "header_1">Спортивное питание</div>
            <div class = "header_2">Выбор для роста</div>
            <div class = "text_info_block">Протеин и креатин - широкий выбор. НИКАКИХ анаболиков, только добавки к питанию</div>

            <div class = "func_block">
            <button class = "button_buy" onclick = "window.location ='?product_id=4', modal.style.display = 'flex'">Купить</button>
            </div>
        </div>

        <div class = "func_block">
        <div class = "product_" style = "background-image: url('block_4.jpg')">
            
        </div>
        </div>
    </div>
    </div>
    
    <div class = "modal" id = "modal">
        <div class = "modal-window">
            <h1 class = "text_modal">Товар перемещен в корзину</h1>
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