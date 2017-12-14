<?php

/**
 * Supplier controller class to handle Admins supplier
 */
class Subuser extends Controller {

    function __construct() {
        parent::__construct();
        $this->validateSession('admin');
        $this->view->selectedMenu = 'subuser';
    }

    /**
     * Display admin suppliers list
     */
    function viewlist() {
        try {

            $list = $this->model->getSubuserList($this->session->get('userid'));
            $int = 0;
            foreach ($list as $item) {
                $list[$int]['encrypted_id'] = $this->encrypt->encode($item['user_id']);
                $int++;
            }

            $this->smarty->assign("list", $list);
            $this->smarty->assign("title", "Sub admin list");
            $this->view->canonical = 'admin/supplier/viewlist';
            $this->view->render('header/list');
            $this->smarty->display(VIEW . 'admin/subuser/list.tpl');
            $this->view->render('footer/list');
        } catch (Exception $e) {
            SwipezLogger::error(__CLASS__, '[E999]Error while listing suppliers Error: for user id [' . $this->session->get('userid') . '] ' . $e->getMessage());
        }
    }

    /**
     * Create new supplier for admin
     */
    function create() {
        $roles = $this->model->getRoleList($this->session->get('userid'));
        $this->smarty->assign("roles", $roles);
        $this->view->title = 'New supplier details';
        $this->HTMLValidationPrinter();
        $this->view->render('header/profile');
        $this->smarty->display(VIEW . 'admin/subuser/create.tpl');
        $this->view->render('footer/profile');
    }

    function roles() {
        try {

            $list = $this->model->getRoleList($this->session->get('userid'));
            $int = 0;
            foreach ($list as $item) {
                $list[$int]['encrypted_id'] = $this->encrypt->encode($item['role_id']);
                $int++;
            }
            $this->view->selectedMenu = 'roles';
            $this->smarty->assign("list", $list);
            $this->smarty->assign("title", "Role list");
            $this->view->canonical = 'admin/supplier/viewlist';
            $this->view->render('header/list');
            $this->smarty->display(VIEW . 'admin/subuser/rolelist.tpl');
            $this->view->render('footer/list');
        } catch (Exception $e) {
            SwipezLogger::error(__CLASS__, '[E999]Error while listing suppliers Error: for user id [' . $this->session->get('userid') . '] ' . $e->getMessage());
        }
    }

    function createrole() {
        $controllerlist = $this->model->getControllers();
        $this->view->selectedMenu = 'roles';
        $this->smarty->assign("list", $controllerlist);
        $this->view->title = 'New role';
        $this->HTMLValidationPrinter();
        $this->view->render('header/list');
        $this->smarty->display(VIEW . 'admin/subuser/createrole.tpl');
        $this->view->render('footer/list');
    }

    function updaterole($link) {
        $role_id = $this->encrypt->decode($link);
        $details = $this->model->getRoleDeatails($role_id);
        $roles = explode(',', $details['controllers']);
        $controllerlist = $this->model->getControllers();
        $int = 0;
        foreach ($controllerlist as $items) {
            if (in_array($items['controller_id'], $roles)) {
                $controllerlist[$int]['checked'] = 'checked';
            } else {
                $controllerlist[$int]['checked'] = '';
            }
            $int++;
        }
        $this->view->selectedMenu = 'roles';
        $this->smarty->assign("list", $controllerlist);
        $this->smarty->assign("details", $details);
        $this->smarty->assign("role_id", $link);
        $this->view->title = 'New role';
        $this->HTMLValidationPrinter();
        $this->view->render('header/list');
        $this->smarty->display(VIEW . 'admin/subuser/updaterole.tpl');
        $this->view->render('footer/list');
    }

    /**
     * Save new role 
     */
    function saverole() {
        try {
            $user_id = $this->session->get('userid');
            if (empty($_POST)) {
                header("Location:/admin/subuser/createrole");
            }
            require_once CONTROLLER . 'admin/Subuservalidator.php';
            $validator = new Subuservalidator($this->model);
            $validator->validateRoleSave($user_id);
            $hasErrors = $validator->fetchErrors();
            if ($hasErrors == false) {
                $this->model->saveRole($user_id, $_POST['role_name'], $_POST['controllers']);
                $this->session->set('successMessage', 'New role have been saved.');
                header("Location:/admin/subuser/roles");
            } else {
                $this->smarty->assign("haserrors", $hasErrors);
                $this->smarty->assign("post", $_POST);
                $this->createrole();
            }
        } catch (Exception $e) {
            SwipezLogger::error(__CLASS__, '[E289]Error while creating supplier Error: ' . $e->getMessage());
            header("Location:/error");
        }
    }

