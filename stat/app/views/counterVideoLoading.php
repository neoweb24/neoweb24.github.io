<img src="<?=Host?>/stat/?sourceId=9&ref=Video_Loading...&current=&isVideo=true&currentTime=<?= time() ?>" width="1" height="1" alt="">
<?php
// currentTime (см. выше) нужен, чтобы исключить ответ из кеша и данные проходили обработку
require ROOT .'/app/data/sourcesSettings.php';
require ROOT .'/stat/app/functions/writeData.php';
// счетчик (все запросы)
writeStatLine_allRequests();