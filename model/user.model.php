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
                            return "deactivated";   
                        }
                     } else return "wrongPw";
                 }
            }
            return "noAccount";
        }
        
        
        // fügt user der datenbank hinzu
        public function insertUser($username, $passwort, $email){
            
            $sql = "INSERT INTO users (username, passwort, email) 
            VALUES ('$username', '$passwort', '$email')";
			
			if(!$this->findUser($username)) {
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
                echo "Fehler bei der Registrierung.";
				return false;
			}
		}
        
        
        //Löscht ein Benutzer
		public function deleteUser($id){	
			if(!mysql_query("DELETE FROM users WHERE idusers = $id")){
				echo "Error delete User: " . mysql_error($this->con). "<br>";
				return false;				
			} else {
				return true;
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
        
        
        // username anhand von id zurückgeben
        public function getUsersUsername($userId) {
            $result = mysql_query("SELECT username FROM users WHERE idusers = '$userId'");
            $value = mysql_fetch_object($result);
            return $value->username;
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
        
        // ändert das passwort eines benutzers
        public function changePasswort($id, $newPassword){
			$sql = "UPDATE users SET passwort = md5(\"$newPassword\") WHERE idusers = $id";
			
			$result = mysql_query($sql);
			
			if($result === FALSE) {
					echo "Error update users (changePasswort)<br>";	
                    die(mysql_error()); // TODO: better error handling
            }
		}
        
        // ändert ein beliebiges Feld eines benutzers
        public function changeValue($id, $typ, $neuerWert) {
			$sql = "UPDATE users SET $typ = '$neuerWert' WHERE idusers = '$id'";
			
			$result = mysql_query($sql);
			
			if($result === FALSE) {
					echo "Error update users (changeUsername)<br>";	
                    die(mysql_error()); // TODO: better error handling
             }
		}
        
        
        // überprüft die registrierung
        public function checkRegister($username, $email, $passwort1, $passwort2){
            if($username == "" || $email == "" || $passwort1 == "" || $passwort2 == ""){                
                return "emptyFields";
            }else if($passwort1 != $passwort2){                             
                return "pwNotSame"; 
            }else{

                $result = mysql_query("SELECT * FROM users");

                if($result === FALSE) {
                    die(mysql_error()); // TODO: better error handling
                }


                while($row = mysql_fetch_array($result)) {
                    if($row['username'] == $username){
                         return "userExists";
                     }
                }

                $sql = "INSERT INTO users (username, passwort, email) VALUES ('$username', md5('$passwort1'), '$email')";
                $sql = mysql_query($sql);
                if ($sql == true) {
                    echo "Hallo $username, Ihre Anmeldung war erfolgreich. Bitte warten Sie bis Sie von einem Administrator freigeschaltet wurden.";
                    die();
                }
                else {
                    return "sqlError";
                    die();
                }
            }
            return true;
        }
        
    }

?>