<?php

function PageHead($title, $page = ''){
	?>
	<!DOCTYPE html>
	<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
	<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
	<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->
	<!-- BEGIN HEAD -->
	<head>
	    <meta charset="UTF-8" />
	    <title>  <?php echo $title; ?> </title>
	     <meta content="width=device-width, initial-scale=1.0" name="viewport" />
		<meta content="Admin Dashboard" name="description" />
		<meta content="http://www.shoppo.com/santosh" name="author" />
		<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
	     <!--[if IE]>
	        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	        <![endif]-->
	    <!-- GLOBAL STYLES -->
	    <link rel="stylesheet" href="<?php echo CDN_ADMIN; ?>/plugins/bootstrap/css/bootstrap.css" />
	    <link rel="stylesheet" href="<?php echo CDN_ADMIN; ?>/css/main.css" />
	    <link rel="stylesheet" href="<?php echo CDN_ADMIN; ?>/css/theme.css" />
	    <link rel="stylesheet" href="<?php echo CDN_ADMIN; ?>/css/MoneAdmin.css" />
	    <link rel="stylesheet" href="<?php echo CDN_ADMIN; ?>/plugins/Font-Awesome/css/font-awesome.css" />
	    <!--END GLOBAL STYLES -->

	    <!-- HOME PAGE LEVEL STYLES -->
	    <link rel="stylesheet" href="<?php echo CDN_ADMIN; ?>/css/layout2.css"/>
        <link rel="stylesheet" href="<?php echo CDN_ADMIN; ?>/plugins/flot/examples/examples.css"/>
        <link rel="stylesheet" href="<?php echo CDN_ADMIN; ?>/plugins/timeline/timeline.css" />
	    <!-- END HOME PAGE LEVEL  STYLES -->
	    <!-- ADD PRODUCT PAGE LEVEL STYLES -->
		<link href="<?php echo CDN_ADMIN; ?>/css/jquery-ui.css" rel="stylesheet" />
		<link rel="stylesheet" href="<?php echo CDN_ADMIN; ?>/plugins/uniform/themes/default/css/uniform.default.css" />
		<link rel="stylesheet" href="<?php echo CDN_ADMIN; ?>/plugins/inputlimiter/jquery.inputlimiter.1.0.css" />
		<link rel="stylesheet" href="<?php echo CDN_ADMIN; ?>/plugins/chosen/chosen.css" />
		<link rel="stylesheet" href="<?php echo CDN_ADMIN; ?>/plugins/colorpicker/css/colorpicker.css" />
		<link rel="stylesheet" href="<?php echo CDN_ADMIN; ?>/plugins/tagsinput/jquery.tagsinput.css" />
		<link rel="stylesheet" href="<?php echo CDN_ADMIN; ?>/plugins/daterangepicker/daterangepicker-bs3.css" />
		<link rel="stylesheet" href="<?php echo CDN_ADMIN; ?>/plugins/datepicker/css/datepicker.css" />
		<link rel="stylesheet" href="<?php echo CDN_ADMIN; ?>/plugins/timepicker/css/bootstrap-timepicker.min.css" />
		<link rel="stylesheet" href="<?php echo CDN_ADMIN; ?>/plugins/switch/static/stylesheets/bootstrap-switch.css" />
    	<!-- END ADD PRODUCT PAGE LEVEL  STYLES -->
    	<!-- DATA Table PAGE LEVEL STYLES -->
	    <link rel="stylesheet" href="<?php echo CDN_ADMIN; ?>/plugins/dataTables/dataTables.bootstrap.css"/>
	    <!-- END PAGE LEVEL  STYLES -->

	    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
	    <!--[if lt IE 9]>
	      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
	      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
	    <![endif]-->
	</head>
	<?php
}

function PageBodyInit($page = ''){
	?>
	<?php
}

function PageTopBar($page = ''){
	?>
	<div id="top">
		<nav class="navbar navbar-inverse navbar-fixed-top ">
	        <a data-original-title="Show/Hide Menu" data-placement="bottom" data-tooltip="tooltip" class="accordion-toggle btn btn-primary btn-sm visible-xs" data-toggle="collapse" href="#menu" id="menu-toggle">
	            <i class="icon-align-justify"></i>
	        </a>
	        <!-- LOGO SECTION -->
	        <header class="navbar-header">
	            <a href="/" class="navbar-brand" style="padding: 0px;">
	            <img src="/assets/Images/logo.png" alt="" style="height: 50px;" />
	                </a>
	        </header>
	        <!-- END LOGO SECTION -->
	        <ul class="nav navbar-top-links navbar-right" style="margin-top: 10px;">
	            <!-- MESSAGES SECTION -->
	            <li class="dropdown">
	                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
	                    <span class="label label-success">2</span>    <i class="icon-envelope-alt"></i>&nbsp; <i class="icon-chevron-down"></i>
	                </a>
	                <ul class="dropdown-menu dropdown-messages">
	                    <li>
	                        <a href="#">
	                            <div>
	                               <strong>John Smith</strong>
	                                <span class="pull-right text-muted">
	                                    <em>Today</em>
	                                </span>
	                            </div>
	                            <div>Lorem ipsum dolor sit amet, consectetur adipiscing.
	                                <br />
	                                <span class="label label-primary">Important</span>

	                            </div>
	                        </a>
	                    </li>
	                    <li class="divider"></li>
	                    <li>
	                        <a href="#">
	                            <div>
	                                <strong>Raphel Jonson</strong>
	                                <span class="pull-right text-muted">
	                                    <em>Yesterday</em>
	                                </span>
	                            </div>
	                            <div>Lorem ipsum dolor sit amet, consectetur adipiscing.
	                                 <br />
	                                <span class="label label-success"> Moderate </span>
	                            </div>
	                        </a>
	                    </li>
	                    <li class="divider"></li>
	                    <li>
	                        <a href="#">
	                            <div>
	                                <strong>Chi Ley Suk</strong>
	                                <span class="pull-right text-muted">
	                                    <em>26 Jan 2014</em>
	                                </span>
	                            </div>
	                            <div>Lorem ipsum dolor sit amet, consectetur adipiscing.
	                                 <br />
	                                <span class="label label-danger"> Low </span>
	                            </div>
	                        </a>
	                    </li>
	                    <li class="divider"></li>
	                    <li>
	                        <a class="text-center" href="#">
	                            <strong>Read All Messages</strong>
	                            <i class="icon-angle-right"></i>
	                        </a>
	                    </li>
	                </ul>
	            </li>
	            <!--END MESSAGES SECTION -->
	            <!--ADMIN SETTINGS SECTIONS -->
	            <li class="dropdown">
	                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
	                    <i class="icon-user "></i>&nbsp; <i class="icon-chevron-down "></i>
	                </a>

	                <ul class="dropdown-menu dropdown-user">
	                    <li><a href="/profile"><i class="icon-user"></i> User Profile </a>
	                    </li>
	                    <li><a href="/setting"><i class="icon-gear"></i> Settings </a>
	                    </li>
	                    <li class="divider"></li>
	                    <li><a href="/logout"><i class="icon-signout"></i> Logout </a>
	                    </li>
	                </ul>
	            </li>
	            <!--END ADMIN SETTINGS -->
	        </ul>
	    </nav>
	</div>
	<?php
}

