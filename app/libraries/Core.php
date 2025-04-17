<?php
  /*
   * App Core Class
   * Creates URL & loads core controller
   * URL FORMAT - /controller/method/params
   */
  class Core {
    protected $currentController = 'Commons';
    protected $currentMethod = 'logmein';
    protected $params = [];

    public function __construct(){
      // print_r($this->getUrl());
    //  echo "In core construct ";
      $url = $this->getUrl();
    //  echo "url 0" . $url[0];
    //  echo "url 1" . $url[1]." .....";
      

      // Look in controllers for first value
    //   if(file_exists('../app/controllers/' . ucwords($url[0]). '.php')){
    //     // If exists, set as controller
    //     $this->currentController = ucwords($url[0]);
    //   //  echo "url 0" . $url[0];
    //     // Unset 0 Index
    //     unset($url[0]);
    //   }
      
      if (isset($url[0]) && file_exists('../app/controllers/' . ucwords($url[0]) . '.php')) {
    // If the file exists, set as controller
    $this->currentController = ucwords($url[0]);
    // Unset the 0 index to proceed
    unset($url[0]);
    } else {
        // Handle the case where $url[0] is not set or the file doesn't exist
        // For example, set a default controller
        $this->currentController = 'Commons'; // Replace with your actual default controller
    }
    //  echo " Current controller is ". $this->currentController. " Method is ". $this->currentMethod ." ";
      // Require the controller
      require_once '../app/controllers/'. $this->currentController . '.php';
      // echo 'in core after controller require_once ';
      // Instantiate controller class
      $this->currentController = new $this->currentController;
      // echo ' in core after controller construct ';
      // Check for second part of url
      if(isset($url[1])){
        // Check to see if method exists in controller
        if(method_exists($this->currentController, $url[1])){
          $this->currentMethod = $url[1];
        //  echo "url 1" . $url[1];
          // Unset 1 index
          unset($url[1]);
        }
      }

      // Get params
      $this->params = $url ? array_values($url) : [];

      // Call a callback with array of params
      call_user_func_array([$this->currentController, $this->currentMethod], $this->params);
    }

    public function getUrl(){
      if(isset($_GET['url'])){
         // echo 'in if block';
        $url = rtrim($_GET['url'], '/');
        $url = filter_var($url, FILTER_SANITIZE_URL);
        $url = explode('/', $url);
        return $url;
      }
     // echo 'outside if block';
    }
  } 
  
  