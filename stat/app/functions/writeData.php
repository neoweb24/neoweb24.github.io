<?php
require ROOT .'/stat/app/functions/limiters.php';

// пишем в лог
function writeLineInBannedLog($ip = '', $host = '') {
    if(!$ip || !$host) return false;
    
    $date = date("Y-m-d");
    $time = date("H:i:s");
    $sourceId = 8;
    $dir = Sources[$sourceId]['dir'];
    $file = $dir .'/'. $date .'.txt';
    $ref = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '';
    $current = isset($_SERVER['REQUEST_URI']) ? Host . $_SERVER['REQUEST_URI'] : '';

    if(!is_dir($dir)) mkdir($dir, 0777, true);
    
    $content = $time  .' | '. $ref .' | '. $current .' | '. $ip .' | '. $host . PHP_EOL;
    if(file_exists($file)) $content .= file_get_contents($file);
    file_put_contents($file, $content);
    // file_put_contents($file, $content, FILE_APPEND);
} // func


// пишем в лог
function writeStatLine_allRequests($isBanned = false, $comment = '', $timer = '') {
    if($_SERVER['REMOTE_ADDR'] === AdminIp) return false; // Исключить мой ip

    $date = date("Y-m-d");
    $time = date("H:i:s");
    $sourceId = 7;
    $dir = Sources[$sourceId]['dir'];
    $file = $dir .'/'. $date .'.txt';
    $isBanned = ($isBanned === true) ? 'Banned' : '';
    if(!$isBanned && $_SERVER['REMOTE_ADDR'] === AdminIp) $isBanned = '[test]'; // помечаю мой ip
    $permissions = defined('Permissions') ? Permissions : '';
    $comment = !$comment ? '' : ' ('. $comment .')';
    $timer = limitLength($timer, 8, false);

    if(!is_dir($dir)) mkdir($dir, 0777, true);

    $ip = $_SERVER['REMOTE_ADDR'];
    $host = gethostbyaddr($ip);
    // $ref = $_SERVER['HTTP_REFERER'];
    // $current = $_SERVER['REQUEST_URI'];
    $ref = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '';
    $current = isset($_SERVER['REQUEST_URI']) ? Host . $_SERVER['REQUEST_URI'] : '';
    $phpUserAgent = isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : '';
    // $browser = get_browser(null, true);
    // $browserName = $browser['parent'] ? $browser['parent'] : '';
    // $os = $browser['platform'] ? $browser['platform'] : '';
    // Для работы функции get_browser необходимо, чтобы в установке browscap в настройках php.ini был установлен корректный путь к файлу browscap.ini в вашей системе.
    if(strpos($current, '/app/views/articles/articleVideo_backend.php') !== false) {
        $ref = 'Video_Loading...';
        $current = '';
    }

    $content = $time .' | '. $ref .' | '. $current . $comment .' | '. $ip .' | '. $host .' | '. $isBanned .' | '. $permissions .' | '. $timer .' | '. $phpUserAgent . PHP_EOL;

    if(file_exists($file)) $content .= file_get_contents($file);
    file_put_contents($file, $content);

    // file_put_contents($file, $content, FILE_APPEND);
    // // FILE_APPEND - если файл уже существует, данные будут дописаны в конец файла вместо того, чтобы его перезаписать.
} // func


function getLocation($ip = '', $domain = '') {
    // $details = json_decode(file_get_contents("http://ipinfo.io/{$ip}"), true);
    // $countryByIp = $details["country"]; // echo "Код страны: ".$details["country"];
    if(empty($ip) || strpos($domain,"clients.your-server.de")) exit;// <- Защита от атаки со стороны конкретного хоста
    
    $details = json_decode(file_get_contents("http://www.geoplugin.net/json.gp?ip={$ip}"), true);
    $country = $details["geoplugin_countryName"];
    $city = $details["geoplugin_city"];
    $currency = $details["geoplugin_currencyCode"];

    return "$country, $city. $currency";
} // func


/**
 * Отслеживание кликов.
 * Чтобы отследить нажание на определенную кнопку (div, внешн. ссылку и т.п.),
 * достаточно добавить в тег элемента data-event-id="nazvanie-sobitija".
 * К странице должен быть подключен vanilla.js
 * Все! Нажатия будут сохраняться в журнал посещений.
 */
function getEventDescriptionByEventId($eventId = '') {
    if(!$eventId) return false;

    $idParts = explode('-', $eventId);
    if(!$idParts[2]) return false;

    $result = '';
    switch($idParts[2]) {
        case 'phone':
        case 'viber':
        case 'telegram':
        case 'whatsapp':
        case 'instagram':
        case 'facebook':
            $result = 'Нажатие на контакт тренера';
            break;
        case 'writeMessage':
            $result = 'Нажатие "Написать сообщение"';
            break;
        case 'writeReviewTop':
            $result = 'Нажатие "Оставить отзыв" (вверху)';
            break;
        case 'writeReviewBtm':
            $result = 'Нажатие "Оставить отзыв" (внизу)';
            break;
        case 'writeComment':
            $result = 'Нажатие "Написать комментарий"';
            break;
        case 'reviews':
            $result = 'Нажатие "Отзывы"';
            break;
        case 'up':
            $result = 'Нажатие "Вверх"';
            break;
        default:
            $result = 'Событие';
            break;
    }
    return '<span class="color-1 bg-1">'. $result .'</span> [event-id: '. $eventId .']';;
} // func


