<?php	
	class userModel{

        //Überprüft ob das Login korrekt ist
		public function checkLogin($username, $md5Password){
            
            $result = mysql_query("SELECT * FROM users");

            if($result === FALSE) {
                die(mysql_error());
            }

            while($row = mysql_fetch_array($result)){
                if($row['username'] == $username){
                    if($row['passwort'] == $md5Password){
                        if($row['typ'] != 0){                            
                            return true;
                        }else{
                            return false;   
                        }
                     }
                 }
            }
            return false;
        }
        
        
        // fügt user der datenbank hinzu
        public function insertUser($username, $passwort, $email){
            
            $sql = "INSERT INTO users (username, passwort, email) 
            VALUES ('$username', '$passwort', '$email')";
			
			if($this->findUser($username)) {
				if(!mysql_query($sql)) {
					echo "Error insert Users: " . mysql_error($this->con). "<br>";;
				}
                else {
                    if($username == "superadmin") {
                        echo "Datenbank inklusive dem ersten User wurden erstellt.";
                    }
                    else echo "Hallo $username, deine Anmeldung war erfolgreich.";
                    
					return true;
				}
			}else{
                echo "Fehler bei der Registrierung. Kontaktieren Sie Ihren Systemadministrator";
				return false;
			}
		}
        
        // Überprüft ob Benutzer bereits existiert
		public function findUser($username){
            $result = mysql_query("SELECT idusers FROM users WHERE username = '$username'");	            
            $value = mysql_fetch_object($result);
            
            if($value == "") return false;
            else return true;
		}
        
        // gibt die ID eines benutzers zurück
        public function getUsersId($username) {
            $result = mysql_query("SELECT idusers FROM users WHERE username = '$username'");	            
            $value = mysql_fetch_object($result);
            
            if($value != "") return $value->idusers;
            else return false;
        }
        
        
        // gibt die ID eines benutzers zurück
        public function getUserTyp($iduser) {
            $result = mysql_query("SELECT typ FROM users WHERE idusers = '$iduser'");	            
            $value = mysql_fetch_object($result);
            
            if($value != "") return $value->typ;
            else return false;
        }
        
        
        // gibt die benutzerdetails zurück
        public function getUserDetails($userId) {
            $result = mysql_query("SELECT * FROM users WHERE idusers = '$userId'");
            $value = mysql_fetch_object($result);
            return $value;
        }
        
        
        /*Ändert die Rolle 
            0 -> deaktiviert
            1 -> Benutzer
            2 -> Admin
            3 -> Superadmin
        */
        public function changeTyp($userId, $typ){
            
            $sql = "UPDATE users SET typ = $typ WHERE idusers = '$userId'";
            
			if(!mysql_query($sql)){	
				echo "Error update users typ<br>";	
				return false;				
			}else{
				return true;
			}
        }
    }

?>