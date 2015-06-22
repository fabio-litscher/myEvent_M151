<?php
    class EventOverviewController {
        
        private $view;
        private $data;
        
        
        public function __construct(){
            // View erstellen
            include './views/standard.view.php';
            $this->view = new StandardView();
        }

        public function display(){
            
            // Daten bereitstellen
            $this->createView();
            
            // Template setzen
            $this->view->setTemplate();
            
            
            // Daten übergeben an view
            $this->view->setContent("title", "Veranstaltungsübersicht");
            $this->view->setContent("content", $this->data);
            $this->view->setContent("menuLeft", "Hier sehen Sie alle vorhanden Veranstaltungen. <br /> Mit einem Klick auf einen Eintrag gelangen Sie auf die Detailansicht der Veranstaltung.");

            return $this->view->parseTemplate();
        }
        
        private function createView() {
            include './model/event.model.php';
            $event = new EventModel();
            
            $allEvents = $event->getAllEvents();
            
            /*
            echo "<br><br><br><br>";
            var_dump($allEvents);
            die();
            */
            
            $this->data = "
            <form method='get' action='#'>
                <select name='eventFilter' id='eventFilter'>
                    <option value='%'>Alle Veranstaltungen</option>
                    <option value='". $_SESSION['username'] ."'>Meine Veranstaltungen</option>
                </select>
                <select name='kategorienFilter' class='filter'>
                    <option value='%'>Alle Kategorien</option>
                    <option value='Sport / Freizeit'>Sport / Freizeit</option>
                    <option value='Festival'>Festival</option>
                    <option value='Konzert'>Konzert</option>
                    <option value='Ferien / Reisen'>Ferien / Reisen</option>
                    <option value='Kunst / Kultur'>Kunst / Kultur</option>
                </select>
                <input type='submit' name='filtern' value='Filtern' class='filter' />
                <input type='submit' name='resetFilter' value='Filter zurücksetzen' />
            </form>
            
            <div id='overviewScroller'>";

            foreach ($allEvents as $oneEvent) {
                
                $this->data = $this->data . "<div style='margin: 15px; padding: 15px;'>

                    <a class='detailLink' href='?nav=eventdetails&detailLink=$oneEvent->idevents'><h3 style='margin-bottom: 0px;'>$oneEvent->name</h3></a>
                    <div style='height: 50px;'>
                        <h5 style='float: left; margin-right: 10px;'>Kategorie: </h5><h5 style='float: left; font-weight: normal;  margin-right: 40px;'>$oneEvent->kategorie</h5>
                        <h5 style='float: left; margin-right: 10px;'>Ort: </h5><h5 style='float: left; font-weight: normal;  margin-right: 40px;'>$oneEvent->ort</h5>
                        <h5 style='float: left; margin-right: 10px;'>Datum: </h5><h5 style='float: left; font-weight: normal;  margin-right: 40px;'>$oneEvent->datum</h5>
                        <h5 style='float: left; margin-right: 10px;'>Ersteller: </h5><h5 style='float: left; font-weight: normal;  margin-right: 40px;'>$oneEvent->ersteller</h5>
                    </div>
                    <p style='max-height: 3em; overflow: hidden;'>$oneEvent->beschreibung</p>
                </div>
                <hr />";
                
            }
            
            $this->data = $this->data . "</div>";
        }
        
    }
        
?>