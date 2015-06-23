<?php
    class MyProfileController {
        
        private $view;
        private $data;
        private $title;
        
        
        public function __construct(){
            // View erstellen
            include './views/standard.view.php';
            $this->view = new StandardView();
        }

        public function display(){
            
            // Daten bereitstellen
            if(isset($_POST['saveMyProfile'])) {
                $this->saveMyProfile();
            } else {
                $this->setData();
                $this->title = "Mein Profil";
            }
            
            // Template setzen
            $this->view->setTemplate();
            
            
            // Daten übergeben an view
            $this->view->setContent("title", $this->title);
            $this->view->setContent("content", $this->data);
            $this->view->setContent("menuLeft", "Hier können Sie Ihr Profil bearbeiten und die einzelnen Angaben ändern.");

            return $this->view->parseTemplate();
        }
        
        private function setData() {
            include './model/user.model.php';
            $userModel = new UserModel();
            
            $userDetails = $userModel->getUserDetails($_SESSION['userId']);
            
            $this->data = "
                <p>Angemeldeter Benutzer: $userDetails->username</p>
                <br />
                
                <form action='' method='post'>
                    <table cellspacing='0'>
                        <tr>
                            <td><label for='benutzername_neu'>Benutzername neu:</label></td>
                            <td><input type='text' name='benutzername_neu' id='benutzername_neu' placeholder='Neuer Benutzername'></td>
                        </tr>
                        <tr>
                            <td colspan='2'><hr /></td>
                        </tr>
                        <tr>
                            <td><label for='email'>E-Mail neu:</label></td>
                            <td><input type='email' name='email' id='email' placeholder='max@muster.ch'></td>
                        </tr>
                        <tr>
                            <td colspan='2'><hr /></td>
                        </tr>
                        <tr>
                            <td><label for='passwort_neu'>Passwort alt:</label></td>
                            <td><input type='password' name='passwort_alt' id='passwort_alt' placeholder='Altes Passwort'></td>
                        </tr>
                        <tr>
                            <td><label for='passwort_neu'>Passwort neu:</label></td>
                            <td><input type='password' name='passwort_neu' id='passwort_neu' placeholder='Neues Passwort'></td>
                        </tr>
                        <tr>
                            <td><label for='passwort_wiederholen'>Passwort wiederholen:</label></td>
                            <td><input type='password' name='passwort_wiederholen' id='passwort_wiederholen' placeholder='Neues Passwort'></td>
                        </tr>
                        <tr>
                            <td colspan='2' style='text-align: right; padding-top: 15px;'>
                                <input type='submit' name='saveMyProfile' id='saveMyProfile' value='Speichern'>
                            </td>
                        </tr>
                    </table>
                </form>
            ";
        }
        
        
        private function saveMyProfile() {
            include './model/admin.model.php';
            include './model/user.model.php';
            $admin = new AdminModel();
            $user = new UserModel();
            
            
            // werden überschrieben wenn es fehler gibt
            $this->title = "Speichern erfolgreich";
            $this->data = "Ihre Daten wurden erfolgreich angepasst";
            
            
            $allUsers = $admin->getAllUsers();
            
            
            $username = $_SESSION['username'];
		
            $abfrage = "SELECT * FROM users";
            $ergebnis = mysql_query($abfrage);
            foreach($allUsers as $oneUser) {
                if($oneUser->username == $username){
                    $id = $oneUser->idusers;
                    $pw = $oneUser->passwort;
                }
            }

            if($_POST['benutzername_neu'] != ""){
                $typ = "username";
                $newUsername = $_POST['benutzername_neu'];
                $user->changeValue($id, $typ, $newUsername);

                // Session anpassen, dass bereits der neue Benutzername angezeigt wird
                $_SESSION['username'] = $newUsername;
                return;
            }

            if($_POST['email'] != ""){
                $typ = "email";
                $newValue = $_POST['email'];
                $user->changeValue($id, $typ, $newValue);
            }
            

            if($_POST['passwort_neu'] != ""){
                if($_POST['passwort_wiederholen'] == $_POST['passwort_neu']){
                    if(md5($_POST['passwort_alt']) == $pw) {
                        $newPassword = $_POST['passwort_neu'];
                        $user->changePasswort($id, $newPassword);
                    }
                    else {
                        $this->title = "Passwort inkorrekt";
                        $this->data = "Das alte Passwort ist falsch.";
                    }
                }
                else {
                    $this->title = "Fehler";
                    $this->data = "Die beiden neuen Passwörter stimmen nicht überein.";
                }
            }
            
        }
        
    }

?>