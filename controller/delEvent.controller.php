<?php
    class DelEventController {
        
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
            $this->delEvent();
            
            // Template setzen
            $this->view->setTemplate();
            
            
            // Daten übergeben an view
            $this->view->setContent("title", $this->title);
            $this->view->setContent("content", $this->data);
            $this->view->setContent("menuLeft", "Löschen einer Veranstaltung.");

            return $this->view->parseTemplate();
        }
        
        private function delEvent() {
            include './model/event.model.php';
            $event = new EventModel();
            
            if($event->deleteEvent($_GET['delEvent'])) {
                $this->title = "Veranstaltung erfolgreich gelöscht";
                $this->data = "Die gelöschte Veranstaltung finden Sie nun nicht mehr in der Veranstaltungsübersicht.";
            } else {
                $this->title = "Fehler beim Löschen Ihrer Veranstaltung";
                $this->data = "Beim Löschen der Veranstaltung ist ein Fehler aufgetreten. <br />
                                Versuchen Sie es erneut oder wenden Sie sich an den Administrator.";
            }
        }
        
    }

?>