function PageLeftNavBar($page = ''){
	global $function;
	?>
	<div id="left" >
        <div class="media user-media well-small">
            <a class="user-link" href="#">
                <img class="media-object img-thumbnail user-img" alt="User Picture" src="/assets/admin/img/user.gif" />
            </a>
            <br />
            <div class="media-body">
                <h5 class="media-heading"><?php echo $_SESSION['SESS__name']; ?></h5>
                <ul class="list-unstyled user-info">
                    <li>
                         <a class="btn btn-success btn-xs btn-circle" style="width: 10px;height: 12px;"></a> <?php echo $function->getData_designationByLevel($_SESSION['SESS__azz_level']); ?> Profile
                    </li>
                </ul>
            </div>
            <br />
        </div>
        <ul id="menu" class="collapse">
            <li class="panel">
                <a href="/shoppo-admin" >
                    <i class="icon-dashboard"></i> Dashboard
                </a>
            </li>
            <li class="panel">
                <a href="#" data-parent="#menu" data-toggle="collapse" class="accordion-toggle collapsed" data-target="#product-nav">
                    <i class="icon-shopping-cart"> </i> Products
                    <span class="pull-right">
                        <i class="icon-angle-left"></i>
                    </span>
                   <!-- &nbsp; <span class="label label-default">10</span>&nbsp; -->
                </a>
                <ul class="collapse" id="product-nav">
                    <li class=""><a href="/shoppo-admin?module=product&mode=add&type=new"><i class="icon-angle-right"></i> Add Product </a></li>
                    <li class="">
                		<a href="#" data-parent="#product-nav" data-toggle="collapse" class="accordion-toggle" data-target="#product-view-nav">
                			<i class="icon-angle-right"></i> View Products
							<span class="pull-right" style="margin-right: 20px;">
		                        <i class="icon-angle-left"></i>
		                    </span>
                		</a>
						<ul class="collapse" id="product-view-nav">
							<li><a href="/shoppo-admin?module=product-view&mode=category&type=all"><i class="icon-angle-right"></i> By Category </a></li>
							<li><a href="/shoppo-admin?module=product-view&mode=master&type=all"><i class="icon-angle-right"></i> By Master </a></li>
                            <li><a href="/shoppo-admin?module=product-view&mode=brand&type=all"><i class="icon-angle-right"></i> By Brand </a></li>
                            <li><a href="/shoppo-admin?module=product-view&mode=vendor&type=all"><i class="icon-angle-right"></i> By Vendor </a></li>
                            <li><a href="/shoppo-admin?module=product-view&mode=list&type=all"><i class="icon-angle-right"></i> By List </a></li>
						</ul>
            		</li>
                    <li class=""><a href="/shoppo-admin?module=product&mode=add-master&type=new"><i class="icon-angle-right"></i> Add Products Master </a></li>
                    <li class="">
                		<a href="#" data-parent="#product-nav" data-toggle="collapse" class="accordion-toggle" data-target="#product-view-master-nav">
                			<i class="icon-angle-right"></i> View Product Masters
							<span class="pull-right" style="margin-right: 20px;">
		                        <i class="icon-angle-left"></i>
		                    </span>
                		</a>
						<ul class="collapse" id="product-view-master-nav">
							<li><a href="/shoppo-admin?module=product-view-master&mode=category&type=all"><i class="icon-angle-right"></i> By Category </a></li>
                            <li><a href="/shoppo-admin?module=product-view-master&mode=brand&type=all"><i class="icon-angle-right"></i> By Brand </a></li>
                            <li><a href="/shoppo-admin?module=product-view-master&mode=vendor&type=all"><i class="icon-angle-right"></i> By Vendor </a></li>
                            <li><a href="/shoppo-admin?module=product-view-master&mode=list&type=all"><i class="icon-angle-right"></i> By List </a></li>
						</ul>
            		</li>
                    <li class=""><a href="/shoppo-admin?module=product&mode=add-brand&type=new"><i class="icon-angle-right"></i> Add Brand </a></li>
                    <li class="">
                		<a href="#" data-parent="#product-nav" data-toggle="collapse" class="accordion-toggle" data-target="#product-view-brand-nav">
                			<i class="icon-angle-right"></i> View Brands
							<span class="pull-right" style="margin-right: 20px;">
		                        <i class="icon-angle-left"></i>
		                    </span>
                		</a>
						<ul class="collapse" id="product-view-brand-nav">
							<li><a href="/shoppo-admin?module=product-view-brand&mode=category&type=all"><i class="icon-angle-right"></i> By Category </a></li>
							<li><a href="/shoppo-admin?module=product-view-brand&mode=master&type=all"><i class="icon-angle-right"></i> By Master </a></li>
                            <li><a href="/shoppo-admin?module=product-view-brand&mode=vendor&type=all"><i class="icon-angle-right"></i> By Vendor </a></li>
                            <li><a href="/shoppo-admin?module=product-view-brand&mode=list&type=all"><i class="icon-angle-right"></i> By List </a></li>
						</ul>
            		</li>
                    <li class=""><a href="/shoppo-admin?module=product&mode=manage&type=admin"><i class="icon-angle-right"></i> Manage </a></li>
                </ul>
            </li>
            <li class="panel">
                <a href="#" data-parent="#menu" data-toggle="collapse" class="accordion-toggle collapsed" data-target="#center-nav">
                    <i class="icon-building"></i> Vendors
                    <span class="pull-right">
                        <i class="icon-angle-left"></i>
                    </span>
                    <!-- &nbsp; <span class="label label-success">5</span>&nbsp; -->
                </a>
                <ul class="collapse" id="center-nav">
                    <li class=""><a href="/shoppo-admin?module=center&mode=add&type=new"><i class="icon-angle-right"></i> Add Vendor </a></li>
                    <li class="">
                		<a href="#" data-parent="#center-nav" data-toggle="collapse" class="accordion-toggle" data-target="#center-view-nav">
                			<i class="icon-angle-right"></i> View Vendors
							<span class="pull-right" style="margin-right: 20px;">
		                        <i class="icon-angle-left"></i>
		                    </span>
                		</a>
						<ul class="collapse" id="center-view-nav">
							<li><a href="/shoppo-admin?module=center-view&mode=category&type=all"><i class="icon-angle-right"></i> By Category </a></li>
							<li><a href="/shoppo-admin?module=center-view&mode=master&type=all"><i class="icon-angle-right"></i> By Master </a></li>
                            <li><a href="/shoppo-admin?module=center-view&mode=brand&type=all"><i class="icon-angle-right"></i> By Brand </a></li>
                            <li><a href="/shoppo-admin?module=center-view&mode=product&type=all"><i class="icon-angle-right"></i> By Product </a></li>
                            <li><a href="/shoppo-admin?module=center-view&mode=list&type=all"><i class="icon-angle-right"></i> By List </a></li>
						</ul>
            		</li>
                    <li class=""><a href="/shoppo-admin?module=center-user&mode=add&type=all"><i class="icon-angle-right"></i> Add Vendor Users </a></li>
                    <li class="">
                		<a href="#" data-parent="#center-nav" data-toggle="collapse" class="accordion-toggle" data-target="#center-user-nav">
                			<i class="icon-angle-right"></i> View Vendor Users
							<span class="pull-right" style="margin-right: 20px;">
		                        <i class="icon-angle-left"></i>
		                    </span>
                		</a>
						<ul class="collapse" id="center-user-nav">
							<li><a href="/shoppo-admin?module=center-user-view&mode=category&type=all"><i class="icon-angle-right"></i> By Category </a></li>
							<li><a href="/shoppo-admin?module=center-user-view&mode=master&type=all"><i class="icon-angle-right"></i> By Master </a></li>
                            <li><a href="/shoppo-admin?module=center-user-view&mode=brand&type=all"><i class="icon-angle-right"></i> By Brand </a></li>
                            <li><a href="/shoppo-admin?module=center-user-view&mode=vendor&type=all"><i class="icon-angle-right"></i> By Vendor </a></li>
                            <li><a href="/shoppo-admin?module=center-user-view&mode=list&type=all"><i class="icon-angle-right"></i> By List </a></li>
						</ul>
            		</li>
                    <li class=""><a href="/shoppo-admin?module=center&mode=manage&type=admin"><i class="icon-angle-right"></i> Manage </a></li>
                </ul>
            </li>
            <li class="panel">
                <a href="#" data-parent="#menu" data-toggle="collapse" class="accordion-toggle collapsed" data-target="#order-nav">
                    <i class="icon-hand-up"></i> Orders
                    <span class="pull-right">
                        <i class="icon-angle-left"></i>
                    </span>
                    <!-- &nbsp; <span class="label label-success">5</span>&nbsp; -->
                </a>
                <ul class="collapse" id="order-nav">
                    <li class=""><a href="/shoppo-admin?module=order&mode=add&type=new"><i class="icon-angle-right"></i> Add Order Manually </a></li>
                    <li class="">
                    	<a href="#" data-parent="#order-nav" data-toggle="collapse" class="accordion-toggle" data-target="#order-process-nav">
                    		<i class="icon-angle-right"></i> Process Order
                    		<span class="pull-right" style="margin-right: 20px;">
		                        <i class="icon-angle-left"></i>
		                    </span>
                    	</a>
                    	<ul class="collapse" id="order-process-nav">
                            <li><a href="/shoppo-admin?module=order-process&mode=single&type=search"><i class="icon-angle-right"></i> By Order Details </a></li>
                            <li><a href="/shoppo-admin?module=order-process&mode=center&type=search"><i class="icon-angle-right"></i> By Vendor </a></li>
                            <li><a href="/shoppo-admin?module=order-process&mode=user&type=search"><i class="icon-angle-right"></i> By User </a></li>
                            <li><a href="/shoppo-admin?module=order-process&mode=list&type=all"><i class="icon-angle-right"></i> By List </a></li>
                        </ul>
                    </li>
                    <li class="">
                    	<a href="#" data-parent="#order-nav" data-toggle="collapse" class="accordion-toggle" data-target="#order-view-nav">
                    		<i class="icon-angle-right"></i> View Orders
                    		<span class="pull-right" style="margin-right: 20px;">
		                        <i class="icon-angle-left"></i>
		                    </span>
                    	</a>
                    	<ul class="collapse" id="order-view-nav">
                    		<li class="">
	                    		<a href="#" data-parent="#order-view-nav" data-toggle="collapse" class="accordion-toggle" data-target="#order-view-pending-nav">
	                    			<i class="icon-angle-right"></i> Pending Orders
									<span class="pull-right" style="margin-right: 20px;">
				                        <i class="icon-angle-left"></i>
				                    </span>
	                    		</a>
								<ul class="collapse" id="order-view-pending-nav">
									<li><a href="/shoppo-admin?module=order-view&mode=single&type=pending"><i class="icon-angle-right"></i> By Order Details </a></li>
		                            <li><a href="/shoppo-admin?module=order-view&mode=center&type=pending"><i class="icon-angle-right"></i> By Vendor </a></li>
		                            <li><a href="/shoppo-admin?module=order-view&mode=user&type=pending"><i class="icon-angle-right"></i> By User </a></li>
		                            <li><a href="/shoppo-admin?module=order-view&mode=list&type=pending"><i class="icon-angle-right"></i> By List </a></li>
								</ul>
                    		</li>
                    		<li class="">
	                    		<a href="#" data-parent="#order-nav" data-toggle="collapse" class="accordion-toggle" data-target="#order-view-canceled-nav">
	                    			<i class="icon-angle-right"></i> Canceled Orders
									<span class="pull-right" style="margin-right: 20px;">
				                        <i class="icon-angle-left"></i>
				                    </span>
	                    		</a>
								<ul class="collapse" id="order-view-canceled-nav">
									<li><a href="/shoppo-admin?module=order-view&mode=single&type=canceled"><i class="icon-angle-right"></i> By Order Details </a></li>
		                            <li><a href="/shoppo-admin?module=order-view&mode=center&type=canceled"><i class="icon-angle-right"></i> By Vendor </a></li>
		                            <li><a href="/shoppo-admin?module=order-view&mode=user&type=canceled"><i class="icon-angle-right"></i> By User </a></li>
		                            <li><a href="/shoppo-admin?module=order-view&mode=list&type=canceled"><i class="icon-angle-right"></i> By List </a></li>
								</ul>
                    		</li>
                    		<li class="">
	                    		<a href="#" data-parent="#order-nav" data-toggle="collapse" class="accordion-toggle" data-target="#order-view-delivered-nav">
	                    			<i class="icon-angle-right"></i> Delivered Orders
									<span class="pull-right" style="margin-right: 20px;">
				                        <i class="icon-angle-left"></i>
				                    </span>
	                    		</a>
								<ul class="collapse" id="order-view-delivered-nav">
									<li><a href="/shoppo-admin?module=order-view&mode=single&type=delivered"><i class="icon-angle-right"></i> By Order Details </a></li>
		                            <li><a href="/shoppo-admin?module=order-view&mode=center&type=delivered"><i class="icon-angle-right"></i> By Vendor </a></li>
		                            <li><a href="/shoppo-admin?module=order-view&mode=user&type=delivered"><i class="icon-angle-right"></i> By User </a></li>
		                            <li><a href="/shoppo-admin?module=order-view&mode=list&type=delivered"><i class="icon-angle-right"></i> By List </a></li>
								</ul>
                    		</li>
                    		<li class="">
	                    		<a href="#" data-parent="#order-nav" data-toggle="collapse" class="accordion-toggle" data-target="#order-view-returned-nav">
	                    			<i class="icon-angle-right"></i> Returned Orders
									<span class="pull-right" style="margin-right: 20px;">
				                        <i class="icon-angle-left"></i>
				                    </span>
	                    		</a>
								<ul class="collapse" id="order-view-returned-nav">
									<li><a href="/shoppo-admin?module=order-view&mode=single&type=returned"><i class="icon-angle-right"></i> By Order Details </a></li>
		                            <li><a href="/shoppo-admin?module=order-view&mode=center&type=returned"><i class="icon-angle-right"></i> By Vendor </a></li>
		                            <li><a href="/shoppo-admin?module=order-view&mode=user&type=returned"><i class="icon-angle-right"></i> By User </a></li>
		                            <li><a href="/shoppo-admin?module=order-view&mode=list&type=returned"><i class="icon-angle-right"></i> By List </a></li>
								</ul>
                    		</li>
                        </ul>
                    </li>
                    <li class=""><a href="/shoppo-admin?module=order&mode=manage&type=admin"><i class="icon-angle-right"></i> Manage </a></li>
                </ul>
            </li>
            <!-- <li class="panel">
                <a href="#" data-parent="#menu" data-toggle="collapse" class="accordion-toggle" data-target="#chart-nav">
                    <i class="icon-gift"></i> Coupons
                    <span class="pull-right">
                        <i class="icon-angle-left"></i>
                    </span>
                    &nbsp; <span class="label label-danger">4</span>&nbsp;
                </a>
                <ul class="collapse" id="chart-nav">
                    <li><a href="/shoppo-admin?module=coupon&mode=add&type=new"><i class="icon-angle-right"></i> Create Coupons </a></li>
                    <li><a href="/shoppo-admin?module=coupon&mode=view&type=all"><i class="icon-angle-right"></i> View Coupons </a></li>
                    <li><a href="/shoppo-admin?module=coupon&mode=linking&type=new"><i class="icon-angle-right"></i> Link Coupon to Category </a></li>
                    <li><a href="/shoppo-admin?module=coupon&mode=manage&type=admin"><i class="icon-angle-right"></i> Manage Coupons </a></li>
                </ul>
            </li> -->
            <li class="panel">
                <a href="#" data-parent="#menu" data-toggle="collapse" class="accordion-toggle collapsed" data-target="#user-nav">
                    <i class="icon-group"></i> Users
                    <span class="pull-right">
                        <i class="icon-angle-left"></i>
                    </span>
                    <!-- &nbsp; <span class="label label-success">5</span>&nbsp; -->
                </a>
                <ul class="collapse" id="user-nav">
                    <li class=""><a href="/shoppo-admin?module=user&mode=add&type=new"><i class="icon-angle-right"></i> Add User Manually </a></li>
                    <li class="">
                    	<a href="#" data-parent="#user-nav" data-toggle="collapse" class="accordion-toggle" data-target="#user-view-nav">
                    		<i class="icon-angle-right"></i> View Users
                    		<span class="pull-right" style="margin-right: 20px;">
		                        <i class="icon-angle-left"></i>
		                    </span>
                    	</a>
                    	<ul class="collapse" id="user-view-nav">
                    		<li><a href="/shoppo-admin?module=user-view&mode=single&type=pending"><i class="icon-angle-right"></i> By User Details </a></li>
                            <li><a href="/shoppo-admin?module=user-view&mode=list&type=pending"><i class="icon-angle-right"></i> By List </a></li>
                        </ul>
                    </li>
                    <li class=""><a href="/shoppo-admin?module=user&mode=manage&type=admin"><i class="icon-angle-right"></i> Manage </a></li>
                </ul>
            </li>
            <li class="panel">
                <a href="#" data-parent="#menu" data-toggle="collapse" class="accordion-toggle collapsed" data-target="#wishlist-nav">
                    <i class="icon-bitbucket"></i> Wishlist
                    <span class="pull-right">
                        <i class="icon-angle-left"></i>
                    </span>
                    <!-- &nbsp; <span class="label label-success">5</span>&nbsp; -->
                </a>
                <ul class="collapse" id="wishlist-nav">
                    <li class=""><a href="/shoppo-admin?module=wishlist&mode=add&type=new"><i class="icon-angle-right"></i> Add Item Manually </a></li>
                    <li class="">
                    	<a href="#" data-parent="#wishlist-nav" data-toggle="collapse" class="accordion-toggle" data-target="#wishlist-view-nav">
                    		<i class="icon-angle-right"></i> View Wishlist
                    		<span class="pull-right" style="margin-right: 20px;">
		                        <i class="icon-angle-left"></i>
		                    </span>
                    	</a>
                    	<ul class="collapse" id="wishlist-view-nav">
                    		<li><a href="/shoppo-admin?module=wishlist-view&mode=single&type=pending"><i class="icon-angle-right"></i> By User Details </a></li>
                            <li><a href="/shoppo-admin?module=wishlist-view&mode=list&type=pending"><i class="icon-angle-right"></i> By List </a></li>
                        </ul>
                    </li>
                    <li class=""><a href="/shoppo-admin?module=wishlist&mode=manage&type=admin"><i class="icon-angle-right"></i> Manage </a></li>
                </ul>
            </li>
            <li class="panel">
                <a href="#" data-parent="#menu" data-toggle="collapse" class="accordion-toggle collapsed" data-target="#review-nav">
                    <i class="icon-star-empty"></i> Reviews & Ratings
                    <span class="pull-right">
                        <i class="icon-angle-left"></i>
                    </span>
                    <!-- &nbsp; <span class="label label-success">5</span>&nbsp; -->
                </a>
                <ul class="collapse" id="review-nav">
                    <li class=""><a href="/shoppo-admin?module=review&mode=add&type=new"><i class="icon-angle-right"></i> Add review Manually </a></li>
                    <li class="">
                    	<a href="#" data-parent="#review-nav" data-toggle="collapse" class="accordion-toggle" data-target="#review-view-nav">
                    		<i class="icon-angle-right"></i> View Reviews
                    		<span class="pull-right" style="margin-right: 20px;">
		                        <i class="icon-angle-left"></i>
		                    </span>
                    	</a>
                    	<ul class="collapse" id="review-view-nav">
                    		<li class="">
	                    		<a href="#" data-parent="#review-view-nav" data-toggle="collapse" class="accordion-toggle" data-target="#review-view-pending-nav">
	                    			<i class="icon-angle-right"></i> Un-approved Reviews
									<span class="pull-right" style="margin-right: 20px;">
				                        <i class="icon-angle-left"></i>
				                    </span>
	                    		</a>
								<ul class="collapse" id="review-view-pending-nav">
									<li><a href="/shoppo-admin?module=review-view&mode=single&type=pending"><i class="icon-angle-right"></i> By Product </a></li>
		                            <li><a href="/shoppo-admin?module=review-view&mode=center&type=pending"><i class="icon-angle-right"></i> By Vendor </a></li>
		                            <li><a href="/shoppo-admin?module=review-view&mode=user&type=pending"><i class="icon-angle-right"></i> By User </a></li>
		                            <li><a href="/shoppo-admin?module=review-view&mode=list&type=pending"><i class="icon-angle-right"></i> By List </a></li>
								</ul>
                    		</li>
                    		<li class="">
	                    		<a href="#" data-parent="#review-nav" data-toggle="collapse" class="accordion-toggle" data-target="#review-view-canceled-nav">
	                    			<i class="icon-angle-right"></i> Denied reviews
									<span class="pull-right" style="margin-right: 20px;">
				                        <i class="icon-angle-left"></i>
				                    </span>
	                    		</a>
								<ul class="collapse" id="review-view-canceled-nav">
									<li><a href="/shoppo-admin?module=review-view&mode=single&type=canceled"><i class="icon-angle-right"></i> By Product </a></li>
		                            <li><a href="/shoppo-admin?module=review-view&mode=center&type=canceled"><i class="icon-angle-right"></i> By Vendor </a></li>
		                            <li><a href="/shoppo-admin?module=review-view&mode=user&type=canceled"><i class="icon-angle-right"></i> By User </a></li>
		                            <li><a href="/shoppo-admin?module=review-view&mode=list&type=canceled"><i class="icon-angle-right"></i> By List </a></li>
								</ul>
                    		</li>
                    		<li class="">
	                    		<a href="#" data-parent="#review-nav" data-toggle="collapse" class="accordion-toggle" data-target="#review-view-approved-nav">
	                    			<i class="icon-angle-right"></i> Approved reviews
									<span class="pull-right" style="margin-right: 20px;">
				                        <i class="icon-angle-left"></i>
				                    </span>
	                    		</a>
								<ul class="collapse" id="review-view-approved-nav">
									<li><a href="/shoppo-admin?module=review-view&mode=single&type=approved"><i class="icon-angle-right"></i> By Product </a></li>
		                            <li><a href="/shoppo-admin?module=review-view&mode=center&type=approved"><i class="icon-angle-right"></i> By Vendor </a></li>
		                            <li><a href="/shoppo-admin?module=review-view&mode=user&type=approved"><i class="icon-angle-right"></i> By User </a></li>
		                            <li><a href="/shoppo-admin?module=review-view&mode=list&type=approved"><i class="icon-angle-right"></i> By List </a></li>
								</ul>
                    		</li>
                        </ul>
                    </li>
                    <li class=""><a href="/shoppo-admin?module=review&mode=manage&type=admin"><i class="icon-angle-right"></i> Manage </a></li>
                </ul>
            </li>
            <li class="panel">
                <a href="#" data-parent="#menu" data-toggle="collapse" class="accordion-toggle collapsed" data-target="#payment-nav">
                    <i class="icon-credit-card"></i> Payments
                    <span class="pull-right">
                        <i class="icon-angle-left"></i>
                    </span>
                    <!-- &nbsp; <span class="label label-success">5</span>&nbsp; -->
                </a>
                <ul class="collapse" id="payment-nav">
                    <li class=""><a href="/shoppo-admin?module=payment&mode=add&type=new"><i class="icon-angle-right"></i> Add Payment Manually </a></li>
                    <li class="">
                    	<a href="#" data-parent="#payment-nav" data-toggle="collapse" class="accordion-toggle" data-target="#payment-view-nav">
                    		<i class="icon-angle-right"></i> View Payments
                    		<span class="pull-right" style="margin-right: 20px;">
		                        <i class="icon-angle-left"></i>
		                    </span>
                    	</a>
                    	<ul class="collapse" id="payment-view-nav">
                    		<li class="">
	                    		<a href="#" data-parent="#payment-view-nav" data-toggle="collapse" class="accordion-toggle" data-target="#payment-view-order-nav">
	                    			<i class="icon-angle-right"></i> For Order
									<span class="pull-right" style="margin-right: 20px;">
				                        <i class="icon-angle-left"></i>
				                    </span>
	                    		</a>
								<ul class="collapse" id="payment-view-order-nav">
									<li><a href="/shoppo-admin?module=payment-view&mode=single&type=order"><i class="icon-angle-right"></i> By Order </a></li>
		                            <li><a href="/shoppo-admin?module=payment-view&mode=center&type=order"><i class="icon-angle-right"></i> By Vendor </a></li>
		                            <li><a href="/shoppo-admin?module=payment-view&mode=user&type=order"><i class="icon-angle-right"></i> By User </a></li>
		                            <li><a href="/shoppo-admin?module=payment-view&mode=list&type=order"><i class="icon-angle-right"></i> By List </a></li>
								</ul>
                    		</li>
                    		<li class="">
	                    		<a href="#" data-parent="#payment-nav" data-toggle="collapse" class="accordion-toggle" data-target="#payment-view-wallet-nav">
	                    			<i class="icon-angle-right"></i> For Wallet
									<span class="pull-right" style="margin-right: 20px;">
				                        <i class="icon-angle-left"></i>
				                    </span>
	                    		</a>
								<ul class="collapse" id="payment-view-wallet-nav">
		                            <li><a href="/shoppo-admin?module=payment-view&mode=user&type=wallet"><i class="icon-angle-right"></i> By User </a></li>
		                            <li><a href="/shoppo-admin?module=payment-view&mode=list&type=wallet"><i class="icon-angle-right"></i> By List </a></li>
								</ul>
                    		</li>
                        </ul>
                    </li>
                    <li class=""><a href="/shoppo-admin?module=payment&mode=manage&type=admin"><i class="icon-angle-right"></i> Manage </a></li>
                </ul>
            </li>
            <li class="panel">
                <a href="#" data-parent="#menu" data-toggle="collapse" class="accordion-toggle collapsed" data-target="#expense-nav">
                    <i class="icon-inr"></i> Expenses
                    <span class="pull-right">
                        <i class="icon-angle-left"></i>
                    </span>
                    <!-- &nbsp; <span class="label label-success">5</span>&nbsp; -->
                </a>
                <ul class="collapse" id="expense-nav">
                    <li class=""><a href="/shoppo-admin?module=expense&mode=add&type=new"><i class="icon-angle-right"></i> Add expense Manually </a></li>
                    <li class="">
                    	<a href="#" data-parent="#expense-nav" data-toggle="collapse" class="accordion-toggle" data-target="#expense-view-nav">
                    		<i class="icon-angle-right"></i> View Expenses
                    		<span class="pull-right" style="margin-right: 20px;">
		                        <i class="icon-angle-left"></i>
		                    </span>
                    	</a>
                    	<ul class="collapse" id="expense-view-nav">
                    		<li class="">
	                    		<a href="#" data-parent="#expense-view-nav" data-toggle="collapse" class="accordion-toggle" data-target="#expense-view-shipper-nav">
	                    			<i class="icon-angle-right"></i> For Shipper
									<span class="pull-right" style="margin-right: 20px;">
				                        <i class="icon-angle-left"></i>
				                    </span>
	                    		</a>
								<ul class="collapse" id="expense-view-shipper-nav">
									<li><a href="/shoppo-admin?module=expense-view&mode=single&type=shipper"><i class="icon-angle-right"></i> By Order </a></li>
		                            <li><a href="/shoppo-admin?module=expense-view&mode=center&type=shipper"><i class="icon-angle-right"></i> By Vendor </a></li>
		                            <li><a href="/shoppo-admin?module=expense-view&mode=user&type=shipper"><i class="icon-angle-right"></i> By User </a></li>
		                            <li><a href="/shoppo-admin?module=expense-view&mode=list&type=shipper"><i class="icon-angle-right"></i> By List </a></li>
								</ul>
                    		</li>
                    		<li class="">
	                    		<a href="#" data-parent="#expense-nav" data-toggle="collapse" class="accordion-toggle" data-target="#expense-view-vendor-nav">
	                    			<i class="icon-angle-right"></i> For Vendor
									<span class="pull-right" style="margin-right: 20px;">
				                        <i class="icon-angle-left"></i>
				                    </span>
	                    		</a>
								<ul class="collapse" id="expense-view-vendor-nav">
		                            <li><a href="/shoppo-admin?module=expense-view&mode=single&type=vendor"><i class="icon-angle-right"></i> By Order </a></li>
		                            <li><a href="/shoppo-admin?module=expense-view&mode=center&type=vendor"><i class="icon-angle-right"></i> By Vendor </a></li>
		                            <li><a href="/shoppo-admin?module=expense-view&mode=user&type=vendor"><i class="icon-angle-right"></i> By User </a></li>
		                            <li><a href="/shoppo-admin?module=expense-view&mode=list&type=vendor"><i class="icon-angle-right"></i> By List </a></li>
								</ul>
                    		</li>
                    		<li class=""><a href="/shoppo-admin?module=expense-view&mode=all&type=other"><i class="icon-angle-right"></i> Other Expenses </a></li>
                        </ul>
                    </li>
                    <li class=""><a href="/shoppo-admin?module=expense&mode=manage&type=admin"><i class="icon-angle-right"></i> Manage </a></li>
                </ul>
            </li>
            <li class="panel">
                <a href="#" data-parent="#menu" data-toggle="collapse" class="accordion-toggle collapsed" data-target="#shipment-nav">
                    <i class="icon-truck"></i> Shipments
                    <span class="pull-right">
                        <i class="icon-angle-left"></i>
                    </span>
                    <!-- &nbsp; <span class="label label-success">5</span>&nbsp; -->
                </a>
                <ul class="collapse" id="shipment-nav">
                    <li class=""><a href="/shoppo-admin?module=shipment&mode=add&type=new"><i class="icon-angle-right"></i> Add Shipment Manually </a></li>
                    <li class=""><a href="/shoppo-admin?module=shipment&mode=add-shipper&type=new"><i class="icon-angle-right"></i> Add New Shipper </a></li>
                    <li class=""><a href="/shoppo-admin?module=shipment&mode=assign-shipper&type=new"><i class="icon-angle-right"></i> Assign Shipper to Pincode </a></li>
                    <li class="">
                		<a href="#" data-parent="#shipment-nav" data-toggle="collapse" class="accordion-toggle" data-target="#shipment-slab-nav">
                			<i class="icon-angle-right"></i> Cost Slabs
							<span class="pull-right" style="margin-right: 20px;">
		                        <i class="icon-angle-left"></i>
		                    </span>
                		</a>
						<ul class="collapse" id="shipment-slab-nav">
							<li><a href="/shoppo-admin?module=shipment-slab&mode=add&type=new"><i class="icon-angle-right"></i> Add New </a></li>
							<li><a href="/shoppo-admin?module=shipment-slab&mode=view&type=shiper"><i class="icon-angle-right"></i> View By Shipper </a></li>
                            <li><a href="/shoppo-admin?module=shipment-slab&mode=view&type=city"><i class="icon-angle-right"></i> By City </a></li>
                            <li><a href="/shoppo-admin?module=shipment-slab&mode=view&type=master"><i class="icon-angle-right"></i> By Product Master </a></li>
						</ul>
            		</li>
                    <li class="">
                    	<a href="#" data-parent="#shipment-nav" data-toggle="collapse" class="accordion-toggle" data-target="#shipment-view-nav">
                    		<i class="icon-angle-right"></i> View Shipments
                    		<span class="pull-right" style="margin-right: 20px;">
		                        <i class="icon-angle-left"></i>
		                    </span>
                    	</a>
                    	<ul class="collapse" id="shipment-view-nav">
                    		<li class="">
	                    		<a href="#" data-parent="#shipment-view-nav" data-toggle="collapse" class="accordion-toggle" data-target="#shipment-view-order-nav">
	                    			<i class="icon-angle-right"></i> For Order
									<span class="pull-right" style="margin-right: 20px;">
				                        <i class="icon-angle-left"></i>
				                    </span>
	                    		</a>
								<ul class="collapse" id="shipment-view-order-nav">
									<li><a href="/shoppo-admin?module=shipment-view&mode=single&type=order"><i class="icon-angle-right"></i> By Order </a></li>
		                            <li><a href="/shoppo-admin?module=shipment-view&mode=center&type=order"><i class="icon-angle-right"></i> By Vendor </a></li>
		                            <li><a href="/shoppo-admin?module=shipment-view&mode=user&type=order"><i class="icon-angle-right"></i> By User </a></li>
		                            <li><a href="/shoppo-admin?module=shipment-view&mode=list&type=order"><i class="icon-angle-right"></i> By List </a></li>
								</ul>
                    		</li>
                    		<li class="">
	                    		<a href="#" data-parent="#shipment-nav" data-toggle="collapse" class="accordion-toggle" data-target="#shipment-view-return-nav">
	                    			<i class="icon-angle-right"></i> For Return
									<span class="pull-right" style="margin-right: 20px;">
				                        <i class="icon-angle-left"></i>
				                    </span>
	                    		</a>
								<ul class="collapse" id="shipment-view-return-nav">
		                            <li><a href="/shoppo-admin?module=shipment-view&mode=single&type=return"><i class="icon-angle-right"></i> By Order </a></li>
		                            <li><a href="/shoppo-admin?module=shipment-view&mode=center&type=return"><i class="icon-angle-right"></i> By Vendor </a></li>
		                            <li><a href="/shoppo-admin?module=shipment-view&mode=user&type=return"><i class="icon-angle-right"></i> By User </a></li>
		                            <li><a href="/shoppo-admin?module=shipment-view&mode=list&type=return"><i class="icon-angle-right"></i> By List </a></li>
								</ul>
                    		</li>
                        </ul>
                    </li>
                    <li class=""><a href="/shoppo-admin?module=shipment&mode=manage&type=admin"><i class="icon-angle-right"></i> Manage </a></li>
                </ul>
            </li>
            <li class="panel">
                <a href="#" data-parent="#menu" data-toggle="collapse" class="accordion-toggle collapsed" data-target="#newsletter-nav">
                    <i class="icon-bell"></i> Newsletter
                    <span class="pull-right">
                        <i class="icon-angle-left"></i>
                    </span>
                    <!-- &nbsp; <span class="label label-success">5</span>&nbsp; -->
                </a>
                <ul class="collapse" id="newsletter-nav">
                    <li class=""><a href="/shoppo-admin?module=newsletter&mode=add&type=new"><i class="icon-angle-right"></i> Send New </a></li>
                    <li class=""><a href="/shoppo-admin?module=newsletter&mode=view&type=all"><i class="icon-angle-right"></i> View Newsletters </a></li>
                    <li class=""><a href="/shoppo-admin?module=newsletter&mode=add-subscriber&type=new"><i class="icon-angle-right"></i> Add Subscribers </a></li>
                    <li class=""><a href="/shoppo-admin?module=newsletter&mode=view-subscribers&type=all"><i class="icon-angle-right"></i> View Subscribers </a></li>
                    <li class=""><a href="/shoppo-admin?module=newsletter&mode=manage&type=admin"><i class="icon-angle-right"></i> Manage </a></li>
                </ul>
            </li>
            <li class="panel">
                <a href="#" data-parent="#menu" data-toggle="collapse" class="accordion-toggle collapsed" data-target="#message-nav">
                    <i class="icon-envelope-alt"></i> Messages
                    <span class="pull-right">
                        <i class="icon-angle-left"></i>
                    </span>
                    <!-- &nbsp; <span class="label label-success">5</span>&nbsp; -->
                </a>
                <ul class="collapse" id="message-nav">
                    <li class="">
						<a href="#" data-parent="#message-nav" data-toggle="collapse" class="accordion-toggle" data-target="#message-sms-nav">
                    		<i class="icon-angle-right"></i> SMS
                    		<span class="pull-right" style="margin-right: 20px;">
		                        <i class="icon-angle-left"></i>
		                    </span>
                    	</a>
                    	<ul class="collapse" id="message-sms-nav">
                    		<li><a href="/shoppo-admin?module=message-sms&mode=send&type=new"><i class="icon-angle-right"></i> Send Manually </a></li>
                            <li><a href="/shoppo-admin?module=message-sms&mode=view&type=user"><i class="icon-angle-right"></i> View By User </a></li>
                            <li><a href="/shoppo-admin?module=message-sms&mode=view&type=all"><i class="icon-angle-right"></i> View List </a></li>
                        </ul>
                    </li>
                    <li class="">
                    	<a href="#" data-parent="#message-nav" data-toggle="collapse" class="accordion-toggle" data-target="#message-email-nav">
                    		<i class="icon-angle-right"></i> Email
                    		<span class="pull-right" style="margin-right: 20px;">
		                        <i class="icon-angle-left"></i>
		                    </span>
                    	</a>
                    	<ul class="collapse" id="message-email-nav">
                    		<li><a href="/shoppo-admin?module=message-email&mode=send&type=new"><i class="icon-angle-right"></i> Send Manually </a></li>
                            <li><a href="/shoppo-admin?module=message-email&mode=view&type=user"><i class="icon-angle-right"></i> View By User </a></li>
                            <li><a href="/shoppo-admin?module=message-email&mode=view&type=all"><i class="icon-angle-right"></i> View List </a></li>
                        </ul>
                    </li>
                    <li class=""><a href="/shoppo-admin?module=message&mode=manage&type=admin"><i class="icon-angle-right"></i> Manage </a></li>
                </ul>
            </li>
            <li class="panel">
                <a href="#" data-parent="#menu" data-toggle="collapse" class="accordion-toggle collapsed" data-target="#categories-nav">
                    <i class="icon-list-alt"></i> Menu & Categories
                    <span class="pull-right">
                        <i class="icon-angle-left"></i>
                    </span>
                    <!-- &nbsp; <span class="label label-info">6</span>&nbsp; -->
                </a>
                <ul class="collapse" id="categories-nav">
                    <li><a href="/shoppo-admin?module=categories&mode=add&type=new"><i class="icon-angle-right"></i> Add Category </a></li>
                    <li><a href="/shoppo-admin?module=categories&mode=view&type="><i class="icon-angle-right"></i> View Categories </a></li>
                    <li><a href="/shoppo-admin?module=categories&mode=footer-add&type=new"><i class="icon-angle-right"></i> Add Bottom Menu </a></li>
                    <li><a href="/shoppo-admin?module=categories&mode=footer-view&type=all"><i class="icon-angle-right"></i> View Bottom Menus </a></li>
                </ul>
            </li>
            <li class="panel">
                <a href="#" data-parent="#menu" data-toggle="collapse" class="accordion-toggle" data-target="#taxation">
                    <i class="icon-gift"></i> Taxation
                    <span class="pull-right">
                        <i class="icon-angle-left"></i>
                    </span>
                    <!-- &nbsp; <span class="label label-danger">4</span>&nbsp; -->
                </a>
                <ul class="collapse" id="taxation">
                    <li><a href="/shoppo-admin?module=taxation&mode=add&type=new"><i class="icon-angle-right"></i> Add Tax Slab </a></li>
                    <li><a href="/shoppo-admin?module=taxation&mode=view&type=category"><i class="icon-angle-right"></i> View Category-wise </a></li>
                    <li><a href="/shoppo-admin?module=taxation&mode=view&type=product"><i class="icon-angle-right"></i> View Product-wise </a></li>
                </ul>
            </li>
            <li class="panel"><a href="/shoppo-admin?module=site&mode=setting&type=admin" id="site"><i class="icon-cog"></i> Setting </a></li>
            <li class="panel">
                <a href="#" data-parent="#menu" data-toggle="collapse" class="accordion-toggle collapsed" data-target="#log-nav">
                    <i class="icon-book"></i> Log Book
                    <span class="pull-right">
                        <i class="icon-angle-left"></i>
                    </span>
                    <!-- &nbsp; <span class="label label-success">5</span>&nbsp; -->
                </a>
                <ul class="collapse" id="log-nav">
                    <li class=""><a href="/shoppo-admin?module=log&mode=events&type=all"><i class="icon-angle-right"></i> Events </a></li>
                    <li class=""><a href="/shoppo-admin?module=log&mode=logins&type=all"><i class="icon-angle-right"></i> Login Attempts </a></li>
                    <li class=""><a href="/shoppo-admin?module=log&mode=invalid-logins-shipper&type=all"><i class="icon-angle-right"></i> Invalid Logins </a></li>
                    <li class=""><a href="/shoppo-admin?module=log&mode=manage&type=admin"><i class="icon-angle-right"></i> Manage </a></li>
                </ul>
            </li>
            <li class="panel">
                <a href="#" data-parent="#menu" data-toggle="collapse" class="accordion-toggle collapsed" data-target="#designation-nav">
                    <i class="icon-th-list"></i> Level Designations
                    <span class="pull-right">
                        <i class="icon-angle-left"></i>
                    </span>
                    <!-- &nbsp; <span class="label label-success">5</span>&nbsp; -->
                </a>
                <ul class="collapse" id="designation-nav">
                    <li class=""><a href="/shoppo-admin?module=designation&mode=add&type=new"><i class="icon-angle-right"></i> Add New </a></li>
                    <li class=""><a href="/shoppo-admin?module=designation&mode=view&type=all"><i class="icon-angle-right"></i> View All </a></li>
                    <li class=""><a href="/shoppo-admin?module=log&mode=manage&type=admin"><i class="icon-angle-right"></i> Manage </a></li>
                </ul>
            </li>
            <li class="panel">
                <a href="#" data-parent="#menu" data-toggle="collapse" class="accordion-toggle collapsed" data-target="#ticket-nav">
                    <i class="icon-envelope-alt"></i> Tickets & Queries
                    <span class="pull-right">
                        <i class="icon-angle-left"></i>
                    </span>
                    <!-- &nbsp; <span class="label label-success">5</span>&nbsp; -->
                </a>
                <ul class="collapse" id="ticket-nav">
                    <li class="">
						<a href="#" data-parent="#ticket-nav" data-toggle="collapse" class="accordion-toggle" data-target="#ticket-user-nav">
                    		<i class="icon-angle-right"></i> From Users
                    		<span class="pull-right" style="margin-right: 20px;">
		                        <i class="icon-angle-left"></i>
		                    </span>
                    	</a>
                    	<ul class="collapse" id="ticket-user-nav">
                    		<li><a href="/shoppo-admin?module=ticket-user&mode=contact&type=new"><i class="icon-angle-right"></i> New Contacts </a></li>
                    		<li><a href="/shoppo-admin?module=ticket-user&mode=contact&type=previous"><i class="icon-angle-right"></i> Previous Contact </a></li>
                            <li><a href="/shoppo-admin?module=ticket-user&mode=complaint&type=new"><i class="icon-angle-right"></i> New Ticket </a></li>
                            <li><a href="/shoppo-admin?module=ticket-user&mode=complaint&type=previous"><i class="icon-angle-right"></i> Previous Ticket </a></li>
                        </ul>
                    </li>
                    <li class="">
                    	<a href="#" data-parent="#ticket-nav" data-toggle="collapse" class="accordion-toggle" data-target="#ticket-vendor-nav">
                    		<i class="icon-angle-right"></i> From Vendors
                    		<span class="pull-right" style="margin-right: 20px;">
		                        <i class="icon-angle-left"></i>
		                    </span>
                    	</a>
                    	<ul class="collapse" id="ticket-vendor-nav">
                    		<li><a href="/shoppo-admin?module=ticket-vendor&mode=contact&type=new"><i class="icon-angle-right"></i> New Contacts </a></li>
                    		<li><a href="/shoppo-admin?module=ticket-vendor&mode=contact&type=previous"><i class="icon-angle-right"></i> Previous Contact </a></li>
                            <li><a href="/shoppo-admin?module=ticket-vendor&mode=complaint&type=new"><i class="icon-angle-right"></i> New Ticket </a></li>
                            <li><a href="/shoppo-admin?module=ticket-vendor&mode=complaint&type=previous"><i class="icon-angle-right"></i> Previous Ticket </a></li>
                        </ul>
                    </li>
                    <li class=""><a href="/shoppo-admin?module=ticket&mode=manage&type=admin"><i class="icon-angle-right"></i> Manage </a></li>
                </ul>
            </li>
        </ul>
    </div>
	<?php
}

