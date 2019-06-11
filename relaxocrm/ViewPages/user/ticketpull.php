<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
    <meta charset="UTF-8" />
    <title>  <?php echo CLIENT_TITLE; ?> Complaint Ticket Tracking </title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <meta content="Complaint Ticket Tracking" name="description" />
    <meta content="http://www.bestwebs.in/santosh" name="author" />
    <META NAME="ROBOTS" CONTENT="INDEX, FOLLOW">
     <!--[if IE]>
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <![endif]-->
    <!-- GLOBAL STYLES -->
    <link rel="stylesheet" href="<?php echo CDN_CSS; ?>/bootstrap.min.css?BestWebs.v.2.2" />
    <link rel="stylesheet" href="<?php echo CDN_ADMIN; ?>/plugins/Font-Awesome/css/font-awesome.css?BestWebs.v.2.2" />
    <link rel="stylesheet" href="<?php echo CDN_ADMIN; ?>/css/main.css?BestWebs.v.2.2" />
    <link rel="stylesheet" href="<?php echo CDN_ADMIN; ?>/css/theme.css?BestWebs.v.2.2" />
    <link rel="stylesheet" href="<?php echo CDN_ADMIN; ?>/css/MoneAdmin.css?BestWebs.v.2.2" />
    <link rel="stylesheet" href="<?php echo CDN_ADMIN; ?>/plugins/timeline/timeline.css" />
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
</head>
    <!-- BEGIN BODY -->
<body >
    <!-- MAIN WRAPPER -->
    <div id="wrap">
        <!--PAGE CONTENT -->
        <div id="content" style="margin:0;width: 100%;">
            <div class="inner" style="min-height: 100%;padding-top: 50px;">
                <div class="row">
                    <div class="col-sm-offset-1 col-sm-5">
                        <h2 style="margin-top: 0;"> Complaint Tracking </h2>
                    </div>
                    <div class="col-sm-5">
                        <form class="ajax-form" action="" method="post" id="checkTicket" enctype="multipart/form-data">
                            <div class="form-group input-group">
                                <div class="col-xs-9">
                                    <input type="text" class="form-control" name="id" placeholder="Enter Ticket Number" id="ticket" required="" minlength="8" maxlength="15" pattern="[A-Za-z0-9]{8,15}" />
                                </div>
                                <input type="hidden" name="process" value="checkTicket">
                                <div class="col-xs-3">
                                    <button class="btn btn-success" type="submit">Check</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <hr />
                <div class="row" id="ticketDetail">
                    <div class="col-sm-offset-1 col-sm-10">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <i class="icon-list"></i> First Enter Complaint Ticket Number above
                            </div>
                            <div class="panel-body">
                                <ul class="timeline"></ul>
                                <center id="ticketStatus"></center>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--END PAGE CONTENT -->
    </div>
    <div id="footer" class="noprint">
        <p> <?php echo CLIENT_COMPANY; ?> | &copy;  <a target="_blank" href="http://www.RealKeeper.in" alt="RealKeeper">RealKeeper</a> &nbsp; 2018 &nbsp;</p>
    </div>
    <template id="detailTemp">
        <li>
            <div class="timeline-badge">
                <i class=" icon-pencil"></i>
            </div>
            <div class="timeline-panel">
                <div class="timeline-heading">
                    <h4 class="timeline-title"><i class="icon-check"></i> Ticket Raised</h4>
                    <p>
                        <small class="text-muted"><span class="open_time"></span></small>
                    </p>
                </div>
                <div class="timeline-body">
                    <p class="ticketIssue"></p>
                </div>
            </div>
        </li>
        <li class="timeline-inverted">
            <div class="timeline-badge primary">
                <i class="icon-external-link"></i>
            </div>
            <div class="timeline-panel">
                <div class="timeline-heading">
                    <h4 class="timeline-title"><i class="icon-check"></i> Forwarded to Service Center</h4>
                </div>
                <div class="timeline-body">
                    <p class="ticketCustomer"></p>
                    <p class="ticketContact"></p>
                    <p class="ticketProduct"></p>
                </div>
            </div>
        </li>
    </template>
    <template id="technicianTemp">
        <li>
            <div class="timeline-badge info">
                <i class="icon-user"></i>
            </div>
            <div class="timeline-panel">
                <div class="timeline-heading">
                    <h4 class="timeline-title"><i class="icon-check"></i> Technician Assigned</h4>
                </div>
                <div class="timeline-body">
                    <p class="ticketTechnicianName"></p>
                    <p class="ticketTechnicianContact"></p>
                </div>
            </div>
        </li>
    </template>
    <script type="text/javascript" src="<?php echo CDN_ADMIN; ?>/plugins/jquery-2.0.3.min.js?BestWebs.v.2.2"></script>
    <script type="text/javascript" src="<?php echo CDN_ADMIN; ?>/plugins/bootstrap/js/bootstrap.min.js?BestWebs.v.2.2"></script>
    <script type="text/javascript" src="<?php echo CDN_ADMIN; ?>/plugins/modernizr-2.6.2-respond-1.1.0.min.js?BestWebs.v.2.2"></script>
    <script type="text/javascript" src="<?php echo CDN_ADMIN; ?>/js/script.js?BestWebs.v.2.2"></script>

</body>
    <!-- END BODY -->
</html>
