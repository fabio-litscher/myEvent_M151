<?php
    class adminController {
        
        //private $template;
        
        private $view;
        private $data;
        
        
        public function __construct(){
            // View erstellen
            include './views/admin.view.php';
            $this->view = new adminView();
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
            $admin = new adminModel();
            
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
                    <br />
                    <br />
                    <br />
                    <br />
                    <br />
                    <br />
                    <br />
                    <br />
                    <br />
                    <br />
                    <br />
                    <br />
                    <br />
                    <br />
                    <br />
                    <br />
                    <br />
                    <br />
                    <br />
                    <br />
                    <br />
                    <br />
                    <br />
                    <br />
                    <br />
                    <br />
                    <br />
                    <br />
                    <br />
                    <br />
                    <br />
                    <br />
                    <br />
                    <br />
                    <br />
                    <br />
                    <br />
                    <br />
                    <br />
                    <br />
                    <br />
                    <br />
                    <br />
                    <br />
                    <br />
                    <br />
                    <br />
                    <br />
                    <br />
                    <br />
                    <br />
                    <br />
                    <br />
                    <br />
                    <br />
                    <br />
                    <br />
                    <br />
                    <br />
                    <br />
                    <br />
                    <br />
                    <br />
                    <br />
                    <br />
                    <br />
                    <br />
                    <br />
                ";
            }
            
            $this->data = $this->data."</table>";
        }
        
    }
        
?>