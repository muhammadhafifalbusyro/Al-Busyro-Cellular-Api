<?php

class Login_model extends CI_Model
{
    public function usersGetByUsername($value)
    {
        return $this->db->get_where('users', array('username' => $value))->result_array();
    }
}
