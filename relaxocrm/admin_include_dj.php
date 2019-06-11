<?php
// define('FILE_VERSIONS', '2.2');
function PageHead($page = ''){
	?>
	<!DOCTYPE html>
	<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
	<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
	<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->
	<!-- BEGIN HEAD -->
	<head>
	    <meta charset="UTF-8" />
	    <title>  <?php echo CLIENT_TITLE." Administration"; ?> </title>
	    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
		<meta content="Admin Dashboard" name="description" />
		<meta content="http://www.bestwebs.in/santosh" name="author" />
		<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
        <meta name="mobile-web-app-capable" content="yes">
        <link rel="icon" href="/favicon.ico">
	     <!--[if IE]>
	        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	        <![endif]-->
	    <!-- GLOBAL STYLES -->
	    <?php
	    	echo '<link rel="stylesheet" href="'.CDN_CSS.'/bootstrap.min.css?BestWebs.v.2.2.1.2" />
			    <link rel="stylesheet" href="'.CDN_ADMIN.'/plugins/Font-Awesome/css/font-awesome.css?BestWebs.v.2.2.1" />
			    <!--END GLOBAL STYLES -->

			    <!-- HOME PAGE LEVEL STYLES -->
			    <link rel="stylesheet" href="'.CDN_ADMIN.'/css/layout2.css?BestWebs.v.2.2.1">
			    <!-- END HOME PAGE LEVEL  STYLES -->
			    <!-- ADD PRODUCT PAGE LEVEL STYLES -->
				<link rel="stylesheet" href="'.CDN_ADMIN.'/css/jquery-ui.css?BestWebs.v.2.2.1" />
				<link rel="stylesheet" href="'.CDN_ADMIN.'/plugins/uniform/themes/default/css/uniform.default.css?BestWebs.v.2.2.1" />
				<link rel="stylesheet" href="'.CDN_ADMIN.'/plugins/chosen/chosen.min.css?BestWebs.v.2.2.1" />
				<link rel="stylesheet" href="'.CDN_ADMIN.'/plugins/dataTables/dataTables.bootstrap.css?BestWebs.v.2.2.1" />
			    <link rel="stylesheet" href="'.CDN_ADMIN.'/css/jquery.cleditor-hack.css" />
				<link rel="stylesheet" href="'.CDN_ADMIN.'/css/main.css?BestWebs.v.2.2.1" />
			    <link rel="stylesheet" href="'.CDN_ADMIN.'/css/theme.css?BestWebs.v.2.2.1" />
			    <link rel="stylesheet" href="'.CDN_ADMIN.'/css/MoneAdmin.css?BestWebs.v.2.2.1" />
			    <link rel="stylesheet" href="'.CDN_ADMIN.'/plugins/flot/examples/examples.css?BestWebs.v.2.2.1"/>
                <link href="https://cdn.datatables.net/buttons/1.4.2/css/buttons.dataTables.min.css" rel="stylesheet" />';
	    ?>
		<style type="text/css" media="screen">
            .currency-sign::before {
                content: "₹ " !important;
            }

			.percent-sign::after {
                content: " %" !important;
            }
            .modal-dialog{
                width: 80%;
            }
            div.dt-buttons{
                margin-bottom: 10px !important;
            }
            div.dataTables_length label {
                float: right !important;
                margin-top: 5px !important;
            }
            div.dataTables_info {
                width: 50%;
                display: inline-block;
            }
        </style>
    	<!-- END ADD PRODUCT PAGE LEVEL  STYLES -->
	    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
	    <!--[if lt IE 9]>
	      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
	      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
	    <![endif]-->
	</head>
	<body class="padTop53 " >
	    <div id="wrap" >
	<?php
}

function PageBodyInit($page = ''){
	?>
	<?php
}

function PageTopBar($page = ''){
	?>
	<div id="top" class="noprint">
		<nav class="navbar navbar-inverse navbar-fixed-top ">
	        <a data-original-title="Show/Hide Menu" data-placement="bottom" data-tooltip="tooltip" class="accordion-toggle btn btn-primary btn-sm visible-xs" data-toggle="collapse" href="#menu" id="menu-toggle">
	            <i class="icon-align-justify"></i>
	        </a>
	        <!-- LOGO SECTION -->
	        <header class="navbar-header">
	            <a href="/BestWebs?module=home&mode=dashboard&type=login" class="navbar-brand" style="padding: 0px;">
	            <img src="/assets/images/logo.png" alt="" style="height: 50px;" />
	                </a>
	        </header>
	    </nav>
	</div>
	<?php
}

