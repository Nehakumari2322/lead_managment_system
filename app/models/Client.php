<?php 

class Client{
    private $db;

    public function __construct(){
        $this->db = new Database;
    }

    public function getClientId($userId){
        $this->db->query(' SELECT cp.c_id,c.name  FROM client_personal_details cp, client c WHERE email = :userId AND c.c_id = cp.c_id');
        $this->db->bind(':userId', $userId);
        $row = $this->db->single();
        return $row; 
    }

    public function getproject($c_id){
        $this->db->query(' SELECT  p.p_id, p.c_id , p.name, p.status, p.broucher , p.created_ts, p.created_by , p.updated_ts , p.updated_by,c.name as client_name FROM project p,client c WHERE p.c_id = :c_id AND p.c_id = c.c_id ORDER BY p.created_ts DESC ');
        $this->db->bind(':c_id', $c_id);
        $row = $this->db->resultSet();
        return $row; 
    }

    public function getLeadDetails($c_id){
        $this->db->query(' SELECT DISTINCT l.p_id, l.l_id, l.name, l.email, l.phone, l.status, l.source, l.assign_to, l.requirement, l.vendor_remarks, l.client_remarks, l.status_updated_ts, l.created_ts, l.client_modified_ts, l.updated_ts FROM lead l, project p, client c WHERE p.p_id = l.p_id AND p.c_id =:c_id AND (l.status = "verified" OR l.status = "Booking Done" OR l.status = "site visit" OR l.status = "appointment fixed" OR l.status = "client call back" OR l.status = "follow up") ORDER BY GREATEST(l.updated_ts, COALESCE(l.client_modified_ts, "1970-01-01 00:00:00") ) DESC');
        $this->db->bind(':c_id', $c_id);
        $row = $this->db->resultSet();
        // print_r($row);
        return $row;
    }

    public function insertClientUserDetails($c_id,$name,$email,$assign,$member_of,$creates_ts,$created_by,$lastUpdatedBy,$lastUpdatedTs){
        $this->db->query('INSERT INTO client_user(id, c_id, name, email, assign_project, member_of, created_ts, created_by, last_updated_ts, last_updated_by) VALUES (0,:c_id,:name,:email,:assign,:member_of,:created_ts,:created_by,:lastupdatedts,:lastupdatedby) ');
        $this->db->bind(':name',$name);
        $this->db->bind(':email', $email);
        $this->db->bind(':c_id',$c_id);
        $this->db->bind(':assign',$assign);               
        $this->db->bind(':member_of',$member_of);
        $this->db->bind(':created_by', $created_by);
        $this->db->bind(':created_ts',$creates_ts);
        $this->db->bind(':lastupdatedby',$lastUpdatedBy);
        $this->db->bind(':lastupdatedts',$lastUpdatedTs);
        if($this->db->execute()){
        $id = $this->db->insertId();
            return $id;
        }
        else {
            return false;
        }
    }

    public function getAllClientUserDetails( $c_id){
        $this->db->query(' SELECT * FROM client_user WHERE c_id = :c_id ORDER BY created_ts DESC ');
        $this->db->bind(':c_id', $c_id);
        $row = $this->db->resultSet();
        return $row;
    }

    public function getLeadDetailsOfId($lead_id){
        $this->db->query(' SELECT l.l_id,l.name,l.email,l.phone, l.status, l.source, l.vendor_remarks, l.client_remarks, l.created_ts, l.client_modified_ts,l.status_updated_ts	,p.name as project_name,c.name as client_name,l.created_by,l.assign_to,l.requirement FROM lead l,project p,client c WHERE l.p_id = p.p_id AND p.c_id = c.c_id AND l.l_id =:lead_id ');
        $this->db->bind(':lead_id',$lead_id);
        $row = $this->db->single();
        return $row; 
    }

    // public function updateStatusOfLead($lead_id, $status,$status_updated_ts, $client_remark, $clientlastUpdatedTs, $lastUpdatedBy){
    //     $this->db->query('UPDATE lead SET client_remarks=:client_remark,status=:status, client_modified_ts=:lastUpdatedTs, updated_by=:lastUpdatedBy WHERE l_id = :l_id');
    //     $this->db->bind(':l_id',$l_id);
    //     $this->db->bind(':status',$status);  
    //       $this->db->bind(':client_remark',$client_remark);  
    //     $this->db->bind(':lastUpdatedBy',$lastUpdatedBy);
    //     $this->db->bind(':lastUpdatedTs',$lastUpdatedTs);   
    //     if($this->db->execute()){
    //         $Id = $this->db->insertId();
    //         return $Id;
    //     }
    //     else {
    //         return false;
    //     }  
    // }

