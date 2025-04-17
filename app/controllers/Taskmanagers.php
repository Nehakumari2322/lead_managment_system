<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
/**
 * Description of User
 *
 * @author Software Development Wing <Penta Head Private Ltd.>
 */
use vendor\vendor;  
 use Facebook\Facebook;
use FacebookAds\Api;
use FacebookAds\Logger\CurlLogger;
use FacebookAds\Object\ServerSide\ActionSource;
use FacebookAds\Object\ServerSide\Content;
use FacebookAds\Object\ServerSide\CustomData;
use FacebookAds\Object\ServerSide\DeliveryCategory;
use FacebookAds\Object\ServerSide\Event;
use FacebookAds\Object\ServerSide\EventRequest;
use FacebookAds\Object\ServerSide\UserData;
class Taskmanagers extends Controller{
    public function __construct() {
        // echo 'Agents construct';
        $this->taskmanagermodel = $this->model('Taskmanager');
        $this->CommonModel = $this->model('Common');
        $todaysDate = null;
    }
 

    public function sidebar(){
        if(isset($_POST['dashboard'])){
            $data = $this->getDashboardUnit();
            
            $currentDate = date('Y-m-d');

            // Last week's date range (from 7 days ago to today)
            $lastWeekStartDate = date('Y-m-d', strtotime('-7 days'));
            $lastWeekEndDate = $currentDate;

            // Last month's date range (from 1 month ago to today)
            $lastMonthStartDate = date('Y-m-d', strtotime('-1 month'));
            $lastMonthEndDate = $currentDate;

            $graphData = $this->taskmanagermodel->getLeadsDataLastWeek();
               // Make sure to pass the data to the view
            $adata = [
                'graphData' => $graphData, // Send data to view
                'lastWeekStartDate' => $lastWeekStartDate,
                'lastWeekEndDate' => $lastWeekEndDate,
                // Other data you need
            ];

            $LastMonthgraphData = $this->taskmanagermodel->getGraphDataOfLastMonth();
            $allLeads = $this->taskmanagermodel->getOverallLeadsData();
            $ndata = $this->getAllClientRecord();
         
            $mdata = [
                'lastmonthgraphData' => $LastMonthgraphData, // Send data to view
                'overAllData' => $allLeads,
                'lastMonthStartDate' => $lastMonthStartDate,
                'lastMonthEndDate' => $lastMonthEndDate,
                // Other data you need
            ];
            $this->view('cmr_all_page/main', $data, $adata, $mdata,$ndata);
        }
        else if(isset($_POST['users'])){
            $data = $this->taskmanagermodel->getAllUserDetails();
            $this->view('cmr_all_page/user',$data);
        }
        else if(isset($_POST['project'])){
            $data = $this->taskmanagermodel->getAllProjectDetails();
            $adata = $this->taskmanagermodel->getAllClientDetails();            
            $this->view('cmr_all_page/project',$data,$adata);
        }
        else if(isset($_POST['client'])){
            $data = $this->taskmanagermodel->getAllClientDetails();
            $this->view('cmr_all_page/client',$data);
        }
        else if(isset($_POST['lead'])){
            $data = $this->taskmanagermodel->getprojectandclient();
            $adata = $this->taskmanagermodel->getLeadDetails();
            $ndata = $this->taskmanagermodel->getAllClientDetails();
           $mdata = [];
            $rdata = $this->taskmanagermodel->getUserDetails();
            $this->view('cmr_all_page/lead',$data,$adata,$mdata,$ndata,$rdata);
        }
        else if(isset($_POST['leadrule'])){
            $data = $this->taskmanagermodel->getProjectDetails();
            $adata = $this->taskmanagermodel->getAssignmentRule();
            $this->view('cmr_all_page/leadrule',$data,$adata);
        }
        else if(isset($_POST['whatsapprule'])){
            $data = $this->taskmanagermodel->getWhatsappRule();
            $mdata = $this->taskmanagermodel->getProjectDetails();
            $adata['message'] = null;
            if($data == null){
                $adata['message'] = " No WhatsApp Rule Found ";
            }
            $this->view('cmr_all_page/whastsapprule',$data,$adata,$mdata);
        }
        else if(isset($_POST['audit'])){
            $this->view('cmr_all_page/audit');
        }
        else if(isset($_POST['call'])){
            $this->view('cmr_all_page/callreport');
        }
        else if(isset($_POST['leadreport'])){
            $this->view('cmr_all_page/leadreport');
        }
    }