function PageLeftNavBar($page = ''){
	global $levels;
    $level = $_SESSION['SESS__azz_level'];
	?>
	<div id="left" class="noprint">
        <div class="media user-media well-small">
            <a rel="tab" class="user-link" href="/BestWebs?module=home&mode=dashboard">
                <img class="media-object img-thumbnail user-img" src="<?php echo "/assets/images/users/$_SESSION[SESS__user_id].png?".time(); ?>" style="max-width:120px;">
            </a>
            <br />
            <div class="media-body">
                <h5 class="media-heading"><?php echo $_SESSION['SESS__name']; ?></h5>
                <ul class="list-unstyled user-info">
                    <li>
                        <?php echo $levels[$_SESSION['SESS__azz_level']]; ?> Profile
                    </li>
                </ul>
            </div>
            <br />
        </div>
        <ul id="menu" class="collapse">
            <li class="panel">
                <a rel="tab" href="/BestWebs?module=home&mode=dashboard&type=login" >
                    <i class="icon-dashboard"></i> Dashboard
                </a>
            </li>
            <?php if(in_array($level, array(1,2,3,4,5,8,9))){ ?>
            <li class="panel">
                <a href="javascript:void(0);" data-parent="#menu" data-toggle="collapse" class="accordion-toggle collapsed" data-target="#view-ticket-nav">
                    <i class="icon-text-width"> </i> View Tickets
                    <span class="pull-right">
                        <i class="icon-angle-left"></i>
                    </span>
                   <!-- &nbsp; <span class="label label-default">10</span>&nbsp; -->
                </a>
                <ul class="collapse" id="view-ticket-nav">
                    <li class=""><a rel="tab" href="/BestWebs?module=ticket&mode=view&type=open"><i class="icon-angle-right"></i> Open </a></li>
                    <li class=""><a rel="tab" href="/BestWebs?module=ticket&mode=view&type=pending"><i class="icon-angle-right"></i> Pending </a></li>
                    <li class="">
                        <a href="javascript:void(0);" data-parent="#view-ticket-nav" data-toggle="collapse" class="accordion-toggle" data-target="#view-closed-ticket-nav">
                            <i class="icon-angle-right"></i> Closed
                            <span class="pull-right" style="margin-right: 20px;">
                                <i class="icon-angle-left"></i>
                            </span>
                        </a>
                        <ul class="collapse" id="view-closed-ticket-nav">
                            <li class=""><a rel="tab" href="/BestWebs?module=ticket&mode=view&type=closed"><i class="icon-angle-right"></i> No replacement </a></li>
                            <li class=""><a rel="tab" href="/BestWebs?module=ticket&mode=view&type=replaced"><i class="icon-angle-right"></i> With Replacement </a></li>
                        </ul>
                    </li>
                    <li class=""><a rel="tab" href="/BestWebs?module=ticket&mode=view&type=canceled"><i class="icon-angle-right"></i> Canceled </a></li>
                    <li class=""><a rel="tab" href="/BestWebs?module=ticket&mode=view&type=tagged"><i class="icon-angle-right"></i> Tagged </a></li>
                    <li class=""><a rel="tab" href="/BestWebs?module=ticket&mode=view&type=all"><i class="icon-angle-right"></i> All </a></li>
                </ul>
            </li>
            <li class="panel">
                <a href="javascript:void(0);" data-parent="#menu" data-toggle="collapse" class="accordion-toggle collapsed" data-target="#job-nav">
                    <i class="icon-wrench"> </i> Jobs
                    <span class="pull-right">
                        <i class="icon-angle-left"></i>
                    </span>
                   <!-- &nbsp; <span class="label label-default">10</span>&nbsp; -->
                </a>
                <ul class="collapse" id="job-nav">
                    <li class=""><a rel="tab" href="/BestWebs?module=job&mode=add&type=new"><i class="icon-angle-right"></i> Add Job </a></li>
                    <li class=""><a rel="tab" href="/BestWebs?module=job&mode=view&type=all"><i class="icon-angle-right"></i> View Jobs </a></li>
                </ul>
            </li>
            <?php }
            if(in_array($level, array(5,8,9))){ ?>
            <li class="panel">
                <a href="javascript:void(0);" data-parent="#menu" data-toggle="collapse" class="accordion-toggle collapsed" data-target="#feedback-nav">
                    <i class="icon-shopping-cart"> </i> Feedback
                    <span class="pull-right">
                        <i class="icon-angle-left"></i>
                    </span>
                   <!-- &nbsp; <span class="label label-default">10</span>&nbsp; -->
                </a>
                <ul class="collapse" id="feedback-nav">
                    <li class=""><a rel="tab" href="/BestWebs?module=feedback&mode=view&type=left"><i class="icon-angle-right"></i> Feedback Left </a></li>
                    <li class=""><a rel="tab" href="/BestWebs?module=feedback&mode=view&type=done"><i class="icon-angle-right"></i> Feedback Done </a></li>
                </ul>
            </li>
            <li class="panel">
                <a href="javascript:void(0);" data-parent="#menu" data-toggle="collapse" class="accordion-toggle collapsed" data-target="#register-ticket-nav">
                    <i class="icon-plus-sign"> </i> Register New
                    <span class="pull-right">
                        <i class="icon-angle-left"></i>
                    </span>
                   <!-- &nbsp; <span class="label label-default">10</span>&nbsp; -->
                </a>
                <ul class="collapse" id="register-ticket-nav">
                    <li class=""><a rel="tab" href="/BestWebs?module=warranty&mode=add&type=new"><i class="icon-angle-right"></i> Product Warranty </a></li>
                    <li class=""><a rel="tab" href="/BestWebs?module=ticket&mode=add&type=new"><i class="icon-angle-right"></i> Complaint Ticket </a></li>
                </ul>
            </li>
            <li class="panel">
                <a href="javascript:void(0);" data-parent="#menu" data-toggle="collapse" class="accordion-toggle collapsed" data-target="#customer-nav">
                    <i class="icon-shopping-cart"> </i> Customers
                    <span class="pull-right">
                        <i class="icon-angle-left"></i>
                    </span>
                   <!-- &nbsp; <span class="label label-default">10</span>&nbsp; -->
                </a>
                <ul class="collapse" id="customer-nav">
                    <li class=""><a rel="tab" href="/BestWebs?module=customer&mode=personal-view&type=all"><i class="icon-angle-right"></i> Customers </a></li>
                    <li class=""><a rel="tab" href="/BestWebs?module=customer&mode=product-view&type=all"><i class="icon-angle-right"></i> Customers Products </a></li>
                </ul>
            </li>
            <?php }
            if(in_array($level, array(3,4,8,9))){ ?>
            <li class="panel">
                <a href="javascript:void(0);" data-parent="#menu" data-toggle="collapse" class="accordion-toggle collapsed" data-target="#report-nav">
                    <i class="icon-list-alt"></i> Reports
                    <span class="pull-right">
                        <i class="icon-angle-left"></i>
                    </span>
                    <!-- &nbsp; <span class="label label-info">6</span>&nbsp; -->
                </a>
                <ul class="collapse" id="report-nav">
                    <li><a rel="tab" href="/BestWebs?module=report&mode=view&type=all"><i class="icon-angle-right"></i> All Centers </a></li>
                    <li><a rel="tab" href="/BestWebs?module=report&mode=center-brief&type=all"><i class="icon-angle-right"></i> Center Brief </a></li>
                    <li><a rel="tab" href="/BestWebs?module=report&mode=center-detail&type=all"><i class="icon-angle-right"></i> Center Detailed </a></li>
                    <li class="">
                    	<a href="javascript:void(0);" data-parent="#report-nav" data-toggle="collapse" class="accordion-toggle" data-target="#spare-report-nav">
                    		<i class="icon-angle-right"></i> Reports
                    		<span class="pull-right" style="margin-right: 20px;">
		                        <i class="icon-angle-left"></i>
		                    </span>
                    	</a>
                    	<ul class="collapse" id="spare-report-nav">
                    		<li class=""><a rel="tab" href="/BestWebs?module=report-spare&mode=add&type=new"><i class="icon-angle-right"></i> View Reports </a></li>
                        </ul>
                    </li>
                </ul>
            </li>
            <?php }
            if(in_array($level, array(6,8,9))){ ?>
            <li class="panel">
                <a href="javascript:void(0);" data-parent="#menu" data-toggle="collapse" class="accordion-toggle collapsed" data-target="#inventory-store-nav">
                    <i class="icon-credit-card"></i> Store Inventory
                    <span class="pull-right">
                        <i class="icon-angle-left"></i>
                    </span>
                    <!-- &nbsp; <span class="label label-success">5</span>&nbsp; -->
                </a>
                <ul class="collapse" id="inventory-store-nav">
                    <li><a rel="tab" href="/BestWebs?module=inventory-store&mode=stock-view&type=all"><i class="icon-angle-right"></i> View Stock </a></li>
            		<li class="">
                		<a href="javascript:void(0);" data-parent="#inventory-store-nav" data-toggle="collapse" class="accordion-toggle" data-target="#inventory-store-in-nav">
                			<i class="icon-angle-right"></i> Stock In
							<span class="pull-right" style="margin-right: 20px;">
		                        <i class="icon-angle-left"></i>
		                    </span>
                		</a>
						<ul class="collapse" id="inventory-store-in-nav">
							<li><a rel="tab" href="/BestWebs?module=inventory-store&mode=in-add&type=new&stock=fresh"><i class="icon-angle-right"></i> Add Entry </a></li>
                            <li><a rel="tab" href="/BestWebs?module=inventory-store&mode=in-view&type=all&stock=fresh"><i class="icon-angle-right"></i> View Entries </a></li>
						</ul>
            		</li>
            		<li class="">
                		<a href="javascript:void(0);" data-parent="#inventory-store-nav" data-toggle="collapse" class="accordion-toggle" data-target="#inventory-store-out-nav">
                			<i class="icon-angle-right"></i> Stock Out
							<span class="pull-right" style="margin-right: 20px;">
		                        <i class="icon-angle-left"></i>
		                    </span>
                		</a>
						<ul class="collapse" id="inventory-store-out-nav">
                            <li><a rel="tab" href="/BestWebs?module=inventory-store&mode=out-add&type=new&stock=fresh"><i class="icon-angle-right"></i> Add Entries </a></li>
                            <li><a rel="tab" href="/BestWebs?module=inventory-store&mode=out-view&type=all&stock=fresh"><i class="icon-angle-right"></i> View Entries </a></li>
						</ul>
            		</li>
                    <li class="">
                        <a href="javascript:void(0);" data-parent="#inventory-store-nav" data-toggle="collapse" class="accordion-toggle" data-target="#inventory-old-store-in-nav">
                            <i class="icon-angle-right"></i> Old Stock In
                            <span class="pull-right" style="margin-right: 20px;">
                                <i class="icon-angle-left"></i>
                            </span>
                        </a>
                        <ul class="collapse" id="inventory-old-store-in-nav">
                            <li><a rel="tab" href="/BestWebs?module=inventory-store&mode=in-add&type=new&stock=old"><i class="icon-angle-right"></i> Add Entry </a></li>
                            <li><a rel="tab" href="/BestWebs?module=inventory-store&mode=in-view&type=all&stock=old"><i class="icon-angle-right"></i> View Entries </a></li>
                        </ul>
                    </li>
                    <li class="">
                        <a href="javascript:void(0);" data-parent="#inventory-store-nav" data-toggle="collapse" class="accordion-toggle" data-target="#inventory-old-store-out-nav">
                            <i class="icon-angle-right"></i> Old Stock Out
                            <span class="pull-right" style="margin-right: 20px;">
                                <i class="icon-angle-left"></i>
                            </span>
                        </a>
                        <ul class="collapse" id="inventory-old-store-out-nav">
                            <li><a rel="tab" href="/BestWebs?module=inventory-store&mode=out-add&type=new&stock=old"><i class="icon-angle-right"></i> Add Entries </a></li>
                            <li><a rel="tab" href="/BestWebs?module=inventory-store&mode=out-view&type=all&stock=old"><i class="icon-angle-right"></i> View Entries </a></li>
                        </ul>
                    </li>
                </ul>
            </li>
            <?php }
            if(in_array($level, array(3,8,9))){ ?>
            <li class="panel">
                <a href="javascript:void(0);" data-parent="#menu" data-toggle="collapse" class="accordion-toggle collapsed" data-target="#inventory-center-nav">
                    <i class="icon-credit-card"></i> Center Inventory
                    <span class="pull-right">
                        <i class="icon-angle-left"></i>
                    </span>
                    <!-- &nbsp; <span class="label label-success">5</span>&nbsp; -->
                </a>
                <ul class="collapse" id="inventory-center-nav">
                    <li><a rel="tab" href="/BestWebs?module=inventory-center&mode=stock-view&type=all"><i class="icon-angle-right"></i> View Stock </a></li>
            		<li class="">
                        <a href="javascript:void(0);" data-parent="#inventory-center-nav" data-toggle="collapse" class="accordion-toggle" data-target="#inventory-old-center-out-nav">
                            <i class="icon-angle-right"></i> Old Stock Out
                            <span class="pull-right" style="margin-right: 20px;">
                                <i class="icon-angle-left"></i>
                            </span>
                        </a>
                        <ul class="collapse" id="inventory-old-center-out-nav">
                            <li><a rel="tab" href="/BestWebs?module=inventory-store&mode=out-add&type=new&stock=old"><i class="icon-angle-right"></i> Add Entries </a></li>
                            <li><a rel="tab" href="/BestWebs?module=inventory-store&mode=out-view&type=all&stock=old"><i class="icon-angle-right"></i> View Entries </a></li>
                        </ul>
                    </li>
                    <li class="">
                        <a href="javascript:void(0);" data-parent="#inventory-center-nav" data-toggle="collapse" class="accordion-toggle" data-target="#inventory-center-out-nav">
                            <i class="icon-angle-right"></i> Stock Out
                            <span class="pull-right" style="margin-right: 20px;">
                                <i class="icon-angle-left"></i>
                            </span>
                        </a>
                        <ul class="collapse" id="inventory-center-out-nav">
                            <li><a rel="tab" href="/BestWebs?module=inventory-store&mode=out-add&type=new&stock=fresh"><i class="icon-angle-right"></i> Add Entries </a></li>
                            <li><a rel="tab" href="/BestWebs?module=inventory-store&mode=out-view&type=all&stock=fresh"><i class="icon-angle-right"></i> View Entries </a></li>
                        </ul>
                    </li>
                </ul>
            </li>
            <?php }
            if(in_array($level, array(8,9))){ ?>
            <li class="panel">
                <a href="javascript:void(0);" data-parent="#menu" data-toggle="collapse" class="accordion-toggle collapsed" data-target="#call-nav">
                    <i class="icon-list-alt"></i> Calls
                    <span class="pull-right">
                        <i class="icon-angle-left"></i>
                    </span>
                    <!-- &nbsp; <span class="label label-info">6</span>&nbsp; -->
                </a>
                <ul class="collapse" id="call-nav">
                    <li><a rel="tab" href="/BestWebs?module=call&mode=view&type=new"><i class="icon-angle-right"></i> New Miss-calls </a></li>
                    <li><a rel="tab" href="/BestWebs?module=call&mode=view&type=all"><i class="icon-angle-right"></i> View Previous Calls </a></li>
                </ul>
            </li>
            <li class="panel">
                <a href="javascript:void(0);" data-parent="#menu" data-toggle="collapse" class="accordion-toggle collapsed" data-target="#expenses-nav">
                    <i class="icon-inr"></i> Expenses & Income
                    <span class="pull-right">
                        <i class="icon-angle-left"></i>
                    </span>
                    <!-- &nbsp; <span class="label label-success">5</span>&nbsp; -->
                </a>
                <ul class="collapse" id="expenses-nav">
                    <li><a rel="tab" href="/BestWebs?module=expense&mode=add&type=new"><i class="icon-angle-right"></i> Add Entry </a></li>
                    <li><a rel="tab" href="/BestWebs?module=expense&mode=view&type=all"><i class="icon-angle-right"></i> View Entries </a></li>
                </ul>
            </li>
            <?php } ?>
            <li class="panel">
                <a rel="tab" href="/BestWebs?module=profile&mode=view&type=all">
                    <i class="icon-user"></i> Profile
                </a>
            </li>
            <li class="panel">
                <a href="/logout">
                    <i class="icon-off"></i> Logout
                </a>
            </li>
            <li class="panel">
                <a rel="tab" href="/BestWebs?module=issue&mode=report&type=all">
                    <i class="icon-exclamation-sign"></i> Report Issue
                </a>
            </li>
            <li class="panel">
                <a href="javascript:void(0);" data-parent="#menu" data-toggle="collapse" class="accordion-toggle collapsed" data-target="#center-user-nav">
                    <i class="icon-btc"> </i> Center Users
                    <span class="pull-right">
                        <i class="icon-angle-left"></i>
                    </span>
                   <!-- &nbsp; <span class="label label-default">10</span>&nbsp; -->
                </a>
                <ul class="collapse" id="center-user-nav">
                    <li><a rel="tab" href="/BestWebs?module=user&mode=add-center&type=new"><i class="icon-angle-right"></i> Add Center User </a></li>
                    <li><a rel="tab" href="/BestWebs?module=user&mode=view&type=all"><i class="icon-angle-right"></i> View Users </a></li>
                </ul>
            </li>
            <?php if($level >= 9){ ?>
            <li class="panel" style="background: #c1c1c1;text-align: center;padding: 10px 0;"> Admin Panel</li>
            <li class="panel">
                <a href="javascript:void(0);" data-parent="#menu" data-toggle="collapse" class="accordion-toggle collapsed" data-target="#center-nav">
                    <i class="icon-list-alt"></i> Party/Centers
                    <span class="pull-right">
                        <i class="icon-angle-left"></i>
                    </span>
                    <!-- &nbsp; <span class="label label-info">6</span>&nbsp; -->
                </a>
                <ul class="collapse" id="center-nav">
                    <li><a rel="tab" href="/BestWebs?module=center&mode=add&type=new"><i class="icon-angle-right"></i> Add </a></li>
                    <li><a rel="tab" href="/BestWebs?module=center&mode=view&type=all"><i class="icon-angle-right"></i> View </a></li>
                </ul>
            </li>
            <li class="panel">
                <a href="javascript:void(0);" data-parent="#menu" data-toggle="collapse" class="accordion-toggle collapsed" data-target="#product-nav">
                    <i class="icon-list-alt"></i> Products
                    <span class="pull-right">
                        <i class="icon-angle-left"></i>
                    </span>
                    <!-- &nbsp; <span class="label label-info">6</span>&nbsp; -->
                </a>
                <ul class="collapse" id="product-nav">
                    <li><a rel="tab" href="/BestWebs?module=product&mode=add&type=new"><i class="icon-angle-right"></i> Add Product </a></li>
                    <li><a rel="tab" href="/BestWebs?module=product&mode=view&type=all"><i class="icon-angle-right"></i> View Products </a></li>
                    <li><a rel="tab" href="/BestWebs?module=product&mode=spares&type=all"><i class="icon-angle-right"></i> View Product Spares </a></li>
                </ul>
            </li>
            <li class="panel">
                <a href="javascript:void(0);" data-parent="#menu" data-toggle="collapse" class="accordion-toggle collapsed" data-target="#spare-nav">
                    <i class="icon-list-alt"></i> Spare
                    <span class="pull-right">
                        <i class="icon-angle-left"></i>
                    </span>
                    <!-- &nbsp; <span class="label label-info">6</span>&nbsp; -->
                </a>
                <ul class="collapse" id="spare-nav">
                    <li class=""><a rel="tab" href="/BestWebs?module=product-spare&mode=add&type=new"><i class="icon-angle-right"></i> Add Spare </a></li>
                    <li class=""><a rel="tab" href="/BestWebs?module=product-spare&mode=view&type=all"><i class="icon-angle-right"></i> View Spares </a></li>
                </ul>
            </li>
            <li class="panel">
                <a href="javascript:void(0);" data-parent="#menu" data-toggle="collapse" class="accordion-toggle collapsed" data-target="#user-nav">
                    <i class="icon-btc"> </i> Users
                    <span class="pull-right">
                        <i class="icon-angle-left"></i>
                    </span>
                   <!-- &nbsp; <span class="label label-default">10</span>&nbsp; -->
                </a>
                <ul class="collapse" id="user-nav">
                    <li class="">
                		<a href="javascript:void(0);" data-parent="#user-nav" data-toggle="collapse" class="accordion-toggle" data-target="#user-add-nav">
                			<i class="icon-angle-right"></i> Add User
							<span class="pull-right" style="margin-right: 20px;">
		                        <i class="icon-angle-left"></i>
		                    </span>
                		</a>
						<ul class="collapse" id="user-add-nav">
							<li><a rel="tab" href="/BestWebs?module=user&mode=add-head&type=new"><i class="icon-angle-right"></i> Head User </a></li>
                            <li><a rel="tab" href="/BestWebs?module=user&mode=add-service&type=new"><i class="icon-angle-right"></i> Calling User </a></li>
						</ul>
            		</li>
                    <li><a rel="tab" href="/BestWebs?module=user&mode=view&type=all"><i class="icon-angle-right"></i> View Users </a></li>
                </ul>
            </li>
            <li class="panel">
                <a href="javascript:void(0);" data-parent="#menu" data-toggle="collapse" class="accordion-toggle collapsed" data-target="#log-nav">
                    <i class="icon-book"></i> Log Book
                    <span class="pull-right">
                        <i class="icon-angle-left"></i>
                    </span>
                    <!-- &nbsp; <span class="label label-success">5</span>&nbsp; -->
                </a>
                <ul class="collapse" id="log-nav">
                    <li class=""><a rel="tab" href="/BestWebs?module=log&mode=events&type=all"><i class="icon-angle-right"></i> Events </a></li>
                    <li class=""><a rel="tab" href="/BestWebs?module=log&mode=logins&type=all"><i class="icon-angle-right"></i> Login Attempts </a></li>
                    <li class=""><a rel="tab" href="/BestWebs?module=log&mode=invalid-logins&type=all"><i class="icon-angle-right"></i> Invalid Logins </a></li>
                    <li class=""><a rel="tab" href="/BestWebs?module=log&mode=manage&type=admin"><i class="icon-angle-right"></i> Manage </a></li>
                </ul>
            </li>
			<?php } ?>
        </ul>
    </div>
    <div id="content">
	<?php
}

