<?php
    class AdminController {
        
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
            if(!$this->checkUserAccess($_SESSION['userId'])) {
                $this->title = "Zugriff verweigert!";
                $this->data = "Da Sie kein Administrator sind können Sie nicht auf die Adminoberfläche zugreifen.";
            } else {
                $this->title = "Adminbereich";
                $this->getUsertable();
            }
            
            // Template setzen
            $this->view->setTemplate();
            
            // Daten übergeben an view
            $this->view->setContent("title", $this->title);
            $this->view->setContent("content", $this->data);
            $this->view->setContent("menuLeft", "Im Adminbereich sehen Sie alle vorhandenen Benutzer.<br /> Sie können ihnen Rollen zuweisen, das heisst Sie können sie deaktivieren, als Administrator machen oder sie als normalen Benutzer speichern.");

            return $this->view->parseTemplate();
        }
        
        // darf der user auf die Adminoberfläche zugreifen?
        private function checkUserAccess($userId) {
            include './model/user.model.php';
            $user = new userModel();
            
            if($user->getUserTyp($userId) == 0 or $user->getUserTyp($userId) == 1) return false;
            else return true;
        }
        
        // Daten holen und entsprechend formatieren
        private function getUsertable() {
            include './model/admin.model.php';
            $admin = new AdminModel();
            
            $allUsers = $admin->getAllUsers();
            
            $this->data = "
                <form action='' method=''>

                    <input type='submit' value='Speichern' name='save_user' style='float: right; margin-bottom: 20px;'>
                    <input type='submit' value='Löschen' name='del_user' style='float: right; margin-right: 10px; margin-bottom: 20px;'>


                    <div> <!--class='user_table_header' > -->
                        <table cellspacing='0' border='1' width='100%'> <!-- class='style_table' > -->
                                <tr>
                                    <th width='2%'></th>
                                    <th width='13%'>User</th>
                                    <th width='25%'>E-Mail</th>
                                    <th width='20%'>Rolle</th>
                                </tr>";
                                foreach ($allUsers as $oneUser) {
                                    $this->data = $this->data.
                                        "<tr>
                                            <td>
                                                <input type='checkbox' />
                                            </td>
                                            <td>
                                                $oneUser->username
                                            </td>
                                            <td>
                                                $oneUser->email
                                            </td>
                                            <td>
                                                <select name='typ_$oneUser->username'>
                                                    <option value='0'"; if($oneUser->typ == 0) {$this->data = $this->data."selected";} $this->data = $this->data. ">deaktiviert</option>
                                                    <option value='1'"; if($oneUser->typ == 1) {$this->data = $this->data."selected";} $this->data = $this->data. ">Benutzer</option>
                                                    <option value='2'"; if($oneUser->typ == 2) {$this->data = $this->data."selected";} $this->data = $this->data. ">Admin</option>
                                                </select>
                                            </td>
                                        </tr>
                                    ";
                                }
                            $this->data = $this->data . "
                        </table>
                    </div>
                </form>
                ";
        }
        
    }
        
?>