<?php

class Commons extends Controller{
    public function __construct(){
        $this->CommonModel = $this->model('Common');
        $this->clientModel = $this->model('Client');
        $this->taskModel = $this->model('Taskmanager');
        // $this->taskmanagermodel = $this->model('taskmanager');
        $todaysDate = null;
    }

 
    public function logmein(){
        $this->view('commons/main');    
    }

    public function Login(){
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $adata['message'] = null;
            if(isset($_POST['submit'])){
                $data = [
                    'userid' => trim($_POST['email']),
                    'password' => trim($_POST['password']),
                    'role' => trim($_POST['role'])
                ];
                $matched = $this->CommonModel->login_verification($data);
                // echo"efdgv".$matched;
                // print_r($data['role']);
                if($matched == true && $data['role']=='admin' ||  $data['role']=='vendor' ){
                    $this->createUserSession($data['userid']);
                    $userId = $_SESSION['userid'];
                    $data = $this->getDashboardUnit();
                    $currentDate = date('Y-m-d');

                    // Last week's date range (from 7 days ago to today)
                    $lastWeekStartDate = date('Y-m-d', strtotime('-7 days'));
                    $lastWeekEndDate = $currentDate;
        
                    // Last month's date range (from 1 month ago to today)
                    $lastMonthStartDate = date('Y-m-d', strtotime('-1 month'));
                    $lastMonthEndDate = $currentDate;
        
                    $graphData = $this->taskModel->getLeadsDataLastWeek();
                       // Make sure to pass the data to the view
                    $adata = [
                        'graphData' => $graphData, // Send data to view
                        'lastWeekStartDate' => $lastWeekStartDate,
                        'lastWeekEndDate' => $lastWeekEndDate,
                        // Other data you need
                    ];
                    $allLeads = $this->taskModel->getOverallLeadsData();
                    $LastMonthgraphData = $this->taskModel->getGraphDataOfLastMonth();
                    $mdata = [
                        'lastmonthgraphData' => $LastMonthgraphData, // Send data to view
                        'lastMonthStartDate' => $lastMonthStartDate,
                        'lastMonthEndDate' => $lastMonthEndDate,
                        'overAllData' => $allLeads,
                        // Other data you need
                    ];
                    $ndata = $this->getAllClientRecord();
                  
                    $this->view('cmr_all_page/main', $data, $adata, $mdata,$ndata);
                }
               
                else if($matched == true &&  $data['role']=='client'){
                    $this->createUserSession($data['userid']);
                  
                    $userId = $_SESSION['userid'];
                   
                    $data = $this->getClientDashboardUnit();
                   
                    $client_id = $_SESSION['clientId'];
                    // Get the current date
                    $currentDate = date('Y-m-d');
        
                    // Last week's date range (from 7 days ago to today)
                    $lastWeekStartDate = date('Y-m-d', strtotime('-7 days'));
                    $lastWeekEndDate = $currentDate;
        
                    // Last month's date range (from 1 month ago to today)
                    $lastMonthStartDate = date('Y-m-d', strtotime('-1 month'));
                    $lastMonthEndDate = $currentDate;
        
                    $graphData = $this->clientModel->getgraphData($client_id);
                       // Make sure to pass the data to the view
                      
                       $adata = [
                        'graphData' => $graphData, // Send data to view
                        'lastWeekStartDate' => $lastWeekStartDate,
                        'lastWeekEndDate' => $lastWeekEndDate,
                        // Other data you need
                    ];
        
                    $LastMonthgraphData = $this->clientModel->getGraphDataOfLastMonth($client_id);
                    $mdata = [
                        'lastmonthgraphData' => $LastMonthgraphData, // Send data to view
                        'lastMonthStartDate' => $lastMonthStartDate,
                        'lastMonthEndDate' => $lastMonthEndDate,
                        // Other data you need
                    ];
                    
                    $this->view('client/main',$data,$adata,$mdata);
                        
                }
                else{
                  
                    $data['message']= " Invalid Password  !! ";
                    $this->view('commons/main', $data);
                }
            }
        }
    }

    public function contactinfo(){
        if(isset($_POST['submit'])){
            $name = trim($_POST['name']);
            $email = trim($_POST['email']);
            $mobile = trim($_POST['mobile']);
            $whom = trim($_POST['who']);
            $creates_ts =  $this->getCurrentTs();
            $data['message'] = null;
            $id = $this->CommonModel->insertClientDetails($name,$email,$mobile,$whom,$creates_ts);
            if($id != null){
                $data['message'] =" Your request is sent we will reach you soon !!";
            }
            $this->view('commons/main',$data);

        }
    }

    public function footer(){
        if(isset($_POST['privacy'])){
            $this->view('commons/privacy');
        }
        else if(isset($_POST['terms'])){
            $this->view('commons/term');
        }
    }
   
    public function getClientDashboardUnit(){
        $c_id = $_SESSION['clientId'];
      
        $client_name = $_SESSION['clientname'];
        
        $data1 = $this->clientModel->getproject($c_id);
      
        $data2 = $this->clientModel->getLeadDetails($c_id);
     
        $data3 = $this->clientModel->getAllClientUserDetails( $c_id);
       
        $data['project'] = count($data1);
     
        $data['lead'] = count($data2);
      
        $data['user'] = count($data3);
     
  
        return $data;
    }
    public function getDashboardUnit(){
        $data1 = $this->taskModel->getAllUserDetails();
        $data2 = $this->taskModel->getprojectandclient();
        $data3 = $this->taskModel->getAllClientDetails();
        $data4 = $this->taskModel->getAllLeadDetails();
        $data['user'] = count($data1);
        $data['project'] = count($data2);
        $data['client'] = count($data3);
        $data['lead'] = count($data4);
        return $data;
    }

    public function getAllClientRecord(){
        $data1 = $this->taskModel->clientRecordOfWeekly();
        $data2 = $this->taskModel->clientRecordOfMonthly();
        $data3 = $this->taskModel->clientTotalRecord();
        $ndata['weekly'] = $data1->count;
        $ndata['monthly'] = $data2->count; 
        $ndata['total'] = $data3->count;
        return $ndata; 
    }
    
public function createUserSession($user) {
    if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    // Taking current system Time
    $_SESSION['start'] = time(); 

    // Destroying session after 1 minute
    // $_SESSION['expire'] = $_SESSION['start'] + (1 * 240); 
    $_SESSION['expire'] = $_SESSION['start'] + (30 * 60); // 30 minutes
    $_SESSION['loggedin'] = "YES";
    $_SESSION['userid'] = $user;
    
    // Get user data
    $data = $this->CommonModel->getUserName($user);
    $_SESSION['username'] = $data->name ?? 'Unknown';  // Handle null value with a default fallback

    // Get client data
    $data1 = $this->clientModel->getClientId($user);
    
    // Check if client data exists before accessing properties
    if ($data1) {
        $_SESSION['clientId'] = $data1->c_id;
        $_SESSION['clientname'] = $data1->name;
    } else {
        // Handle the case when the client data is not found
        $_SESSION['clientId'] = 'Unknown';
        $_SESSION['clientname'] = 'Unknown';
    }
}

   
    
    public function logout(){

        unset($_SESSION['userid']);
        unset($_SESSION['username']);
        unset($_SESSION['loggedin']);
        session_destroy();
        // redirect('users/login');
    }

    
}
?>
