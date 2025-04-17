<?php

class Taskmanager {
    private $db;

    public function __construct() {
    
        $this->db = new Database;
    }

// new project
    public function insertUserDetails($name,$email,$membertype,$assign,$admin,$member_of,$creates_ts,$created_by,$lastUpdatedBy,$lastUpdatedTs){
        $this->db->query('INSERT INTO user(id, name, email, member_type, assign_project, org_admin, member_of, created_ts, '
        .'created_by, updated_ts, updated_by)'
        .' VALUES (0,:name,:email,:membertype,:assign,:admin,:member_of,:created_ts,:created_by,:last_updated_ts,:last_updated_by)');
   
        $this->db->bind(':name',$name);
        $this->db->bind(':email', $email);
        $this->db->bind(':membertype',$membertype);
        $this->db->bind(':assign',$assign);
        $this->db->bind(':admin',$admin);                 
        $this->db->bind(':member_of',$member_of);
        $this->db->bind(':created_by', $created_by);
        $this->db->bind(':created_ts',$creates_ts);
        $this->db->bind(':last_updated_by',$lastUpdatedBy);
        $this->db->bind(':last_updated_ts',$lastUpdatedTs);
        if($this->db->execute()){
        $id = $this->db->insertId();
            return $id;
        }
        else {
            return false;
        }
    }
    
    public function insertIntoLoginDetails($name,$email,$password,$role,$created_ts,$created_by){
         $this->db->query('INSERT INTO login(id, name, email, password, role, created_ts, created_by) VALUES (0,:name,:email,:password,:role,:created_ts,:created_by)');
        $this->db->bind(':name',$name);
        $this->db->bind(':email',$email);                 
        $this->db->bind(':password',$password);
        $this->db->bind(':role',$role);
        $this->db->bind(':created_by', $created_by);
        $this->db->bind(':created_ts',$created_ts); 
      
        if($this->db->execute()){
        $id = $this->db->insertId();
            return $id;
        }
        else {
            return false;
        }
    }
     public function loginDetails($name,$email,$password,$role,$created_ts,$created_by){
        $this->db->query('INSERT INTO login(id, name, email, password, role, created_ts, created_by) VALUES (0,:name,:email,:password,:role,:created_ts,:created_by)');
        $this->db->bind(':name',$name);
        $this->db->bind(':email',$email);                 
        $this->db->bind(':password',$password);
        $this->db->bind(':role',$role);
        $this->db->bind(':created_by', $created_by);
        $this->db->bind(':created_ts',$created_ts); 
      
        if($this->db->execute()){
        $id = $this->db->insertId();
            return $id;
        }
        else {
            return false;
        }
    }

    public function getAllUserDetails(){
        $this->db->query(' SELECT * FROM user WHERE 1 = 1 ORDER BY created_ts DESC');
        $row = $this->db->resultSet();
        return $row;
    }

    public function insertClientDetails($name,$creates_ts,$created_by,$lastUpdatedBy,$lastUpdatedTs){
        $this->db->query(' INSERT INTO client(c_id, name, created_ts, created_by, updates_ts, updated_by) '
                        .' VALUES (0,:name,:created_ts,:created_by,:last_updated_ts,:last_updated_by)');
        $this->db->bind(':name',$name);
        $this->db->bind(':created_by', $created_by);
        $this->db->bind(':created_ts',$creates_ts);
        $this->db->bind(':last_updated_by',$lastUpdatedBy);
        $this->db->bind(':last_updated_ts',$lastUpdatedTs);
        if($this->db->execute()){
        $id = $this->db->insertId();
            return $id;
        }
        else {
            return false;
        }    
    }

    public function insertClientPersonal($id,$email,$phone, $creates_ts, $created_by, $lastUpdatedBy, $lastUpdatedTs){
        $this->db->query('INSERT INTO client_personal_details(id, c_id, email, mobile, created_ts, created_by, updated_ts, updated_by)'
                    .    ' VALUES (0,:id,:email,:mobile,:created_ts,:created_by,:last_updated_ts,:last_updated_by)');
        $this->db->bind(':id',$id);
        $this->db->bind(':email',$email);
        $this->db->bind(':mobile',$phone);
        $this->db->bind(':created_by', $created_by);
        $this->db->bind(':created_ts',$creates_ts);
        $this->db->bind(':last_updated_by',$lastUpdatedBy);
        $this->db->bind(':last_updated_ts',$lastUpdatedTs);
        if($this->db->execute()){
        $id = $this->db->insertId();
            return $id;
        }
        else {
            return false;
        }  
    }

