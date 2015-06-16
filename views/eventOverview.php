<!DOCTYPE HTML>
<html>
    <body>

        <!-- Menu left -->
        <div id="menuLeft">

        </div>
        
        
        <!-- Ganze Seite -->
        <div class="page">
            
            <h1>Veranstaltungsübersicht</h1>
            
            <form method="get" action="../helper/overviewHelper.php">
                <select name="eventFilter" id="eventFilter">
                    <option value="%">Alle Veranstaltungen</option>
                    <option value="<?php echo $_SESSION['username']; ?>" <?php if($_GET['ersteller'] == $_SESSION['username']) echo "selected"; ?>>Meine Veranstaltungen</option>
                </select>
                <select name="kategorienFilter" class="filter">
                    <option value="%">Alle Kategorien</option>
                    <option value="Sport / Freizeit" <?php if($_GET['kategorie'] == "Sport / Freizeit") echo "selected"; ?> >Sport / Freizeit</option>
                    <option value="Festival" <?php if($_GET['kategorie'] == "Festival") echo "selected"; ?>>Festival</option>
                    <option value="Konzert" <?php if($_GET['kategorie'] == "Konzert") echo "selected"; ?>>Konzert</option>
                    <option value="Ferien / Reisen" <?php if($_GET['kategorie'] == "Ferien / Reisen") echo "selected"; ?>>Ferien / Reisen</option>
                    <option value="Kunst / Kultur" <?php if($_GET['kategorie'] == "Kunst / Kultur") echo "selected"; ?>>Kunst / Kultur</option>
                </select>
                <input type="submit" name="filtern" value="Filtern" class="filter" />
                <input type="submit" name="resetFilter" value="Filter zurücksetzen" />
            </form>
            
            <div id="overviewScroller">
                <?php
/*
                    $eventClass -> showEvents($_GET['ersteller'], $_GET['kategorie']);
*/                ?>
            </div>
            
            
        </div>
        
    </body>
</html>