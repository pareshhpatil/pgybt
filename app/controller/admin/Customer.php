<?php

/**
 * Supplier controller class to handle Admins supplier
 */
class Customer extends Controller {

    function __construct() {
        parent::__construct();
        $this->validateSession('admin');
        $this->view->selectedMenu = 'customer';
    }

    /**
     * Display admin suppliers list
     */
    function viewlist() {
        try {
            $success = $this->session->get('successMessage');
            if ($success != '') {
                $this->session->remove('successMessage');
            }
            $list = $this->model->getCustomerList();
            $int = 0;
            foreach ($list as $item) {
                $list[$int]['encrypted_id'] = $this->encrypt->encode($item['customer_id']);
                $int++;
            }

            $this->smarty->assign("success", $success);
            $this->smarty->assign("list", $list);
            $this->smarty->assign("title", "Customer list");
            $this->view->canonical = 'admin/supplier/viewlist';
            $this->view->selectedMenu = 'list_customer';
            $this->view->render('header/list');
            $this->smarty->display(VIEW . 'admin/customer/list.tpl');
            $this->view->render('footer/list');
        } catch (Exception $e) {
            SwipezLogger::error(__CLASS__, '[E999]Error while listing suppliers Error: for user id [' . $this->session->get('userid') . '] ' . $e->getMessage());
        }
    }

    /**
     * Create new supplier for admin
     */
    function create() {

        $userlist = $this->model->getUserlist();
        $this->smarty->assign("userlist", $userlist);
        $this->view->title = 'New supplier details';
        $this->view->selectedMenu = 'create_customer';
        $this->HTMLValidationPrinter();
        $this->view->render('header/profile');
        $this->smarty->display(VIEW . 'admin/customer/create.tpl');
        $this->view->render('footer/profile');
    }

    /**
     * Save new supplier 
     */
    function save() {
        try {
            $user_id = $this->session->get('userid');
            if (empty($_POST)) {
                header("Location:/admin/customer/create");
            }

            require CONTROLLER . 'admin/Customervalidator.php';
            $validator = new Customervalidator($this->model);
            $validator->validateCustomerSave();
            $hasErrors = $validator->fetchErrors();
            if ($hasErrors == false) {
                $join_date = new DateTime($_POST['join_date']);
                $birth_date = new DateTime($_POST['birth_date']);
                $anniversary = new DateTime($_POST['anniversary']);
                $result = $this->model->saveCustomer($_POST['name'], $_POST['email'], $_POST['mobile'], $_POST['mobile2'], $_POST['current_address'], $_POST['permanent_address'], $_POST['reff_by'], $join_date->format('Y-m-d'), $birth_date->format('Y-m-d'), $anniversary->format('Y-m-d'), $_POST['note'], $_FILES["uploaded_file"], $user_id
                        , $_POST['pan'], $_POST['voter_no'], $_POST['uid'], $_POST['nom1_name'], $_POST['nom1_phone'], $_POST['nom1_address'], $_POST['nom2_name']
                        , $_POST['nom2_phone'], $_POST['nom2_address'], $_POST['vitnase_name'], $_POST['vitnase_phone'], $_POST['vitnase_address']);
                if ($result['message'] == 'success') {
                    $this->session->set('successMessage', 'Customer have been saved.');
                    header("Location:/admin/customer/viewlist");
                }
            } else {
                $this->smarty->assign("hasErrors", $hasErrors);
                $this->smarty->assign("post", $_POST);
                $this->create();
            }
        } catch (Exception $e) {
            SwipezLogger::error(__CLASS__, '[E289]Error while creating supplier Error: ' . $e->getMessage());
            header("Location:/error");
        }
    }

    /**
     * Delete admin supplier
     */
    function delete($link) {
        try {
            $user_id = $this->session->get('userid');
            $converter = new Encryption;
            $customer_id = $converter->decode($link);
            $result = $this->model->deleteCustomer($customer_id, $user_id);
            if ($result == true) {
                $this->session->set('successMessage', 'Customer have been deleted successfully.');
                header("Location:/admin/supplier/viewlist");
            }
        } catch (Exception $e) {
            SwipezLogger::error(__CLASS__, '[E290]Error while deleting supplier Error: ' . $e->getMessage());
            header("Location:/error");
        }
    }