    public function getAllClientDetails(){
        $this->db->query(' SELECT c.c_id, c.name AS client_name, c.created_ts, c.updates_ts, COUNT(p.c_id) AS project_count FROM client c LEFT JOIN project p ON c.c_id = p.c_id GROUP BY c.c_id, c.name, c.created_ts, c.created_by ORDER BY c.created_ts DESC ');
        $row = $this->db->resultSet();
        return $row;
    }

    public function getAllProjectDetails(){
        $this->db->query(' SELECT p.p_id, p.name as project_name, p.status, p.broucher, p.created_ts, p.created_by, p.updated_ts, p.updated_by,c.c_id,c.name as client_name FROM project p ,client c WHERE c.c_id = p.c_id ORDER BY p.created_ts DESC');
        $row = $this->db->resultSet();
        return $row;
    }

    public function getprojectlist($client_id){
        $this->db->query(' SELECT p.p_id,p.name as project_name, p.status, p.created_ts, c.name as client_name FROM project p, client c WHERE p.c_id =:client_id AND p.c_id =c.c_id ORDER BY p.created_ts DESC;');
        $this->db->bind(':client_id',$client_id);
        $row = $this->db->resultSet();
        return $row;
    }

    public function getprojectlistAndLeadCounte2($client_id){
        $this->db->query(' SELECT p.p_id, p.name AS project_name, p.status, l.l_id, COUNT(l.l_id) AS lead_count FROM project p LEFT JOIN client c ON p.c_id = c.c_id LEFT JOIN lead l ON l.p_id = p.p_id WHERE p.c_id = :client_id GROUP BY p.p_id, p.name, p.status, p.created_ts, c.name ');
        $this->db->bind(':client_id',$client_id);
        $row = $this->db->resultSet();
        return $row;
    }

    public function insertProjectDetails($cid, $p_name, $status,$url, $created_by, $creates_ts, $lastUpdatedBy, $lastUpdatedTs){
        $this->db->query(' INSERT INTO project(p_id, c_id, name,status, broucher, created_ts, created_by, updated_ts, updated_by) '
                        .' VALUES (0,:cid,:p_name,:status,:url,:created_ts,:created_by,:last_updated_ts,:last_updated_by)');
        $this->db->bind(':cid',$cid);
        $this->db->bind(':p_name',$p_name);
        $this->db->bind(':status',$status);
        $this->db->bind(':url',$url);
        $this->db->bind(':created_by', $created_by);
        $this->db->bind(':created_ts',$creates_ts);
        $this->db->bind(':last_updated_by',$lastUpdatedBy);
        $this->db->bind(':last_updated_ts',$lastUpdatedTs);
        if($this->db->execute()){
        $id = $this->db->insertId();
            return $id;
        }
        else {
            return false;
        }  
    }

    public function getprojectandclient(){
        $this->db->query(' SELECT p_id,c_id,name FROM project WHERE 1=1 ');
        $row = $this->db->resultSet();
        return $row;
    }

    public function insertLeadDetails($pid, $l_name, $email, $phone, $status, $source, $vendor_remark, $client_remark,$vendor_name,$requirement, $created_ts, $created_by, $lastUpdatedBy, $lastUpdatedTs) {
        $this->db->query('INSERT INTO lead (p_id, name, email, phone, status, source,assign_to, requirement, vendor_remarks, '
                      .  ' client_remarks, created_ts, created_by, updated_ts, updated_by) '
                      .  ' VALUES (:pid, :l_name, :email, :phone, :status, :source,:vendor_name,:requirement,:vendor_remark,'
                      .  ' :client_remarks, :created_ts, :created_by, :last_updated_ts, :last_updated_by)');
        
        $this->db->bind(':pid', $pid);
        $this->db->bind(':l_name', $l_name);
        $this->db->bind(':email', $email);
        $this->db->bind(':phone', $phone);
        $this->db->bind(':status', $status);
        $this->db->bind(':source', $source);
        $this->db->bind(':vendor_remark', $vendor_remark);
        $this->db->bind(':requirement', $requirement);
        $this->db->bind(':client_remarks', $client_remark);
        $this->db->bind(':vendor_name', $vendor_name);
        $this->db->bind(':created_ts', $created_ts);
        $this->db->bind(':created_by', $created_by);
        $this->db->bind(':last_updated_by', $lastUpdatedBy);
        $this->db->bind(':last_updated_ts', $lastUpdatedTs);
    
        if($this->db->execute()) {
            return $this->db->insertId(); // Return the last inserted ID if successful
        } else {
            return false; // Return false if the execution fails
        }
    }
    

