<?php
/**
 * Мой счетчик. На HTML, JS и PHP.
 * Файл (counter.min.php) минифицировал (в ручную), чтобы при просмотре кода в браузере, весь код (этого файла) был в одну строку.
 * Решил не "выносить" код в отдельный js файл (хотя проверял и работает), чтобы не добавлять лишние запросы на сервер. Чем меньше запросов, тем лучше.
 */
define('currentTime', time());
?><script>
let permissions = '<?/*= Permissions */?>';
const currentTime = <?= currentTime ?>; 
let pageViews = localStorage.getItem('pageViews');
let firstVisit = localStorage.getItem('firstVisit');
let lastVisit = localStorage.getItem('lastVisit');
// в строке не только цифры (или переменная пуста)
if(!pageViews || !pageViews.match(/^\d+$/)) pageViews = 0;
// в строке не только цифры (или переменная пуста)
if(!firstVisit || !firstVisit.match(/^\d+$/)) {
    firstVisit = '';
    localStorage.setItem('firstVisit', currentTime);
}
// в строке не только цифры (или переменная пуста)
if(!lastVisit || !lastVisit.match(/^\d+$/)) {
    lastVisit = '';
    localStorage.setItem('lastVisit', currentTime);
}
if(firstVisit.length > 12) { firstVisit = ''; localStorage.setItem('firstVisit', currentTime); }
pageViews = Number(pageViews) + 1;
localStorage.setItem('pageViews', pageViews);
localStorage.setItem('lastVisit', currentTime);
// localStorage.setItem('lastVisit', Date.now());
// // userAgent - ON:
// document.write( '<img src="<?=Host?>/stat/?sourceId=9&ref=' + document.referrer + '&current=' + document.location.href + '&screenW=' + window.screen.width + '&screenH=' + window.screen.height + '&userAgent=' + window.navigator.userAgent + '&pageViews=' + pageViews + '&firstVisit=' + firstVisit + '&lastVisit=' + lastVisit + '&permissions=' + permissions + '" width="1" height="1" alt="">');
// userAgent - OFF:
document.write( '<img src="<?=Host?>/stat/?sourceId=3&ref=' + document.referrer + '&current=' + document.location.href + '&screenW=' + window.screen.width + '&screenH=' + window.screen.height + '&pageViews=' + pageViews + '&firstVisit=' + firstVisit + '&lastVisit=' + lastVisit + '&permissions=' + permissions + '" width="1" height="1" alt="">');
</script>
<?php
// посмотреть что выдают SCRIPT_NAME, QUERY_STRING
// location.href=\"${_SERVER['SCRIPT_NAME']}?${_SERVER['QUERY_STRING']}"