<?php
    class NewEventController {
        
        private $view;
        private $data;
        private $title;
        
        
        public function __construct(){
            // View erstellen
            include './views/newEvent.view.php';
            $this->view = new NewEventView();
        }

        public function display(){
            
            // Wenn Veranstaltung gespeichert werden soll
            if(isset($_POST['saveNewEvent'])) {
                $this->saveEvent();
            }
            else {
                $this->title = "Neue Veranstaltung erstellen";
                $this->makeForm();
            }
            
            // Template setzen
            $this->view->setTemplate();
            
            // Daten übergeben an view
            $this->view->setContent("title", $this->title);
            $this->view->setContent("content", $this->data);
            $this->view->setContent("menuLeft", "Erstellen Sie hier eine neue Veranstaltung oder bearbeiten Sie eine von Ihren bereits vorhandenen Veranstaltungen");

            return $this->view->parseTemplate();
        }
        
        private function saveEvent() {
            include './model/event.model.php';
            $event = new EventModel();
            
            // überprüfung ob eine gleichnamige veranstaltung bereits existiert
            if($event->existsEvent($_POST['eventName'])) {
                $this->title = "Veranstaltung bereits vorhanden";
                $this->data = "Sie können keine Veranstaltung erstellen wenn es bereits einen gleichnamigen Eintrag gibt.";
            }
            
            
            // Veranstaltung in db hinzufügen
            elseif($event->addNewEvent(htmlspecialchars($_POST['eventName']), $_POST['eventKategorie'], htmlspecialchars($_POST['eventOrt']), $_POST['eventDatum'], htmlspecialchars($_POST['eventBeschreibung']), $_SESSION['userId'])) {
                $this->title = "Veranstaltung erfolgreich erstellt";
                $this->data = "Sie finden Ihre eben erstellte Veranstaltung in der Veranstaltungsübersicht.";
            } else {
                $this->title = "Fehler beim Erstellen Ihrer Veranstaltung";
                $this->data = "Beim Erstellen der Veranstaltung ist ein Fehler aufgetreten. <br />
                                Versuchen Sie es erneut oder wenden Sie sich an den Administrator.";
            }
            
            
        }
        
        // Formular bereitstellen
        private function makeForm() {
            
            // wenn id mitgegeben oder so, daten laden um veranstaltung bearbeiten zu können
            
            $this->data = 
                "<p>Erfassen Sie hier eine neue Veranstaltung.</p>
            
            <br />
            <form method='post' action='#'>
                <table>
                    <tr>
                        <td class='normal'><label for='eventName'>Veranstaltung:</label></td>
                        <td><input type='text' name='eventName' id='eventName' placeholder='Veranstaltungsname' required  /></td>
                    </tr>
                    <tr>
                        <td class='normal'><label for='eventKategorie'>Kategorie:</label></td>
                        <td>
                            <select id='eventKategorie' name='eventKategorie' required>
                                <option value='Sport / Freizeit'>Sport / Freizeit</option>
                                <option value='Festival'>Festival</option>
                                <option value='Konzert'>Konzert</option>
                                <option value='Ferien / Reisen'>Ferien / Reisen</option>
                                <option value='Kunst / Kultur'>Kunst / Kultur</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td class='normal'><label for='eventOrt'>Ort:</label></td>
                        <td><input type='text' name='eventOrt' id='eventOrt' placeholder='Ort' required /></td>
                    </tr>
                    <tr>
                        <td class='normal'><label for='eventDatum'>Datum:</label></td>
                        <td><input type='date' name='eventDatum' id='eventDatum' placeholder='Datum' required /></td>
                    </tr>
                    <tr>
                        <td class='normal'><label for='eventBeschreibung'>Beschreibung:</label></td>
                        <td><textarea id='eventBeschreibung' name='eventBeschreibung' placeholder='Beschreibung der Veranstaltung' required /> </textarea></td>
                    </tr>
                    <tr>
                        <td colspan='2' style='text-align: right;'><input type='submit' id='saveNewEvent' name='saveNewEvent' value='Speichern' /></td>
                    </tr>
                </table>
            </form>
                ";
        }
        
    }
        
?>