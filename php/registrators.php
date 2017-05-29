<?php
header('Content-Type: text/html; charset=utf-8');

require '../sql/connect.php';

function examDateList() {
	$examDate = $_GET['exam__date'];	
	global $conn;

	if (isset($examDate) and isset($_GET['reg__list'])) {		

		$queryRegDate = "SELECT * FROM schedule WHERE date = :date";		
		$stmt = $conn->prepare($queryRegDate); 
    	$stmt->execute(array(':date' => $examDate));		
    	$row = $result->fetch();
    	echo $row['date'] . "</br>";

	}
}

// Получим список регистратора кот. должны работать в эту дату
examDateList();

?>