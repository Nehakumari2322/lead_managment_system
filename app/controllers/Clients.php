<?php

class Clients extends Controller{
    public function __construct(){
        $this->clientModel = $this->model('Client');
        $todaysDate = null;
    }


    public function sidebar(){
        if(isset($_POST['dashboard'])){
            $data = $this->getDashboardUnit();
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
        else if(isset($_POST['project'])){
            $c_id = $_SESSION['clientId'];
            $data = $this->clientModel->getproject($c_id);            
            $this->view('client/project',$data);
        }
        else if(isset($_POST['user'])){
            $c_id = $_SESSION['clientId'];
            $data = $this->clientModel->getAllClientUserDetails( $c_id);
            $this->view('client/user',$data);
        }
        else if(isset($_POST['lead'])){
            $c_id = $_SESSION['clientId'];
            $data = $this->clientModel->getproject($c_id);
            $adata = $this->clientModel->getLeadDetails($c_id);
            $this->view('client/lead',$data,$adata);
        }
    }

 

    public function getDashboardUnit(){
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

    public function createClientUser(){
        if(isset($_POST['submit'])){
            $name = trim($_POST['name']);
            $email = trim($_POST['email']);
            $assign = trim($_POST['assign']);
            $member_of = trim($_POST['member_of']);
            $creates_ts =  $this->getCurrentTs();
            $created_by = $_SESSION['userid'];
            $lastUpdatedBy = $_SESSION['userid'];
            $lastUpdatedTs = $this->getCurrentTs();
            $c_id = $_SESSION['clientId'];
            $adata['message']= null;
            $id = $this->clientModel->insertClientUserDetails($c_id,$name,$email,$assign,$member_of,$creates_ts,$created_by,$lastUpdatedBy,$lastUpdatedTs);
            if($id != null){
                $adata['message'] = "User has been created !!";
            }
            $data = $this->clientModel->getAllClientUserDetails( $c_id);
           $this->view('client/user',$data,$adata);
        }
    }

    
    public function leadDetails(){
        if ($_SERVER['REQUEST_METHOD'] == 'POST'){
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);    
            $totalcount = trim($_POST['totalcount']);
            for ($count = 0; $count < $totalcount; $count++) {
                if (isset($_POST['lead_name'.$count])) {
                    $lead_id = trim($_POST['lead_id'.$count]);
                    $status = trim($_POST['status'.$count]);
                    $data = $this->clientModel->getLeadDetailsOfId($lead_id);
                    $c_id = $_SESSION['clientId'];
                    $adata = $this->clientModel->getAllClientUserDetails( $c_id);
                    $ndata =  $status;
                   $mdata = [];
                    $this->view('client/leadDetails', $data,$adata,$mdata,$ndata);
                    return; 
                }
               
          
    
            }
        }
    }

    public function updateLeadAssignedTo(){
        if(isset($_POST['submit'])){
            $l_id = trim($_POST['leadId']);
            $status = trim($_POST['status']);
            $status1 = trim($_POST['status1']);
            $client_remark = trim($_POST['client_remarks']);
            $clientlastUpdatedTs = $this->getCurrentTs();
            $lastUpdatedBy = $_SESSION['userid'];
            $status_updated_ts =$this->getCurrentTs();

             if (empty($status)) {
                        // Get the current status from the database
             $id = $this->clientModel->updateClientRemark($l_id,$client_remark,$lastUpdatedBy,$clientlastUpdatedTs);
            }
            else if(!empty($status)) {
                $Id = $this->clientModel->updateStatusOfLead($l_id, $status,$status_updated_ts, $client_remark, $clientlastUpdatedTs, $lastUpdatedBy);
            }
            $mdata['message'] = null;
           
            if ($Id != null || $id != null) {
                $mdata['message'] = "Updated Successfully !!";
            }
            $c_id = $_SESSION['clientId'];
             $data = $this->clientModel->getLeadDetailsOfId($l_id);
            $adata = $this->clientModel->getAllClientUserDetails( $c_id);
            $ndata =  $status1;
            $this->view('client/leadDetails', $data,$adata,$mdata,$ndata);
        
          
        }
    }
    
     public function goback(){
         if(isset($_POST['back'])){
            $status = $_POST['status1'];
            $c_id = $_SESSION['clientId'];
            // Check if $status is an array
            if (is_array($status)) {
                // Convert the array to a string (for display or debugging)
                $statusString = implode(', ', $status);
                // echo "Status: " . $statusString;
            } else {
                // If it's not an array, just display it as a string
                // echo "Status: " . trim($status);
            }
            $mdata['message'] = null;
            
            $c_id = $_SESSION['clientId'];
            $data = $this->clientModel->getproject($c_id);
            $adata = $this->clientModel->getLeadDetailsWithStatus($status,$c_id);
            if($adata == null){
                $mdata['message'] = "Lead not exist !!";
            }
            
            $this->view('client/lead',$data,$adata,$mdata);
           
        
         }
    }
    
    public function navform(){
        if(isset($_POST['homebtn'])){
            $data = $this->getDashboardUnit();
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
        else if(isset($_POST['logout'])){
        //    $this->logout();
            $this->view('commons/main');
        }   
    }


    public function leadfilter(){
        if(isset($_POST['search'])){  
            $project_id = trim($_POST['pid']);
            $status = trim($_POST['status']);
            $mdata['message']= null;
          
             if( $project_id && $status==""){
                // echo"in project";
                $adata = $this->clientModel->getLeadDetailsWithProject($project_id);
                if($adata == null){
                    $mdata['message'] = "Lead not exist !!";
                }
            }
            else if($project_id=="" && $status ){
                // echo"in status";
                $c_id = $_SESSION['clientId'];
                $adata = $this->clientModel->getLeadDetailsWithStatus($status,$c_id);
                if($adata == null){
                    $mdata['message'] = "Lead not exist !!";
                }
            }
            else if($project_id && $status ){
                // echo"in CLIENT AND PROJECT with status";
                $c_id = $_SESSION['clientId'];
                $adata = $this->clientModel->getLeadDetailsWithProjectAndStatus($c_id,$project_id,$status);
                if($adata == null){
                    $mdata['message'] = "Lead not exist !!";
                }
            }
            else{
                // echo"else";
            }

           
        }
        $c_id = $_SESSION['clientId'];
        $data = $this->clientModel->getproject($c_id);
        $this->view('client/lead',$data,$adata,$mdata);

    }
}

?>