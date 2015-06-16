<?php	
	class dbController{
        public function checkDatabaseExists() {
            include './model/db.model.php';
            $dbModel = new dbModel();
            
            // verbindung zu DB herstellen
            $dbModel->connect();
            
            // überprüfen ob DB existiert
            $dbModel->createDB();
        }
    }

?>