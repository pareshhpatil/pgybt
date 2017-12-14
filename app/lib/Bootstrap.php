<?php

class Bootstrap {

    private $_url = null;
    private $_controller = null;
    private $_controllerPath = CONTROLLER; // Always include trailing slash
    private $_modelPath = MODEL; // Always include trailing slash
    private $_errorFile = 'error.php';
    private $_defaultFile = 'Home.php';
    private $Restricted_GET = array("admin/invoice/create", "admin/paymentrequest/view", "admin/register/index", "admin/register", "admin/register/saved", "admin/register/verifyemail",
        "patron/register/saved", "patron/register/verifyemail", "patron/register", "patron/register/index", "admin/template/create", "admin/template/update", "patron/paymentrequest/view", "secure/response");
    private $Restricted_POST = array("admin/invoice/invoicesave", "admin/paymentrequest/respond", "admin/register/personalsave", "admin/register/entitysave", "admin/register/thankyou",
        "admin/register/success", "admin/template/saved", "admin/template/saveupdate", "patron/paymentrequest/respond", "patron/paymentrequest/success", "patron/register/personalsave", "patron/register/success", "patron/register/thankyou",
        "paymentgateways/success");
    private $session;

    /**
     * Starts the Bootstrap
     * 
     * @return boolean
     */
    public function init() {
        $this->session = new Session();
        if (!SITEDOWN) {
            // Sets the protected $_url
            $this->_handleURL();
        } else {
            $this->_invokeSiteDownPage();
        }
    }

    /**
     * (Optional) Set a custom path to controllers
     * @param string $path
     */
    public function setControllerPath($path) {
        $this->_controllerPath = trim($path, '/') . '/';
    }

    /**
     * (Optional) Set a custom path to models
     * @param string $path
     */
    public function setModelPath($path) {
        $this->_modelPath = trim($path, '/') . '/';
    }

    /**
     * (Optional) Set a custom path to the error file
     * @param string $path Use the file name of your controller, eg: error.php
     */
    public function setErrorFile($path) {
        $this->_errorFile = trim($path, '/');
    }

    /**
     * (Optional) Set a custom path to the error file
     * @param string $path Use the file name of your controller, eg: index.php
     */
    public function setDefaultFile($path) {
        $this->_defaultFile = trim($path, '/');
    }

    /**
     * Fetches the $_GET from 'url'
     */
    private function _handleURL() {
        try {
            $rawurl = isset($_GET['url']) ? $_GET['url'] : null;
            $url = rtrim($rawurl, '/');
            #SwipezLogger::debug(__CLASS__, "url : " . $url);
            $filterurl = filter_var($url, FILTER_SANITIZE_URL);
            #SwipezLogger::debug(__CLASS__, "filterurl : " . $filterurl);

            $this->_url = explode('/', $filterurl);
            $length = count($this->_url);


            //This block is for root domain level invocation of PGYBT i.e. http://www.pgybt.in/
            if ($this->_url[0] == "") {
                $this->_loadDefaultController();
                return;
            }


            $firstLevel = $this->_url[0];
            $firstLevel = ucfirst($firstLevel);
            $accessdenied = array("Uploads", "Images", "Css", "Js", "Fonts", "Inc");
            if (in_array($firstLevel, $accessdenied)) {
                header('Location: /error');
                exit;
            }
            if (substr($rawurl, -1) == "/") {
                $redirectUrl = "/" . substr_replace($rawurl, "", -1);
                header('Location:' . $redirectUrl, TRUE, 301);
            }

            switch ($firstLevel) {
             
                case 'Admin':
                    $this->_handleAdminURL();
                    break;
                case 'Login':
                    $this->_handleGenericURL($firstLevel);
                case 'Logout':
                    $this->_handleGenericURL($firstLevel);
                    break;
                case 'Home':
                    $this->_handleGenericURL($firstLevel);
                    break;
                case 'Profile':
                    $this->_handleGenericURL($firstLevel);
                    break;
                default :
                    $this->_error();
                    break;
            }
        } catch (Exception $e) {
            throw $e;
        }
    }


