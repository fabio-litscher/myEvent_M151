<?php	
	class dbModel{
        private $con;
        
        var $dbName = "m151_myEvent";
        var $dbUser = "root";
        var $dbPassword = "";
        
        //	Stellt die Verbindung her
		public function connect(){
			$this->con=mysql_connect("localhost",$this->dbUser,$this->dbPassword);
			if(!$this->con){
				die('Keine Verbindung:: '.mysql_error());
			}
		}	
        
		//Erstellt eine Datenbank wenn diese noch nicht existiert		
		public function createDB(){
			$existDB = mysql_select_db($this->dbName); 
			
			if(!$existDB){
				if (mysql_query("CREATE DATABASE $this->dbName", $this->con)){
                    $this->createTableUsers();
                    $this->createTableEvents();
				} else {
					echo 'Schemaerzeugung fehlgeschlagen: ' . mysql_error() . "<br />";;
				}
			}
		}
        
        // Tabelle Users erstellen
        private function createTableUsers() {	
			mysql_select_db($this->dbName);		
            
            $sql="CREATE TABLE IF NOT EXISTS `users` (
              `idusers` int(11) NOT NULL AUTO_INCREMENT,
              `username` varchar(20) DEFAULT NULL,
              `passwort` varchar(45) DEFAULT NULL,
              `email` varchar(45) DEFAULT NULL,
              `typ` int(11) DEFAULT '0',
              PRIMARY KEY (`idusers`)
            )";
            
            if (!mysql_query($sql, $this->con)) {	
                echo "Error creating table users: " . mysql_error($this->con). "<br>";
            } else {
                include './model/user.model.php';
                $user = new userModel();
                $user->insertUser('superadmin', '17c4520f6cfd1ab53d8745e84681eb49', 'fabio.litscher@swissonline.ch');
                $user->changeTyp('1', 3);
            }
                        
			/*
			if(!mysql_num_rows(mysql_query("SHOW TABLES LIKE 'users'"))==1) {    // wenn die anzahl zeilen im ergebnis != 1 ist
				$userClass = NEW userHandling();			
				
				if (mysql_query($sql, $this->con))
				{	
					$this->insertUser("superadmin", md5("superadmin"), "fabio.litscher@swissonline.ch");
                    $userClass->changeTyp("1", 3);
				}
				else {
					echo "Error creating table Users: " . mysql_error($this->con). "<br>";;
				}				
			}
            */
            
		}
        
        // Tabelle Events erstellen
        private function createTableEvents(){		
			mysql_select_db($this->dbName);		
            
            $sql="CREATE TABLE IF NOT EXISTS `events` (
              `idevents` int(11) NOT NULL AUTO_INCREMENT,
              `name` varchar(20) DEFAULT NULL,
              `kategorie` varchar(60) DEFAULT NULL,
              `ort` varchar(45) DEFAULT NULL,
              `datum` date DEFAULT NULL,
              `beschreibung` text(200) DEFAULT NULL,
              `ersteller` int,
              PRIMARY KEY (`idevents`),
              FOREIGN KEY (ersteller) REFERENCES Users(idusers)
            )";
                        
			
            if (!mysql_query($sql, $this->con)) {	
                echo "Error creating table events: " . mysql_error($this->con). "<br>";
            }
		}
        
        
        
        
        /*
        //Löscht die Datenbank	
		public function deleteDB(){
			$existDB = mysql_select_db($this->dbName); 
			
			if($existDB){
				if (!mysql_query("DROP DATABASE $this->dbName", $this->con)){
                    echo "Error droping Database!";
                }
			}
		}
        */
    }