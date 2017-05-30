<?php

// Для выбранной даты мы получаем список регистраторов
// на которых надо выключить все камеры (каналы)

require_once 'function.php';
require_once '../sql/connect.php';

// Получим список регистратора кот. должны работать в эту дату
$ipArr = examDateList();
print_r($ipArr);

?>