<?php

class User_model extends CI_Model
{
    // Register User
    public function cust_register($uname, $email, $pass, $otp)
    {
        $query = "insert into user values('','$uname','$email','$pass','$otp','')";
        // echo $query;
        $this->db->query($query);
    }



    public function is_available_email($email) //verfiy Email
    {
        $this->db->where('email', $email);
        $query = $this->db->get('user');

        if ($query->num_rows() > 0) {
            return true;
            echo 'yes';
        } else {
            return false;
            echo 'no';
        }
    }

    public function check($otp, $email) //check otp
    {

        $this->db->where('email', $email);
        $this->db->where('otp', $otp);
        $query = $this->db->get('user');

        print_r($this->db->last_query());

        if ($query->num_rows() > 0) { //Update Status
            echo "<h2><script>alert('Successful Login');</script></h2>";
            $data = ['status' => 1,];
            $this->db->where('email', $email);
            $this->db->update('user', $data);

            // print_r($this->db->last_query());


            return true;
        } else {
            echo "<h2><script>alert('Wrong Otp Entered');</script></h2>";
            return false;
        }
    }
}