function writeStatLine($sourceId = 9, $counterIsRequired = false, $comment = '') {
    // if($_SERVER['REMOTE_ADDR'] === AdminIp) return false; // Исключить мой ip
    $ip = $_SERVER['REMOTE_ADDR'];
    $domainName = gethostbyaddr($ip);
    if(strpos($domainName, 'fbsv.net') !== false) return false; // исключить дыбильный фейсбук-скрипт (facebook.com/externalhit_uatext.php)

    $ref = isset($_GET['ref']) ? $_GET['ref'] : '';
    $current = isset($_GET['current']) ? $_GET['current'] : '';
    $screenW = isset($_GET['screenW']) ? $_GET['screenW'] : '';
    $screenH = isset($_GET['screenH']) ? $_GET['screenH'] : '';
    $browser = isset($_SERVER['HTTP_SEC_CH_UA']) ? $_SERVER['HTTP_SEC_CH_UA'] : '';
    $phpUserAgent = isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : '';
    $pageViews = isset($_GET['pageViews']) ? $_GET['pageViews'] : '';
    $firstVisit = isset($_GET['firstVisit']) ? $_GET['firstVisit'] : '';
    $lastVisit = isset($_GET['lastVisit']) ? $_GET['lastVisit'] : '';
    // $phpLanguage = isset($_SERVER['HTTP_ACCEPT_LANGUAGE']) ? $_SERVER['HTTP_ACCEPT_LANGUAGE'] : '';
    $userAgent = isset($_GET['userAgent']) ?
        $_GET['userAgent'] .' - '. $browser :
        $phpUserAgent .' - '. $browser;
    $isVideo = isset($_GET['isVideo']) ? true : false;
    $permissions = isset($_GET['permissions']) ? $_GET['permissions'] : '';
    $eventId = isset($_GET['eventId']) ? $_GET['eventId'] : '';

    if($eventId) {
        $eventDescriprion = getEventDescriptionByEventId($eventId);
        if($eventDescriprion) $ref = $eventDescriprion;
    }

    // // для учета Axax загрузок видео в статьях:
    // if($isVideo) { $sourceId = 9; $ref = $comment; }
    // if(!empty($comment)) { $sourceId = 9; $ref = $comment; }
    if($counterIsRequired) {
        // $sourceId = 9;
        $ref = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '';
        $current = isset($_SERVER['REQUEST_URI']) ? Host . $_SERVER['REQUEST_URI'] : '';
        $isVideo = true;
    }

    // ctype_digit - возвращает true, если каждый символ строки является цифрой
    // array_key_exists - проверяет, присутствует ли в массиве (Sources) указанный ключ или индекс ($sourceId)
    if( empty($sourceId) ||
       !ctype_digit(strval($sourceId)) ||
       !array_key_exists($sourceId, Sources))
       exit("Некорректный запрос");

    if(!ctype_digit(strval($pageViews))) $pageViews = '';
    if(!ctype_digit(strval($firstVisit))) $firstVisit = '';
    if(!ctype_digit(strval($lastVisit))) $lastVisit = '';

    $time = date("H:i:s");
    $dir = Sources[$sourceId]['dir'];
    $file = $dir .'/'. Date .'.txt';

    if(!is_dir($dir)) mkdir($dir, 0777, true);

    $location = ($isVideo == false) ? getLocation($ip, $domainName) : '';
    // $location = '';
    $content = "$time | $ref | $current | $location | $ip | $domainName | $screenW | $screenH | $pageViews | $permissions | $firstVisit | $lastVisit | $userAgent ". PHP_EOL;

    // file_put_contents($file, $content , FILE_APPEND);
    if(file_exists($file)) $content .= file_get_contents($file);
    file_put_contents($file, $content);

    // echo 'file '. $file;
    // echo '<br>content '. $content;
    // exit;

    // Для информации:
    // file_put_contents (с флагом FILE_APPEND) предпочтительнее, когда нужно просто добавить в файл одну строку (или текст).
    // fopen открывает поток для чтения-записи. То есть предполагает работу с содержимым файла (не просто запись одной строки в файл).
    // PHP_EOL - константа (строка). Корректный символ конца строки, используемый на данной платформе
    // iconv - преобразование строки в требуемую кодировку

    // $stream = fopen( $file, "a+") or exit();
    // $counter = fputs( $stream, $content);
    // fclose($stream);
} // func


function printImage($width = 1, $height = 1) {
    Header("Content-type: image/png");

    $image = ImageCreate($width, $height) or exit('Невозможно создать поток изображения');
    $backgroundColor = imagecolorallocate($image, 0, 0, 0);
    // $backgroundColor = imagecolorallocate($image, 255, 255, 255);
    // $textColor = imagecolorallocate($image, 233, 14, 91);
    // imagestring($image, 1, 5, 5, $refPage, $textColor);
    imagepng($image);
    imagedestroy($image);
} // func