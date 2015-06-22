<?php
    class AdminController {
        
        private $view;
        private $data;
        
        
        public function __construct(){
            // View erstellen
            include './views/admin.view.php';
            $this->view = new AdminView();
        }

        public function display(){
            
            // Daten bereitstellen
            $this->getUsertable();
            
            // Template setzen
            $this->view->setTemplate();
            
            // Daten übergeben an view
            $this->view->setContent("title", "Adminbereich");
            $this->view->setContent("content", $this->data);
            $this->view->setContent("menuLeft", "Some other things");

            return $this->view->parseTemplate();
        }
        
        // Daten holen und entsprechend formatieren
        public function getUsertable() {
            include './model/admin.model.php';
            $admin = new AdminModel();
            
            $allUsers = $admin->getAllUsers();
            
            $this->data = "<table>";
            
            foreach ($allUsers as $oneUser) {
                $this->data = $this->data.
                    "<tr>
                        <td>
                            $oneUser->username
                        </td>
                        <td>
                            $oneUser->email
                        </td>
                        <td>
                            $oneUser->typ
                        </td>
                    </tr>
                ";
            }
            
            $this->data = $this->data."</table>";
        }
        
    }
        
?>