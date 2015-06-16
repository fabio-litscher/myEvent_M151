<?php

    class adminView {
        
        private $path = 'views';
        private $template;
        private $content = array();
        
        // Content wird gesetzt von Controller heraus
        public function setContent($key, $value){
            $this->content[$key] = $value;
        }
    
        // template setzen
        public function setTemplate($template = 'default'){
            $this->template = $this->path . DIRECTORY_SEPARATOR . 'templates'. DIRECTORY_SEPARATOR . $template . '.tpl.php';
        }

        public function parseTemplate(){

            if(file_exists($this->template)){

                ob_start();
                include $this->template;
                $output = ob_get_contents();
                ob_end_clean();

                return $output;
            }
            return "Kann das Template ".$this->template." nicht finden";
        }
        
    }


?>
