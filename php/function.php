<?php 

header('Content-Type: text/html; charset=utf-8');

// Ф-ия получающая список каналов для регистратора 
function getChannelIdList($registratorIp) {
$urlRegistrator = "http://$registratorIp:2032/list";	

	// инициализируем соединение
	$ch = curl_init($urlRegistrator);	

	// запишем рез. в перем. а не выведем в браузер
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);	
	$data = curl_exec($ch);

	// закроем соединение
	curl_close($ch);

	// переведем данные в json формат
	$dataToJson = json_decode($data, true);

	// вычление список все id камер	
	if (is_array($dataToJson)) 
	{
		foreach($dataToJson as $list => $array) {
			if (is_array($array)) 
			{
				foreach($array as $cameraId => $cameraArray) {			
					$camId[] = $cameraArray['channel']['id'];									
				}
			}
		}
	}
	// возвратим camId как рез-т работы ф-ции
	return $camId;
}

// Ф-ия упр. Каналами на выбранном регистраторе
function manageChannelId($camId, $registratorIp) {
	
	// Если нажа кнопка stop
	if (isset($_GET['btn__stop']) and is_array($camId)) {		
		foreach ($camId as $id=> $value) {
			$ch = curl_init("http://$registratorIp:2032/$value/suspend");
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			$stopResult = curl_exec($ch);
				if ($stopResult === FALSE) {
					echo "камера с id = $value не была остановлена" . "</br>";
				}
				else {
					echo "камера с id = $value остановлена". "</br>";					
				}										
			curl_close($ch);
		}		
	}

	// Если нажа кнопка restart
	if (isset($_GET['btn__restart']) and is_array($camId)) {		
		foreach ($camId as $id=> $value) {
			$ch = curl_init("http://$registratorIp:2032/$value/restart");
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			$restartResult = curl_exec($ch);
				if ($restartResult  === FALSE) {
					echo "камера с id = $value не была включена" . "</br>";
				}
				else {
					echo "камера с id = $value включена". "</br>";					
				}										
			curl_close($ch);
		}		
	}

	unset($registratorIp);
	unset($camId);
}

// ф-ия получающая массив ip адресов регистраторов за выбранную дату
function examDateList() {

	// Дата экзамена
	$examDate = $_GET['exam__date'];	
	global $conn;

	if (isset($examDate) and isset($_GET['reg__list'])) {
		$queryRegDate = 'SELECT * FROM schedule WHERE date = :date';
		$stmt = $conn->prepare($queryRegDate) ;
     	$stmt->execute(array(':date' => $examDate));
     	$result = $stmt->fetchAll();	// Извлечем все данные

     	// Пройдемся по массиву массивов и извлечем ip адреса регистраторов
		if (is_array($result)) {
			foreach ($result as $key => $value) {
				$ipddrArr[] = $value['ipaddr'];
			}
		}
   	}
   	// Получим массив с ip адресами регистраторов
   	return $ipddrArr;
}

?>