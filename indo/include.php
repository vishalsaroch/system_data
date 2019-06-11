<?php

function pageHeader($title = 'Welcome to '.CLIENT_TITLE, $page = ''){
	?>
	<!DOCTYPE html>
    <!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
    <!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
    <!--[if !IE]> <html lang="en"> -->
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no" />
        <meta name="copyright" content="Copyright <?php echo date('Y'); ?>. www.BestWebs.in, Delhi India. All Rights Reserved." />
        <meta name="Author" content="www.BestWebs.in/team      -       Santosh" />
        <meta name="MobileOptimized" content="320" />
        <link rel="shortcut icon" href="/favicon.ico">
        <title><?php echo $title; ?></title>
        <meta http-equiv="content-type" content="text/html;charset=utf-8" />
        <!--[if IE]><meta http-equiv="X-UA-Compatible" content="IE=edge" /><![endif]-->
        <meta name="robots" content="noindex,nofollow" />
        <?php
        echo '
        <link href="'.CDN_CSS.'/bootstrap.min.css?v=BestWebs.v.1.0" rel="stylesheet" type="text/css" />
        <link href="'.CDN_CSS.'/main.min.css?v=BestWebs.v.1.0" rel="stylesheet" type="text/css" />
        <link href="'.CDN_CSS.'/jquery-ui.css?v=BestWebs.v.1.0" rel="stylesheet" type="text/css" />
        <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
        <link href="https://cdn.datatables.net/buttons/1.4.2/css/buttons.dataTables.min.css" rel="stylesheet" />
        <!-- WARNING: Respond.js doesnt work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
            <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->';
}

function pageTopBar($page = ''){
  ?>
    <header class="main-header">
        <!-- Logo -->
        <a href="/home" class="logo">
            <!-- mini logo for sidebar mini 50x50 pixels -->
            <span class="logo-mini"><img src="/assets/images/favicon.png" width="40px;" alt="<?php echo CLIENT_TITLE; ?>"></span>
            <!-- logo for regular state and mobile devices -->
            <span class="logo-lg"><img src="/assets/images/logo.png" style="max-height: 50px;" alt="<?php echo CLIENT_TITLE; ?>"></span>
        </a>
        <nav class="navbar navbar-static-top" role="navigation">
            <!-- Sidebar toggle button-->
            <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
              <span class="sr-only">Menu</span>
            </a>
            <!-- Navbar Right Menu -->
            <div class="navbar-custom-menu">
              <ul class="nav navbar-nav">
                <!-- Notifications: style can be found in dropdown.less -->
                <!-- <li class="dropdown notifications-menu" id="notificationTip">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <i class="glyphicon glyphicon-bell"></i>
                    <span class="label label-warning">10</span>
                  </a>
                  <ul class="dropdown-menu">
                    <li>
                      <ul class="menu">
                        10
                      </ul>
                    </li>
                    <li class="footer"><a href="index.php?notification=all">View all</a></li>
                  </ul>
                <li> -->
                <!-- User Account: style can be found in dropdown.less -->
                <li class="dropdown user user-menu">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <img src="/assets/images/users/<?php echo $_SESSION['SESS__user_id']; ?>.png" class="user-image" alt="user"/>
                    <span class="hidden-xs"><?php echo $_SESSION['SESS__name']; ?></span>
                  </a>
                  <ul class="dropdown-menu">
                    <!-- USER IMAGE -->
                    <li class="user-header">
                      <img src="/assets/images/users/<?php echo $_SESSION['SESS__user_id'];?>.png" class="img-circle" alt="user" />
                      <p>
                        <?php echo $_SESSION['SESS__name'];?>
                        <small><?php echo $_SESSION['SESS__center_code'];?></small>
                        <small><?php echo $_SESSION['SESS__center'];?></small>
                      </p>
                    </li>
                    <!-- Menu Footer-->
                    <li class="user-footer">
                      <div class="pull-left">
                        <a href="/profile" class="btn btn-default btn-flat">Profile</a>
                      </div>
                      <div class="pull-right">
                        <a href="/logout" class="btn btn-default btn-flat">Logout</a>
                      </div>
                    </li>
                  </ul>
                </li>
              </ul>
            </div>
        </nav>
    </header>
  <?php
}

