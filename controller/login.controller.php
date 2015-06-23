<?php
    class loginController{
        
        public function checkLogin($username, $password) {
            include './model/user.model.php';
            $userModel = new userModel();
            
            $md5password = md5($password);

            $_SESSION['username'] = $username;
            $_SESSION['userId'] = $userModel->getUsersId($username);

            $auth = $userModel->checkLogin($username, $md5password);

            if($auth == true){
                $nav = 'home';
            } else {
                
                if($auth == "deactivated") {
                    echo "Ihr Account wurde noch nicht freigeschaltet!";
                    die();
                }elseif($auth == "wrongPw") {
                    echo "Passwort falsch!";
                    die();
                }elseif($auth == "noAccount") {
                    echo "Es existiert kein Account mit diesem Benutzernamen!";
                    die();
                }
                
                session_destroy();
                unset($_SESSION['username']);
                $nav = 'login';
            }
            
            //return $nav;
        }
        
        
        public function registerUser($username, $email, $passwort1, $passwort2) {
            include './model/user.model.php';
            $userModel = new userModel();
            
            $result = $userModel->checkRegister($_POST["username"], $_POST["email"], $_POST["password"], $_POST["password2"]);
            
            if($result == "emptyFields") {
                echo "Nicht alle Felder ausgefüllt!";
                die();
            } elseif($result == "pwNotSame") {
                echo "Die beiden Passwörter stimmen nicht überein";
                die();
            } elseif($result == "userExists") {
                echo "Ein Benutzer mit diesem Benutzernamen existiert beretis!";
                die();
            } elseif($result == "sqlError") {
                echo "Fehler beim Erstellen Ihres Benutzers, wenden Sie sich an den Administrator.";
                die();
            } else {
                return 'login';
            }
        }
        
    }

?>