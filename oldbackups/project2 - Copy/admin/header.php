<?php
echo "<!-- HEADER MOBILE-->
        <header class='header-mobile d-block d-lg-none'>
            <div class='header-mobile__bar'>
                <div class='container-fluid'>
                    <div class='header-mobile-inner'>
                        <a class='logo' href='index.html'>
                            <img src='images/icon/logo.jpg' alt='RealKeeper' />
                        </a>
                        <button class='hamburger hamburger--slider' type='button'>
                            <span class='hamburger-box'>
                                <span class='hamburger-inner'></span>
                            </span>
                        </button>
                    </div>
                </div>
            </div>
            <nav class='navbar-mobile'>
                <div class='container-fluid'>
                    <ul class='navbar-mobile__list list-unstyled'>
                        <li class='has-sub'>
                            <a class='js-arrow' href='#'>
                                <i class='fas fa-tachometer-alt'></i>Enquiry</a>
                            <ul class='navbar-mobile-sub__list list-unstyled js-sub-list'>
                                <li>
                                    <a href='index.php'>Home enquiry</a>
                                </li>
                                <li>
                                    <a href='index2.php'>Contact enquiry</a>
                                </li>
                                <li>
                                    <a href='index3.php'>Tour enquiry</a>
                                </li>
                                
                            </ul>
                        </li>
                       
                    </ul>
                </div>
            </nav>
        </header>
        <!-- END HEADER MOBILE-->

        <!-- MENU SIDEBAR-->
        <aside class='menu-sidebar d-none d-lg-block'>
            <div class='logo'>
                <a href='#'>
                    <img src='../images/logo1.jpg' width='200'  alt='ARK global' />
                </a>
            </div>
            <div class='menu-sidebar__content js-scrollbar1'>
                <nav class='navbar-sidebar'>
                    <ul class='list-unstyled navbar__list'>
								<li class='active has-sub'><a class='js-arrow' href='index.php'><i class='fas fa-tachometer-alt'></i>Dashboard</a>
                                <li>
                                    <a href='home.php'><i class='fas fa-tachometer-alt'></i>Home enquiry</a>
                                </li>
                                <li>
                                    <a href='index3.php'><i class='fas fa-tachometer-alt'></i>Contact enquiry</a>
                                </li>
                                <li>
                                    <a href='index4.php'><i class='fas fa-tachometer-alt'></i>Tour enquiry</a>
                                </li>
                                <li>
                                    <a href='index5.php'><i class='fas fa-tachometer-alt'></i>Dashboard 4</a>
                                </li>
                         
                        </li>
                        
                    </ul>
                </nav>
            </div>
        </aside>
        <!-- END MENU SIDEBAR-->

        <!-- PAGE CONTAINER-->
        <div class='page-container'>
            <!-- HEADER DESKTOP-->
            <header class='header-desktop'>
                <div class='section__content section__content--p30'>
                    <div class='container-fluid'>
                        <div class='header-wrap'>
                            <form >
                                
                            </form>
                            <div class='header-button'>
                                
                                <div class='account-wrap'>
                                    <div class='account-item clearfix js-item-menu'>
                                        
                                        <div class='content'>
                                            <a class='js-acc-btn' href='#'>admin</a>
                                        </div>
                                        <div class='account-dropdown js-dropdown'>
                                            
                                            
                                            <div class='account-dropdown__footer'>
                                                <a href='../login/logout.php'>
                                                    <i class='zmdi zmdi-power'></i>Logout</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </header>
		</div>";
?>