function pageSideBar($page=''){
    ?>
    <aside class="main-sidebar">
      <!-- sidebar: style can be found in sidebar.less -->
      <section class="sidebar">
        <!-- search form -->
        <form action="/tickets-view" method="get" class="sidebar-form">
          <div class="input-group">
            <input type="hidden" name="view" value="open"/>
            <input type="text" id="searchTicket" name="code" class="form-control" placeholder="Search Ticket/Customer ..."/>
            <span class="input-group-btn">
              <button type='submit' id='search-btn' class="btn btn-flat"><i class="glyphicon glyphicon-search"></i></button>
            </span>
          </div>
        </form>
        <!-- /.search
        form -->
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
          <li class="header"> </li>
          <li class="home treeview">
            <a href="/home">
              <i class="glyphicon glyphicon-home"></i>
              <span> Home</span>
            </a>
          </li>
          <li class="tickets treeview">
            <a href="#">
              <i class="glyphicon glyphicon-compressed"></i>
              <span> Tickets</span>
              <i class="glyphicon glyphicon-chevron-left pull-right"></i>
            </a>
            <ul class="treeview-menu">
              <?php if ($_SESSION['SESS__azz_level']  > 5) { ?><li class="tickets-new"><a href="/tickets-new"><i class="glyphicon glyphicon-minus"></i> Register New</a></li> <?php } ?>
              <li class="tickets-open"><a href="/tickets-view/closed"><i class="glyphicon glyphicon-minus"></i> All Closed</a></li>
              <li class="tickets-closed"><a href="/tickets-view/open"><i class="glyphicon glyphicon-minus"></i> All Open</a></li>
              <li class="tickets-closed"><a href="/tickets-view/canceled"><i class="glyphicon glyphicon-minus"></i> All Canceled</a></li>
            </ul>
          </li>
          <li class="jobs treeview">
            <a href="#">
              <i class="glyphicon glyphicon-scale"></i>
              <span> Jobs</span>
              <i class="glyphicon glyphicon-chevron-left pull-right"></i>
            </a>
            <ul class="treeview-menu">
              <li class="jobs-new"><a href="/jobs-new"><i class="glyphicon glyphicon-minus"></i> Register New</a></li>
              <li class="jobs-closed"><a href="/jobs-view/closed"><i class="glyphicon glyphicon-minus"></i> Closed Ticket Jobs</a></li>
              <li class="jobs-open"><a href="/jobs-view/open"><i class="glyphicon glyphicon-minus"></i> Open Ticket Jobs</a></li>
            </ul>
          </li>
          <li class="reports treeview">
            <a href="#">
              <i class="glyphicon glyphicon-edit"></i> <span> Reports</span>
              <i class="glyphicon glyphicon-chevron-left pull-right"></i>
            </a>
            <ul class="treeview-menu">
              <li class="report-all"><a href="/center-reports"><i class="glyphicon glyphicon-minus"></i> Center Reports</a></li>
            </ul>
          </li>
          <li class="profile">
            <a href="/profile">
              <i class="glyphicon glyphicon-user"></i> <span> Profile</span>
            </a>
          </li>
          <li>
            <a href="/logout">
              <i class="glyphicon glyphicon-off"></i> <span> Logout</span>
            </a>
          </li>
          <?php
                if ($_SESSION['SESS__azz_level']  > 8) {
                  ?>
          <li class="header">ADMIN PANEL</li>
          <li class="users treeview">
            <a href="#">
              <i class="glyphicon glyphicon-list"></i>
              <span> Users</span>
              <i class="glyphicon glyphicon-chevron-left pull-right"></i>
            </a>
            <ul class="treeview-menu">
              <li class="users-new"><a href="/users-new"><i class="glyphicon glyphicon-minus"></i> Add New</a></li>
              <li class="users-view"><a href="/users-view"><i class="glyphicon glyphicon-minus"></i> View All</a></li>
            </ul>
          </li>
          <li class="centers treeview">
            <a href="#">
              <i class="glyphicon glyphicon-briefcase"></i> <span> Centers</span>
              <i class="glyphicon glyphicon-chevron-left pull-right"></i>
            </a>
            <ul class="treeview-menu">
              <li class="centers"><a href="/centers"><i class="glyphicon glyphicon-minus"></i> View & Add</a></li>
            </ul>
          </li>
          <li class="users treeview">
            <a href="#">
              <i class="glyphicon glyphicon-object-align-vertical"></i>
              <span> Products</span>
              <i class="glyphicon glyphicon-chevron-left pull-right"></i>
            </a>
            <ul class="treeview-menu">
              <li class="products-view"><a href="/products"><i class="glyphicon glyphicon-minus"></i> View & Add</a></li>
            </ul>
          </li>
          <li class="logs treeview">
            <a href="#">
              <i class="glyphicon glyphicon-book"></i> <span> Log Book</span>
              <i class="glyphicon glyphicon-chevron-left pull-right"></i>
            </a>
            <ul class="treeview-menu">
              <li class="log-login"><a href="/log-logins"><i class="glyphicon glyphicon-minus"></i> Logins</a></li>
              <li class="log-login"><a href="/log-invalid-logins"><i class="glyphicon glyphicon-minus"></i>Invalid Logins</a></li>
              <li class="log-event"><a href="/log-events"><i class="glyphicon glyphicon-minus"></i> Events</a></li>
            </ul>
          </li>
          <?php
              }
          ?>
          <li class="issues"><a href="/issues"><i class="glyphicon glyphicon-exclamation-sign text-red"></i> <span> Report Issue</span></a></li>
        </ul>
      </section>
      <!-- /.sidebar -->
    </aside>
    <?php
}

