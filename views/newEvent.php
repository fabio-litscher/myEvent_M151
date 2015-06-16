<!DOCTYPE HTML>
<html>
    <body>

        <!-- Menu left -->
        <div id="menuLeft">

        </div>
        
        
        <!-- Ganze Seite -->
        <div class="page">
            
            <h1><?php if(isset($_GET['edit'])) echo $_GET['name']; else echo "Neue Veranstaltung erstellen"; ?></h1>
            <p><?php if(isset($_GET['edit'])) echo "Bearbeiten Sie hier Ihre Veranstaltung."; else echo "Erfassen Sie hier eine neue Veranstaltung."; ?></p>
            
            <br />
            <form method="post" action="../helper/newEventHelper.php">
                <table>
                    <tr>
                        <td class="normal"><label for="eventName">Veranstaltung:</label></td>
                        <td><input type="text" name="eventName" id="eventName" placeholder="Veranstaltungsname" required <?php if(isset($_GET['edit'])) echo 'value="'.$_GET['name'].'"'; ?> /></td>
                    </tr>
                    <tr>
                        <td class="normal"><label for="eventKategorie">Kategorie:</label></td>
                        <td>
                            <select id="eventKategorie" name="eventKategorie" required>
                                <option value="Sport / Freizeit" <?php if(isset($_GET['edit']) and $_GET['kategorie'] == 'Sport / Freizeit') echo 'selected'; ?>>Sport / Freizeit</option>
                                <option value="Festival" <?php if(isset($_GET['edit']) and $_GET['kategorie'] == 'Festival') echo 'selected'; ?>>Festival</option>
                                <option value="Konzert" <?php if(isset($_GET['edit']) and $_GET['kategorie'] == 'Konzert') echo 'selected'; ?>>Konzert</option>
                                <option value="Ferien / Reisen" <?php if(isset($_GET['edit']) and $_GET['kategorie'] == 'Ferien / Reisen') echo 'selected'; ?>>Ferien / Reisen</option>
                                <option value="Kunst / Kultur" <?php if(isset($_GET['edit']) and $_GET['kategorie'] == 'Kunst / Kultur') echo 'selected'; ?>>Kunst / Kultur</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td class="normal"><label for="eventOrt">Ort:</label></td>
                        <td><input type="text" name="eventOrt" id="eventOrt" placeholder="Ort" required <?php if(isset($_GET['edit'])) echo 'value="'.$_GET['ort'].'"'; ?> /></td>
                    </tr>
                    <tr>
                        <td class="normal"><label for="eventDatum">Datum:</label></td>
                        <td><input type="date" name="eventDatum" id="eventDatum" placeholder="Datum" required <?php if(isset($_GET['edit'])) echo 'value="'.$_GET['datum'].'"'; ?> /></td>
                    </tr>
                    <tr>
                        <td class="normal"><label for="eventBeschreibung">Beschreibung:</label></td>
                        <td><textarea id="eventBeschreibung" name="eventBeschreibung" placeholder="Beschreibung der Veranstaltung" required /> <?php if(isset($_GET['edit'])) { echo str_replace(array("<br />", " "), "", $_GET['beschreibung']); } ?></textarea></td>
                    </tr>
                    <tr>
                        <td colspan="2" style="text-align: right;"><input type="submit" id="saveEvent" name="<?php if(isset($_GET['edit'])) echo "saveEditedEvent"; else echo "saveEvent"; ?>" value="Speichern" /></td>
                    </tr>
                </table>
                <?php
                    if(isset($_GET['edit'])) {
                        echo '<input type="hidden" name="idEvent" value='.$_GET['idEvent'].' />';
                    }
                ?>
            </form>
            
            
        </div>
        
    </body>
</html>