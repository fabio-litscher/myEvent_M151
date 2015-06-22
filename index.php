<?php
    // session starten
    session_start();

    // check db connection and if database exists
    include './controller/db.controller.php';
    $dbController = new dbController();
    $dbController->checkDatabaseExists();


    // login getätigt (auf login geklickt)
    if(isset($_POST['login'])) {
        include './controller/login.controller.php';
        $loginController = new loginController();
        $nav = $loginController->checkLogin($_POST['username'], $_POST['password']);
    }

    // benutzer eingeloggt?
    if(!isset($_SESSION['username'])) {
        // Variable $nav setzen, dass unten dann auf die Loginseite navigiert wird, falls der Benutzer nicht eingeloggt ist
        $nav = 'login';
    }
?>


<!-- html header Informationen -->
    <!DOCTYPE HTML>
    <html>
        <head>
            <meta charset="utf-8">
            <title>myEvent</title>

            <!-- CSS -->
            <link rel="stylesheet" type="text/css" href="./views/templates/template.css">

            <!-- fonts -->
            <link href='http://fonts.googleapis.com/css?family=Lato|Raleway' rel='stylesheet' type='text/css'>

            <!-- jQuery & Javascript -->
            <script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
            <script src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
            
            <script src="./js/navigation.js"></script>
        </head>
    </html>


<?php

    // header includen
    include './views/templates/header.php';

// Formulare abfangen
    if(isset($_POST['saveNewEvent'])) {
        include './controller/newEvent.controller.php';
        $newEvent = new NewEventController();
        
        echo $newEvent->display();
    }


// Navigation abfange
    // wurde die variable $nav irgendwo speziell gesetzt?
    elseif(isset($nav)) include "./views/$nav.php";
    
    // sonst auf geter gehen
    elseif(!isset($_GET['nav'])) {
        // noch ändern dann
        include './views/home.php';
    }
    elseif($_GET['nav'] == 'home') {
        include './views/home.php';
    }
    elseif($_GET['nav'] == 'overview') {
        include './controller/eventOverview.controller.php';
        $eventOverview = new EventOverviewController();
        
        echo $eventOverview->display();
    }
    elseif($_GET['nav'] == 'eventdetails') {
        include './controller/eventDetails.controller.php';
        $eventDetails = new EventDetailsController();
        
        echo $eventDetails->display();
    }
    elseif($_GET['nav'] == 'new') {
        include './controller/newEvent.controller.php';
        $newEvent = new NewEventController();
        
        echo $newEvent->display();
    }
    elseif($_GET['nav'] == 'admin') {
        include './controller/admin.controller.php';
        $admin = new AdminController();
        
        echo $admin->display();
    }

    elseif($_GET['nav'] == 'myProfile') {
        include './views/myProfile.php';
    }
    elseif($_GET['nav'] == 'logout') {
        session_destroy();
        include './views/login.php';
    }
    else {
        include './views/home.php';
    }



    // footer includen
    include './views/templates/footer.php';

?>