<?php
require ROOT .'/stat/app/functions/limiters.php';

function printAllSources($sourceId = DefaultSourceId) {
    echo '<div>';
    foreach(Sources as $key => $value){
        $style = isset(Sources[$key]['btnStyle']) ? Sources[$key]['btnStyle'] : DefaultBtnStyle;
        if($key == $sourceId)
            echo '<div class="btn btn-outline-'. $style .' btn-sm mr-10 mb-10">'. $value['btnTitle'] .'</div>';
        else
            echo '<a href="?sourceId='. $key .'"><div class="btn btn-'. $style .' btn-sm mr-10 mb-10">'. $value['btnTitle'] .'</div></a>';
	}
    echo '</div>';
    // echo '<hr class="dashed">';
} // func


function getAsLink($href = '', $limit = 500, $dots = '') {
    $deletedStrings = ['https://massaclub.com'];
    $href = trim($href);
    $href = str_ireplace($deletedStrings, '', $href);
    $length = mb_strlen($href);

    if($length > $limit) {
        return '<a href="'. $href .'" title="'. $href .'">'. limitLength($href, $limit, $dots) .'</ a>';
    }
    return '<a href="'. $href .'" title="'. $href .'">'. $href .'</a>';
} // func


// function printLink($href = '', $limit = 500, $dots = '', $deletedStrings = ['https://massaclub.com']) {
//     $href = trim($href);
//     $href = str_ireplace($deletedStrings, '', $href);
//     $length = mb_strlen($href);

//     if($length > $limit) {
//         echo '<a href="'. $href .'" title="'. $href .'">'. limitLength($href, $limit, $dots) .'</ a>';
//         return;
//     }
//     echo '<a href="'. $href .'" title="'. $href .'">'. $href .'</a>';
//     return;
// } // func


function shortRootPath($path = '') {
    $deletedStrings = [
        'E:/OpenServer/domains/MassaClub',
        '/home2/massaclu/public_html',
    ];

    foreach ($deletedStrings as $value) {
        $path = str_ireplace($value, '', $path);
    }
    return $path;
} // func


function printFileDescription($array = '') {
    echo 'Название: <b>'. Sources[$array['sourceId']]['name'] .'</b><br>';
    echo '<div class="lightgray">'. Sources[$array['sourceId']]['description'] .'</div>';
    echo '<div class="lightgray">ID источника: '. $array['sourceId'] .'</div>';
    echo '<div class="lightgray">Каталог: '. shortRootPath($array['dir']) .'</div>';
    echo (!$array['file']) ? 'Файл не выбран' : 'Файл: '. $array['file'] .'<p>';
} // func


function printFileData_style1($array = '') {
    pre($array['content']);
} // func


function printFileData_style2($array = '') {
    echo '<table>';
    // Как сделать - копировать текст в буфер обмена:
    // https://html5css.ru/howto/howto_js_copy_clipboard.php
    foreach($array['content'] as $row){
        echo '<tr class="highlighted">';
        foreach($row as $key => $value){
            $value = trim($value);
            echo '<td>';
            switch((int)$key) {
                case 1:
                case 2:
                    if(str_contains($value, 'http')) {
                        $value = '<div class="overflow-ellipsis mw-500">'. getAsLink($value, 55, '...') .'</div>';
                    } echo $value; break;
                case 3: echo limitLength($value, 20, '..', useAbbr: true); break;
                case 4:
                    echo '<div class="text-right">';
                    echo limitLength($value, 14, '..', 'left', useAbbr: true);
                    echo '</div>'; break;
                case 7:
                    if($value) {
                        $boldWidth = 5;
                        $limit = 8;
                        $length = mb_strlen($value);
                        $value = limitLength($value, $limit);
                        // подкрашиваем часть строки
                        if($boldWidth <= $limit && $boldWidth <= $length) {
                            $value = mb_substr($value, 0, $boldWidth) .'<span class="gray-3">'. mb_substr($value, $boldWidth, $length - $boldWidth) .'</span>';
                        }
                        echo $value;
                    } break;
                default: echo $value; break;
            }
            echo '</td>';
        }
        echo '</tr>';
	}
    echo '</table>';
} // func


function printFileData_style3($array = '') {
    echo '<table>';
    // Как сделать - копировать текст в буфер обмена:
    // https://html5css.ru/howto/howto_js_copy_clipboard.php
    foreach($array['content'] as $row){
        echo '<tr class="highlighted">';
        foreach($row as $key => $value){
            $value = trim($value);
            echo '<td>';
            switch((int)$key) {
                case 1:
                case 2:
                    if(str_contains($value, 'http')) {
                        $value = '<div class="overflow-ellipsis mw-500">'. getAsLink($value, 55, '...') .'</div>';
                    } echo $value; break;
                case 3: echo limitLength($value, 20, '..', useAbbr: true); break;
                case 4: echo limitLength($value, 50, '..', 'left', useAbbr: true); break;
                default: echo $value; break;
            }
            echo '</td>';
        }
        echo '</tr>';
	}
    echo '</table>';
} // func


