<?php
// Для сбора статистики на фронте устанавливаем код счетчика: 
// Для PHP/HTML: /stat/app/views/counter.php
// Для React использую компонент MyCounter.jsx
// Для Vue использую компонент MyCounter.vue
// Дополнительно:
// Для учета загрузок видео на страницах статей (PHP/HTML) подключать counterVideoLoading.php в ajax_loadVideo_backend.php

require __DIR__ .'/../config/core.php';
require ROOT .'/app/data/sourcesSettings.php';
require ROOT .'/stat/app/functions/writeData.php';

$id = isset($_GET['id']) ? $_GET['id'] : ''; // legacy код (есть в Vue-Catalog)
$sourceId = isset($_GET['sourceId']) ? $_GET['sourceId'] : $id;  // legacy код
// $sourceId = isset($_GET['sourceId']) ? $_GET['sourceId'] : ''; // <- использовать после удаления legacy кода
// (когда на vue-react, react-cms и Vue-Catalog заменю счетчики на те,что с sourceId вместо id)

// var_dump($_GET['current']);
writeStatLine($sourceId);
printImage();


// Для информации:
// 
// <script type="text/javascript"><!--
// document.write("<a href='http://    www.liveinternet.ru/click' "+
// "target=_blank><img src='//counter.yadro.ru/hit?ttttt"+
// escape(document.referrer)+((typeof(screen)=="undefined")?"":
// ";s"+screen.width+"*"+screen.height+"*"+(screen.colorDepth?
// screen.colorDepth:screen.pixelDepth))+";u"+escape(document.URL)+
// ";h"+escape(document.title.substring(0,80))+";"+Math.random()+
// "' alt='' title='LiveInternet: показано число просмотров за 24"+
// " часа, посетителей за 24 часа и за сегодня' "+
// "border='0' width='88' height='31'><\/a>")//-->
// </script>