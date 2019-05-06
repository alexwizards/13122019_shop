<?php

    include($_SERVER['DOCUMENT_ROOT'] . "/db/connect.php");

    echo '<pre>';
    print_r ($_GET);
    echo '</pre>';
    // получение id
    if ( isset($_GET['id']) ) {
        $cat = $_GET['id'];
    } else {
        $cat = 1;
    }

    // выбор родительских категорий
    $query = "SELECT * FROM `categories` WHERE `parent_category` = 0";
    $result = mysqli_query($db, $query);
    $template = [];

    while($row = mysqli_fetch_assoc($result) ) {
        $template['cats'][] = $row;
    }

    // выбор дочерних категорий
    $query = "SELECT * FROM `categories` WHERE `parent_category` = $cat";
    $result = mysqli_query($db, $query);

    while($row = mysqli_fetch_assoc($result) ) {
        $template['children'][] = $row;
    }

    $cat_name = '';

    foreach($template['cats'] as $key => $value) {
        if ($cat == $value['id']) {
            $cat_name = $value['name'];
        }
    }

    // echo '<pre>';
    // print_r ($template);
    // echo '</pre>'

?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../styles/dest/style.css">
    <title>Каталог товаров</title>
</head>
<body>
    <div class="wrapper">
        <header class="header">
            <div class="header__flex">
            <div class="logo logo_margin-right"></div>
            <nav class="navigation">
                <?php foreach($template['cats'] as $key => $value):?>
                <a href="/pages/catalog.php?id=<?=$value['id']?>" class="navigation__item"><?=$value['name']?></a>
                <?php endforeach;?>
                <a href="#" class="navigation__item">Новинки</a>
                <a href="#" class="navigation__item">О нас</a>
            </nav>
            </div>
            <div class="header__flex">
            <div class="icon-text">
                <div class="icon-text__icon icon-text__icon_photo"></div>
                <div class="icon-text__text">Привет, Пользователь (<a class="main-link main-link_orange" href="#">выйти</a>)</div>
            </div>
            <div class="icon-text">
                <div class="icon-text__icon icon-text__icon_basket"></div>
                <div class="icon-text__text">Корзина (5)</div>
            </div>
            </div>
        </header>
        <main>
        <div class="line"></div>
        <div class="links-navigation">
            <a href="#" class="links-navigation__item">Главная</a>
            <span class="links-navigation__item"> / </span>
            <a href="/pages/catalog.php?id=<?=$cat?>" class="links-navigation__item"><?=$cat_name?></a>
        </div>
        <section>
            <h1 class="title"><?=$cat_name?></h1>
            <div class="choose-text">Все товары</div>
            <div class="categories">
                <select name="cat_name" class="categories__items" id="cat_name">
                    <option class="categories__item" hidden>Категория</option>
                    <?php foreach($template['children'] as $key => $value): ?>
                    <option  value="<?=$value['id']?>" class="categories__item"><?=$value['name']?></option>
                    <?php endforeach;?>
                </select>
                <select class="categories__items">
                    <option class="categories__item">Размер</option>
                    <option value="S" class="categories__item">S</option>
                    <option value="M" class="categories__item">M</option>
                    <option value="L" class="categories__item">L</option>
                    <option value="XL" class="categories__item">XL</option>
                    <option value="XXL" class="categories__item">XXL</option>
                </select>
                <select class="categories__items">
                    <option class="categories__item">Стоимость</option>
                    <option value="до 1000" class="categories__item">до 1000</option>
                    <option value="1000-3000" class="categories__item">1000-3000</option>
                    <option value="3000-6000" class="categories__item">3000-6000</option>
                    <option value="6000-20000" class="categories__item">6000-20000</option>
                </select>
            </div>
            <div class="goods">   
            </div>
            <div class="goods-pages">
                <div class="goods-pages__item goods-pages__item_hover">1</div>
                <div class="goods-pages__item">2</div>
                <div class="goods-pages__item">3</div>
                <div class="goods-pages__item">4</div>
            </div>
        </section>
        </main>
        <footer class="footer">
            <div class="footer-items">
                <h3 class="footer-items__h3">Коллекции</h3>
                <a href="#" class="footer-items__links">Женщинам (1725)</a>
                <a href="#" class="footer-items__links">Мужчинам (635)</a>
                <a href="#" class="footer-items__links">Детям (2514)</a>
                <a href="#" class="footer-items__links">Новинки (76)</a>
            </div>
            <div class="footer-items">
                <h3 class="footer-items__h3">Магазин</h3>
                <a href="#" class="footer-items__links footer-items__links_center">О нас</a>
                <a href="#" class="footer-items__links footer-items__links_center">Доставка</a>
                <a href="#" class="footer-items__links footer-items__links_center">Работай с нами</a>
                <a href="#" class="footer-items__links footer-items__links_center">Контакты</a>
            </div>
            <div class="footer-items footer-items_no-border">
                <h3 class="footer-items__h3">Мы в социальных сетях</h3>
                <span href="#" class="footer-items__links">Сайт разработан в inordic.ru</span>
                <span href="#" class="footer-items__links">2018 Все права защищены</span>
                <div class="social">
                    <div class="social__item"></div>
                    <div class="social__item"></div>
                    <div class="social__item"></div>
                </div>
            </div>
        </footer>
    </div>
    <script src="../js/catalog.js"></script>
</body>
</html>