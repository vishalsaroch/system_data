﻿<?php
$level = $function->checkLogin();
if ($level < 2) {
    header('Location: /error/404');
    exit;
}
$title = "Welcome to ".CLIENT_TITLE.' Administration ';
PageHead($title);
    ?>
<body class="padTop53 " >
    <div id="wrap" >
        <?php
            PageTopBar();
            PageLeftNavBar(); ?>
        <!--PAGE CONTENT -->
        <div id="content">
            <div class="inner" style="min-height: 700px;">
                <div class="row">
                    <div class="col-lg-12">
                        <h1> Admin Dashboard </h1>
                    </div>
                </div>
                  <hr />
                 <!--BLOCK SECTION -->
                 <div class="row">
                    <div class="col-lg-12">
                        <div style="text-align: center;">
                            <a class="quick-btn" href="#">
                                <i class="icon-check icon-2x"></i>
                                <span> Products</span>
                                <span class="label label-danger">2</span>
                            </a>

                            <a class="quick-btn" href="#">
                                <i class="icon-envelope icon-2x"></i>
                                <span>Messages</span>
                                <span class="label label-success">456</span>
                            </a>
                            <a class="quick-btn" href="#">
                                <i class="icon-signal icon-2x"></i>
                                <span>Profit</span>
                                <span class="label label-warning">+25</span>
                            </a>
                            <a class="quick-btn" href="#">
                                <i class="icon-external-link icon-2x"></i>
                                <span>value</span>
                                <span class="label btn-metis-2">3.14159265</span>
                            </a>
                            <a class="quick-btn" href="#">
                                <i class="icon-lemon icon-2x"></i>
                                <span>tasks</span>
                                <span class="label btn-metis-4">107</span>
                            </a>
                            <a class="quick-btn" href="#">
                                <i class="icon-bolt icon-2x"></i>
                                <span>Tickets</span>
                                <span class="label label-default">20</span>
                            </a>



                        </div>

                    </div>

                </div>
                  <!--END BLOCK SECTION -->
                <hr />
                   <!-- CHART & CHAT  SECTION -->
                 <div class="row">
                    <div class="col-lg-8">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                Real Time Traffic
                            </div>


			<div class="demo-container">
			<div id="placeholderRT" class="demo-placeholder"></div>
		</div>

                        </div>

                    </div>


                     <div class="col-lg-4">

                        <div class="chat-panel panel panel-primary">
                            <div class="panel-heading">
                                <i class="icon-comments"></i>
                                Chat
                            <div class="btn-group pull-right">
                                <button type="button" data-toggle="dropdown">
                                    <i class="icon-chevron-down"></i>
                                </button>
                                <ul class="dropdown-menu slidedown">
                                    <li>
                                        <a href="#">
                                            <i class="icon-refresh"></i> Refresh
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <i class=" icon-comment"></i> Available
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <i class="icon-time"></i> Busy
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <i class="icon-tint"></i> Away
                                        </a>
                                    </li>
                                    <li class="divider"></li>
                                    <li>
                                        <a href="#">
                                            <i class="icon-signout"></i> Sign Out
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            </div>

                            <div class="panel-body">
                                <ul class="chat">
                                    <li class="left clearfix">
                                        <span class="chat-img pull-left">
                                            <img src="/assets/admin/img/1.png" alt="User Avatar" class="img-circle" />
                                        </span>
                                        <div class="chat-body clearfix">
                                            <div class="header">
                                                <strong class="primary-font"> Jack Sparrow </strong>
                                                <small class="pull-right text-muted">
                                                    <i class="icon-time"></i> 12 mins ago
                                                </small>
                                            </div>
                                             <br />
                                            <p>
                                                Lorem ipsum dolor sit amet, bibendum ornare dolor, quis ullamcorper ligula sodales.
                                            </p>
                                        </div>
                                    </li>
                                    <li class="right clearfix">
                                        <span class="chat-img pull-right">
                                            <img src="/assets/admin/img/2.png" alt="User Avatar" class="img-circle" />
                                        </span>
                                        <div class="chat-body clearfix">
                                            <div class="header">
                                                <small class=" text-muted">
                                                    <i class="icon-time"></i> 13 mins ago</small>
                                                <strong class="pull-right primary-font"> Jhony Deen</strong>
                                            </div>
                                            <br />
                                            <p>
                                                Lorem ipsum dolor sit amet, consectetur a dolor, quis ullamcorper ligula sodales.
                                            </p>
                                        </div>
                                    </li>
                                    <li class="left clearfix">
                                        <span class="chat-img pull-left">
                                            <img src="/assets/admin/img/3.png" alt="User Avatar" class="img-circle" />
                                        </span>
                                        <div class="chat-body clearfix">
                                            <div class="header">
                                                <strong class="primary-font"> Jack Sparrow </strong>
                                                <small class="pull-right text-muted">
                                                    <i class="icon-time"></i> 12 mins ago
                                                </small>
                                            </div>
                                             <br />
                                            <p>
                                                Lorem ipsum dolor sit amet, bibendum ornare dolor, quis ullamcorper ligula sodales.
                                            </p>
                                        </div>
                                    </li>
                                    <li class="right clearfix">
                                        <span class="chat-img pull-right">
                                            <img src="/assets/admin/img/4.png" alt="User Avatar" class="img-circle" />
                                        </span>
                                        <div class="chat-body clearfix">
                                            <div class="header">
                                                <small class=" text-muted">
                                                    <i class="icon-time"></i> 13 mins ago</small>
                                                <strong class="pull-right primary-font"> Jhony Deen</strong>
                                            </div>
                                            <br />
                                            <p>
                                                Lorem ipsum dolor sit amet, consectetur a dolor, quis ullamcorper ligula sodales.
                                            </p>
                                        </div>
                                    </li>
                                </ul>
                            </div>

                            <div class="panel-footer">
                                <div class="input-group">
                                    <input id="Text1" type="text" class="form-control input-sm" placeholder="Type your message here..." />
                                    <span class="input-group-btn">
                                        <button class="btn btn-warning btn-sm" id="Button1">
                                            Send
                                        </button>
                                    </span>
                                </div>
                            </div>

                        </div>


                    </div>
                </div>
                 <!--END CHAT & CHAT SECTION -->
                 <!-- COMMENT AND NOTIFICATION  SECTION -->
                <div class="row">
                    <div class="col-lg-7">

                        <div class="chat-panel panel panel-success">
                            <div class="panel-heading">
                                <i class="icon-comments"></i>
                                New Comments

                            </div>

                            <div class="panel-body">
                                <ul class="chat">
                                    <li class="left clearfix">
                                        <span class="chat-img pull-left">
                                            <img src="/assets/admin/img/1.png" alt="User Avatar" class="img-circle" />
                                        </span>
                                        <div class="chat-body clearfix">
                                            <div class="header">
                                                <strong class="primary-font "> Jack Sparrow </strong>
                                                <small class="pull-right text-muted label label-danger">
                                                    <i class="icon-time"></i> 12 mins ago
                                                </small>
                                            </div>
                                             <br />
                                            <p>
                                                Lorem ipsum dolor sit amet, bibendum ornare dolor, quis ullamcorper ligula sodales.
                                            </p>
                                        </div>
                                    </li>
                                    <li class="right clearfix">
                                        <span class="chat-img pull-right">
                                            <img src="/assets/admin/img/2.png" alt="User Avatar" class="img-circle" />
                                        </span>
                                        <div class="chat-body clearfix">
                                            <div class="header">
                                                <small class=" text-muted label label-info">
                                                    <i class="icon-time"></i> 13 mins ago</small>
                                                <strong class="pull-right primary-font"> Jhony Deen</strong>
                                            </div>
                                            <br />
                                            <p>
                                                Lorem ipsum dolor sit amet, consectetur a dolor, quis ullamcorper ligula sodales.
                                            </p>
                                        </div>
                                    </li>
                                    <li class="left clearfix">
                                        <span class="chat-img pull-left">
                                            <img src="/assets/admin/img/3.png" alt="User Avatar" class="img-circle" />
                                        </span>
                                        <div class="chat-body clearfix">
                                            <div class="header">
                                                <strong class="primary-font"> Jack Sparrow </strong>
                                                <small class="pull-right text-muted label label-warning">
                                                    <i class="icon-time"></i> 12 mins ago
                                                </small>
                                            </div>
                                             <br />
                                            <p>
                                                Lorem ipsum dolor sit amet, bibendum ornare dolor, quis ullamcorper ligula sodales.
                                            </p>
                                        </div>
                                    </li>
                                    <li class="right clearfix">
                                        <span class="chat-img pull-right">
                                            <img src="/assets/admin/img/4.png" alt="User Avatar" class="img-circle" />
                                        </span>
                                        <div class="chat-body clearfix">
                                            <div class="header">
                                                <small class=" text-muted label label-primary">
                                                    <i class="icon-time"></i> 13 mins ago</small>
                                                <strong class="pull-right primary-font"> Jhony Deen</strong>
                                            </div>
                                            <br />
                                            <p>
                                                Lorem ipsum dolor sit amet, consectetur a dolor, quis ullamcorper ligula sodales.
                                            </p>
                                        </div>
                                    </li>
                                </ul>
                            </div>

                            <div class="panel-footer">
                                <div class="input-group">
                                    <input id="btn-input" type="text" class="form-control input-sm" placeholder="Type your comment here..." />
                                    <span class="input-group-btn">
                                        <button class="btn btn-success btn-sm" id="btn-chat">
                                            Send
                                        </button>
                                    </span>
                                </div>
                            </div>

                        </div>


                    </div>
                    <div class="col-lg-5">

                       <div class="panel panel-danger">
                            <div class="panel-heading">
                                <i class="icon-bell"></i> Notifications Alerts Panel
                            </div>

                            <div class="panel-body">
                                <div class="list-group">
                                    <a href="#" class="list-group-item">
                                        <i class=" icon-comment"></i> New Comment
                                    <span class="pull-right text-muted small"><em> 4 minutes ago</em>
                                    </span>
                                    </a>
                                    <a href="#" class="list-group-item">
                                        <i class="icon-twitter"></i> 3 New Followers
                                    <span class="pull-right text-muted small"><em> 12 minutes ago</em>
                                    </span>
                                    </a>
                                    <a href="#" class="list-group-item">
                                        <i class="icon-envelope"></i> Message Sent
                                    <span class="pull-right text-muted small"><em> 27 minutes ago</em>
                                    </span>
                                    </a>
                                    <a href="#" class="list-group-item">
                                        <i class="icon-tasks"></i> New Task
                                    <span class="pull-right text-muted small"><em>43 minutes ago</em>
                                    </span>
                                    </a>
                                    <a href="#" class="list-group-item">
                                        <i class="icon-upload"></i> Server Rebooted
                                    <span class="pull-right text-muted small"><em>11:32 AM</em>
                                    </span>
                                    </a>
                                    <a href="#" class="list-group-item">
                                        <i class="icon-warning-sign"></i> Server Crashed!
                                    <span class="pull-right text-muted small"><em>11:13 AM</em>
                                    </span>
                                    </a>

                                    <a href="#" class="list-group-item">
                                        <i class="icon-ok"></i> New Order Placed
                                    <span class="pull-right text-muted small"><em>9:49 AM</em>
                                    </span>
                                    </a>
                                    <a href="#" class="list-group-item">
                                        <i class=" icon-money"></i> Payment Received
                                    <span class="pull-right text-muted small"><em>Yesterday</em>
                                    </span>
                                    </a>
                                </div>

                                <a href="#" class="btn btn-default btn-block btn-primary">View All Alerts</a>
                            </div>

                        </div>



                    </div>
                </div>
                <!-- END COMMENT AND NOTIFICATION  SECTION -->




                 <!--  STACKING CHART  SECTION   -->
                <div class="row">
                   <div class="col-lg-12">
                    <div class="panel panel-default">
                            <div class="panel-heading">
                            Sales   Stacking
                            </div>

                            <div class="panel-body">

			<div class="demo-container">
			<div id="placeholderStack" class="demo-placeholder"></div>
		</div>
                                <p class="stackControls">
			<button class="btn btn-primary" >With stacking</button>
			<button class="btn btn-primary">Without stacking</button>
		</p>

		<p class="graphControls">
			<button class="btn btn-primary">Bars</button>
			<button class="btn btn-primary">Lines</button>
			<button class="btn btn-primary">Lines with steps</button>
		</p>
		</div>

                            </div>
                    </div>

                </div>
                 <!--END STACKING CHART SCETION  -->

                 <!--TABLE, PANEL, ACCORDION AND MODAL  -->
                          <div class="row">
                    <div class="col-lg-6">
                        <div class="box">
                            <header>
                                <h5>Simple Table</h5>
                                <div class="toolbar">
                                    <div class="btn-group">
                                        <a href="#sortableTable" data-toggle="collapse" class="btn btn-default btn-sm accordion-toggle minimize-box">
                                            <i class="icon-chevron-up"></i>
                                        </a>
                                    </div>
                                </div>
                            </header>
                            <div id="sortableTable" class="body collapse in">
                                <table class="table table-bordered sortableTable responsive-table">
                                    <thead>
                                        <tr>
                                            <th>#<i class="icon-sort"></i><i class="icon-sort-down"></i> <i class="icon-sort-up"></i></th>
                                            <th>First Name<i class="icon-sort"></i><i class="icon-sort-down"></i> <i class="icon-sort-up"></i></th>
                                            <th>Last Name<i class="icon-sort"></i><i class="icon-sort-down"></i> <i class="icon-sort-up"></i></th>
                                            <th>Score<i class="icon-sort"></i><i class="icon-sort-down"></i> <i class="icon-sort-up"></i></th>
                                        </tr>
                                    </thead>
                                    <tbody>


                                        <tr>
                                            <td>1</td>
                                            <td>Jill</td>
                                            <td>Smith</td>
                                            <td>50</td>
                                        </tr>

                                        <tr>
                                            <td>2</td>
                                            <td>Eve</td>
                                            <td>Jackson</td>
                                            <td>94</td>
                                        </tr>

                                        <tr>
                                            <td>3</td>
                                            <td>John</td>
                                            <td>Doe</td>
                                            <td>80</td>
                                        </tr>

                                        <tr>
                                            <td>4</td>
                                            <td>Adam</td>
                                            <td>Johnson</td>
                                            <td>67</td>
                                        </tr>


                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="panel panel-primary">
                            <div class="panel-heading ">
                                Collapsible Accordion Panel Group
                            </div>
                            <div class="panel-body">
                                <div class="panel-group" id="accordion">
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <h4 class="panel-title">
                                                <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">Collapsible Group Item #1</a>
                                            </h4>
                                        </div>
                                        <div id="collapseOne" class="panel-collapse collapse in">
                                            <div class="panel-body">
                                                Lorem ipsum dolor sit amet, luaute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <h4 class="panel-title">
                                                <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">Collapsible Group Item #2</a>
                                            </h4>
                                        </div>
                                        <div id="collapseTwo" class="panel-collapse collapse">
                                            <div class="panel-body">
                                                Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <h4 class="panel-title">
                                                <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree">Collapsible Group Item #3</a>
                                            </h4>
                                        </div>
                                        <div id="collapseThree" class="panel-collapse collapse">
                                            <div class="panel-body">
                                                Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                Primary Panel
                            </div>
                            <div class="panel-body">
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum tincidunt est vitae ultrices accumsan. Aliquam ornare lacus adipiscing, posuere lectus et, fringilla augue.</p>
                            </div>
                            <div class="panel-footer">
                                Panel Footer
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                Context Classes
                            </div>
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>First Name</th>
                                                <th>Last Name</th>
                                                <th>Username</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr class="success">
                                                <td>1</td>
                                                <td>Mark</td>
                                                <td>Otto</td>
                                                <td>@mdo</td>
                                            </tr>
                                            <tr class="info">
                                                <td>2</td>
                                                <td>Jacob</td>
                                                <td>Thornton</td>
                                                <td>@fat</td>
                                            </tr>
                                            <tr class="warning">
                                                <td>3</td>
                                                <td>Larry</td>
                                                <td>the Bird</td>
                                                <td>@twitter</td>
                                            </tr>
                                            <tr class="danger">
                                                <td>4</td>
                                                <td>John</td>
                                                <td>Smith</td>
                                                <td>@jsmith</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                Modal Example
                            </div>
                            <div class="panel-body">
                                <button class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal">
                                    Launch Demo Modal
                                </button>
                                <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                <h4 class="modal-title" id="myModalLabel">Modal title</h4>
                                            </div>
                                            <div class="modal-body">
                                                Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                <button type="button" class="btn btn-primary">Save changes</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                 <!--TABLE, PANEL, ACCORDION AND MODAL  -->


            </div>

        </div>
        <!--END PAGE CONTENT -->

         <!-- RIGHT STRIP  SECTION -->
        <div id="right">


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
    </div>
    <!--END MAIN WRAPPER -->
    <?php
        pageFooter();
        PageJsInclude();
    ?>
</body>
    <!-- END BODY -->
</html>
