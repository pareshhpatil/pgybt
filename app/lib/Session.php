<?php

class Session
{
    
    function __construct()
    {
        @session_start();
    }
    
    public function set($key, $value)
    {
        $_SESSION[$key] = $value;
    }
    
    public function remove($key)
    {
        if (isset($_SESSION[$key]))
            unset($_SESSION[$key]);
    }
    
    public function get($key)
    {
        if (isset($_SESSION[$key]))
            return $_SESSION[$key];
    }
    
    public function destroy()
    {
        //unset($_SESSION);
        session_destroy();
    }
    public function destroyuser()
    {
        $this->remove('userid');
        $this->remove('logged_in');
        $this->remove('email_id');
        $this->remove('display_name');
        $this->remove('user_status');
        $this->remove('user_name');
        
    }
}