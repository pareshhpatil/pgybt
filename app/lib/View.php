<?php

class View {

    protected $_error = NULL;
    
    function __construct() {
        //echo 'this is the view';
    }

    public function render($name, $noInclude = false)
    {
        require VIEW . $name . '.php';    
    }
    
    public function setError($error_) {
        $this->_error = $error_;
    }
    
    public function hasError() {
        if(is_array($this->_error)) {
            return TRUE;
        }
    }

}