    public function getLeadDetails(){
        $this->db->query('SELECT l.l_id, l.name, l.email, l.phone, l.status, l.source, l.vendor_remarks, l.client_remarks, l.created_ts, l.updated_ts, p.name AS project_name, l.assign_to, l.requirement, l.client_modified_ts FROM lead l JOIN project p ON l.p_id = p.p_id ORDER BY l.updated_ts DESC, l.l_id DESC;');
        $row = $this->db->resultSet();
        return $row;
    }

    public function getUserDetails(){
        $this->db->query(' SELECT id,name FROM user WHERE 1 = 1 ');
        $row = $this->db->resultSet();
        return $row;
    }

    public function getLeadDetailsWithClient($client_id){
        $this->db->query(' SELECT l.l_id,l.name,l.email,l.phone, l.status, l.source, l.vendor_remarks, l.client_remarks, l.created_ts, l.updated_ts,p.name as project_name,l.assign_to,l.requirement,l.client_modified_ts FROM lead l,project p WHERE l.p_id = p.p_id AND p.c_id = :client_id ORDER BY l.created_ts DESC');
        $this->db->bind(':client_id',$client_id);
        $row = $this->db->resultSet();
        return $row;
    }

    public function getLeadDetailsWithProject($project_id){
        $this->db->query(' SELECT l.l_id,l.name,l.email,l.phone, l.status, l.source, l.vendor_remarks, l.client_remarks, l.created_ts, l.updated_ts,p.name as project_name,l.assign_to,l.requirement,l.client_modified_ts FROM lead l,project p WHERE l.p_id = p.p_id AND p.p_id = :project_id ORDER BY l.created_ts DESC');
        $this->db->bind(':project_id',$project_id);
        $row = $this->db->resultSet();
        return $row;
    }

    public function getLeadDetailsWithStatus($status){
        $this->db->query(' SELECT l.l_id,l.name,l.email,l.phone, l.status, l.source, l.vendor_remarks, l.client_remarks, l.created_ts, l.updated_ts,p.name as project_name,l.assign_to,l.requirement,l.client_modified_ts FROM lead l,project p WHERE l.p_id = p.p_id AND l.status = :status ORDER BY GREATEST(l.updated_ts, COALESCE(l.client_modified_ts, "1970-01-01 00:00:00")) DESC');
        $this->db->bind(':status',$status);
        $row = $this->db->resultSet();
        return $row; 
    }

    public function getLeadDetailsWithVendor($vendor){
        $this->db->query(' SELECT l.l_id,l.name,l.email,l.phone, l.status, l.source, l.vendor_remarks, l.client_remarks, l.created_ts, l.updated_ts,p.name as project_name,l.assign_to,l.requirement,l.client_modified_ts FROM lead l,project p WHERE l.p_id = p.p_id AND l.assign_to = :vendor ORDER BY GREATEST(l.updated_ts, COALESCE(l.client_modified_ts, "1970-01-01 00:00:00")) DESC ');
        $this->db->bind(':vendor',$vendor);
        $row = $this->db->resultSet();
        // print_r($row);
        return $row; 
    }

    public function getLeadDetailsWithClientAndProject($client_id,$project_id){
        $this->db->query(' SELECT l.l_id,l.name,l.email,l.phone, l.status, l.source, l.vendor_remarks, l.client_remarks, l.created_ts, l.updated_ts,p.name as project_name,l.assign_to,l.requirement,l.client_modified_ts FROM lead l,project p WHERE l.p_id = p.p_id AND p.c_id = :client_id AND p.p_id = :project_id ORDER BY GREATEST(l.updated_ts, COALESCE(l.client_modified_ts, "1970-01-01 00:00:00")) DESC');
        $this->db->bind(':client_id',$client_id);
        $this->db->bind(':project_id',$project_id);
        $row = $this->db->resultSet();
        // print_r($row);
        return $row;   
    }

