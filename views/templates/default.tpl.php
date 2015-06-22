<body>
    <!-- Menu left -->
    <div id='menuLeft'>
        <?php echo $this->content['menuLeft']; ?>
    </div>


    <!-- Ganze Seite -->
    <div class='page'>

        <h1><?php echo $this->content['title']; ?></h1>

        <?php echo $this->content['content']; ?>
        
        <!-- einzelner Container -->
        <!--
        <div class='container'>
        </div>
        -->
        
    </div>

</body>