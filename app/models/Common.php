<?php 

class Common{
    private $db;

    public function __construct(){
        $this->db = new Database;
    }

    public function login_verification($data){
        // return true;
        $this->db->query('SELECT * FROM login WHERE email LIKE :userid AND password LIKE :password AND role LIKE :role ' );
        $this->db->bind(':userid', $data['userid']);
        $this->db->bind(':password', $data['password']);
        $this->db->bind(':role', $data['role']);
        if($row = $this->db->single()){
            return true;
        }
        else{
            return false;
        }
               
    } 

    public function getUserName($user){
        $this->db->query(' SELECT id,name FROM login WHERE email = :user');
        $this->db->bind(':user', $user);
        $row = $this->db->single();
        return $row; 
    }

    public function insertClientDetails($name,$email,$mobile,$whom,$creates_ts){
        $this->db->query(' INSERT INTO contact_info(id, name, email,mobile, who, created_ts) VALUES (0,:name,:email,:mobile,:whom,:creates_ts)');
        $this->db->bind(':name',$name);
        $this->db->bind(':email',$email);                
        $this->db->bind(':mobile',$mobile);
        $this->db->bind(':whom',$whom);  
        $this->db->bind(':creates_ts',$creates_ts);   
        if($this->db->execute()){
            $Id = $this->db->insertId();
            return $Id;
        }
        else {
            return false;
        } 
    }

    public function getgraphData($client_id){
        $this->db->query('SELECT COUNT(CASE WHEN l.status = "interested" THEN 1 END) AS interested_leads, COUNT(CASE WHEN l.status = "not interested" THEN 1 END) AS not_interested_leads, COUNT(CASE WHEN l.status = "follow up" THEN 1 END) AS follow_up_leads, COUNT(CASE WHEN l.status = "call back" THEN 1 END) AS call_back_leads, COUNT(*) AS total_leads , COUNT(CASE WHEN l.status = "Booking done" THEN 1 END) AS booking_done , COUNT(CASE WHEN l.status = "Site Visit" THEN 1 END) AS Site_visit, COUNT(CASE WHEN l.status = "verified" THEN 1 END) AS verified , COUNT(CASE WHEN l.status = "not verified" THEN 1 END) AS not_verified , COUNT(CASE WHEN l.status = "fresh" THEN 1 END) AS fresh, COUNT(CASE WHEN l.status = "invalid_number" THEN 1 END) AS Invalid_number, COUNT(CASE WHEN l.status = "Appointment fixed" THEN 1 END) AS Appointment_Fixed FROM lead l JOIN project p ON l.p_id = p.p_id JOIN client c ON p.c_id = c.c_id WHERE p.c_id = :client_id AND l.created_ts >= CURDATE() - INTERVAL 7 DAY; ');
        $this->db->bind(':client_id', $client_id);
        $row = $this->db->single();
        return $row; 
    }

    public function getGraphDataOfLastMonth($client_id){
        $this->db->query(' SELECT  COUNT(CASE WHEN l.status = "interested" THEN 1 END) AS interested_leads,  COUNT(CASE WHEN l.status = "not interested" THEN 1 END) AS not_interested_leads,  COUNT(CASE WHEN l.status = "follow up" THEN 1 END) AS follow_up_leads,  COUNT(CASE WHEN l.status = "call back" THEN 1 END) AS call_back_leads,  COUNT(*) AS total_leads,  COUNT(CASE WHEN l.status = "Booking done" THEN 1 END) AS booking_done,  COUNT(CASE WHEN l.status = "Site Visit" THEN 1 END) AS Site_visit,  COUNT(CASE WHEN l.status = "verified" THEN 1 END) AS verified,  COUNT(CASE WHEN l.status = "not verified" THEN 1 END) AS not_verified, COUNT(CASE WHEN l.status = "fresh" THEN 1 END) AS fresh, COUNT(CASE WHEN l.status = "invalid_number" THEN 1 END) AS Invalid_number, COUNT(CASE WHEN l.status = "Appointment fixed" THEN 1 END) AS Appointment_Fixed FROM lead l JOIN project p ON l.p_id = p.p_id JOIN client c ON p.c_id = c.c_id WHERE p.c_id =  :client_id AND l.created_ts >= CURDATE() - INTERVAL 1 MONTH');
        $this->db->bind(':client_id', $client_id);
        $row = $this->db->single();
        return $row; 
    }
    

}
?>