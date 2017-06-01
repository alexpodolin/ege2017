<?php
// Для выбранной даты мы получаем список регистраторов
// на которых надо выключить все камеры (каналы)

require_once 'function.php';
require_once '../sql/connect.php';

// Получим список регистратора кот. должны работать в эту дату
// и запишем все это в переменную
$ipArr = examDateList();

// Для списка регистраторов данной даты получим список ссылок на камеры
// для управления ими
if (is_array($ipArr) and (count($ipArr) > 0) ) {
	foreach ($ipArr as $key => $ipAddr) {
		$camLinkArr = getChannelIdList($ipAddr);
//		print_r($camLinkArr);

		if (empty($camLinkArr)) {
			echo "<h3>" . "Невозможно обработать Регистратор с ip: $ipAddr" . "</h3>" . "</br>";
		}
		else {
			echo "Обработан Регистратор с ip: $ipAddr" . "</br>" ;
		}

		if (isset($_GET['reg__list_stop'])) {
			foreach ($camLinkArr as $id => $value) {
				$ch = curl_init("http://$ipAddr:2032/$value/suspend");
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
				$stopResult = curl_exec($ch);
					if ($stopResult === FALSE) {
						echo "<h5>" . "камера с id = $value не была остановлена" . "</h5>" ."</br>";
					}
					else {
						echo "камера с id = $value остановлена". "</br>";					
					}										
				curl_close($ch);
			}
		}

		if (isset($_GET['reg__list_start'])) {
			foreach ($camLinkArr as $id=> $value) {
				$ch = curl_init("http://$ipAddr:2032/$value/restart");
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
				$stopResult = curl_exec($ch);
					if ($stopResult === FALSE) {
						echo "<h5>" ."камера с id = $value не была включена" . "</h5>" . "</br>";
					} 
					else {
						echo "камера с id = $value включена" ."</br>";					
					}										
				curl_close($ch);
			}
		}		
	}
}

?>