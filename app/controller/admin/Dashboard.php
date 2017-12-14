<?php

/**
 * Dashboard controller class to handle dashboard requests for admin
 */
class Dashboard extends Controller {

    function __construct() {
        parent::__construct();

        //TODO : Check if using static function is causing any problems!
        $this->validateSession('admin');
        //$this->view->js = array('dashboard/js/default.js');
        $this->view->selectedMenu = 'dashboard';
    }

    /**
     * Display admin dashboard
     */
    function index() {
        try {
            $user_id = $this->session->get('userid');
            $this->view->chart_display = TRUE;


            $this->view->adminType = $this->session->get('admin_type');
            $admin_status = $this->session->get('admin_status');
            $this->view->title = 'Admin dashboard';
            $this->view->canonical = 'admin/dashboard';
            $this->view->user_type = 'admin';
            $this->view->render('header/mDashboard');
            $this->view->render('admin/dashboard/dashboard');
            $this->view->render('footer/mDashboard');
        } catch (Exception $e) {
            SwipezLogger::error(__CLASS__, '[E001]Error while admin dashboard initiate Error: for admin [' . $user_id . '] ' . $e->getMessage());
            $this->setGenericError();
        }
    }

    function update($type) {
        try {
            $admin_id = $this->session->get('admin_id');
            $this->model->seenNotification($this->session->get('userid'), $type);
        } catch (Exception $e) {
            SwipezLogger::error(__CLASS__, '[E002]Error while update admin notification Error: for admin [' . $admin_id . '] ' . $e->getMessage());
            $this->setGenericError();
        }
    }

}