    /**
     * Supplier update initiate
     */
    function update($link) {
        try {
            $converter = new Encryption;
            $customer_id = $converter->decode($link);
            $user_id = $this->session->get('userid');
            $details = $this->model->getCustomerDetails($customer_id);
            if (empty($details)) {
                SwipezLogger::error(__CLASS__, '[E291]Error while update Customer profile fetching supplier details Error: ');
                $this->setGenericError();
            }
            $userlist = $this->model->getUserlist();
            $this->smarty->assign("userlist", $userlist);
            $this->smarty->assign("detail", $details);
            $this->smarty->assign("customer_id", $link);
            $this->HTMLValidationPrinter();
            $this->view->render('header/profile');
            $this->smarty->display(VIEW . 'admin/customer/update.tpl');
            $this->view->render('footer/profile');
        } catch (Exception $e) {
            SwipezLogger::error(__CLASS__, '[E292]Error while updating supplier Error: ' . $e->getMessage());
            header("Location:/error");
        }
    }

    /**
     * Update save supplier
     */
    function saveupdate() {
        try {
            $customer_id = $this->encrypt->decode($_POST['customer_id']);
            $user_id = $this->session->get('userid');
            require CONTROLLER . 'admin/Customervalidator.php';
            $validator = new Customervalidator($this->model);
            $validator->validateCustomerSave();
            $hasErrors = $validator->fetchErrors();
            if ($hasErrors == false) {
                $join_date = new DateTime($_POST['join_date']);
                $birth_date = new DateTime($_POST['birth_date']);
                $anniversary = new DateTime($_POST['anniversary']);
                $result = $this->model->updateCustomer($customer_id, $_POST['name'], $_POST['email'], $_POST['mobile'], $_POST['mobile2'], $_POST['current_address'], $_POST['permanent_address'], $_POST['reff_by'], $join_date->format('Y-m-d'), $birth_date->format('Y-m-d'), $anniversary->format('Y-m-d'), $_POST['note'], $_FILES["uploaded_file"], $user_id
                        , $_POST['pan'], $_POST['voter_no'], $_POST['uid'], $_POST['nom1_name'], $_POST['nom1_phone'], $_POST['nom1_address'], $_POST['nom2_name']
                        , $_POST['nom2_phone'], $_POST['nom2_address'], $_POST['vitnase_name'], $_POST['vitnase_phone'], $_POST['vitnase_address']);
                if ($result['message'] == 'success') {
                    $this->session->set('successMessage', 'Customer have been update.');
                    header("Location:/admin/customer/viewlist");
                }
            } else {
                $this->smarty->assign("hasErrors", $hasErrors);
                $this->update($_POST['customer_id']);
            }
        } catch (Exception $e) {
            SwipezLogger::error(__CLASS__, '[E293]Error while updating supplier Error: ' . $e->getMessage());
            header("Location:/error");
        }
    }

    function document($link) {
        $customer_id = $this->encrypt->decode($link);
        $doclist = $this->model->getCustomerDocument($customer_id);
        $cust_det = $this->model->getCustomerDetails($customer_id);
        $this->smarty->assign("link", $link);
        $this->smarty->assign("customer_id", $customer_id);
        $this->smarty->assign("doclist", $doclist);
        $this->smarty->assign("title", $cust_det['name']);
        $this->view->title = 'New supplier details';
        $this->view->selectedMenu = 'list_customer';
        $this->HTMLValidationPrinter();
        $this->view->render('header/profile');
        $this->smarty->display(VIEW . 'admin/customer/document.tpl');
        $this->view->render('footer/profile');
    }

    function documentsave($link) {
        try {
            $user_id = $this->session->get('userid');
            if (empty($_POST)) {
                header("Location:/admin/customer/create");
            }

            $result = $this->model->saveDocument($_POST['customer_id'], $_POST['name'], $_FILES["uploaded_file"], $user_id);
            $this->session->set('successMessage', 'Document have been saved.');
            header("Location:/admin/customer/document/" . $link);
        } catch (Exception $e) {
            SwipezLogger::error(__CLASS__, '[E289]Error while save document Error: ' . $e->getMessage());
            header("Location:/error");
        }
    }

}

?>