    public function getAllClientRecord(){
        $data1 = $this->taskmanagermodel->clientRecordOfWeekly();
        $data2 = $this->taskmanagermodel->clientRecordOfMonthly();
        $data3 = $this->taskmanagermodel->clientTotalRecord();
        $ndata['weekly'] = $data1->count;
        $ndata['monthly'] = $data2->count; 
        $ndata['total'] = $data3->count;
        return $ndata; 
    }

    public function getDashboardUnit(){
        $data1 = $this->taskmanagermodel->getAllUserDetails();
        $data2 = $this->taskmanagermodel->getprojectandclient();
        $data3 = $this->taskmanagermodel->getAllClientDetails();
        $data4 = $this->taskmanagermodel->getAllLeadDetails();
        $data['user'] = count($data1);
        $data['project'] = count($data2);
        $data['client'] = count($data3);
        $data['lead'] = count($data4);
        return $data;
    }

    public function navform(){
        if(isset($_POST['homebtn'])){
            $data = $this->getDashboardUnit();
            
            $currentDate = date('Y-m-d');

            // Last week's date range (from 7 days ago to today)
            $lastWeekStartDate = date('Y-m-d', strtotime('-7 days'));
            $lastWeekEndDate = $currentDate;

            // Last month's date range (from 1 month ago to today)
            $lastMonthStartDate = date('Y-m-d', strtotime('-1 month'));
            $lastMonthEndDate = $currentDate;

            $graphData = $this->taskmanagermodel->getLeadsDataLastWeek();
               // Make sure to pass the data to the view
            $adata = [
                'graphData' => $graphData, // Send data to view
                'lastWeekStartDate' => $lastWeekStartDate,
                'lastWeekEndDate' => $lastWeekEndDate,
                // Other data you need
            ];

            $LastMonthgraphData = $this->taskmanagermodel->getGraphDataOfLastMonth();
            $allLeads = $this->taskmanagermodel->getOverallLeadsData();
            $ndata = $this->getAllClientRecord();
         
            $mdata = [
                'lastmonthgraphData' => $LastMonthgraphData, // Send data to view
                'overAllData' => $allLeads,
                'lastMonthStartDate' => $lastMonthStartDate,
                'lastMonthEndDate' => $lastMonthEndDate,
                // Other data you need
            ];
            $this->view('cmr_all_page/main', $data, $adata, $mdata,$ndata);
        }
        else if(isset($_POST['logout'])){
           $this->logout();
           $this->view('commons/main');
        }   
    }

    public function createUser(){
        if(isset($_POST['submit'])){
            $name = trim($_POST['name']);
            $email = trim($_POST['email']);
            $membertype = trim($_POST['membertype']);
            $assign = trim($_POST['assign']);
            $password = trim($_POST['password']);
            $admin = trim($_POST['admin']);
            $member_of = trim($_POST['member_of']);
            $creates_ts =  $this->getCurrentTs();
            $created_by = $_SESSION['userid'];
            $lastUpdatedBy = $_SESSION['userid'];
            $lastUpdatedTs = $this->getCurrentTs();
            $adata['message']= null;
            $id = $this->taskmanagermodel->insertUserDetails($name,$email,$membertype,$assign,$admin,$member_of,$creates_ts,$created_by,$lastUpdatedBy,$lastUpdatedTs);
            $Id = $this->taskmanagermodel->insertIntoLoginDetails($name,$email,$password,$membertype,$creates_ts,$created_by);
            if($id != null && $Id != null){
                $adata['message'] = "User has been created !!";
            }
           $data = $this->taskmanagermodel->getAllUserDetails();
           $this->view('cmr_all_page/user',$data,$adata);
        }
    }