    function roleupdatesaved() {
        try {
            $role_id = $this->encrypt->decode($_POST['role_id']);

            if (empty($_POST)) {
                header("Location:/admin/subuser/roles");
            }

            $this->model->updateRole($role_id, $_POST['role_name'], $_POST['controllers']);
            $this->session->set('successMessage', 'Update role successfully.');
            header("Location:/admin/subuser/roles");
        } catch (Exception $e) {
            SwipezLogger::error(__CLASS__, '[E289]Error while creating supplier Error: ' . $e->getMessage());
            header("Location:/error");
        }
    }

    /**
     * Save new sub admin 
     */
    function saved() {
        try {
            $user_id = $this->session->get('userid');
            if (empty($_POST)) {
                header("Location:/admin/subuser/create");
            }
            require_once CONTROLLER . 'admin/Subuservalidator.php';
            $validator = new Subuservalidator($this->model);
            $validator->validateSubadminSave();
            $hasErrors = $validator->fetchErrors();
            if ($hasErrors == false) {
                $result = $this->model->savesubAdmin($user_id, $_POST['name'], $_POST['email'], $_POST['mobile'],$_POST['user_name'], $_POST['password'], $_POST['role']);
                if ($result['message'] == 'success') {
                    $this->sendMail($result['usertimestamp'], $_POST['email']);
                }
                $this->session->set('successMessage', 'New subadmin have been saved.');
                header("Location:/admin/subuser/viewlist");
            } else {
                $this->smarty->assign("haserrors", $hasErrors);
                $this->smarty->assign("post", $_POST);
                $this->create();
            }
        } catch (Exception $e) {
            SwipezLogger::error(__CLASS__, '[E289]Error while creating supplier Error: ' . $e->getMessage());
            header("Location:/error");
        }
    }

    public function sendMail($concatStr_, $toEmail_) {
        try {
            $encoded = $this->encrypt->encode($concatStr_);
            $baseurl = $this->host . '://' . $_SERVER['SERVER_NAME'];
            $verifyemailurl = $baseurl . '/admin/register/verifyemail/' . $encoded . '';

            $emailWrapper = new EmailWrapper();
            $mailcontents = $emailWrapper->fetchMailBody("user.verifyemail");

            if (isset($mailcontents[0]) && isset($mailcontents[1])) {
                $message = $mailcontents[0];
                $message = str_replace('__EMAILID__', $toEmail_, $message);
                $message = str_replace('__LINK__', $verifyemailurl, $message);
                $message = str_replace('__BASEURL__', $baseurl, $message);

                $emailWrapper->sendMail($toEmail_, "", $mailcontents[1], $message);
            } else {
                SwipezLogger::warn("Mail could not be sent with verify email link to : " . $toEmail_);
            }
        } catch (Exception $e) {
            SwipezLogger::error(__CLASS__, '[E166]Error while sending mail Error: email link to : ' . $toEmail_ . $e->getMessage());
        }
    }

    /**
     * Delete admin supplier
     */
    function delete($user_id) {
        try {
            $user_id = $this->encrypt->decode($user_id);
            require_once MODEL . 'CommonModel.php';
            $common = new CommonModel();
            $common->updateUserStatus(21, $user_id);
            $this->session->set('successMessage', 'Sub admin deleted successfully.');
            header("Location:/admin/subuser/viewlist");
        } catch (Exception $e) {
            SwipezLogger::error(__CLASS__, '[E290]Error while deleting supplier Error: ' . $e->getMessage());
            header("Location:/error");
        }
    }

    /**
     * Delete admin supplier
     */
    function deleterole($role_id) {
        try {
            $user_id = $this->session->get('userid');
            $role_id = $this->encrypt->decode($role_id);
            $result = $this->model->deleterole($role_id, $user_id);
            if ($result == true) {
                $this->session->set('successMessage', 'Role have been deleted successfully.');
                header("Location:/admin/subuser/roles");
            }
        } catch (Exception $e) {
            SwipezLogger::error(__CLASS__, '[E290]Error while deleting supplier Error: ' . $e->getMessage());
            header("Location:/error");
        }
    }

}

?>