    public function getLeadDetailsWithClientAndProjectAndStatus($client_id,$project_id,$status){
        $this->db->query(' SELECT l.l_id,l.name,l.email,l.phone, l.status, l.source, l.vendor_remarks, l.client_remarks, l.created_ts, l.updated_ts,p.name as project_name,l.assign_to,l.requirement,l.client_modified_ts FROM lead l,project p WHERE l.p_id = p.p_id AND p.c_id = :client_id AND p.p_id = :project_id AND l.status= :status ORDER BY GREATEST(l.updated_ts, COALESCE(l.client_modified_ts, "1970-01-01 00:00:00")) DESC');
        $this->db->bind(':client_id',$client_id);
        $this->db->bind(':project_id',$project_id);
        $this->db->bind(':status',$status);
        $row = $this->db->resultSet();
        // print_r($row);
        return $row; 
    }

    public function getLeadDetailsWithClientAndProjectAndStatusAndVendor($client_id,$project_id,$status,$vendor){
        $this->db->query(' SELECT l.l_id,l.name,l.email,l.phone, l.status, l.source, l.vendor_remarks, l.client_remarks, l.created_ts, l.updated_ts,p.name as project_name,l.assign_to,l.requirement,l.client_modified_ts FROM lead l,project p WHERE l.p_id = p.p_id AND p.c_id = :client_id AND p.p_id = :project_id AND l.status= :status AND l.assign_to =:vendor ORDER BY GREATEST(l.updated_ts, COALESCE(l.client_modified_ts, "1970-01-01 00:00:00")) DESC');
        $this->db->bind(':client_id',$client_id);
        $this->db->bind(':project_id',$project_id);
        $this->db->bind(':status',$status);
        $this->db->bind(':vendor',$vendor);
        $row = $this->db->resultSet();
        return $row; 
    }

    public function getLeadDetailsOfId($lead_id){
        $this->db->query(' SELECT l.l_id,l.name,l.email,l.phone, l.status, l.source, l.vendor_remarks, l.client_remarks, l.created_ts, l.updated_ts,p.name as project_name,c.name as client_name,l.created_by,l.assign_to,l.requirement,l.status,l.client_modified_ts FROM lead l,project p,client c WHERE l.p_id = p.p_id AND p.c_id = c.c_id AND l.l_id =:lead_id  ');
        $this->db->bind(':lead_id',$lead_id);
        $row = $this->db->single();
        return $row; 
    }

    public function updateStatusOfLead($lead_id,$status,$vendor_remark,$lastUpdatedTs,$lastUpdatedBy){
        $this->db->query(' UPDATE lead SET status=:status ,vendor_remarks=:vendor_remark,updated_ts=:lastUpdatedTs, updated_by=:lastUpdatedBy WHERE l_id= :lead_id');
        $this->db->bind(':lead_id',$lead_id); 
        $this->db->bind(':status',$status);  
        $this->db->bind(':vendor_remark',$vendor_remark);               
        $this->db->bind(':lastUpdatedBy',$lastUpdatedBy);
        $this->db->bind(':lastUpdatedTs',$lastUpdatedTs); 
        if($this->db->execute()){
            return true;
        }
            return false;   
    }

    public function updateClientRemark($lead_id,$client_remark,$lastUpdatedBy,$lastUpdatedTs){
        $this->db->query(' UPDATE lead SET client_remarks=:client_remark,updated_ts=:lastUpdatedTs,updated_by=:lastUpdatedBy WHERE l_id =:lead_id');
        $this->db->bind(':lead_id',$lead_id); 
        $this->db->bind(':client_remark',$client_remark);                
        $this->db->bind(':lastUpdatedBy',$lastUpdatedBy);
        $this->db->bind(':lastUpdatedTs',$lastUpdatedTs); 
        if($this->db->execute()){
            return true;
        }
            return false;   
    }

    public function getProjectDetails(){
        $this->db->query(' SELECT p_id, name, status FROM project WHERE 1 = 1 ');
        $row = $this->db->resultSet();
        return $row;
    }

    public function getStatus($p_id){
        $this->db->query(' SELECT status,name FROM project WHERE p_id =:p_id ');
        $this->db->bind(':p_id',$p_id); 
        $row = $this->db->single();
        return $row;
    }