    public function addClientDetails(){
         if(isset($_POST['submit'])){
            $name = trim($_POST['name']);
            $email = trim($_POST['email']);
            $phone = trim($_POST['number']);
            $password = trim($_POST['password']);
            $role = 'client';
            $creates_ts =  $this->getCurrentTs();
            $created_by = $_SESSION['userid'];
            $lastUpdatedBy = $_SESSION['userid'];
            $lastUpdatedTs = $this->getCurrentTs();
            $adata['message']= null;
            $id = $this->taskmanagermodel->insertClientDetails($name,$creates_ts,$created_by,$lastUpdatedBy,$lastUpdatedTs);
            $ID = $this->taskmanagermodel->insertClientPersonal($id,$email,$phone, $creates_ts, $created_by, $lastUpdatedBy, $lastUpdatedTs);
            $login = $this->taskmanagermodel->loginDetails($name,$email,$password,$role,$creates_ts,$created_by);
            if($id != null && $ID != null && $login != null){
                $adata['message'] = "Client has been created !!";
            }
           $data = $this->taskmanagermodel->getAllClientDetails();
           $this->view('cmr_all_page/client',$data,$adata);
        }
    }

    public function createProject(){
        if(isset($_POST['submit'])){
            $cid = trim($_POST['cid']);
            $p_name = trim($_POST['pname']);
            $status = trim($_POST['status']);
            $creates_ts =  $this->getCurrentTs();
            $created_by = $_SESSION['userid'];
            $lastUpdatedBy =$_SESSION['userid'];
            $lastUpdatedTs = $this->getCurrentTs();
            $url =  trim($_POST['url']);
            $mdata['message']= null;
          
            $Id = $this->taskmanagermodel->insertProjectDetails($cid, $p_name, $status,$url, $created_by, $creates_ts, $lastUpdatedBy, $lastUpdatedTs);
            if($Id != null){
                $mdata['message'] = "Project has been created !!";
            }          
           
            $data = $this->taskmanagermodel->getAllProjectDetails();
            $adata = $this->taskmanagermodel->getAllClientDetails();            
            $this->view('cmr_all_page/project',$data,$adata,$mdata);
        }
    }

