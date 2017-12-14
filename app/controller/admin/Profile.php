<?php

/**
 * Profile controller class to handle profile update for admin
 */
class Profile extends Controller {

    function __construct() {
        parent::__construct();

        //TODO : Check if using static function is causing any problems!
        $this->validateSession('admin');
        $this->view->selectedMenu = 'profile';
        //$this->view->js = array('dashboard/js/default.js');
    }

    /**
     * Display admin profile
     */
    function index() {
        try {
            $admin_id = $this->session->get('admin_id');
            $user_id = $this->session->get('userid');
            $personalDetails = $this->model->getPersonalDetails($user_id);
            if (empty($personalDetails)) {
                SwipezLogger::error(__CLASS__, '[E014]Error while update admin profile fetching personal details. user id ' . $user_id);
                $this->setGenericError();
            }
            $adminDetails = $this->model->getAdminDetails($user_id);
            if (empty($adminDetails)) {
                SwipezLogger::error(__CLASS__, '[E015]Error while update admin profile fetching admin details Error: ');
                $this->setGenericError();
            }
            $accountDetails = $this->model->getBankDetails($adminDetails['admin_id']);
            $pgDetails = $this->model->getPGDetails($adminDetails['admin_id']);
            $entitytype = $this->model->getEntityType();
            if (empty($entitytype)) {
                SwipezLogger::warn(__CLASS__, 'Fetching empty enitity type list while admin update profile ');
            }
            $industrytype = $this->model->getIndustryType();
            if (empty($industrytype)) {
                SwipezLogger::warn(__CLASS__, 'Fetching empty industry type list while admin update profile ');
            }

            $this->smarty->assign("personal", $personalDetails);
            $this->smarty->assign("admin", $adminDetails);
            $this->smarty->assign("account", $accountDetails);
            $this->smarty->assign("pg", $pgDetails);
            $this->smarty->assign("entitytype", $entitytype);
            $this->smarty->assign("industrytype", $industrytype);
            $this->view->canonical = 'admin/profile';
            $this->HTMLValidationPrinter();
            $this->view->render('header/profile');
            $this->smarty->display(VIEW . 'admin/profile/profile.tpl');
            $this->view->render('footer/profile');
        } catch (Exception $e) {
            SwipezLogger::error(__CLASS__, '[E016]Error while admin profile initiate Error: for admin [' . $admin_id . '] ' . $e->getMessage());
            $this->setGenericError();
        }
    }

    /**
     * Update admin profile
     */
    function update() {
        try {
            $admin_id = $this->session->get('admin_id');
            if (empty($_POST)) {
                header('Location:/admin/profile');
            }
            require CONTROLLER . 'admin/Registervalidator.php';
            $validator = new Registervalidator($this->model);
            $validator->validateUpdate();
            $hasErrors = $validator->fetchErrors();
            if ($hasErrors == false) {
                $dob = new DateTime($_POST['dob']);
                $landline = ($_POST['landline'] > 0) ? $_POST['landline'] : 0;
                $business_contact = ($_POST['business_contact'] > 0) ? $_POST['business_contact'] : 0;
                $result = $this->model->pesonalUpdate($this->session->get('userid'), $_POST['email'], $_POST['first_name'], $_POST['last_name'], $_POST['mob_country_code'], $_POST['mobile'], $_POST['ll_country_code'], $landline, $dob->format('Y-m-d'), $_POST['address'], $_POST['address2'], $_POST['city'], $_POST['state'], $_POST['country'], $_POST['zip'], $_POST['type'], $_POST['industry_type'], $_POST['company_name'], $_POST['registration_no'], $_POST['pan'], $_POST['current_address'], $_POST['current_address2'], $_POST['current_city'], $_POST['current_state'], $_POST['current_country'], $_POST['current_zip'], $_POST['business_email'], $_POST['country_code'], $business_contact);
                if ($result == 'success') {
                    $this->session->set('display_name', ucfirst($_POST['first_name']));
                    $this->session->set('successMessage', 'Updates made to your profile have been saved.');
                    header('Location:/admin/profile');
                } else {
                    SwipezLogger::error(__CLASS__, '[E017-a]Error while update profile Error: for admin [' . $admin_id . ']' . $result);
                    $this->setGenericError();
                }
            } else {
                $this->smarty->assign("haserrors", $hasErrors);
                $this->index();
            }
        } catch (Exception $e) {
            SwipezLogger::error(__CLASS__, '[E017]Error while update profile Error: for admin [' . $admin_id . ']' . $e->getMessage());
            $this->setGenericError();
        }
    }

}