    public function getAssignmentRule(){
        $this->db->query(' SELECT lr.r_id,lr.p_id,lr.rule,lr.status,lr.created_ts,lr.created_by,lr.updated_ts,lr.updated_by,p.name FROM lead_rule lr,project p WHERE lr.p_id = p.p_id ORDER BY lr.created_ts DESC');
        $row = $this->db->resultSet();
        return $row;  
    }

    public function insertAssignmentRule($p_id,$rule,$status,$created_ts,$created_by,$lastUpdatedTs,$lastUpdatedBy){
        $this->db->query(' INSERT INTO lead_rule(r_id, p_id, rule, status, created_ts, created_by, updated_ts, updated_by) '
                    .    ' VALUES (0,:p_id,:rule,:status,:created_ts,:created_by,:lastUpdatedTs,:lastUpdatedBy)');
        $this->db->bind(':p_id',$p_id); 
        $this->db->bind(':rule',$rule);
        $this->db->bind(':status',$status);
        $this->db->bind(':created_ts',$created_ts);
        $this->db->bind(':created_by',$created_by);                
        $this->db->bind(':lastUpdatedBy',$lastUpdatedBy);
        $this->db->bind(':lastUpdatedTs',$lastUpdatedTs);
                    
        if($this->db->execute()){
            return true;
        }
        return false;  
    }

    public function getWhatsappRule(){
        $this->db->query(' SELECT w.w_id,w.whatsapp_message,p.name as project_name,c.name as client_name,w.created_ts,w.created_by FROM whatsapp_rule w,project p,client c WHERE w.p_id = p.p_id AND c.c_id= p.c_id ORDER BY w.created_ts DESC');
        $row = $this->db->resultSet();
        return $row;  
    }

    public function insertWhatsappRule($p_id,$message,$created_ts,$created_by,$lastUpdatedTs,$lastUpdatedBy){
        $this->db->query(' INSERT INTO whatsapp_rule(w_id, p_id, whatsapp_message, created_ts, created_by, last_updated_ts, '
                .        ' last_updated_by) VALUES (0,:p_id,:message,:created_ts,:created_by,:lastUpdatedTs,:lastUpdatedBy) ');
        $this->db->bind(':p_id',$p_id); 
        $this->db->bind(':message',$message);
        $this->db->bind(':created_ts',$created_ts);
        $this->db->bind(':created_by',$created_by);                
        $this->db->bind(':lastUpdatedBy',$lastUpdatedBy);
        $this->db->bind(':lastUpdatedTs',$lastUpdatedTs);   
        if($this->db->execute()){
            $Id = $this->db->insertId();
            return $Id;
        }
        else {
            return false;
        }         
    }

    public function getAllLeadDetails(){
        $this->db->query(' SELECT * FROM lead WHERE 1 = 1 ORDER BY created_ts DESC');
        $row = $this->db->resultSet();
        return $row;
    }


    public function updateVendorName($l_id, $assignto, $status, $vendor_remark, $lastUpdatedTs, $lastUpdatedBy) {
        $this->db->query('UPDATE lead SET assign_to= :assignto, status=:status, vendor_remarks= :vendor_remarks, updated_ts=:lastUpdatedTs, updated_by=:lastUpdatedBy WHERE l_id = :l_id');
        $this->db->bind(':l_id', $l_id);
        $this->db->bind(':assignto', $assignto); 
        $this->db->bind(':status', $status); 
        $this->db->bind(':vendor_remarks', $vendor_remark); 
        $this->db->bind(':lastUpdatedBy', $lastUpdatedBy);
        $this->db->bind(':lastUpdatedTs', $lastUpdatedTs);   
            if($this->db->execute()) {
                $Id = $this->db->insertId();
                return $Id;
            } else {
                return false;
            }  
        }

