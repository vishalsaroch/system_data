<?php if($level < 5){header('Location: /error/404');echo '<script type="text/javascript">window.location = "/error/404"</script>';exit;} ?>
<div class="inner">
    <div class="row">
        <div class="col-lg-12">
            <div class="box dark">
                <header>
                    <div class="icons"><i class="icon-shopping-cart"></i></div>
                    <h5>Add New Brand</h5>
                    <div class="toolbar">
                        <ul class="nav">
                            <li class="dropdown">
                                <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                                    <i class="icon-th-large"></i> Masters
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a href="/BestWebs?module=product&mode=add-master&type=new">Add New Product Master</a></li>
                                    <li><a href="/BestWebs?module=product&mode=add&type=new">Add New Product</a></li>
                                    <li><a href="/BestWebs?module=categories&mode=add-master&type=new">Add New Category</a></li>
                                </ul>
                            </li>
                            <!-- <li>
                                <a href="#">
                                    <form name="form" action="" method="post" enctype="multipart/form-data">
                                        <label for="uploadExcel" style="margin:0;">
                                            <i class="icon-list-alt"></i> Upload Excel
                                            <input type="file" id="uploadExcel" name="uploadExcel" class="" onchange="uploadExcelf(this.form);">
                                        </label>
                                        <input type="hidden" name="adminProcess" value="uploadExcel">
                                    </form>
                                </a>
                            </li> -->
                            <li>
                                <a class="accordion-toggle minimize-box" data-toggle="collapse" href="#div-1">
                                    <i class="icon-chevron-up"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                </header>
                <div id="div-1" class="accordion-body collapse in body">
                    <form class="ajax-form" action="" method="post" enctype="multipart/form-data">
                        <div class="row">
                            <div class="form-group col-xs-6">
                                <label for="category_id" class="control-label">Category</label>
                                <select data-placeholder="Choose Categories" id="category_id" name="product[category_id][]" class="form-control chzn-select" multiple="multiple" tabindex="6" required="">
                                    <optgroup label="Main Menu">
                                    <?php
                                        $options = $function->getArrayOptions_All_Table(' client_categories ', array('title title', 'category_id catId', 'parent_id parentId'), ' ORDER BY ul_parent_id ASC ');
                                        $parent = NULL;
                                        foreach ($options as $option) {
                                            if ($parent == $option['parentId']) {
                                                echo '<option value="'.$option['catId'].'">'.$option['title'].'</option>';
                                            }else{
                                                $parent = $option['parentId'];
                                                echo "
                                                </optgroup>
                                                <optgroup label='$parent'>
                                                ";
                                            }

                                        }
                                    ?>
                                    </optgroup>
                                </select>
                            </div>
                            <div class="form-group col-xs-6">
                                <label for="title" class="control-label">Title</label>
                                <input type="text" id="title" name="product[title]" placeholder="Exe. Nike" title="Title of this product" class="form-control" maxlength="30"  required=""/>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-xs-4 pull-right">
                                <label for="submit" class="control-label"></label>
                                <input type="hidden" name="adminAjax" value="addBrand">
                                <input type="submit"  id="submit" class="btn btn-success btn-block" value="Save Brand"/>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>