<?php
// $localhost = ($_SERVER['SERVER_NAME'] === 'massaclub') ? '/local' : '';
// На заметку:
// define - константы работающие за пределами классов
define ('Date', date("Y-m-d"));
define ('StatDataDir', ROOT .'/app/data/stat'. Local);
define ('CronDataDir', ROOT .'/app/data/cron'. Local);
define ('ErrorsDataDir', ROOT .'/app/data/errors'. Local);
define ('DefaultSourceId', 3);
define ('DefaultBtnStyle', 'success');

define ('Sources', [
    3 => [
        'btnTitle'      => 'neoweb',
        'description'   => 'Данные Javascript счетчика.',
        'name'          => 'neoweb',
        'dir'           => StatDataDir .'/neoweb-js',
        'defaultFile'   => Date .'.txt',
        'dataCols'      => 13,
        'dataFormat'    => 'array',
        'viewFolder'    => true,
    ],
    // 7 => [
    //     'btnTitle'      => 'Все запросы',
    //     'description'   => 'Лог всех запросов к сайту. Данные сохраняются PHP функцией (не JS).',
    //     'name'          => 'massaclub',
    //     'dir'           => StatDataDir .'/massaclub-php',
    //     'defaultFile'   => Date .'.txt',
    //     'dataCols'      => 12,
    //     'dataFormat'    => 'array',
    //     'viewFolder'    => true,
    // ],
    // 8 => [
    //     'btnTitle'      => 'Блокировано',
    //     'description'   => 'Все запросы, которые были заблокированы. Данные сохраняются PHP функцией (не JS).',
    //     'name'          => 'massaclub',
    //     'dir'           => StatDataDir .'/massaclub-banned',
    //     'defaultFile'   => Date .'.txt',
    //     'dataCols'      => 12,
    //     'dataFormat'    => 'array',
    //     'viewFolder'    => true,
    // ],
    // 9 => [
    //     'btnTitle'      => 'massaclub',
    //     'description'   => 'Данные собирает Javascript счетчик.',
    //     'name'          => 'massaclub',
    //     'dir'           => StatDataDir .'/massaclub-js',
    //     'defaultFile'   => Date .'.txt',
    //     'dataCols'      => 13,
    //     'dataFormat'    => 'array',
    //     'viewFolder'    => true,
    // ],
    // 10 => [
    //     'btnTitle'      => 'vue-react',
    //     'description'   => 'Данные собирает Javascript счетчик.',
    //     'name'          => 'vue-react',
    //     'dir'           => StatDataDir .'/vue-react',
    //     'defaultFile'   => Date .'.txt',
    //     'dataCols'      => 13,
    //     'dataFormat'    => 'array',
    //     'viewFolder'    => true,
    // ],
    // 11 => [
    //     'btnTitle'      => 'Генерация уведомлений',
    //     'description'   => 'Создание уведомлений (для админа, тренеров, Chats) и постановке в email и telegram-очереди',
    //     'name'          => 'notifyConstructor-log',
    //     'dir'           => CronDataDir,
    //     'defaultFile'   => 'notifyConstructor-log.txt',
    //     'dataCols'      => 0,
    //     'btnStyle'      => 'info',
    // ],
    // 12 => [
    //     'btnTitle'      => 'Telegram worker',
    //     'description'   => 'Отправлено из telegram очереди',
    //     'name'          => 'telegramQueue-log',
    //     'dir'           => CronDataDir,
    //     'defaultFile'   => 'telegramQueue-log.txt',
    //     'dataCols'      => 0,
    //     'btnStyle'      => 'info',        
    // ],
    // 13 => [
    //     'btnTitle'      => 'Email worker',
    //     'description'   => 'Отправлено из email очереди',
    //     'name'          => 'mailQueue-log',
    //     'dir'           => CronDataDir,
    //     'defaultFile'   => 'mailQueue-log.txt',
    //     'dataCols'      => 0,
    //     'btnStyle'      => 'info',
    // ],
    // 14 => [
    //     'btnTitle'      => 'cron test',
    //     'description'   => '[description]',
    //     'name'          => 'test-log',
    //     'dir'           => CronDataDir,
    //     'defaultFile'   => 'test-log.txt',
    //     'dataCols'      => 0,
    //     'btnStyle'      => 'info',
    // ],
    // 15 => [
    //     'btnTitle'      => 'Логи (ошибок)',
    //     'description'   => '[description]',
    //     'name'          => 'Error-logs',
    //     'dir'           => ErrorsDataDir,
    //     'defaultFile'   => 'errors-log.txt',
    //     'dataCols'      => 0,
    //     'viewFolder'    => true,
    //     'btnStyle'      => 'warning',
    // ],
]);