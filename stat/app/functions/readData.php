<?php

function dataStringToArray($content = '', $colDelimiter = '|', $rowDelimiter = PHP_EOL) {
    if(empty($content)) return false;

    // когда php (на windows) не понимает PHP_EOL
    if(mb_strpos($content, PHP_EOL) === false) {
        $lines = explode('<br />', nl2br($content)); // получаем строки в виде массива        
    } else {
        $lines = explode($rowDelimiter, $content); // получаем строки в виде массива
    }

	$lines = array_filter($lines); // удаляем все пустые элементы массива
	$lines = array_map('trim', $lines); // применяем функцию trim ко всем элементам

	$content = [];
	foreach($lines as $key => $line){
        $content[] = explode($colDelimiter, $line); // получаем массив из строки
		// $content[] = str_getcsv( $line, $colDelimiter ); // str_getcsv - выполняет разбор CSV-строки. Возвращает массив. Тоже самое можем сделать функцией explode
		unset( $lines[$key] ); // unset - удаляет переменную/элемент массива
	}

    return $content;
} // func


function readData($sourceId = DefaultSourceId) { // $needArray = true
    if(!ctype_digit((string)$sourceId) || !array_key_exists($sourceId, Sources)) $sourceId = DefaultSourceId;

    $file = isset($_GET['file']) ? $_GET['file'] : Sources[$sourceId]['defaultFile'];
    // $localhost = ($_SERVER['SERVER_NAME'] === 'massaclub') ? '/localhost' : '';
    $dir = Sources[$sourceId]['dir'];
    $filePath = $dir .'/'. $file;
    $dataFormat = isset(Sources[$sourceId]['dataFormat']) ? Sources[$sourceId]['dataFormat'] : '';
    $viewFolder = isset(Sources[$sourceId]['viewFolder']) ? Sources[$sourceId]['viewFolder'] : false;

    $content = file_exists($filePath) ? trim(file_get_contents($filePath)) : '';
    if($dataFormat === 'array') $content = dataStringToArray($content);

    // array_reverse

    return [
        'sourceId' => (int)$sourceId,
        'dir' => $dir,
        'file' => $file,
        'content' => $content,
        'viewFolder' => $viewFolder,
    ];
} // func