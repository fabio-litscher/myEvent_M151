<?php
    class loginController{
        
        public function checkLogin($username, $password) {
            include './model/user.model.php';
            $userModel = new userModel();
            
            $md5password = md5($password);

            $_SESSION['username'] = $username;
            $_SESSION['userId'] = $userModel->getUsersId($username);

            $auth = $userModel->checkLogin($username, $md5password);

            if($auth == "true"){
                $nav = 'home';
            }else {
                session_destroy();
                unset($_SESSION['username']);
                
                $nav = 'login';
                
                /* so wurde vorher fehlermeldugn jeweils angezeigt
                
                header('location: ../template/homeMeldung.php?titel=&meldung=Ihre Anmeldung ist fehlgeschlagen. Klicken Sie <a href="../home/home.php?home">hier</a> um zurück zum Login zu gelangen.');
                */
            }
            
            return $nav;
        }
    }

?>