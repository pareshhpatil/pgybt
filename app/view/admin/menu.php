<?php
switch ($this->selectedMenu) {
    case 'customer':
        $select = 'm1';
        break;
    case 'create_customer':
        $select = 'm1';
        break;
    case 'list_customer':
        $select = 'm1';
        break;
    case 'loan_create':
        $select = 'm2';
        break;
    case 'loan_list':
        $select = 'm2';
        break;
    case 'emi':
        $select = 'm2';
        break;
    case 'emilist':
        $select = 'm2';
        break;

    case 'fd_create':
        $select = 'm3';
        break;
    case 'fd_list':
        $select = 'm3';
        break;
    case 'fd_maturity':
        $select = 'm3';
        break;


    case 'rd_create':
        $select = 'm4';
        break;
    case 'rd_list':
        $select = 'm4';
        break;
    case 'rd_installment':
        $select = 'm4';
        break;
    case 'rd_installmentlist':
        $select = 'm4';
        break;
    case 'rd_maturity':
        $select = 'm4';
        break;





    case 'profile':
        $select = 'm5';
        break;
    case 'onboarding':
        $select = 'm5';
        break;
    case 'suppliers':
        $select = 'm5';
        break;
    case 'companyprofileupdate':
        $select = 'm5';
        break;
    case 'companyprofileview':
        $select = 'm5';
        break;

    case 'dashboard':
        $select = 'm6';
        break;
    case 'subuser':
        $select = 'm5';
        break;
    case 'roles':
        $select = 'm5';
        break;

    case 'loan_calculator':
        $select = 'm8';
        break;
    case 'rd_calculator':
        $select = 'm8';
        break;

    case 'r1':
        $select = 'm7';
        break;
    case 'r2':
        $select = 'm7';
        break;
    case 'r3':
        $select = 'm7';
        break;
    case 'r4':
        $select = 'm7';
        break;
    case 'r5':
        $select = 'm7';
        break;
    case 'r6':
        $select = 'm7';
        break;
    case 'r7':
        $select = 'm7';
        break;
    case 'r8':
        $select = 'm7';
        break;

    case 'cheque_add':
        $select = 'm9';
        break;
    case 'cheque_list':
        $select = 'm9';
        break;
    case 'deposite':
        $select = 'm9';
        break;
    
    
    case 'expense_add':
        $select = 'm10';
        break;
    case 'expense_list':
        $select = 'm10';
        break;
    case 'account_add':
        $select = 'm11';
        $sub = 'a1';
        break;
    case 'account_list':
        $select = 'm11';
        $sub = 'a1';
        break;
    case 'transfer':
        $select = 'm11';
        $sub = 'a1';
        break;
}
?>  