    /**
     * Handle generic urls i.e. non patron, admin and secure urls are handled here
     * 
     */
    private function _handleGenericURL($firstLevel_) {
        $this->_loadExistingController(TRUE, $firstLevel_, NULL);
    }

    /**
     * Handle generic urls i.e. non patron, admin and secure urls are handled here
     * 
     */



    /**
     * Handle patron url requests
     * 
     */
    private function _handlePatronURL() {
        if (empty($this->_url[1])) {
            $this->_error();
        }

        $firstLevel = $this->_url[0];
        $secondLevel = ucfirst($this->_url[1]);
        switch ($secondLevel) {
            case 'Dashboard':
                $this->_loadExistingController(FALSE, $firstLevel, $secondLevel);
                break;
            default :
                $this->_error();
                break;
        }
    }

    /**
     * Handle admin url requests
     * 
     */
    private function _handleAdminURL() {

        if (empty($this->_url[1])) {
            $this->_url[1] = 'Landing';
        }

        $firstLevel = $this->_url[0];
        $secondLevel = ucfirst($this->_url[1]);

        #sub-admin validation start
        $group_type = $this->session->get('group_type');
        if ($group_type == 2) {
            $result = $this->_roleExist($secondLevel);
            if ($result != 1) {
                $this->setError('Access denied', 'You do not have access to this feature. If you need access to this feature please contact your main admin.');
                $this->_error();
            }
        }
        #sub admin validation end

        switch ($secondLevel) {
            case 'Dashboard':
                $this->_loadExistingController(FALSE, $firstLevel, $secondLevel);
                break;
            case 'Profile':
                $this->_loadExistingController(FALSE, $firstLevel, $secondLevel);
                break;
            case 'Loan':
                $this->_loadExistingController(FALSE, $firstLevel, $secondLevel);
                break;
            case 'Fd':
                $this->_loadExistingController(FALSE, $firstLevel, $secondLevel);
                break;
            case 'Rd':
                $this->_loadExistingController(FALSE, $firstLevel, $secondLevel);
                break;
            case 'Rd':
                $this->_loadExistingController(FALSE, $firstLevel, $secondLevel);
                break;
            case 'Customer':
                $this->_loadExistingController(FALSE, $firstLevel, $secondLevel);
                break;
            case 'Report':
                $this->_loadExistingController(FALSE, $firstLevel, $secondLevel);
                break;
            case 'Chart':
                $this->_loadExistingController(FALSE, $firstLevel, $secondLevel);
                break;
            case 'Subuser':
                $this->_loadExistingController(FALSE, $firstLevel, $secondLevel);
                break;
            case 'Cheque':
                $this->_loadExistingController(FALSE, $firstLevel, $secondLevel);
                break;
            case 'Receipt':
                $this->_loadExistingController(FALSE, $firstLevel, $secondLevel);
                break;
            case 'Expense':
                $this->_loadExistingController(FALSE, $firstLevel, $secondLevel);
                break;
            case 'Account':
                $this->_loadExistingController(FALSE, $firstLevel, $secondLevel);
                break;
            default :
                $this->_error();
                break;
        }
    }


    private function _roleExist($controller) {
        $controller_list = array('Dashboard' => '1', 'Template' => '2', 'Invoice' => '3', 'Bulkupload' => '4', 'Subscription' => '5', 'Paymentrequest' => '6', 'Event' => '7', 'Subscription' => '8', 'Transaction' => '9', 'Report' => '10', 'Supplier' => '11', 'Profile' => '12', 'Companyprofile' => '13', 'Chart' => '14');
        $role_id = $controller_list[$controller];
        $roles = $this->session->get('roles');
        if (in_array($role_id, $roles)) {
            return 1;
        }
    }

    /**
     * This loads if there is no GET parameter passed
     */
    private function _loadDefaultController() {
        require $this->_controllerPath . $this->_defaultFile;
        $this->_controller = new Home();
        $this->_controller->Home();
    }