    public function updateStatusOfLead($lead_id,$status,$status_updated_ts, $client_remark, $clientlastUpdatedTs,$lastUpdatedBy){
        $this->db->query(' UPDATE lead SET status=:status ,status_updated_ts=:status_updated_ts, client_modified_ts	=:clientlastUpdatedTs, updated_by=:lastUpdatedBy,client_remarks=:client_remark WHERE l_id= :lead_id');
        $this->db->bind(':lead_id',$lead_id); 
        $this->db->bind(':status',$status);
        $this->db->bind(':client_remark',$client_remark); 
        $this->db->bind(':status_updated_ts',$status_updated_ts);                 
        $this->db->bind(':lastUpdatedBy',$lastUpdatedBy);
        $this->db->bind(':clientlastUpdatedTs',$clientlastUpdatedTs); 
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

    public function getLeadDetailsWithProject($project_id){
        $this->db->query('SELECT DISTINCT l.l_id,l.name,l.email,l.phone, l.status, l.source, l.vendor_remarks, l.client_remarks, l.created_ts,l.status_updated_ts, l.client_modified_ts	,p.name as project_name,l.assign_to,l.requirement FROM lead l,project p WHERE l.p_id = p.p_id AND p.p_id = :project_id AND (l.status="verified" OR l.status="booking done" OR l.status="site visit" OR l.status="follow up" OR l.status="client call back" OR l.status = "appointment fixed") ORDER BY l.created_ts DESC;');
        $this->db->bind(':project_id',$project_id);
        $row = $this->db->resultSet();
        return $row;
    }

    public function getLeadDetailsWithStatus($status,$c_id){
        $this->db->query(' SELECT l.l_id,l.name,l.email,l.phone, l.status,l.status_updated_ts, l.source, l.vendor_remarks, l.client_remarks, l.created_ts, l.client_modified_ts	,p.name as project_name,l.assign_to,l.requirement FROM lead l,project p WHERE l.p_id = p.p_id AND l.status =:status AND p.c_id = :c_id  ORDER BY GREATEST(l.updated_ts, COALESCE(l.client_modified_ts, "1970-01-01 00:00:00") ) DESC;');
        $this->db->bind(':status',$status);
        $this->db->bind(':c_id',$c_id);
        $row = $this->db->resultSet();
        return $row; 
    }

    public function getLeadDetailsWithProjectAndStatus($c_id,$project_id,$status){
        $this->db->query(' SELECT l.l_id,l.name,l.email,l.phone, l.status, l.source,l.status_updated_ts, l.vendor_remarks, l.client_remarks, l.created_ts, l.client_modified_ts,p.name as project_name,l.assign_to,l.requirement FROM lead l,project p WHERE l.p_id = p.p_id AND l.status =:status  AND p.c_id = :c_id AND p.p_id = :project_id  ORDER BY GREATEST(l.updated_ts, COALESCE(l.client_modified_ts, "1970-01-01 00:00:00") ) DESC');
        $this->db->bind(':status',$status);
        $this->db->bind(':c_id',$c_id);
        $this->db->bind(':project_id',$project_id);
        $row = $this->db->resultSet();
        return $row; 
    }

    public function getgraphData($client_id){
        $this->db->query('SELECT  COUNT(CASE WHEN l.status = "Booking done" OR l.status = "verified" OR l.status = "Site Visit" OR l.status = "follow up" OR l.status = "Appointment fixed" OR l.status = "call back" THEN 1 END) AS total_leads , COUNT(CASE WHEN l.status = "Booking done" THEN 1 END) AS booking_done , COUNT(CASE WHEN l.status = "Site Visit" THEN 1 END) AS Site_visit, COUNT(CASE WHEN l.status = "verified" THEN 1 END) AS verified ,  COUNT(CASE WHEN l.status = "Appointment fixed" THEN 1 END) AS Appointment_Fixed ,COUNT(CASE WHEN l.status = "client call back" THEN 1 END) AS call_back_leads,  COUNT(CASE WHEN l.status = "follow up " THEN 1 END) AS Follow_up FROM lead l JOIN project p ON l.p_id = p.p_id JOIN client c ON p.c_id = c.c_id WHERE p.c_id = :client_id  AND  l.created_ts >= CURDATE() - INTERVAL 7 DAY ;');
        $this->db->bind(':client_id', $client_id);
        $row = $this->db->single();
        return $row; 
    }

    public function getGraphDataOfLastMonth($client_id){
        $this->db->query(' SELECT  COUNT(CASE WHEN l.status = "Booking done" OR l.status = "verified" OR l.status = "Site Visit"  OR l.status = "follow up" OR l.status = "Appointment fixed" OR l.status = "call back" THEN 1 END) AS total_leads , COUNT(CASE WHEN l.status = "Booking done" THEN 1 END) AS booking_done , COUNT(CASE WHEN l.status = "Site Visit" THEN 1 END) AS Site_visit, COUNT(CASE WHEN l.status = "verified" THEN 1 END) AS verified ,  COUNT(CASE WHEN l.status = "Appointment fixed" THEN 1 END) AS Appointment_Fixed,COUNT(CASE WHEN l.status = "client call back" THEN 1 END) AS call_back_leads, COUNT(CASE WHEN l.status = "follow up " THEN 1 END) AS Follow_up FROM lead l JOIN project p ON l.p_id = p.p_id JOIN client c ON p.c_id = c.c_id WHERE p.c_id = :client_id AND  l.created_ts >= CURDATE() - INTERVAL 1 MONTH;');
        $this->db->bind(':client_id', $client_id);
        $row = $this->db->single();
        return $row; 
    }
    

}
?>

