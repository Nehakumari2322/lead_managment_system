<?php
  /*
   * Base Controller
   * Loads the models and views
   */
  class Controller {
    // Load model
    // public function model($model){
    //   // Require model file
    //   // echo 'model is '.$model;
    //  require_once '../app/models/' . $model . '.php';

    //   // Instantiate model
    //   return new $model();
    // }
    
    public function model($model){
        $modelFile = __DIR__ . '/../models/' . $model . '.php';
        if(file_exists($modelFile)){
            require_once $modelFile;
            // echo 'Loaded model: ' . $model;
            return new $model();
        } else {
            die('Model ' . $model . ' not found.');
        }
    }
    
    // public function loadController($controller, $method, $params){
    //   // Require model file
    //   // echo 'COntroller is '.$controller;
    //   require_once '../app/controllers/' . $controller . '.php';

    //   // Instantiate model
    //   $controller = new $controller();
    //  // echo "I am in load controller ";
    //  // print_r($params);
    //   call_user_func_array([$controller, $method], $params);
      
    // }

    public function loadController($controller, $method, $params){
        // Construct absolute path to the controller file
        $controllerFile = __DIR__ . '/../controllers/' . $controller . '.php';
        
        // Check if the controller file exists
        if(file_exists($controllerFile)){
            require_once $controllerFile;
            $controller = new $controller(); // Instantiate controller
            call_user_func_array([$controller, $method], $params);
        } else {
            die('Controller ' . $controller . ' not found.');
        }
    }


    // Load view
    // public function view($view, $data = [], $additionalData = [], $moreData = [], $newData = [], $result = [],$store =[],$content = [],$line = [],$double = [],$triple = [],$quard = [],$resultset = []){
    //   // Check for view file
    //  // echo 'i am in view called from controller base class with '. $view . " Data: ";
    //  // print_r($data);
    //   if(file_exists('../app/views/' . $view . '.php')){
    //      // echo ' file exists ';
    //     require_once '../app/views/' . $view . '.php';
    //   } else {
    //     // View does not exist
    //     die('View does not exist');
    //   }
    // }
    
     public function view($view, $data = [], $additionalData = [], $moreData = [], $newData = [], $result = [],$store =[],$content = [],$line = [],$double = [],$triple = [],$quard = [],$resultset = []){
        // Construct absolute path to the view file
        $viewFile = __DIR__ . '/../views/' . $view . '.php';
        
        // Check if the view file exists
        if(file_exists($viewFile)){
            require_once $viewFile;
        } else {
            die('View ' . $view . ' does not exist');
        }
    }

    public function view1($view, $data = [], $additionalData = [], $moreData = [], $newData = [], $result = [],$store =[],$content = [],$line = [], $double = [],$triple = [],$quard = [],$resultset = []){
      // Check for view file
     // echo 'i am in view1 called from controller base class with '. $view . " Data: ";
     // print_r($data);
      if(file_exists( $view . '.php')){
         // echo ' file exists ';
        require_once $view . '.php';
      } else {
        // View does not exist
        die('View does not exist');
      }
    }
    public function getCurrentTs(){
      date_default_timezone_set('Asia/Kolkata');
      $current_ts=date('Y-m-d H:i:s');
      return $current_ts;
    }

    public function getCurrentDate(){
      date_default_timezone_set('Asia/Kolkata');
      $current_date=date('Y-m-d ');
      return $current_date;
    }

  }