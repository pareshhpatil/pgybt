<?php

class SubuserModel extends Model {

    function __construct() {
        parent::__construct();
    }

    public function getControllers() {
        try {
            $sql = "select * from controller where is_active=1";
            $params = array();
            $this->db->exec($sql, $params);
            return $this->db->resultset();
        } catch (Exception $e) {
            SwipezLogger::error(__CLASS__, '[E700]Error while fetching industry type list Error: ' . $e->getMessage());
        }
    }

    public function isExistTemplate($name, $user_id) {
        try {
            $sql = 'select role_id from roles WHERE name=:name and user_id=:user_id and is_active=1';
            $params = array(':name' => $name, ':user_id' => $user_id);
            $this->db->exec($sql, $params);
            $result = $this->db->single();
            if (!empty($result)) {
                return TRUE;
            }
            $this->db->closeStmt();
        } catch (Exception $e) {
            SwipezLogger::error(__CLASS__, '[E138]Error while checking template exist Error:for user id[' . $user_id . '] ' . $e->getMessage());
        }
    }

    public function saveRole($user_id, $name, $controllers) {
        try {
            $controllers = implode(',', $controllers);
            $sql = "insert into roles(name,controllers,created_by,created_date,last_update_by)values(:name,:controllers,:user_id,CURRENT_TIMESTAMP(),:user_id)";
            $params = array(':user_id' => $user_id, ':name' => $name, ':controllers' => $controllers,);
            $this->db->exec($sql, $params);
        } catch (Exception $e) {
            SwipezLogger::error(__CLASS__, '[E295]Error while creating supplier Error: ' . $e->getMessage());
            $this->setGenericError();
        }
    }
    
    public function updateRole($role_id, $name, $controllers) {
        try {
            $controllers = implode(',', $controllers);
            $sql = "update roles set name=:name,controllers=:controllers where role_id=:role_id";
            $params = array(':role_id' => $role_id, ':name' => $name, ':controllers' => $controllers,);
            $this->db->exec($sql, $params);
        } catch (Exception $e) {
            SwipezLogger::error(__CLASS__, '[E295]Error while creating supplier Error: ' . $e->getMessage());
            $this->setGenericError();
        }
    }
    public function savesubAdmin($user_id, $name,$email,$mobile,$user_name,$password,$role) {
        try {
            $sql = "call save_sub_admin(:user_id,:email,:name,:mobile,:user_name,:password,:role)";
            $params = array(':user_id' => $user_id, ':email' => $email,':name' => $name, ':mobile' => $mobile,':user_name' => $user_name, ':password' => $password,':role' => $role);
            $this->db->exec($sql, $params);
            $row = $this->db->single();
            return $row;
        } catch (Exception $e) {
            SwipezLogger::error(__CLASS__, '[E295]Error while creating subadmin Error: ' . $e->getMessage());
            $this->setGenericError();
        }
    }
    
    public function getRoleDeatails($role_id) {
        try {
            $sql = "select * from roles where role_id=:role_id";
            $params = array(':role_id' => $role_id);
            $this->db->exec($sql, $params);
            $list = $this->db->single();
            return $list;
        } catch (Exception $e) {
            SwipezLogger::error(__CLASS__, '[E296]Error while fetching supplier list Error: for user id[' . $userid . ']' . $e->getMessage());
        }
    }

    public function getRoleList() {
        try {
            $sql = "select * from roles where is_active=:active;";
            $params = array(':active' => 1);
            $this->db->exec($sql, $params);
            $list = $this->db->resultset();
            return $list;
        } catch (Exception $e) {
            SwipezLogger::error(__CLASS__, '[E296]Error while fetching supplier list Error: for user id[]' . $e->getMessage());
        }
    }

    function deleterole($role_id, $user_id) {
        try {
            $sql = "UPDATE `roles` SET `is_active` = 0 , last_update_by=`user_id`  WHERE role_id=:role_id and user_id=:user_id";
            $params = array(':role_id' => $role_id, ':user_id' => $user_id);
            $this->db->exec($sql, $params);
            $this->db->closeStmt();
            return true;
        } catch (Exception $e) {
            SwipezLogger::error(__CLASS__, '[E297]Error while delete role Error: for role id [' . $role_id . '] ' . $e->getMessage());
            $this->setGenericError();
        }
    }

    public function emailAlreadyExists($emailId_) {
        try {
            $sql = "SELECT `user_id` FROM `user` where email=:email";
            $params = array(':email' => $emailId_);

            $this->db->exec($sql, $params);
            $row = $this->db->single();

            if (isset($row['user_id'])) {
                return true;
            } else {
                return false;
            }
        } catch (Exception $e) {
            SwipezLogger::error(__CLASS__, '[E170]Error while checking email exist Error: for email id [' . $emailId_ . ']' . $e->getMessage());
            $this->setGenericError();
        }
    }

    

    public function getSubuserList() {
        try {
            $sql = "select u.email,u.mobile,u.name,r.name as role,u.user_id,u.user_type from user u inner join roles r on u.role_id=r.role_id where u.is_active=1;";
            $params = array();
            $this->db->exec($sql, $params);
            $row = $this->db->resultset();
            return $row;
        } catch (Exception $e) {
            SwipezLogger::error(__CLASS__, '[E299]Error while fetching supplier details Error: for user id[' . $userid . ']' . $e->getMessage());
        }
    }

}

?>