function printFileData_style4($array = '') {
    echo '<table>';
    echo '<tr>';
    echo '<td>Время</td>';
    echo '<td><div>Источник</div></td>';
    echo '<td><div>Страница с счетчиком</div></td>';
    echo '<td>Страна, город</td>';
    echo '<td>IP</td>';
    echo '<td>Domain</td>';
    echo '<td><abbr title="Ширина экрана">W</abbr></td>';
    echo '<td><abbr title="Высота экрана">H</abbr></td>';
    echo '<td><abbr title="Просмотрено страниц пользователем (PageViews)">PV</abbr></td>';
    echo '<td><abbr title="Авторизован ли пользователь (Правай доступа/Permissions/Auth)">Auth</abbr></td>';
    echo '<td><abbr title="Первый визит на сайт (First Visit)">First Visit</abbr></td>';
    echo '<td><abbr title="Время последнего визита (Last Visit)">Last Visit</abbr></td>';
    echo '<td>Браузер, ОС</td>';
    echo '</tr>';
    // Как сделать - копировать текст в буфер обмена:
    // https://html5css.ru/howto/howto_js_copy_clipboard.php
    foreach($array['content'] as $row){
        echo '<tr class="highlighted">';
        foreach($row as $key => $value){
            $value = trim($value);
            echo '<td>';

            switch((int)$key) {
                case 1:
                case 2:
                    if(str_contains($value, 'http')) {
                        $value = '<div class="overflow-ellipsis mw-500">'. getAsLink($value, 55, '...') .'</div>';
                    } echo $value; break;
                case 3: echo limitLength($value, 17, '..', useAbbr: true); break;
                case 4: echo limitLength($value, 15, '..', useAbbr: true); break;
                case 5:
                    echo '<div class="text-right">';
                    echo limitLength($value, 14, '..', 'left', useAbbr: true);
                    echo '</div>'; break;
                case 8: echo '<b>'. $value .'</b>'; break;
                case 9: echo '<i>'. $value .'</i>'; break;
                case 10:
                case 11:
                    echo (!$value) ? '' : date('d.m.Y H:i:s', (int)$value); break;
                default: echo $value; break;
            }
            echo '</td>';
        }
        echo '</tr>';
	}
    echo '</table>';
} // func


function printFileData($array = '') {

    printFileDescription($array);

    if(empty($array['file'])) {
        echo '<p><b>Необходимо выбрать файл</b>';
        return false;
    }
    if(empty($array['content'])) {
        echo '<p><b>Нет данных</b>';
        return false;
    }

    switch((int)$array['sourceId']) {
        case 7: printFileData_style2($array); break;
        case 8: printFileData_style3($array); break;
        case 9:
        case 10: printFileData_style4($array); break;
        default: printFileData_style1($array); break;
    } // switch
} // func


// Функция отображает список txt файлов из папки $dir
// Если количество txt файлов больше, чем $limit, то удаляет лишние txt
function viewServerFolder($sourceId, $selectedFile = '', $limit = 365) {

    echo '<p>';
    if(!$sourceId || !array_key_exists($sourceId, Sources)) exit ('~');
    // $localhost = ($_SERVER['SERVER_NAME'] === 'massaclub') ? '/localhost' : '';
    $dir = Sources[$sourceId]['dir'];

    if(!file_exists($dir)) exit('Каталог <b>'. shortRootPath($dir) .'</b> не найден');

    $exceptions = [ '.', '..', 'functions', 'data', 'local', 'index.php', 'settings.php', 'show.php' ];
    
    $files = array_diff(scandir($dir), $exceptions);
    
    // Сортировка массива в порядке убывания
    arsort($files);

    $count = 0;
    foreach ($files as $file) {
        $count += 1;
        // Если файл лишний (превышен $limit количества txt файлов), то удаляем его
        if($count >= $limit + 1){
            // chmod( $dir.'/'.$file, 0777 );   // Если заранее не известно какие права у файла и можно ли его удалить, то перед удалением добавьте команду установки прав
            unlink($dir.'/'.$file);
        }else{
            echo"<div>";
            // echo"$count) $file <br>";
            if($file === $selectedFile) echo $count.") <b>$file</b>";
            else echo $count.") <a href=\"?sourceId=$sourceId&file=$file\">$file</a>";
            // else echo $count.") <b><a href=\"?file=$file\">$file</a></b>";
            echo"</div>";
        }//	if($count >= $limit + 1){

    }// foreach
    // return rmdir($dir);

}// func