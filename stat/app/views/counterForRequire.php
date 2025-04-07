<?php 
// require_once ROOT .'/stat/app/functions/writeData.php';

writeStatLine_allRequests(); // сохраняем в log "Все запросы"
writeStatLine(9, true, '');

/*<img src="<?=Host?>/stat/?sourceId=9&ref=Video_Loading...&current=&isVideo=true">*/