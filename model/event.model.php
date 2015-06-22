<?php	
	class EventModel {

        public function addNewEvent($name, $kategorie, $ort, $datum, $beschreibung, $userId){
            
            $beschreibung = nl2br($beschreibung);

            $sql = "INSERT INTO events (name, kategorie, ort, datum, beschreibung, ersteller) 
            VALUES ('$name', '$kategorie', '$ort', '$datum', '$beschreibung', '$userId')";
            
            if(!mysql_query($sql)) {
                return false;
            }else {
                return true;
            }
		}
        
        
        // vorhandene veranstaltung bearbeiten
        public function updateEvent($idEvent, $name, $kategorie, $ort, $datum, $beschreibung) {
            $beschreibung = nl2br($beschreibung);
            
            $sql = "UPDATE events SET name = '$name', kategorie = '$kategorie', ort = '$ort', datum = '$datum', beschreibung = '$beschreibung' WHERE idevents = '$idEvent'";
            
            if(!mysql_query($sql)) {
                return false;
            }else {
                return true;
            }
        }
        
        // löscht eine veranstaltung
        public function deleteEvent($idEvent) {
            
			if(!mysql_query("DELETE FROM events WHERE idevents = $idEvent")){
				return false;				
			}else{
				return true;
			}
        }
        
        
        // Gibt Array mit allen Veranstaltungen zurück
        public function getAllEvents() {
            
            $eventArray = array();
            
            $result = mysql_query("SELECT * FROM events ORDER BY `idevents` DESC"); 
            
            while($row = mysql_fetch_object($result)) {
                array_push($eventArray, $row);
   			}
            
            return $eventArray;
        }
        
        
        // gibt daten einer Veranstaltung zurück
        public function getEventDetails($eventId) {
            $result = mysql_query("SELECT * FROM events WHERE idevents = '$eventId'");
            $value = mysql_fetch_object($result);
            return $value;
        }
        
        
        // Überprüft ob eine gleichnamige Veranstaltung bereits existiert
		public function existsEvent($eventName){
			mysql_select_db($this->dbName);           
            
			$result = mysql_query("SELECT * FROM events");	            

			while($row = mysql_fetch_array($result)) {				                
				if($row['name'] == $eventName){
					 return true;
				}
			 }
			 return false;
		}
        
    }

?>