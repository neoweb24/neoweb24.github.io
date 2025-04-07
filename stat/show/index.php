<?php
require __DIR__ .'/../../config/core.php';
require ROOT .'/app/data/sourcesSettings.php';
require ROOT .'/stat/app/functions/readData.php';
require ROOT .'/stat/app/functions/printData.php';

// получаем id
$sourceId = isset($_GET['sourceId']) ? $_GET['sourceId'] : DefaultSourceId;

// model
$result = readData($sourceId);

// view
require ROOT .'/stat/app/views/templates/header.php';
printAllSources($result['sourceId']);
printFileData($result);
if($result['viewFolder']) viewServerFolder($result['sourceId'], $result['file']);
require ROOT .'/stat/app/views/templates/footer.php';