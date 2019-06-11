<?php if($level < 5){header('Location: /error/404');echo '<script type="text/javascript">window.location = "/error/404"</script>';exit;} $start = 0;
$start = (isset($_GET['start'])) ? $_GET['start'] : 0;
$results = (isset($_GET['results'])) ? $_GET['results'] : 200;
?>
<div class="inner" style="min-height: 700px;">
    <div class="row">
        <div class="col-lg-12">
            <div class="box DARK data-table-box">
                <header>
                    <div class="icons"><i class="icon-list"></i></div>
                    <h5>List Events</h5>
                    <div class="toolbar">
                        <ul class="nav">
                            <li><input class="data-table-filter" type="text" placeholder="Search ..."></li>
                            <li class="dropdown">
                                <a data-toggle="dropdown" class="dropdown-toggle" href="javascript:void(0);">
                                    <i class="icon-th-large"></i> Action
                                </a>
                                <ul class="dropdown-menu dropdown-form-menu">
                                    <form>
                                        <?php
                                            foreach ($_GET as $key=>$value) {
                                                echo "<input type='hidden' name='$key' value='$value'>";
                                            }
                                        ?>
                                        <div class="form-group">
                                            <label>Results Start From</label>
                                            <input type="number" name="start" class="form-control" min="0" value="<?php echo $start; ?>" max="999999" placeholder="From" />
                                        </div>
                                        <div class="form-group">
                                            <label>Number of Results</label>
                                            <input type="number" name="results" class="form-control" min="1" value="<?php echo $results; ?>" max="999999" placeholder="Results" />
                                        </div>
                                        <button type="submit" class="btn btn-success btn-block"><i class="glyphicon glyphicon-ok"></i> Load Data</button>
                                    </form>
                                </ul>
                            </li>
                            <li>
                                <a class="accordion-toggle minimize-box" data-toggle="collapse" href="#box-1">
                                    <i class="icon-chevron-up"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                </header>
                <div id="box-1" class="accordion-body collapse in body">
                    <table id="employees" class="table table-bordered table-striped data-table">
                    <thead>
                      <tr>
                        <th>User</th>
                        <th>Center</th>
                        <th>Time</th>
                        <th>Logout</th>
                        <th>IP</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                            $results = $function->getArray_logins($start, $results);
                            foreach ($results as $result) {
                                if ($result['status'] < 0) {
                                  $status = 'class="danger" title="Login Failed"';
                                }elseif ($result['status'] === '1') {
                                  $status = 'class="success" title="User Logged IN"';
                                }else{
                                  $status = ' title="User Logged out"';
                                }
                                echo '
                                <tr '.$status.'>
                                    <td class="entity-details" data-id="'.$result['user'].'" data-entity="user">
                                        <a href="javascript:void(0);" class="btn-action" data-action="details">'.$result['name'].'</a>
                                    </td>
                                    <td class="entity-details" data-id="'.$result['centerId'].'" data-entity="center">
                                        <a href="javascript:void(0);" class="btn-action" data-action="details">'.$result['center'].'</a>
                                    </td>
                                    <td>'.$result['login'].'</td>
                                    <td>'.$result['logout'].'</td>
                                    <td><a href="http://ip-api.com/#'.$result['ip'].'" target="_blank">'.$result['ip'].'</a></td>
                                </tr>
                                ';
                            }

                      ?>
                    </tbody>
                  </table>
                </div>
            </div>
        </div>
    </div>
</div>