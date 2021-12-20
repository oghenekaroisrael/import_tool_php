<!-- HEADER MOBILE-->
<header class="header-mobile d-block d-lg-none">
            <div class="header-mobile__bar">
                <div class="container-fluid">
                    <div class="header-mobile-inner">
                        <a class="logo" href="index.php">
                            <img src="images/icon/logo.png" alt="CoolAdmin" />
                        </a>
                        <button class="hamburger hamburger--slider" type="button">
                            <span class="hamburger-box">
                                <span class="hamburger-inner"></span>
                            </span>
                        </button>
                    </div>
                </div>
            </div>
            <nav class="navbar-mobile">
                <div class="container-fluid">
                    <ul class="navbar-mobile__list list-unstyled">
                    <li class="active has-sub">
                            <a class="js-arrow" href="dashboard.php">
                                <i class="fas fa-tachometer-alt"></i>Dashboard</a>
                        </li>
                        <li>
                            <a href="loan_requests.php">
                            <i class="fas fa-table"></i>Loan Requests</a>
                                
                        </li>
                        <li>
                            <a href="manage_savings.php">
                                <i class="fas fa-table"></i>Manage Payments</a>
                        </li>
                        <li>
                            <a href="manage_withdrawals.php">
                                <i class="fas fa-table"></i>Manage Withdrawals</a>
                        </li>
                        <li>
                            <a href="passbook.php">
                                <i class="far fa-check-square"></i>Passbook</a>
                        </li>
                        <li>
                            <a href="calendar.php">
                                <i class="fas fa-calendar-alt"></i>Chat</a>
                        </li>
                        <li>
                            <a href="dividend.php">
                                <i class="fas fa-calendar-alt"></i>Dividends</a>
                        </li>
                        <li>
                            <a href="manage_departments.php">
                                <i class="fas fa-table"></i>Manage Departments</a>
                        </li>
                        <li>
                            <a href="settings.php">
                                <i class="fas fa-cogs"></i>Settings</a>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <!-- END HEADER MOBILE-->

        <!-- MENU SIDEBAR-->
        <aside class="menu-sidebar d-none d-lg-block">
            <div class="logo">
                <a href="#">
                    <img src="images/icon/logo.png" alt="Alcop" />
                </a>
            </div>
            <div class="menu-sidebar__content js-scrollbar1">
                <nav class="navbar-sidebar">
                    <ul class="list-unstyled navbar__list">
                        <li class="<?php if ($active_page == 'dashboard') { echo 'active'; } ?>">
                            <a href="dashboard.php">
                                <i class="fas fa-tachometer-alt"></i>Dashboard</a>
                        </li>
                        <li class="<?php if ($active_page == 'loan_requests') { echo 'active'; } ?>">
                            <a href="loan_requests.php">
                            <i class="fas fa-table"></i>Loan Requests</a>
                                
                        </li>
                        <li class="<?php if ($active_page == 'manage_savings') { echo 'active'; } ?>">
                            <a href="manage_savings.php">
                                <i class="fas fa-table"></i>Manage Payments</a>
                        </li>                        
                        <li class="<?php if ($active_page == 'manage_withdrawals') { echo 'active'; } ?>">
                            <a href="manage_withdrawals.php">
                                <i class="fas fa-table"></i>Manage Withdrawals</a>
                        </li>
                        <li class="<?php if ($active_page == 'passbook') { echo 'active'; } ?>">
                            <a href="passbook.php">
                                <i class="far fa-check-square"></i>Passbook</a>
                        </li>
                        <li class="<?php if ($active_page == 'chat') { echo 'active'; } ?>">
                            <a href="chat.php">
                                <i class="fas fa-calendar-alt"></i>Chat</a>
                        </li>
                        <li class="<?php if ($active_page == 'dividend') { echo 'active'; } ?>">
                            <a href="dividend.php">
                                <i class="fas fa-calendar-alt"></i>Dividends</a>
                        </li>
                        <li class="<?php if ($active_page == 'manage_departments') { echo 'active'; } ?>">
                            <a href="manage_departments.php">
                                <i class="fas fa-table"></i>Manage Departments</a>
                        </li>
                        <li class="<?php if ($active_page == 'settings') { echo 'active'; } ?>">
                            <a href="settings.php">
                                <i class="fas fa-cogs"></i>Settings</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </aside>
        <!-- END MENU SIDEBAR-->