  public function createLead() {
        if (isset($_POST['submit'])) {
            // Capture form data
            $pid = trim($_POST['pid']);
            $l_name = trim($_POST['lname']);
            $email = trim($_POST['email']);
            $phone = trim($_POST['phone']);
            $status = trim($_POST['status']);
            $source = trim($_POST['source']);
            $vendor_remark = trim($_POST['vendor']);
            $client_remark = trim($_POST['client']);
            $vendor_name = trim($_POST['vendor_name']);
            $requirement = trim($_POST['requi']);
            $created_ts = $this->getCurrentTs();
            $created_by = $_SESSION['userid'];
            $lastUpdatedBy = $_SESSION['userid'];
            $lastUpdatedTs = $this->getCurrentTs();
            $mdata['message'] = null;
    
            // Insert lead data into the database
            $id = $this->taskmanagermodel->insertLeadDetails($pid, $l_name, $email, $phone, $status, $source, $vendor_remark, $client_remark, $vendor_name, $requirement, $created_ts, $created_by, $lastUpdatedBy, $lastUpdatedTs);
    
            if ($id != null) {
                $mdata['message'] = "Lead has been created !!";
    
                // Include Facebook SDK and necessary classes
              
    
              
    
                // Initialize Facebook API
                $access_token = 'EAAIGJNvBx2QBO8ZAM4ca8i9cZAeDCA1ZBtR4nz6G9PTPbIFJl3W3vTZBckZAziRHgYJpPCgoZAEndYOlwZCe1lGoPfE4rqZBwxFmeGgQUD5tixk6MNVL34ltswlY9wTvgv0lJERvA3xYbRSmaJeFF0dIpiiQlKFEFfBZB1J4JvZB1ZBEIYgRcmf78fsMFLJXOteSAZAnJAZDZD'; // Your access token
                $pixel_id = '514885268208478'; // Your Pixel ID
                $api = Api::init(null, null, $access_token);
                $api->setLogger(new CurlLogger());
    
                // Hash email and phone for security (as Facebook expects hashed data)
                $hashed_email = hash('sha256', $email);
                $hashed_phone = hash('sha256', $phone);
    
                // Create user data
                $user_data = (new UserData())
                    ->setEmails([$hashed_email])
                    ->setPhones([$hashed_phone])
                    ->setClientIpAddress($_SERVER['REMOTE_ADDR'])
                    ->setClientUserAgent($_SERVER['HTTP_USER_AGENT'])
                    ->setFbc('fb.1.1554763741205.AbCdEfGhIjKlMnOpQrStUvWxYz1234567890')
                    ->setFbp('fb.1.1558571054389.1098115397');
    
                // Custom data for the event
                $custom_data = (new CustomData())
                    ->setValue(100.2) // Use actual lead value if applicable
                    ->setCurrency('USD')
                    ->setContentIds(['product.id.123']) // Example product ID
                    ->setContentType('product');
    
                // Create the event
                $event = (new Event())
                    ->setEventName('Purchase')
                    ->setEventTime(time())
                    ->setEventId("event.id.123")
                    ->setEventSourceUrl("http://jaspers-market.com/product/123")
                    ->setUserData($user_data)
                    ->setCustomData($custom_data)
                    ->setActionSource(ActionSource::WEBSITE);
    
                // Send the event to Facebook
                $events = [$event];
                $request = (new EventRequest($pixel_id))->setEvents($events);
                $response = $request->execute();
    
                // Optional: Log or output the response to verify success
                // print_r($response);
            }
    
            // Load and render the updated lead view
            $data = $this->taskmanagermodel->getprojectandclient();
            $adata = $this->taskmanagermodel->getLeadDetails();
            $this->view('cmr_all_page/lead', $data, $adata, $mdata);
        }
    }
    
    // public function createLead(){
    //     if(isset($_POST['submit'])){
    //         $pid = trim($_POST['pid']);
    //         $l_name = trim($_POST['lname']);
    //         $email = trim($_POST['email']);
    //         $phone = trim($_POST['phone']);
    //         $status = trim($_POST['status']);
    //         $source = trim($_POST['source']); 
    //         $vendor_remark = trim($_POST['vendor']); 
    //         $client_remark = trim($_POST['client']);
    //         $vendor_name = trim($_POST['vendor_name']);
    //         $requirement = trim($_POST['requi']);
    //         $created_ts =  $this->getCurrentTs();
    //         $created_by = $_SESSION['userid'];
    //         $lastUpdatedBy = $_SESSION['userid'];
    //         $lastUpdatedTs = $this->getCurrentTs();
    //         $mdata['message']= null;
    //         $id = $this->taskmanagermodel->insertLeadDetails($pid,$l_name,$email,$phone,$status,$source,$vendor_remark,$client_remark,$vendor_name,$requirement,$created_ts,$created_by,$lastUpdatedBy,$lastUpdatedTs);
    //         if($id != null){
    //             $mdata['message'] = "Lead has been created !!";
    //         }
    //         $data = $this->taskmanagermodel->getprojectandclient();
    //         $adata = $this->taskmanagermodel->getLeadDetails();
    //         $this->view('cmr_all_page/lead',$data,$adata,$mdata);
    //     }
    // }

