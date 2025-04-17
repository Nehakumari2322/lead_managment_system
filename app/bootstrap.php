<?php
  // Load Config
  require_once 'config/config.php';
  // Load Helpers
  require_once 'helpers/url_helper.php';
  require_once 'helpers/session_helper.php';
 require_once '../app/vendor/autoload.php';  
  // require_once '../app/dompdf/autoload.inc.php';

  // Autoload Core Libraries
  spl_autoload_register(function($className){
    require_once 'libraries/' . $className . '.php';
    // require_once 'dompdf/src/Dompdf.php';
  });
  
