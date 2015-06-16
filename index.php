<?php
    // session starten
    session_start();

    // check db connection and if database exists
    include './controller/db.controller.php';
    $dbController = new dbController();
    $dbController->checkDatabaseExists();

    // login getätigt
    if(isset($_POST['login'])) {
        include './controller/login.controller.php';
        $loginController = new loginController();
        $nav = $loginController->checkLogin($_POST['username'], $_POST['password']);
    }

    // benutzer eingeloggt?
    if(!isset($_SESSION['username'])) {
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


// Welche Seite soll angezeigt werden
    // wurde die variable $nav irgendwo speziell gesetzt?
    if(isset($nav)) include "./views/$nav.php";
    
    // sonst auf geter gehen
    elseif(!isset($_GET['nav'])) {
        // noch ändern dann
        include './views/home.php';
    }
    elseif($_GET['nav'] == 'home') {
        include './views/home.php';
    }
    elseif($_GET['nav'] == 'overview') {
        include './views/eventOverview.php';
    }
    elseif($_GET['nav'] == 'new') {
        include './views/newEvent.php';
    }

    elseif($_GET['nav'] == 'admin') {
        include './controller/admin.controller.php';
        $admin = new adminController();
        
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