<?php
    class EventDetailsController {
        
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
            $this->setData();
            
            // Template setzen
            $this->view->setTemplate();
            
            
            // Daten übergeben an view
            $this->view->setContent("title", $this->title);
            $this->view->setContent("content", $this->data);
            $this->view->setContent("menuLeft", "Hier sehen Sie die ausgewählte Veranstaltung mit allen Details.");

            return $this->view->parseTemplate();
        }
        
        private function setData() {
            include './model/event.model.php';
            include './model/user.model.php';
            $event = new EventModel();
            $userModel = new userModel();
            
            $thisEvent = $event->getEventDetails($_GET['detailLink']);
            
            // titel setzen
            $this->title = $thisEvent->name;
            
            // Detaildarstellung erstellen
            $this->data = "
                <div>
                    <table>
                        <tr>
                            <td style='min-width: 200px;'><h3>Kategorie:</h3></td>
                            <td>$thisEvent->kategorie</td>
                        </tr>
                        <tr>
                            <td><h3>Ort:</h3></td>
                            <td>$thisEvent->ort</td>
                        </tr>
                        <tr>
                            <td><h3>Datum:</h3></td>
                            <td>$thisEvent->datum</td>
                        </tr>
                        <tr>
                            <td><h3>Ersteller:</h3></td>
                            <td>$thisEvent->ersteller</td>
                        </tr>
                        <tr>
                            <td style='vertical-align: top;'><h3>Beschreibung:</h3></td>
                            <td style='vertical-align: bottom;'>$thisEvent->beschreibung</td>
                        </tr>
                    </table>
                        ";
                        if($userModel->getUserTyp($_SESSION['userId']) != 1 or $_SESSION['userId'] == $thisEvent->ersteller) {
                            $this->data = $this->data . "
                                <a href='?editEvent=$thisEvent->idevents'><input type='submit' value='Veranstaltung bearbeiten' /> </a>
                                <a href='?delEvent=$thisEvent->idevents'><input type='submit' value='Veranstaltung löschen' /> </a>
                                ";
                        }
                    $this->data = $this->data . "
                </div>
            ";
        }
        
    }

?>