function pageFooter($page = ''){
    ?>
	<div id="footer">
        <p> <?php echo  CLIENT_COMPANY. ' | &copy;  <a href="http://www.bestwebs.in/shoppo" alt="BestWebs">SHOPPO</a> &nbsp; '.date('Y').' &nbsp;</p>'; ?>
    </div>
    <?php
}

function PageJsInclude($page = ''){
	?>
	<!-- GLOBAL SCRIPTS -->
    <script src="<?php echo CDN_ADMIN; ?>/plugins/jquery-2.0.3.min.js"></script>
    <script src="<?php echo CDN_ADMIN; ?>/plugins/bootstrap/js/bootstrap.min.js"></script>
    <script src="<?php echo CDN_ADMIN; ?>/plugins/modernizr-2.6.2-respond-1.1.0.min.js"></script>
    <!-- END GLOBAL SCRIPTS -->
	<!-- ADD PRODUCT PAGE LEVEL SCRIPT-->
	<script src="<?php echo CDN_ADMIN; ?>/js/jquery-ui.min.js"></script>
	<script src="<?php echo CDN_ADMIN; ?>/plugins/uniform/jquery.uniform.min.js"></script>
	<script src="<?php echo CDN_ADMIN; ?>/plugins/inputlimiter/jquery.inputlimiter.1.3.1.min.js"></script>
	<script src="<?php echo CDN_ADMIN; ?>/plugins/chosen/chosen.jquery.min.js"></script>
	<script src="<?php echo CDN_ADMIN; ?>/plugins/colorpicker/js/bootstrap-colorpicker.js"></script>
	<script src="<?php echo CDN_ADMIN; ?>/plugins/tagsinput/jquery.tagsinput.min.js"></script>
	<script src="<?php echo CDN_ADMIN; ?>/plugins/validVal/js/jquery.validVal.min.js"></script>
	<script src="<?php echo CDN_ADMIN; ?>/plugins/daterangepicker/daterangepicker.js"></script>
	<script src="<?php echo CDN_ADMIN; ?>/plugins/daterangepicker/moment.min.js"></script>
	<script src="<?php echo CDN_ADMIN; ?>/plugins/datepicker/js/bootstrap-datepicker.js"></script>
	<script src="<?php echo CDN_ADMIN; ?>/plugins/timepicker/js/bootstrap-timepicker.min.js"></script>
	<script src="<?php echo CDN_ADMIN; ?>/plugins/switch/static/js/bootstrap-switch.min.js"></script>
	<script src="<?php echo CDN_ADMIN; ?>/plugins/jquery.dualListbox-1.3/jquery.dualListBox-1.3.min.js"></script>
	<script src="<?php echo CDN_ADMIN; ?>/plugins/autosize/jquery.autosize.min.js"></script>
	<script src="<?php echo CDN_ADMIN; ?>/plugins/jasny/js/bootstrap-inputmask.js"></script>
    <script src="<?php echo CDN_ADMIN; ?>/js/formsInit.js"></script>
    <script>
        $(function () { formInit(); });
    </script>
    <!--END ADD PRODUCT PAGE LEVEL SCRIPT-->
    <!-- PAGE LEVEL SCRIPTS -->
    <script src="<?php echo CDN_ADMIN; ?>/plugins/dataTables/jquery.dataTables.js"></script>
    <script src="<?php echo CDN_ADMIN; ?>/plugins/dataTables/dataTables.bootstrap.js"></script>
    <script>
         $(document).ready(function () {
             $('#table').dataTable();
         });
    </script>
    <!-- DATA TABLE PAGE LEVEL SCRIPTS -->
	<?php
}