    public function leadfilter(){
        if(isset($_POST['search'])){
            $client_id = trim($_POST['cid']);
            $project_id = trim($_POST['pid']);
            $status = trim($_POST['status']);
            $vendor = trim($_POST['vendor']);
          
            $mdata['message']= null;
            if($client_id && $project_id=="" && $status=="" && $vendor=="" ){
                // echo"in client";
                $adata = $this->taskmanagermodel->getLeadDetailsWithClient($client_id);
                if($adata == null){
                    $mdata['message'] = "Lead not exist !!";
                }
            }
            else if($client_id=="" && $project_id && $status=="" && $vendor==""){
                // echo"in project";
                $adata = $this->taskmanagermodel->getLeadDetailsWithProject($project_id);
                if($adata == null){
                    $mdata['message'] = "Lead not exist !!";
                }
            }
            else if($client_id=="" && $project_id=="" && $status && $vendor==""){
                // echo"in status";
                $adata = $this->taskmanagermodel->getLeadDetailsWithStatus($status);
                if($adata == null){
                    $mdata['message'] = "Lead not exist !!";
                }
            }
            else if($vendor && $client_id=="" && $project_id=="" && $status=="" ){
                // echo"in vendor";
                $sdata ="Assigned to ".$vendor;
                $adata = $this->taskmanagermodel->getLeadDetailsWithVendor($vendor);
                $sdata ="Assigned to ".$vendor;
                if($adata == null){
                    $mdata['message'] = "Lead not exist !!";
                }
            }
            else if($client_id && $project_id && $status == "" && $vendor ==""){
                // echo"in CLIENT AND PROJECT";
                $adata = $this->taskmanagermodel->getLeadDetailsWithClientAndProject($client_id,$project_id);
                if($adata == null){
                    $mdata['message'] = "Lead not exist !!";
                }
            }

            else if($client_id && $project_id && $status && $vendor ==""){
                // echo"in CLIENT AND PROJECT with status";
                $adata = $this->taskmanagermodel->getLeadDetailsWithClientAndProjectAndStatus($client_id,$project_id,$status);
                if($adata == null){
                    $mdata['message'] = "Lead not exist !!";
                }
            }

            else if($client_id && $project_id && $status && $vendor){
                // echo"in CLIENT AND PROJECT with status and vendor";
                $adata = $this->taskmanagermodel->getLeadDetailsWithClientAndProjectAndStatusAndVendor($client_id,$project_id,$status,$vendor);
                if($adata == null){
                    $mdata['message'] = "Lead not exist !!";
                }
            }

            else{
                echo"else";
            }

           
        }
        $data = $this->taskmanagermodel->getprojectandclient();
        $ndata = $this->taskmanagermodel->getAllClientDetails();
        $rdata = $this->taskmanagermodel->getUserDetails();
        $this->view('cmr_all_page/lead',$data,$adata,$mdata,$ndata,$rdata,$sdata);

    }

