<?php

class Register_model extends CI_Model
{
    public function usersGetByUsername($value)
    {
        return $this->db->get_where('users', array('username' => $value))->result_array();
    }

    public function register($value)
    {
        $checkUsername = $this->usersGetByUsername($value['username']);
        if ($checkUsername) {
            return false;
        } else {
            $this->db->insert("users", $value);
            return $this->db->affected_rows();
        }

    }
}
