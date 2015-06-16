<?php	
	class adminModel{
        
        public function getAllUsers(){
            
            $userArray = array();
            
			$sql = "SELECT * FROM users";
			$result = mysql_query($sql);
			while($row = mysql_fetch_object($result)) {
				if($row->typ != 3 && $row->username != $_SESSION['username']){
                    array_push($userArray, $row);
				}
   			}
            
            return $userArray;
        }
        
    }
?>