function PageRightBar($page = ''){
	?>
	<!-- RIGHT STRIP  SECTION -->
    <div id="right" class="noprint">
        <div class="well well-small">
            <ul class="list-unstyled">
                <li>Visitor &nbsp; : <span>23,000</span></li>
                <li>Users &nbsp; : <span>53,000</span></li>
                <li>Registrations &nbsp; : <span>3,000</span></li>
            </ul>
        </div>
        <div class="well well-small">
            <button class="btn btn-block"> Help </button>
            <button class="btn btn-primary btn-block"> Tickets</button>
            <button class="btn btn-info btn-block"> New </button>
            <button class="btn btn-success btn-block"> Users </button>
            <button class="btn btn-danger btn-block"> Profit </button>
            <button class="btn btn-warning btn-block"> Sales </button>
            <button class="btn btn-inverse btn-block"> Stock </button>
        </div>
        <div class="well well-small">
            <span>Profit</span><span class="pull-right"><small>20%</small></span>

            <div class="progress mini">
                <div class="progress-bar progress-bar-info" style="width: 20%"></div>
            </div>
            <span>Sales</span><span class="pull-right"><small>40%</small></span>

            <div class="progress mini">
                <div class="progress-bar progress-bar-success" style="width: 40%"></div>
            </div>
            <span>Pending</span><span class="pull-right"><small>60%</small></span>

            <div class="progress mini">
                <div class="progress-bar progress-bar-warning" style="width: 60%"></div>
            </div>
            <span>Summary</span><span class="pull-right"><small>80%</small></span>

            <div class="progress mini">
                <div class="progress-bar progress-bar-danger" style="width: 80%"></div>
            </div>
        </div>
    </div>
     <!-- END RIGHT STRIP  SECTION -->
	<?php
}