    /**
     * Load an existing controller if there IS a GET parameter passed
     * 
     * @return boolean|string
     */
    private function _loadExistingController($isGenericURL_, $firstLevel_, $secondLevel_ = NULL) {
        $file = "";
        $controller = "";
        if (isset($secondLevel_)) {
            $file = $this->_controllerPath . $firstLevel_ . "/" . $secondLevel_ . ".php";
            $controller = $secondLevel_;
        } else {
            $file = $this->_controllerPath . $firstLevel_ . ".php";
            $controller = $firstLevel_;
        }
        // SwipezLogger::debug(__CLASS__, "filepath " . $file);

        if (file_exists($file)) {
            require $file;
            $this->_controller = new $controller;

            $controllerMethodName = "";
            $controllerMethodParams = "";

            //If generic url is set to false then the url is for /patron and /admin
            if ($isGenericURL_ == FALSE) {
                $firstLevel_ = lcfirst($firstLevel_);
                $this->_controller->loadModel($controller, $this->_modelPath . $firstLevel_ . "/");
                $controllerMethodName = isset($this->_url[2]) ? $this->_url[2] : NULL;
                $controllerMethodParams = isset($this->_url[3]) ? $this->_url[3] : NULL;
            } else {
                $this->_controller->loadModel($controller, $this->_modelPath);
                $controllerMethodName = isset($this->_url[1]) ? $this->_url[1] : NULL;
                $controllerMethodParams = isset($this->_url[2]) ? $this->_url[2] : NULL;
            }
            //restricted post -- check if user reload submit form and success form 
            $this->restrictedPost($firstLevel_, $controller, $controllerMethodName, $controllerMethodParams);
            $this->_callControllerMethod($controllerMethodName, $controllerMethodParams);
        } else {
            $this->_error();
            return false;
        }
    }

    /**
     * If a method is passed in the GET url paremter
     * 
     *  http://localhost/controller/method/(param)/
     *  $thirdLevel_ = Method
     *  $fourthLevel_ = Param
     */
    private function _callControllerMethod($controllerMethodName_ = NULL, $controllerMethodParams_ = NULL) {
        //The below block checks if the third level url is empty then redirects to index method of the controller
        if ($controllerMethodName_ == NULL) {
            $this->_controller->index();
            return;
        }

        //Check if invoked method exists in the controller
        if (!method_exists($this->_controller, $controllerMethodName_)) {
            $this->_error();
            return;
        }

        //If there are no parameters passed in the url then call the controllers method without params
        if ($controllerMethodParams_ == NULL) {
            $this->_controller->{$controllerMethodName_}();
        } else {
            // Handle parameters sent within request url
            $this->_controller->{$controllerMethodName_}($controllerMethodParams_);
        }
    }



    private function _error() {
        require CONTROLLER . $this->_errorFile;
        $this->_controller = new Error();
        $this->_controller->index();
        exit;
    }

    public function ucfirst($str) {
        $fc = strtoupper(substr($str, 0, 1));
        return $fc . substr($str, 1);
    }

    public function restrictedPost($first, $controller, $MethodName) {

        $controller = strtolower($controller);
        $first = ($first != '') ? $first . '/' : '';
        $url = $first . $controller . '/' . $MethodName;
        if (in_array($url, $this->Restricted_GET)) {
            $this->session->set('isValidPost', TRUE);
        } else {
            if (in_array($url, $this->Restricted_POST)) {
                if ($this->session->get('isValidPost') == TRUE) {
                    $this->session->remove('isValidPost');
                } else {
                    $this->setError('Invalid request', 'Please do not refresh the browser window or hit enter in the browser address bar click <a href="/" >here</a> go back to home page.');
                    header('location: /error');
                    die();
                }
            }
        }
    }

    public function setError($title, $message) {
        $this->session->set('errorTitle', $title);
        $this->session->set('errorMessage', $message);
    }

}
