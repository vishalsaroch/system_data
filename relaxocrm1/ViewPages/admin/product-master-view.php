<?php if($level < 5){header('Location: /error/404');echo '<script type="text/javascript">window.location = "/error/404"</script>';exit;} ?>
<div class="inner" style="min-height: 700px;">
    <div class="row">
        <div class="col-lg-12">
            <div class="box DARK data-table-box">
                <header>
                    <div class="icons"><i class="icon-list"></i></div>
                    <h5>List Product Masters</h5>
                    <div class="toolbar">
                        <ul class="nav">
                            <li><input class="data-table-filter" type="text" placeholder="Search ..."></li>
                            <li class="dropdown">
                                <a data-toggle="dropdown" class="dropdown-toggle" href="javascript:void(0);">
                                    <i class="icon-th-large"></i> Action
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a class="meta-data">#</a></li>
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
                    <table class="table table-bordered table-hover wide-table data-table">
                        <thead>
                            <tr>
                            	<th>Icon</th>
								<th>Title</th>
                                <th>Category</th>
                                <th>Brand</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                if ($results = $function->getArray_prodMasterList()) {
                                    foreach ($results as $result) {
                                        echo '
                                        <tr class="entity-details" data-id="'.$result['id'].'" data-entity="product-master">
                                            <td id="productImagesDiv"><img src="'.$result['thumbnail'].'" class="img-responsive"></td>
                                            <td><a href="javascript:void(0);" class="btn-action" data-action="details">'.$result['title'].'</a></td>
                                            <td class="entity-details" data-id="'.$result['catId'].'" data-entity="category"><a href="javascript:void(0);" class="btn-action" data-action="details">'.$result['categoryName'].'</a></td>
                                            <td class="entity-details" data-id="'.$result['brdId'].'" data-entity="brand"><a href="javascript:void(0);" class="btn-action" data-action="details">'.$result['brandName'].'</a></td>
                                            <td>'.$result['status'].'</td>
                                            <td>
                                                <a href="javascript:void(0);" class="btn btn-primary btn-circle btn-line btn-action" data-action="edit" title="Edit"><i class="icon-edit"></i></a>
                                                <a href="javascript:void(0);" class="btn btn-warning btn-circle btn-line btn-action" data-action="block" title="Block"><i class="icon-ban-circle"></i></a>
                                                <a href="javascript:void(0);" class="btn btn-success btn-circle btn-line btn-action" data-action="unblock" title="Unblock"><i class="icon-ok"></i></a>
                                                <a href="javascript:void(0);" class="btn btn-danger btn-circle btn-line btn-action" data-action="delete" title="Delete"><i class="icon-trash"></i></a>
                                            </td>
                                        </tr>
                                        ';
                                    }
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>