function pageFooter($page = ''){
    ?>
    		</div>
		</div>
		<div id="footer" class="noprint">
	        <p> <?php echo  CLIENT_COMPANY. ' | &copy;  <a target="_blank" href="http://www.RealKeeper.in" alt="RealKeeper">RealKeeper</a> &nbsp; '.date('Y').' &nbsp;</p>'; ?>
	    </div>
	    <div class="modal print" id="modal">

	    </div>
	</body>
    <!-- END BODY -->
	</html>
    <?php
}

function PageJsInclude($page = ''){
	echo '<!-- GLOBAL SCRIPTS -->
        <script type="text/javascript">var autoRemoveLoader, dataTabel;</script>
	    <script type="text/javascript" src="'.CDN_ADMIN.'/plugins/jquery-2.0.3.min.js?BestWebs.v.2.2.1"></script>
	    <script type="text/javascript" src="'.CDN_ADMIN.'/plugins/bootstrap/js/bootstrap.min.js?BestWebs.v.2.2.1"></script>
	    <script type="text/javascript" src="'.CDN_ADMIN.'/plugins/modernizr-2.6.2-respond-1.1.0.min.js?BestWebs.v.2.2.1"></script>
	    <!-- END GLOBAL SCRIPTS -->
		<!-- ADD PRODUCT PAGE LEVEL SCRIPT-->
		<script type="text/javascript" src="'.CDN_ADMIN.'/js/jquery-ui.min.js?BestWebs.v.2.2.1"></script>
		<script type="text/javascript" src="'.CDN_ADMIN.'/js/pace.min.js?BestWebs.v.2.2.1"></script>
		<script type="text/javascript" src="'.CDN_ADMIN.'/plugins/uniform/jquery.uniform.min.js?BestWebs.v.2.2.1"></script>
		<script type="text/javascript" src="'.CDN_ADMIN.'/plugins/chosen/chosen.jquery.min.js?BestWebs.v.2.2.1"></script>
		<script type="text/javascript" src="'.CDN_ADMIN.'/plugins/chosen/chosen.ajaxaddition.jquery.js?BestWebs.v.2.2.1"></script>
		<script type="text/javascript" src="'.CDN_ADMIN.'/plugins/switch/static/js/bootstrap-switch.min.js?BestWebs.v.2.2.1"></script>
		<script type="text/javascript" src="'.CDN_ADMIN.'/plugins/autosize/jquery.autosize.min.js?BestWebs.v.2.2.1"></script>
		<script type="text/javascript" src="'.CDN_JS.'/shoppo_hash.js?v=BestWebs.2.2.1"></script>
	    <script type="text/javascript" src="'.CDN_ADMIN.'/js/formsInit.js?BestWebs.v.2.2.1"></script>
	    <script type="text/javascript" src="'.CDN_JS.'/owl.carousel.js?v=BestWebs.2.2.1"></script>';
    echo '<!-- DATA TABLE EXPORT BUTTON FILES -->
        <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.colVis.min.js"></script>
        <script src="https://cdn.datatables.net/select/1.2.5/js/dataTables.select.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/1.5.1/js/dataTables.buttons.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.html5.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/pdfmake.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/vfs_fonts.js"></script>
        <script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.print.min.js"></script>';
	?>
    <script type="text/javascript">
        var isProcessingAjax = false;
    	$('body').on('click', '#close-overlay-button', function(event) {
    		ajaxLoading(true);
    	});
        function html_entity_decode(str) {
            return String(str).replace(/"/g, '&amp;quot;').replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g,'&gt;').replace(/"/g, '&quot;');
        }
    	function ajaxSubmit(form){
    		e.preventDefault();
	            var status;
                performAjax(form.serialize(), " ", function(status, msg){
                	showResponse(status, msg);
                	if(status === "success"){
                		form[0].reset();
                		$(".chzn-select").val('').trigger("chosen:updated");
                	}
                });
    	}
        function showResponse(status, msg, msgTime){
        	msgTime = msgTime ? msgTime : 150000;
            var milliseconds = new Date().getTime();
            $('.inner, #processOverlay').prepend('<div class="responseMsg-'+milliseconds+' row">'+
                                   '<center class="col-xs-12"><div class="alert alert-'+status+' alert-dismissable">'+
                                       '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'+
                                       msg+
                                   '</div></center>'+
                                '</div>');
            setTimeout(function(){
                $('.responseMsg-'+milliseconds).fadeOut(500, function() { $(this).remove(); });
            }, msgTime);
        }
        function ajaxLoading(isHide = false){
            if(isHide){
                $('#processOverlay').remove();
                clearTimeout(autoRemoveLoader);
                return;
            }

            $('body').append('<div id="processOverlay" style="background:#000;width:100%;height:1000px;position:fixed;top:0;left:0;opacity:0.8;display:block; z-index:10000;"><a href="#" style="float:right;" id="close-overlay-button">X<a><img style="margin:20% auto;display: block;transform: scale(2)" src="http://www.bestwebs.in/images/loader1.svg" alt="Processing ..."></div>');
            autoRemoveLoader = setTimeout(function(){
                $('#processOverlay').remove();
                showResponse("warning", "Something is not good, Check your console (Control+Shift+J)");
            }, 10000);
        }
        function performAjax(varsArray, optionalErrMsg, optionalFunctiontoPerform, noLoader){
            if(isProcessingAjax) return false;
        	var response, status;
        	if(typeof varsArray === "string"){
        		varsArray += "&ajax=true";
        	}else{
        		varsArray.ajax = "true";
        	}
        	if(typeof optionalErrMsg === "function"){
        		optionalFunctiontoPerform = optionalErrMsg;
        		optionalErrMsg = "";
        	}else if(typeof optionalErrMsg === "undefined"){
        		optionalFunctiontoPerform = showResponse;
        		optionalErrMsg = " ";
        	}
            $.ajax({
            	xhr: function(){
			        var xhr = new window.XMLHttpRequest();
			        //Upload progress
			        xhr.upload.addEventListener("progress", function(evt){
			        if (evt.lengthComputable) {
			          var percentComplete = evt.loaded / evt.total;
			          //Do something with upload progress
			          //console.log(percentComplete);
			          }
			        }, false);
			        //Download progress
			        xhr.addEventListener("progress", function(evt){
			          if (evt.lengthComputable) {
			            var percentComplete = evt.loaded / evt.total;
			            //Do something with download progress
			            //console.log(percentComplete);
			          }
			        }, false);
			        return xhr;
			    },
                async:false,
                type: 'POST',
                data: varsArray,
                beforeSend : ajaxLoading(noLoader)
            })
            .done(function(data) {
            	// console.log(data);
            	if(! noLoader) $("html, body").animate({scrollTop: 0},"slow");
            	if(optionalErrMsg === ""){
            		optionalFunctiontoPerform(data);
            		isProcessingAjax = false
                    return true;
            	}
                try {
                    response = JSON.parse(data);
                    status = true;
                } catch(e) {
                    response = data.search('{"status":');
                    if( response != -1){
                        response = data.substring(response, data.indexOf(' }')+2);
                        //console.log(response);
                        try{
                          response = JSON.parse(response);
                          status = true;
                        }catch(e){
                          response = {"status": "warning", "message": "Unknown Status (catch2) : <b>Please refresh page and check manually</b>"+optionalErrMsg};
                          status = false;
                          //console.log(data);
                        }
                    }else{
                       response = {"status": "warning", "message": "Unknown Status (else) : <b>Please refresh page and check manually</b>"+optionalErrMsg};
                       status = false;
                       //console.log(data);
                    }
                } finally {
                    optionalFunctiontoPerform(response.status, response.message);
                    isProcessingAjax = false
                    return status;
                }
            })
            .fail(function(jqXHR, textStatus, errorThrown) {
                response = {"status": "danger", "message": "Error Unable to Complete Ajax request, Please try Later after refreshing Page"+optionalErrMsg};
                showResponse(response.status, response.message);
                // console.log(textStatus+' : '+errorThrown);
                isProcessingAjax = false
                return false;
            })
            .always(function() {
                ajaxLoading(true);
            });
        }
        function setPageContent(content){
        	$("#content").html('');
        	$("#content").html(content);
        	formInit();
        }
        function setShowModal(data, type) {
            $("#modal").html('<div class="modal-dialog">'+
                                '<form method="post" enctype="multipart/form-data" class="ajax-form modal-content" id="modal-details">'+
                                    '<div class="modal-header">'+
                                        '<button type="button" class="close" data-dismiss="modal" aria-hidden="true">X</button>'+
                                        '<h4 class="modal-title" id="H1"></h4>'+
                                    '</div>'+
                                    '<div class="modal-body">'+
                                        '<button type="button" class="close" data-dismiss="modal" aria-hidden="true">X</button>'+
                                        '<div class="animate-icon">'+
                                            '<span class="glyphicon"></span>'+
                                        '</div>'+
                                        '<center class="noprint modalMsg" style="padding: 100px 20px;"><b>Unable to fetch details</b></center>'+
                                        '<button type="button" class="btn btn-danger btn-block" data-dismiss="modal" aria-hidden="true">Close</button>'+
                                    '</div>'+
                                    '<div class="modal-footer">'+
                                        '<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>'+
                                        '<button type="button" class="btn btn-primary">Save changes</button>'+
                                    '</div>'+
                                '</form>'+
                              '</div>');
            var modal_ = $("#modal"),
                header =  modal_.find('.modal-header'),
                title =  header.find('.modal-title'),
                body =  modal_.find('.modal-body'),
                modalMsg =  body.find('.modalMsg'),
                footer =  modal_.find('.modal-footer');
            if(type == "success") {
                modal_.find('.glyphicon').addClass('glyphicon-thumbs-up');
            }else{
                modal_.find('.glyphicon').addClass('glyphicon-thumbs-down');
            }
            if((typeof data == "string")){
                modalMsg.html(data);
                footer.remove();
                header.remove();
            }else if((typeof data != "undefined") && (typeof type != "undefined")){
                title.html(data.title);
                body.html(data.body);
                footer.html(data.footer);
            }else if(typeof data != "undefined"){
                body.html(data.body);
                header.remove();
                footer.remove();
            }else{
                type = type ? type : "default";
                header.remove();
                footer.remove();
            }
            type = type ? type : "default";
            modal_.attr('class', 'modal modal-'+type);
            modal_.modal({show:true, backdrop:"static", keyboard:true});
        }
        function previewSelectedImages(targetdiv, inputTag, limitFiles) {
	        targetdiv.html('');
	        //Check File API support
	        if (window.File && window.FileList && window.FileReader) {
	            var files = event.target.files; //FileList object
	            var noOfFiles = files.length;
	            if(noOfFiles > limitFiles){
	                alert("You can select maximum "+limitFiles+" Images");
	                inputTag.val('');
	                return false;
	            }
	            for (var i = 0; i < noOfFiles; i++) {
	                var file = files[i];
	                //Only pics
	                if (!file.type.match('image')) {alert("Some of selected file(s) is not an image, cannot not be uploaded !"); return false;}
	                //Max 480 KB
	                if(file.size > 500000) {alert("Size of some file(s) is greater than 480 Kb, cannot not be uploaded !"); return false;}
	                var picReader = new FileReader();
	                picReader.addEventListener("load", function (event) {
	                    var picFile = event.target;
	                    targetdiv.append("<img class='thumbnail' src='" + picFile.result + "'" + "title='" + picFile.name + "'/>");
	                });
	                //Read the image
	                picReader.readAsDataURL(file);
	            }
	        } else {
	            alert("Your browser does not support File API, so unable to preview selected images");
	        }
	        return true;
	    }
	    function updateReferalCharges(input1, input2){
	        var total1, total2, total3, total, payout,
	            price = input1 ? $('#sample-price').val() : $('#sample-price').text(),
	            type1 = input2 ? $('#referral-type-1').val() : $('#referral-type-1').text(),
	            type2 = input2 ? $('#referral-type-2').val() : $('#referral-type-2').text(),
	            type3 = input2 ? $('#referral-type-3').val() : $('#referral-type-3').text(),
	            amount1 = input2 ? $('#referral-amount-1').val() : $('#referral-amount-1').text(),
	            amount2 = input2 ? $('#referral-amount-2').val() : $('#referral-amount-2').text(),
	            amount3 = input2 ? $('#referral-amount-3').val() : $('#referral-amount-3').text(),
	            tax = <?php echo CLIENT_TAX; ?>;
	        if(type1 === "Flat"){
	            total1 = amount1 * 1;
	        }else{
	            total1 = price * amount1 / 100;
	        }
	        if(type2 === "Flat"){
	            total2 = amount2 * 1;
	        }else{
	            total2 = price * amount2 / 100;
	        }
	        if(type3 === "Flat"){
	            total3 = amount3 * 1;
	        }else{
	            total3 = price * amount3 / 100;
	        }
	        total = (total1 + total2 + total3) * ( 1 + tax);
	        total = Math.round(total*100)/100;
	        payout = price-total;
	        if(price === ''){
	        	payout = "please Enter Price First";
	        }else{
	        	payout = payout.toFixed(2);
	        }
	        $('#referral-total-1').text(total1.toFixed(2));
	        $('#referral-total-2').text(total2.toFixed(2));
	        $('#referral-total-3').text(total3.toFixed(2));
	        $('#referral-total').text(total.toFixed(2));
	        $('#payout-total').text(payout);
	    }
	    function updateTaxes(input1, input2){
	        var total1, total2, total3, total_state, total_out,
	            price = input1 ? $('#tax-price').val() : $('#tax-price').text(),
	            tax1 = input2 ? $('#tax-1').val() : $('#tax-1').text(),
	            tax2 = input2 ? $('#tax-2').val() : $('#tax-2').text(),
	            tax3 = input2 ? $('#tax-3').val() : $('#tax-3').text();
	        total1 = price * tax1 / 100;
	        total2 = price * tax2 / 100;
	        total3 = price * tax3 / 100;
	        total_state = total2 + total3;
	        total_out = total1;
	        $('#tax-total-1').text(total1.toFixed(2));
	        $('#tax-total-2').text(total2.toFixed(2));
	        $('#tax-total-3').text(total3.toFixed(2));
	        $('#tax-total-state').text(total_state.toFixed(2));
	        $('#tax-total-out').text(total_out.toFixed(2));
	    }
	    function copyToClipboard(element) {
	        var $temp = $("<input>");
	        $("body").append($temp);
	        $temp.val(element).select();
	        document.execCommand("copy");
	        $temp.remove();
	    }
        function fillEditForm(dataArray) {
            dataArray = dataArray[0
            ];
            $.each(dataArray, function(name, value) {
                $("#"+name).val(value);
            });
        }
        function plotCustomer(id, msg){
            var results = {
                "title":"Select Customer & his Product for <b>"+id+"</b>",
                "body": "<table class='table table-hover table-bordered'>"+
                            "<thead>"+
                                "<tr>"+
                                    "<th>Name</th>"+
                                    "<th>Mobile</th>"+
                                    "<th>Address</th>"+
                                    "<th>Product</th>"+
                                    "<th>Previous Tickets</th>"+
                                    "<th class='sr-only'></th>"+
                                "</tr>"+
                            "</thead>"+
                            "<tbody>",
                "footer": ""
            };
            $.each(msg, function(index,data){
                results.body += '<tr>'+
                                  '<td><span class="add-new-option-btn name">'+data.name+'</span> <br>(#<span class="crn">'+data.crn+'</span>)</td>'+
                                  '<td><span class="mobile">'+data.mobile+'</span> <br><span class="alternate_mobile">'+data.alternate_mobile+'</span>'+' <br><span class="email">'+data.email+'</span></td>'+
                                  '<td class="address">'+data.address+', Near '+data.landmark+', '+data.city+', '+data.district+', '+data.state+' - '+data.pin+'</td>'+
                                  '<td><span class="brand">'+data.brand+'</span> <span class="product">'+data.model+' '+data.product+'</span><br> <span class="quantity">'+data.quantity+'</span></td>'+
                                  '<td><a target="_blank" href="/BestWebs?module=ticket&mode=view&type=all&ticket='+data.complaint+'">#'+data.complaint+'</td>'+
                                  '<td class="sr-only"><span class="district">'+data.district+'</span><span class="customer_product">'+data.customer_product+'</span><span class="purchase_date">'+data.purchase_date+'</span><span class="warranty">'+data.warranty+'</span> Months</td>'+
                              '</tr>';
            });
            results.body += "</tbody></table>";
            setShowModal(results, "info");
            // $("#customerModal").modal({show:true, backdrop:"static", keyboard:true}).children('.modal-dialog').css({'width': '90%', 'margin-left': 'auto', 'margin-right': 'auto', 'left': '5%'});
        }
    </script>
    <script type="text/javascript">
    	var dataTabel;
    	$(function() {
            formInit();

            if( navigator.userAgent.match(/Android/i) || navigator.userAgent.match(/webOS/i) || navigator.userAgent.match(/iPhone/i) || navigator.userAgent.match(/iPad/i) || navigator.userAgent.match(/iPod/i) || navigator.userAgent.match(/BlackBerry/i) || navigator.userAgent.match(/Windows Phone/i) ){
                var isMobile = true;
            }else {
                var isMobile = false;
            }

            // Ajax Page Content (#content.html) reLoad
			$("body").on("click", "a[rel='tab']", function(e){
				// e.preventDefault();
				$('.active-li').removeClass('active active-li');
				$('.active-ul').removeClass('in active-ul');
				$(this).closest('li').addClass('active active-li').closest('li').addClass('active active-li').closest('li').addClass('active active-li');
				$(this).closest('ul').addClass('active-ul collapse in').closest('ul').addClass('active-ul collapse in');
				var pageurl = $(this).attr('href'),
					varsArray = {"adminAjax":"changePage", "url":pageurl};
	            performAjax(varsArray, "", setPageContent);
	            // To change the browser URL to the given link location
                if(isMobile) $("#menu").collapse('hide');
				if(pageurl!=window.location){
					window.history.pushState({path:pageurl},'',pageurl);
				}
	            return false;
			});
			window.onpopstate = function(event) {
				var pageurl, varsArray;
				if((typeof event.state === "object") && (event.state != null)){
					pageurl = event.state.path;
					varsArray = {"adminAjax":"changePage", "url":pageurl};
		            performAjax(varsArray, "", setPageContent);
				}
			};

			// Ajax Form Submit
	        $("#content").on("submit", ".ajax-form", function(e) {
	            e.preventDefault();
	            var status,
                    form = $(this),
                    formId = form.attr('id'),
	                vars = form.serialize();
                performAjax(vars , " ", function(status, msg){
                	showResponse(status, msg);
                	if(status === "success"){
                        if(formId == "add-job-form"){
                            $("#complaint option:selected").remove().trigger('change');
                            $("#complaint").trigger('change');
                        }
                        $(".modal").modal("hide");
                        form[0].reset();
                		$(".chzn-select").val('').trigger("chosen:updated");
                	}else if(formId == "changePass-form"){
                        form[0].reset();
                    }
                });
                return false;
	        });

            $("body").on('click', '.misscallCalled' ,function(e) {
                var tagging = $('[name="tagging"]').val(),
                    status = $(this).attr('data-status'),
                    ajax = "misscall",
                    action = "tag",
                    id = $(this).attr("data-id"),
                    varsArray = {"adminAjax":ajax, "action":action, "id":{"id":id, "tagging":tagging, "status":status}};
                if(!tagging){
                    $("#tagMsg").html("<span style='color:red;'>Required *</span>");
                    return;
                }
                performAjax(varsArray, " ", function(status, msg){
                    showResponse(status, msg);
                    if(status === "success"){
                        $("[data-misscall='"+id+"']").hide("slow");
                        $("#modal").modal("hide");
                    }
                }, true);
            });

	        // Perform Action
	        $("#content").on('click', '.btn-action' ,function(e) {
	        	e.preventDefault();
	            var action_button = $(this),
                    entity_details = action_button.closest('.entity-details'),
	          	    entity = entity_details.attr('data-entity'),
	          	    id = entity_details.attr('data-id'),
	          	    action = action_button.attr('data-action'),
                    callback = action_button.attr('data-callback'),
	          	    varsArray = {"adminAjax":entity, "action":action, "id":id};
                if(action === "delete"){
                    if(! confirm("Are You Sure to Delete This Entry from CRM, it cannot be undo!")) return false;
                }
                if(entity === "misscall"){
                    var contact = entity_details.find('.contact').text();
                    varsArray.number = entity_details.attr('data-misscall');
                    copyToClipboard(contact);
                }else if(entity === "ticket"){
                    if (action === "jobsheet") {
                        window.open("/BestWebs?module=ticket&mode=jobsheet&type="+id, '_blank');
                        return true;
                    }else if (action === "add-job") {
                        window.open("/BestWebs?module=job&mode=add&type=new&ticket="+id, '_blank');
                        return true;
                    }else if (action === "edit-ticket") {
                        window.open("/BestWebs?module=ticket&mode=add&type="+id, '_blank');
                        return true;
                    }
                }
	          	performAjax(varsArray, " ", function(status, msg){
	          		if(status === "success"){
                        if((entity === "misscall") && (action === "call" || action === "tag-detail")){
                            if(typeof msg != "object"){
                                showResponse(status, msg);
                                return;
                            }
                            var code = entity_details.attr('data-misscall'),
                                number = entity_details.attr('data-id'),
                                data = {};
                            data.body = "<h4>Tagging for "+number+"</h4><hr>"+
                                        "<div class='row form-group'>"+
                                            "<div class='col-xs-12'><span id='tagMsg'></span><input type='text' class='form-control' name='tagging' list='taggingOptions' placeholder='Enter Your Action On Call' row='2'><datalist id='taggingOptions'><option value='Unable to Connect, Mobile Switched off'><option value='Unable to Connect, Mobile out of Coverage'><option value='Unable to Connect, Call not picked'><option value='Customer Miss-behaved'><option value='Complaint Registered'><option value='Product Registered'><option value='Complaint & Product both Registered'><option value='Sales Enquiry'><option value='No Service Area Call'></datalist> </div>"+
                                        "</div>"+
                                        "<hr><h4>Previous Calls</h4><hr>";
                            if(action === "tag-detail"){
                                data.body = "";
                                data.footer = "<button type='button' class='btn btn-default' data-dismiss='modal'>Close</button>";
                            }
                            $.each(msg, function(index, el) {
                                data.body += "<div class='row form-group' style='margin:20px 0;'>"+
                                                "<div class='col-xs-8'> <b>"+el.user+"</b></div>"+
                                                "<div class='col-xs-4'> <small>"+el.time+"</small></div>"+
                                                "<div class='col-xs-8'> "+el.details+"</div>"+
                                                "<div class='col-xs-4'> <small> "+el.circle+"</small></div>"+
                                            "</div>";
                            });
                            data.body += "<hr><div class='row form-group'>"+
                                            "<button type='button' data-status='1' data-id='"+code+"' class='btn btn-success misscallCalled pull-right'><i class='icon-ok'></i> Called</button> &nbsp; "+
                                            "<button type='button' data-status='0' data-id='"+code+"' class='btn btn-danger misscallCalled pull-right'><i class='icon-ban-circle'></i> Discarded</button>"+
                                         "</div>";
                            setShowModal(data);
                            return;
                        }else if(action === "details"){
                            var code = entity_details.find('.btn-action').eq(0).text(),
                                data = {
                                    "title":"#"+code+" Details",
                                    "body": "<table class='table table-hover table-bordered table-striped'>",
                                    "footer": ""
                                };
                            $.each(msg, function(index, el) {
                                if(index == "id") return;
                                data.body += "<tr><td>"+index.toUpperCase()+"</td><td>"+el+"</td></tr>";
                            });
                            data.body += "</table>";
                            setShowModal(data, status);
                            return;
                        }else if(action === "delete"){
                            showResponse(status, msg);
                            dataTabel.row( entity_details ).remove().draw();
                            return;
                        }else if(action === "block"){
                            showResponse(status, msg);
                            entity_details.addClass('warning');
                            action_button.replaceWith("<a href='javascript:void(0);' class='btn btn-success btn-circle btn-line btn-action' data-action='unblock' title='Unblock'><i class='icon-check'></i></a>");
                            return;
                        }else if(action === "unblock" || action === "approve"){
                            showResponse(status, msg);
                            entity_details.removeClass('warning danger');
                            action_button.replaceWith("<a href='javascript:void(0);' class='btn btn-warning btn-circle btn-line btn-action' data-action='block' title='Block'><i class='icon-ban-circle'></i></a>");
                            return;
                        }else if(entity === "ticket"){
                            if (action === "technician") {
                                var code = entity_details.find('.btn-action').eq(0).text(),
                                    data = {"title":"Ticket #"+code+" Technician Details",
                                            "footer":
                                                "<button type='button' class='btn btn-default' data-dismiss='modal'>Close</button>"+
                                                "<button type='button' id='updateTechnician' data-id='"+id+"' class='btn btn-success'>Save changes</button>"
                                            };
                                if(msg[0].technician){
                                    data.body = "<div class='row form-group'>"+
                                                    "<div class='col-xs-6'>Technician Assigned : </div>"+
                                                    "<div class='col-xs-6'> "+msg[0].technician+" ( "+msg[0].mobile+" )</div>"+
                                                "</div>"+
                                                "<div class='row form-group'>"+
                                                    "<div class='col-xs-6'>Change To : </div>"+
                                                    "<div class='col-xs-6'> "+
                                                        "<select class='form-control' name='center_user'>"+
                                                            "<option value=''>Select ...</option>";
                                    $.each(msg, function(index, el) {
                                               data.body += "<option value='"+el.id+"'>"+el.technician+" ( "+el.mobile+" )</option>";
                                    });
                                    data.body +=        "</select>"+
                                                    "</div>"+
                                                "</div>";
                                }else{
                                    data.body = "<form  class='ajax-form' method='post' enctype='multipart/form-data'><div class='row form-group'>"+
                                                    "<div class='col-xs-6'>Assign To : </div>"+
                                                    "<div class='col-xs-6'> "+
                                                        "<select class='form-control' name='center_user'>"+
                                                            "<option value=''>Select ...</option>";
                                    $.each(msg, function(index, el) {
                                        if(! index) return;
                                        data.body += "<option value='"+el.id+"'>"+el.technician+" ("+el.mobile+")</option>";
                                    });
                                    data.body +=        "</select>"+
                                                    "</div>"+
                                                "</form>";
                                    status = "warning";
                                }
                                setShowModal(data, status);
                                return;
                            }else if (action === "jobdetails") {
                                var code = entity_details.find('.btn-action').eq(0).text(),
                                data = {
                                    "title":"Ticket #"+code+" Job Details",
                                    "body": "",
                                    "footer": ""
                                },
                                jobAdded = [];
                                $.each(msg, function(count, job) {
                                    data.body += "<table class='table table-hover table-bordered table-striped'>";
                                    $.each(job, function(index, el) {
                                        if(index == "stts") return;
                                        data.body += "<tr><td>"+index.toUpperCase()+"</td><td>"+el+"</td></tr>";
                                    });
                                    data.body += "</table>";
                                });
                                setShowModal(data, status);
                                return;
                            }else if (action === "feedback") {
                                var code = entity_details.find('.btn-action').eq(0).text(),
                                data = {"title":"Ticket #"+code+" Feedback",
                                        "body": "",
                                        "footer":
                                            "<button type='button' class='btn btn-default' data-dismiss='modal'>Close</button>"+
                                            "<button type='button' id='ticketFeedback' data-id='"+id+"' class='btn btn-success'>Save changes</button>"
                                        };
                                $.each(msg, function(index, el) {
                                   data.body += "<div class='row form-group' style='margin:20px 0;'>"+
                                                    "<div class='col-xs-8'><b>"+el.user+"</b></div>"+
                                                    "<div class='col-xs-4'> <small>"+el.time+"</small></div>"+
                                                    "<div class='col-xs-8'> "+el.review+"</div>"+
                                                    "<div class='col-xs-4'> "+"<i class='icon-star'></i>".repeat(el.rating)+"</div>"+
                                                "</div>";
                                });
                                data.body += "<div class='row form-group'>"+
                                                "<div class='col-xs-8'><span id='reviewMsg'></span><input type='text' class='form-control' list='reviewOptions' name='review' placeholder='Enter Customer Review'><datalist id='reviewOptions'><option value='Work Done, Customer Satisfied'><option value='Work Done, Customer Not Satisfied'><option value='Work Done, Customer Paid'><option value='Work Done, Service Associate Miss-behaved'><option value='Work Done, Calling Associate Miss-behaved'><option value='Work Done, No Spare Replaced, Fake replacement shown'><option value='Work Not Properly Done, Still facing problem'><option value='Work Not Done, Customer Not Satisfied'><option value='Work Not Done, Service Associate did not come'></datalist> </div>"+
                                                "<div class='col-xs-4'> "+
                                                    "<span id='ratingMsg'></span><select class='form-control' name='rating'>"+
                                                        "<option value=''>Rating ...</option><option value='1'>1</option><option value='2'>2</option><option value='3'>3</option><option value='4'>4</option><option value='5'>5</option>"+
                                                    "</select>"+
                                                "</div>"+
                                            "</div>";
                                setShowModal(data, status);
                                return;
                            }
                        }
	          		}
                    setShowModal(msg, status);
                });
	        });
        });
    </script>
    <!--END ADD PRODUCT PAGE LEVEL SCRIPT-->
	<?php
}