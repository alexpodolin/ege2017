<?php

// Получение списков id камер(каналов) и 
// управление этими камерами для выбранного регистратора

require_once 'function.php';

// ip адрес регистратора
$registratorIp = $_GET['registrator__ip'];


// Ф-ия получающия список(массив) id камер
$camId = getChannelIdList($registratorIp);

// Ф-ия управляющая камерами (стоп/старт)
manageChannelId($camId, $registratorIp);

?>