function pageFooter($page = ''){
    echo '<footer class="main-footer">
      <span class="mini-footer">'.$_SESSION['SESS__center'].' | '.CLIENT_TITLE.'</span>
      <strong class="full-footer"><small> powered by - <a href="http://www.realkeeper.in" target="_blank">Realkeeper</a></small></strong>.
    </footer>';
}

function pageJsInclude($page = ''){
    ?>
    <!-- jQuery 2.1.4 -->
    <script src="<?php echo CDN_JS; ?>/jQuery-2.1.4.min.js?v=BestWebs.v.1.0"></script>
    <!-- Bootstrap 3.3.2 JS -->
    <script src="<?php echo CDN_JS; ?>/bootstrap.min.js?v=BestWebs.v.1.0" type="text/javascript"></script>
    <!-- FastClick -->
    <script src='<?php echo CDN_JS; ?>/fastclick.min.js?v=BestWebs.v.1.0'></script>
    <!-- App -->
    <script src="<?php echo CDN_JS; ?>/app.min.js?v=BestWebs.v.1.0" type="text/javascript"></script>
    <!-- SlimScroll 1.3.0 -->
    <script src="<?php echo CDN_JS; ?>/jquery.slimscroll.min.js?v=BestWebs.v.1.0" type="text/javascript"></script>
    <!-- for demo purposes -->
    <script src="<?php echo CDN_JS; ?>/jquery-ui.min.js?v=BestWebs.v.1.0" type="text/javascript"></script>
    <script src="<?php echo CDN_JS; ?>/demo.js?v=BestWebs.v.1.0" type="text/javascript"></script>
    <!-- DATA TABES SCRIPT -->
    <script src="<?php echo CDN_JS; ?>/jquery.dataTables.min.js?v=BestWebs.v.1.0" type="text/javascript"></script>
    <script src="<?php echo CDN_JS; ?>/dataTables.bootstrap.min.js?v=BestWebs.v.1.0" type="text/javascript"></script>
    <script src="<?php echo CDN_JS; ?>/shoppo_hash.js?v=BestWebs.v.1.0" type="text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.4/js/select2.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.4.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.4.2/js/buttons.flash.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.4.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.4.2/js/buttons.print.min.js"></script>
    <script type="text/javascript">
      $(document).ready(function() {
          $('.table:not(.nodataTable)').DataTable( {
              dom: 'Bfrtip',
              buttons: [
                  'copy', 'csv', 'excel', 'pdf', 'print'
              ]
          });
        });
      $(function() {
        $('#searchTicket').autocomplete({
          source: function( request, response ) {
            $.ajax({
              dataType: "json",
              type: "post",
          data: {
             term: request.term,
             process: 'ajax'
          },
           success: function( data ) {
             response( $.map( data, function( item ) {
              return {
                label: item,
                value: item
              }
            }));
          }
            });
          },
          autoFocus: true,
          minLength: 0
        });
      });
    </script>
    <script type="text/javascript">
        function validateEmail(email) {
            var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
            return re.test(email);
        }
        <?php
            if (isset($_SESSION['FORM'])) {
                foreach ($_SESSION['FORM'] as $key => $value) {
                    if (is_array($value)) {
                        foreach ($value as $key1 => $value1) {
                            echo '$("[name='.$key.'['.$key1.']]").val("'.$value1.'");
                                    ';
                        }
                    }else{
                        echo '$("[name='.$key.']").val("'.$value.'");
                            ';
                    }
                }
                unset($_SESSION['FORM']);
            }
            if (isset($_SESSION['MODAL'])) {
                echo '$("#'.$_SESSION['MODAL'].'").modal("show");';
                unset($_SESSION['MODAL']);
            }
        ?>
    </script>
    <?php
}