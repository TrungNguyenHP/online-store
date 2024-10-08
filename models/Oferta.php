<?php 
class Oferta{
	public static $table = 'oferta';

	// получение информации из oferta
	public static function getInformOferta(){		 
		global $pdo;		 
		$query = "SELECT * FROM " . self::$table ;
		$q = $pdo->query($query);		 
		return $result = $q->fetch();
	}

	// изменение данных в любой таблице 
	public static function updateDataTable($data, $table, $id) {
		global $pdo;		 
 		if (isset($data)&&!empty($data)) {  
			$query = "UPDATE $table SET ";

			foreach ($data as $field => $value) {
				$query .= $field . ' = :' . $field . ', ';
			}
			 
			$query = substr($query, 0, -2);			 
			$query .= " WHERE id=$id ";
			
			$q = $pdo->prepare($query);

			foreach ($data as $field => $value) {
				$q->bindValue(':' . $field, $value);
			}

			return $q->execute();
	    }
	}

	 
}
?>