    public function takeMeToProjectList(){
        if ($_SERVER['REQUEST_METHOD'] == 'POST'){
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);    
            $totalcount = trim($_POST['totalcount']);
            for ($count = 0; $count < $totalcount; $count++) {
                if (isset($_POST['projectCount'.$count])) {
                    $client_id = trim($_POST['client_id'.$count]);
                    $data = $this->taskmanagermodel->getprojectlist($client_id);
                    $this->view('cmr_all_page/projectlist', $data);
                  
                }
                else if(isset($_POST['projectName'.$count])){
                    $client_id = trim($_POST['client_id'.$count]);
                    $data = $this->taskmanagermodel->getprojectlistAndLeadCounte2($client_id);
                    $this->view('cmr_all_page/projectDetailsList', $data);
                }
            }
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
                    $data = $this->taskmanagermodel->getLeadDetailsOfId($lead_id);
                    $mdata = $this->taskmanagermodel->getUserDetails();
                    $ndata =  $status;
                    $adata = [];
                   
                    $this->view('cmr_all_page/leadDetails', $data,$adata,$mdata,$ndata);
                    return; 
                }  
            }
        }
    }
    
    public function goback(){
         if(isset($_POST['back'])){
            $status = $_POST['status1'];

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
            $adata = $this->taskmanagermodel->getLeadDetailsWithStatus($status);
            $data = $this->taskmanagermodel->getprojectandclient();
            if($adata == null){
                $mdata['message'] = "Lead not exist !!";
            }
            $ndata = $this->taskmanagermodel->getAllClientDetails();
            $rdata = $this->taskmanagermodel->getUserDetails();
            
            $this->view('cmr_all_page/lead',$data,$adata,$mdata,$ndata,$rdata);
         }
    }
    
    public function createLeadRule(){
        if(isset($_POST['login'])){
            $rule = trim($_POST['rule']);
            $p_id = trim($_POST['pid']);
            $created_ts =  $this->getCurrentTs();
            $created_by = $_SESSION['userid'];
            $id = $this->taskmanagermodel->getStatus($p_id);
            $lastUpdatedTs = $this->getCurrentTs();
            $lastUpdatedBy =$_SESSION['userid'];
            $mdata['message'] = null;
            $data = $this->taskmanagermodel->insertAssignmentRule($p_id,$rule,$id->status,$created_ts,$created_by,$lastUpdatedTs,$lastUpdatedBy);
            if($data != null){
                $mdata['message'] = "Assignment Rule Created for the Project ".$id->name;
            }
            $data = $this->taskmanagermodel->getProjectDetails();
            $adata = $this->taskmanagermodel->getAssignmentRule();
            $this->view('cmr_all_page/leadrule',$data,$adata,$mdata);

        }
    }
    
    // public function createMessage(){
    //     if(isset($_POST['submit'])){
    //         $message = trim($_POST['message']);
    //         $p_id = trim($_POST['pid']);
    //         $created_ts =  $this->getCurrentTs();
    //         $created_by = $_SESSION['userid'];
    //         $lastUpdatedTs = $this->getCurrentTs();
    //         $lastUpdatedBy = $_SESSION['userid'];
    //         $adata['message'] = null;
    //         $data1 = $this->taskmanagermodel->insertWhatsappRule($p_id,$message,$created_ts,$created_by,$lastUpdatedTs,$lastUpdatedBy);
    //         if($data1 != null){
    //             $adata['message'] = "Whatsapp Rule Created Successfully !!";
    //         }
    //         $data = $this->taskmanagermodel->getWhatsappRule();
    //         $mdata = $this->taskmanagermodel->getProjectDetails();
    //         $this->view('cmr_all_page/whastsapprule',$data,$adata,$mdata);

    //     }
    // }
    
   public function createMessage(){
    if(isset($_POST['submit'])){
        // Retrieve form data
        $message = trim($_POST['message']);
        $p_id = trim($_POST['pid']);
        $created_ts =  $this->getCurrentTs();
        $created_by = $_SESSION['userid'];
        $lastUpdatedTs = $this->getCurrentTs();
        $lastUpdatedBy = $_SESSION['userid'];
        
        $adata['message'] = null;

        // Insert into database
        $data1 = $this->taskmanagermodel->insertWhatsappRule($p_id, $message, $created_ts, $created_by, $lastUpdatedTs, $lastUpdatedBy);
        
        if($data1 != null){
            // Success message
            $adata['message'] = "WhatsApp Rule Created Successfully !!";

            // Now send an email
            $to = "nehakumarigupta2322@gmail.com";  // Add the recipient's email
            $subject = "Leads form Kioskitech";
            $headers = "From: info@kioskitech.com\r\n";  // Update with your sender email
            $headers .= "Reply-To: info@kioskitech.com\r\n";
            $headers .= "MIME-Version: 1.0\r\n";
            $headers .= "Content-Type: text/html; charset=UTF-8\r\n";  // HTML email

            // Email body
            $emailContent = "
                <html>
                <head>
                    <title>Lead From Kioskitech</title>
                </head>
                <body>
                    <h2>New Rule Created for Project ID: {$p_id}</h2>
                    <p><strong>Message:</strong> {$message}</p>
                    <p><strong>Created By:</strong> User ID: {$created_by}</p>
                </body>
                </html>
            ";

            // Send the email
            if (mail($to, $subject, $emailContent, $headers)) {
                $adata['email_message'] = "Email sent successfully!";
            } else {
                $adata['email_message'] = "Email could not be sent.";
            }
        }

        // Get updated data and return the view
        $data = $this->taskmanagermodel->getWhatsappRule();
        $mdata = $this->taskmanagermodel->getProjectDetails();
        $this->view('cmr_all_page/whastsapprule', $data, $adata, $mdata);
    }
}




     public function updateLeadAssignedTo(){
        if(isset($_POST['submit'])){
            $l_id = trim($_POST['leadId']);
            $assignto = trim($_POST['vendor_name']);
            $status = trim($_POST['status']);
            $status1 = trim($_POST['status1']);
            $vendor_remark = trim($_POST['vendor_remark']);
            $lastUpdatedTs = $this->getCurrentTs();
            $lastUpdatedBy = $_SESSION['userid'];
            $adata['message'] = null;
            $data = $this->taskmanagermodel->updateVendorName($l_id, $assignto, $status, $vendor_remark, $lastUpdatedTs, $lastUpdatedBy);
            if($data != null){
                $adata['message'] =" updated Succesfully !!";
            }
            $data = $this->taskmanagermodel->getLeadDetailsOfId($l_id);
            $mdata = $this->taskmanagermodel->getUserDetails();
            $ndata =  $status1;
            $this->view('cmr_all_page/leadDetails', $data,$adata,$mdata,$ndata);
          
        }
    }



 
    public function uploadLeads() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
            $file = $_FILES['file']['tmp_name'];
    
            // Check if the file exists and is readable
            if (($handle = fopen($file, "r")) !== FALSE) {
                fgetcsv($handle); // Skip header row
    
                // Initialize an array to hold CSV data
                $csvData = [];
    
                // Loop through CSV rows and store them in an array
                while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                    $csvData[] = $data;  // Collect each row in the array
                }
    
                // Reverse the array to process rows in descending order
                $csvData = array_reverse($csvData);
    
                // Loop through the reversed CSV data and insert each row sequentially
                foreach ($csvData as $data) {
                    // Prepare the data from the CSV row
                    $pid = trim($_POST['pid']);
                    $l_name = trim($data[1]);
                    $email = trim($data[2]);
                    $phone = trim($data[3]);
                    $status = trim($data[4]);
                    $source = trim($data[5]);
                    $requirement = trim($data[6]);
                    $vendor_remark = trim($data[7]);
                    $client_remark = 'null';
                    $vendor_name = trim($_POST['vendor_name']);
                    $created_ts = $this->getCurrentTs();
                    $created_by = $_SESSION['userid'];
                    $lastUpdatedBy = $_SESSION['userid'];
                    $lastUpdatedTs = $this->getCurrentTs();
    
                    // Insert the data row into the database
                    $id = $this->taskmanagermodel->insertLeadDetails(
                        $pid, $l_name, $email, $phone, $status, $source, 
                        $vendor_remark, $client_remark, $vendor_name, 
                        $requirement, $created_ts, $created_by, 
                        $lastUpdatedBy, $lastUpdatedTs
                    );
    
                    // Error handling for each row
                    if (!$id) {
                        $mdata['message'] = "Error: Unable to create lead for row: " . print_r($data, true);
                        break; // If there's an error, stop the process
                    }
                }
    
                // If all rows are processed without errors
                if (!isset($mdata['message'])) {
                    $mdata['message'] = "All leads have been created successfully!";
                }
    
                // Fetch any other required data and pass to the view
                $data = $this->taskmanagermodel->getprojectandclient();
                $adata = $this->taskmanagermodel->getLeadDetails();
                $this->view('cmr_all_page/lead', $data, $adata, $mdata);
            } else {
                // File couldn't be opened
                $mdata['message'] = "Error: File could not be opened.";
                $data = $this->taskmanagermodel->getprojectandclient();
                $adata = $this->taskmanagermodel->getLeadDetails();
                $this->view('cmr_all_page/lead', $data, $adata, $mdata);
            }
        }
    }


    

    public function logout(){

        unset($_SESSION['userid']);
        unset($_SESSION['username']);
        unset($_SESSION['loggedin']);
        session_destroy();
        // redirect('users/login');
    }
    // end
 
}