    public function getLeadsDataLastWeek() {
        $this->db->query(' SELECT COUNT(CASE WHEN l.status = "interested" THEN 1 END) AS interested_leads, COUNT(CASE WHEN l.status = "not interested" THEN 1 END) AS not_interested_leads, COUNT(CASE WHEN l.status = "follow up" THEN 1 END) AS follow_up_leads, COUNT(CASE WHEN l.status = "vendor call back" OR l.status = "client call back" THEN 1 END) AS call_back_leads, COUNT(*) AS total_leads , COUNT(CASE WHEN l.status = "Booking done" THEN 1 END) AS booking_done , COUNT(CASE WHEN l.status = "Site Visit" THEN 1 END) AS Site_visit, COUNT(CASE WHEN l.status = "verified" THEN 1 END) AS verified , COUNT(CASE WHEN l.status = "not verified" THEN 1 END) AS not_verified , COUNT(CASE WHEN l.status = "fresh" THEN 1 END) AS fresh, COUNT(CASE WHEN l.status = "invalid_number" THEN 1 END) AS Invalid_number, COUNT(CASE WHEN l.status = "Appointment fixed" THEN 1 END) AS Appointment_Fixed FROM lead l JOIN project p ON l.p_id = p.p_id JOIN client c ON p.c_id = c.c_id WHERE  l.created_ts >= CURDATE() - INTERVAL 7 DAY ');
        $row = $this->db->single();
       
        return $row; 
    }

    public function getGraphDataOfLastMonth(){
        $this->db->query('SELECT COUNT(CASE WHEN l.status = "interested" THEN 1 END) AS interested_leads, COUNT(CASE WHEN l.status = "not interested" THEN 1 END) AS not_interested_leads, COUNT(CASE WHEN l.status = "follow up" THEN 1 END) AS follow_up_leads, COUNT(CASE WHEN l.status = "vendor call back" OR l.status = "client call back" THEN 1 END) AS call_back_leads, COUNT(*) AS total_leads, COUNT(CASE WHEN l.status = "Booking done" THEN 1 END) AS booking_done, COUNT(CASE WHEN l.status = "Site Visit" THEN 1 END) AS Site_visit, COUNT(CASE WHEN l.status = "verified" THEN 1 END) AS verified, COUNT(CASE WHEN l.status = "not verified" THEN 1 END) AS not_verified, COUNT(CASE WHEN l.status = "fresh" THEN 1 END) AS fresh, COUNT(CASE WHEN l.status = "invalid_number" THEN 1 END) AS Invalid_number, COUNT(CASE WHEN l.status = "Appointment fixed" THEN 1 END) AS Appointment_Fixed FROM lead l JOIN project p ON l.p_id = p.p_id JOIN client c ON p.c_id = c.c_id WHERE l.created_ts >= CURDATE() - INTERVAL 1 MONTH;');   
        $row = $this->db->single();
     
        return $row; 
    }
    
    

    // Get overall leads data
    public function getOverallLeadsData() {
        $this->db->query(' SELECT  COUNT(CASE WHEN l.status = "interested" THEN 1 END) AS interested_leads,  COUNT(CASE WHEN l.status = "not interested" THEN 1 END) AS not_interested_leads,  COUNT(CASE WHEN l.status = "follow up" THEN 1 END) AS follow_up_leads,  COUNT(CASE WHEN l.status = "vendor call back" OR l.status = "client call back" THEN 1 END) AS call_back_leads,  COUNT(*) AS total_leads,  COUNT(CASE WHEN l.status = "Booking done" THEN 1 END) AS booking_done,  COUNT(CASE WHEN l.status = "Site Visit" THEN 1 END) AS Site_visit,  COUNT(CASE WHEN l.status = "verified" THEN 1 END) AS verified,  COUNT(CASE WHEN l.status = "not verified" THEN 1 END) AS not_verified, COUNT(CASE WHEN l.status = "fresh" THEN 1 END) AS fresh, COUNT(CASE WHEN l.status = "invalid_number" THEN 1 END) AS Invalid_number, COUNT(CASE WHEN l.status = "Appointment fixed" THEN 1 END) AS Appointment_Fixed FROM lead l JOIN project p ON l.p_id = p.p_id JOIN client c ON p.c_id = c.c_id 
        ');

        // Execute and return result
        $row = $this->db->single();
        return $row; 
    }

    public function clientRecordOfWeekly(){
        $this->db->query(' SELECT COUNT(*)as count FROM client WHERE  created_ts >= CURDATE() - INTERVAL 7 DAY ');
        $row = $this->db->single();
        return $row; 
    }

    public function clientRecordOfMonthly(){
        $this->db->query(' SELECT COUNT(*)as count FROM client WHERE  created_ts >= CURDATE() - INTERVAL 1 MONTH ');
        $row = $this->db->single();
        return $row; 
    }

    public function clientTotalRecord(){
        $this->db->query(' SELECT COUNT(*)as count FROM client ');
        $row = $this->db->single();
        return $row; 
    }
  
    
// new project
  

}
?>