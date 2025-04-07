<?php require __DIR__ .'/../config/core.php'; ?><!DOCTYPE html>
<html lang="uk">
    <head>
        <meta charset="UTF-8">
        <title>Візуальний редактор - Створення сайтів, створення Інтернет магазинів</title>
        <meta name="description" content="Візуальний редактор - Створення сайтів, створення Інтернет магазинів">
        <meta name="keywords" content="створення сайтів створення Інтернет магазинів">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" type="image/png" href="<?= Host ?>/src/img/favicons/favicon_144px.png">
        <meta name="robots" content="noindex,nofollow">
        <link rel="stylesheet" type="text/css" href="../src/css/jan04/styles.min.css">
        <link rel="alternate" hreflang="uk" href="https://neoweb.kyiv.ua/editor">
        <link rel="alternate" hreflang="ru" href="https://neoweb.kyiv.ua/ru/editor">
        <link rel="canonical" href="https://neoweb.kyiv.ua/editor">
    </head>
<body>
    <div class="text-center px-15 pt-15 pb-40">
        <h1 class="mb-12">Візуальний редактор</h1><p>
        Материіл в процессі редагування виглядає так само, як і кінцевий результат.<br>
        Зображення візуального редактору:<p>
        <img src="../src/img/editor.gif" width="677" height="422" class="img-fluid" alt="Візуальний редактор"><p>
        <a href="../" class="intext" title="">Повернутись на головну</a>
    </div>
<?php
	// Исключить мой ip
	if($_SERVER['SERVER_NAME'] !== 'neoweb2024') {
?>
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-ZVRMKZ8F8C"></script>
    <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'G-ZVRMKZ8F8C');
    </script>
<? } /*require ROOT .'/stat/app/views/counter.min.php';*/ ?>
</body>
</html>