<div class="page-sidebar-wrapper">
    <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
    <!-- DOC: Change data-auto-speed="200" to adjust the sub menu slide up/down speed -->
    <div class="page-sidebar navbar-collapse collapse">
        <!-- BEGIN SIDEBAR MENU -->
        <!-- DOC: Apply "page-sidebar-menu-light" class right after "page-sidebar-menu" to enable light sidebar menu style(without borders) -->
        <!-- DOC: Apply "page-sidebar-menu-hover-submenu" class right after "page-sidebar-menu" to enable hoverable(hover vs accordion) sub menu mode -->
        <!-- DOC: Apply "page-sidebar-menu-closed" class right after "page-sidebar-menu" to collapse("page-sidebar-closed" class must be applied to the body element) the sidebar sub menu mode -->
        <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
        <!-- DOC: Set data-keep-expand="true" to keep the submenues expanded -->
        <!-- DOC: Set data-auto-speed="200" to adjust the sub menu slide up/down speed -->
        <ul class="page-sidebar-menu" data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200">
            <!-- DOC: To remove the sidebar toggler from the sidebar you just need to completely remove the below "sidebar-toggler-wrapper" LI element -->
            <li class="sidebar-toggler-wrapper">
                <!-- BEGIN SIDEBAR TOGGLER BUTTON -->
                <div class="sidebar-toggler">
                </div>
                <!-- END SIDEBAR TOGGLER BUTTON -->
            </li>
            <li >
                &nbsp;<br>&nbsp;
            </li>

            <li class="<?php echo ($select == 'm6') ? 'active open' : 'start'; ?>">
                <a href="/admin/dashboard">
                    <i class="icon-home"></i>
                    <span class="<?php echo ($select == 'm6') ? 'active' : 'title'; ?>">Dashboard</span>
                </a>
            </li>
            <li class="<?php echo ($select == 'm1') ? 'active open' : ''; ?>">
                <a href="javascript:;">
                    <i class="icon-basket"></i>
                    <span class="title">Customers</span>
                    <span class="arrow"></span>
                    <?php echo ($select == 'm1') ? '<span class="selected"></span>' : ''; ?>
                </a>
                <ul class="sub-menu">
                    <li <?php
                    if ($this->selectedMenu == 'create_customer') {
                        echo 'class="active"';
                    }
                    ?>>
                        <a href="/admin/customer/create">
                            Create Customer</a>
                    </li>
                    <li <?php
                    if ($this->selectedMenu == 'list_customer') {
                        echo 'class="active"';
                    }
                    ?>>
                        <a href="/admin/customer/viewlist">
                            Customer list</a>
                    </li>
                </ul>
            </li>
            <li class="<?php echo ($select == 'm2') ? 'active open' : ''; ?>">
                <a href="javascript:;">
                    <i class="icon-rocket"></i>
                    <span class="title">Loan</span>
                    <span class="arrow"></span>
                    <?php echo ($select == 'm2') ? '<span class="selected"></span>' : ''; ?>
                </a>
                <ul class="sub-menu">
                    <li <?php
                    if ($this->selectedMenu == 'loan_create') {
                        echo 'class="active"';
                    }
                    ?>>
                        <a href="/admin/loan/create">
                            Create loan</a>
                    </li>
                    <li <?php
                    if ($this->selectedMenu == 'loan_list') {
                        echo 'class="active"';
                    }
                    ?>>
                        <a href="/admin/loan/viewlist">
                            Loan list</a>
                    </li>
                    <li <?php
                    if ($this->selectedMenu == 'emi') {
                        echo 'class="active"';
                    }
                    ?>>
                        <a href="/admin/loan/emi">
                            Loan EMI</a>
                    </li>
                    <li <?php
                    if ($this->selectedMenu == 'emilist') {
                        echo 'class="active"';
                    }
                    ?>>
                        <a href="/admin/loan/emilist">
                            Loan EMI list</a>
                    </li>
                </ul>
            </li>

            <li class="<?php echo ($select == 'm3') ? 'active open' : ''; ?>">
                <a href="javascript:;">
                    <i class="icon-rocket"></i>
                    <span class="title">FD</span>
                    <span class="arrow"></span>
                    <?php echo ($select == 'm3') ? '<span class="selected"></span>' : ''; ?>
                </a>
                <ul class="sub-menu">
                    <li <?php
                    if ($this->selectedMenu == 'fd_create') {
                        echo 'class="active"';
                    }
                    ?>>
                        <a href="/admin/fd/create">
                            Create FD</a>
                    </li>
                    <li <?php
                    if ($this->selectedMenu == 'fd_list') {
                        echo 'class="active"';
                    }
                    ?>>
                        <a href="/admin/fd/viewlist">
                            FD list</a>
                    </li>
                    <li <?php
                    if ($this->selectedMenu == 'fd_maturity') {
                        echo 'class="active"';
                    }
                    ?>>
                        <a href="/admin/fd/maturity">
                            FD Maturity</a>
                    </li>
                </ul>
            </li>

            <li class="<?php echo ($select == 'm4') ? 'active open' : ''; ?>">
                <a href="javascript:;">
                    <i class="icon-rocket"></i>
                    <span class="title">RD</span>
                    <span class="arrow"></span>
                    <?php echo ($select == 'm4') ? '<span class="selected"></span>' : ''; ?>
                </a>
                <ul class="sub-menu">
                    <li <?php
                    if ($this->selectedMenu == 'rd_create') {
                        echo 'class="active"';
                    }
                    ?>>
                        <a href="/admin/rd/create">
                            Create RD</a>
                    </li>
                    <li <?php
                    if ($this->selectedMenu == 'rd_list') {
                        echo 'class="active"';
                    }
                    ?>>
                        <a href="/admin/rd/viewlist">
                            RD list</a>
                    </li>
                    <li <?php
                    if ($this->selectedMenu == 'rd_installment') {
                        echo 'class="active"';
                    }
                    ?>>
                        <a href="/admin/rd/installment">
                            Installment</a>
                    </li>
                    <li <?php
                    if ($this->selectedMenu == 'rd_installmentlist') {
                        echo 'class="active"';
                    }
                    ?>>
                        <a href="/admin/rd/installmentlist">
                            Installment List</a>
                    </li>
                    <li <?php
                    if ($this->selectedMenu == 'rd_maturity') {
                        echo 'class="active"';
                    }
                    ?>>
                        <a href="/admin/rd/maturity">
                            RD Maturity</a>
                    </li>
                </ul>
            </li>

            <li class="<?php echo ($select == 'm9') ? 'active open' : ''; ?>">
                <a href="javascript:;">
                    <i class="icon-credit-card"></i>
                    <span class="title">Cheque Master</span>
                    <span class="arrow"></span>
                    <?php echo ($select == 'm9') ? '<span class="selected"></span>' : ''; ?>
                </a>
                <ul class="sub-menu">
                    <li <?php
                    if ($this->selectedMenu == 'cheque_add') {
                        echo 'class="active"';
                    }
                    ?>>
                        <a href="/admin/cheque/add">
                            Add Cheque </a>
                    </li>
                    <li <?php
                    if ($this->selectedMenu == 'cheque_list') {
                        echo 'class="active"';
                    }
                    ?>>
                        <a href="/admin/cheque/viewlist">
                            Cheque List</a>
                    </li>
                    <li <?php
                    if ($this->selectedMenu == 'deposite') {
                        echo 'class="active"';
                    }
                    ?>>
                        <a href="/admin/cheque/deposite">
                            Cheque Deposite
                        </a>
                    </li>
                </ul>
            </li>
            <li class="<?php echo ($select == 'm10') ? 'active open' : ''; ?>">
                <a href="javascript:;">
                    <i class="icon-credit-card"></i>
                    <span class="title">Expense Master</span>
                    <span class="arrow"></span>
                    <?php echo ($select == 'm10') ? '<span class="selected"></span>' : ''; ?>
                </a>
                <ul class="sub-menu">
                    <li <?php
                    if ($this->selectedMenu == 'expense_add') {
                        echo 'class="active"';
                    }
                    ?>>
                        <a href="/admin/expense/create">
                            Add Expense </a>
                    </li>
                    <li <?php
                    if ($this->selectedMenu == 'expense_list') {
                        echo 'class="active"';
                    }
                    ?>>
                        <a href="/admin/expense/viewlist">
                            Expense List</a>
                    </li>
                </ul>
            </li>

            <li class="<?php echo ($select == 'm8') ? 'active open' : ''; ?>">
                <a href="javascript:;">
                    <i class="icon-credit-card"></i>
                    <span class="title">Calculator</span>
                    <span class="arrow"></span>
                    <?php echo ($select == 'm4') ? '<span class="selected"></span>' : ''; ?>
                </a>
                <ul class="sub-menu">
                    <li <?php
                    if ($this->selectedMenu == 'loan_calculator') {
                        echo 'class="active"';
                    }
                    ?>>
                        <a href="/admin/loan/calculator">
                            Loan calculator</a>
                    </li>
                    <li <?php
                    if ($this->selectedMenu == 'rd_calculator') {
                        echo 'class="active"';
                    }
                    ?>>
                        <a href="/admin/rd/calculator">
                            RD calculator</a>
                    </li>
                </ul>
            </li>

            <li class="<?php echo ($select == 'm7') ? 'active open' : ''; ?>">
                <a href="javascript:;">
                    <i class="icon-credit-card"></i>
                    <span class="title">My reports</span>
                    <span class="arrow"></span>
                    <?php echo ($select == 'm4') ? '<span class="selected"></span>' : ''; ?>
                </a>
                <ul class="sub-menu">

                    <li <?php
                    if ($this->selectedMenu == 'r1') {
                        echo 'class="active"';
                    }
                    ?>>
                        <a href="/admin/report/customerpolicy">
                            Customer Policy</a>
                    </li>
                    <li <?php
                    if ($this->selectedMenu == 'r2') {
                        echo 'class="active"';
                    }
                    ?>>
                        <a href="/admin/report/userpolicy">
                            User Policy</a>
                    </li>
                    <li <?php
                    if ($this->selectedMenu == 'r3') {
                        echo 'class="active"';
                    }
                    ?>>
                        <a href="/admin/receipt/viewlist">
                            Receipt List</a>
                    </li>
                    <li <?php
                    if ($this->selectedMenu == 'r4') {
                        echo 'class="active"';
                    }
                    ?>>
                        <a href="/admin/receipt/maturitylist">
                            Maturity List</a>
                    </li>
                    <li <?php
                    if ($this->selectedMenu == 'r5') {
                        echo 'class="active"';
                    }
                    ?>>
                        <a href="/admin/report/incomelist">
                            Income List</a>
                    </li>

                </ul>
            </li>
            <li class="<?php echo ($select == 'm11') ? 'active open' : ''; ?>">
                <a href="javascript:;">
                    <i class="icon-user"></i>
                    <span class="title">Admin</span>
                    <span class="arrow "></span>
                    <?php echo ($select == 'm11') ? '<span class="selected"></span>' : ''; ?>
                </a>
                <ul class="sub-menu">
                    <li class="<?php echo ($select == 'm11') ? 'active open' : ''; ?>">
                        <a href="javascript:;">
                            <i class="icon-user"></i>
                            <span class="title">Account</span>
                            <span class="arrow "></span>
                            <?php echo ($sub == 'a1') ? '<span class="selected"></span>' : ''; ?>
                        </a>
                        <ul class="sub-menu">
                            <li <?php
                            if ($this->selectedMenu == 'account_add') {
                                echo 'class="active"';
                            }
                            ?>>
                                <a href="/admin/account/create">
                                    Account Create</a>
                            </li>
                            <li <?php
                            if ($this->selectedMenu == 'account_list') {
                                echo 'class="active"';
                            }
                            ?>>
                                <a href="/admin/account/viewlist">
                                    Account List</a>
                            </li>
                            <li <?php
                            if ($this->selectedMenu == 'transfer') {
                                echo 'class="active"';
                            }
                            ?>>
                                <a href="/admin/account/transfer">
                                    Amount Transfer</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </li>
        </ul>
        <!-- END SIDEBAR MENU -->
    </div>
</div>