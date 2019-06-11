<?php
define('FILES_VERSION', '1.5');

function PageHead($page = ''){
    global $metaArray;
	?>
	<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
    <html class="no-js" lang="en-IN">
    <head>
        <meta charset="utf-8" />
        <title><?php echo $metaArray['title']; ?></title>
        <meta http-equiv="content-type" content="text/html;charset=utf-8" />
        <!--[if IE]><meta http-equiv="X-UA-Compatible" content="IE=edge" /><![endif]-->
        <meta name="keywords" content="<?php echo $metaArray['keywords']; ?>" />
        <meta name="introText" content="<?php echo $metaArray['description']; ?>" />
        <meta name="header" content="<?php echo $metaArray['title']; ?>" />
        <meta name="category" />
        <meta name="section" />
        <meta name="visibility" />
        <meta name="segment" />
        <meta name="spo" />
        <meta name="searchTitle" content="<?php echo $metaArray['title']; ?>" />
        <meta name="title" content="<?php echo $metaArray['title']; ?>" />
        <meta property="og:title" content="<?php echo $metaArray['title']; ?>" />
        <meta name="description" content="<?php echo $metaArray['description']; ?>" />
        <meta property="og:description" content="<?php echo $metaArray['description']; ?>" />
        <meta property="og:url" content="index" />
        <meta name="robots" content="index,follow" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no" />
        <link rel="shortcut icon" href="/favicon.ico">
        <style type="text/css" media="screen">
            /*.skiptranslate{
                display: none !important;
                width: 0px !important;
            }
            .skiptranslate div {
                display: inline !important;
                width: auto !important;
            }*/
            #google_translate_element{
                width: 148px !important;
                overflow: hidden !important;
            }
            .navbar-nav:last-child{
              list-style: none;
            }
        </style>
        <?php
        echo '
        <!-- Bootstrap -->
        <link rel="stylesheet" type="text/css" href="'.CDN_CSS.'/bootstrap.min.css?v=BestWebs.'.FILES_VERSION.'">
        <!-- Plugins -->
        <link rel="stylesheet" type="text/css" href="'.CDN_CSS.'/font-awesome.css?v=BestWebs.'.FILES_VERSION.'">
        <link rel="stylesheet" type="text/css" href="'.CDN_CSS.'/bootstrap-select.css?v=BestWebs.'.FILES_VERSION.'">
        <link rel="stylesheet" type="text/css" href="'.CDN_CSS.'/owl.carousel.css?v=BestWebs.'.FILES_VERSION.'">
        <link rel="stylesheet" type="text/css" href="'.CDN_CSS.'/owl.theme.default.css?v=BestWebs.'.FILES_VERSION.'">
        <link rel="stylesheet" type="text/css" href="'.CDN_CSS.'/wizard.css?v=BestWebs.'.FILES_VERSION.'">
        <link rel="stylesheet" type="text/css" href="'.CDN_CSS.'/jquery.bootstrap-touchspin.css?v=BestWebs.'.FILES_VERSION.'">
        <link rel="stylesheet" type="text/css" href="'.CDN_CSS.'/style.teal.flat.css?v=BestWebs.'.FILES_VERSION.'">

        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesnt work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
        <style type="text/css" media="screen">
            .currency-sign::before {
                    content: "₹" !important;
                }
        </style>';
}

function PageTopBar($page = ''){
    global $function;
	?>
    <div class="middle-header">
      <div class="container">
        <div class="row">
          <div class="col-md-3 logo">
            <a href="/"><img alt="Logo" src="/assets/images/logo-teal.png" style="height:40px; margin-top: 0.6rem;" class="img-responsive" data-text-logo="<?php echo CLIENT_TITLE; ?>" /></a>
          </div>
          <div class="col-sm-8 col-md-6 search-box m-t-2">
            <div class="input-group">
              <input type="text" class="form-control search-input" aria-label="Search here..." placeholder="Search here...">
              <div class="input-group-btn">
                <button type="button" class="btn btn-default btn-search"><i class="fa fa-search"></i></button>
              </div>
            </div>
          </div>
          <div class="col-sm-4 col-md-3 cart-btn hidden-xs m-t-2">
            <?php
                if (isset($_SESSION['SESS__user'])) {
                    echo '
                    <a href="/profile" class="btn profile-btn dropdown-toggle" id="dropdownUser" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                        <img src="'.$_SESSION['SESS__avatar'].'" alt="user" class="user-avatar">
                        <span class="caret"></span>
                        '.$_SESSION['SESS__name'].'
                    </a>
                    <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownUser">
                        <li><a href="/my-profile">My Profile</a></li>
                        <li><a href="/my-address">My Address</a></li>
                        <li><a href="/my-history">Order History</a></li>
                        <li><a href="/my-password">Change Password</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="/logout">Logout</a></li>
                    </ul>';
                }else{
                    echo '
                    <a href="#loginModal" id="userBtn" class="btn theme-btn" data-toggle="modal" data-target="#loginModal">
                        <i class="fa fa-user"></i>
                        Login
                    </a>';
                }
            ?>
            <a href="/cart" class="btn btn-theme" data-toggle="tooltip" title="Cart" data-placement="bottom">
                <i class="fa fa-shopping-cart"></i>
                <span id="cart-count"><?php echo isset($_SESSION['CART']) ? count($_SESSION['CART']) : 0; ?></span>
            </a>
          </div>
        </div>
      </div>
    </div>
	<?php
}

function PageMenuBar($page = ''){
    global $function;
    ?>
    <nav class="navbar navbar-default shadow-navbar" role="navigation">
      <div class="container">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-ex1-collapse">
              <span class="sr-only">Menu</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a href="/my-profile" class="small-menu-btn visible-xs pull-right">
              <i class="fa fa-user"></i>
            </a>
            <a href="/cart" class="small-menu-btn visible-xs pull-right">
                <i class="fa fa-shopping-cart"></i>
            </a>
          </div>
          <div class="collapse navbar-collapse" id="navbar-ex1-collapse">
            <ul class="nav navbar-nav">
            <?php
                $categories = $function->getArray_frontMenu(true);
                $count  = 0;
                foreach ($categories as $category) {
                    $active = '';
                    $count++;
                    if (isset($_GET['catId']) && ($_GET['catId'] == $category['catId'])) {
                        $active = 'active';
                    }
                   if ($count == 9) {
                       echo '
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                  More <span class="caret"></span>
                                </a>
                                <ul class="dropdown-menu">
                       ';
                   }
                   echo '
                   <li class="'.$active.'" id="'.$category['catPermalink'].'__tab"><a href="/home/'.$category['catId'].'/'.$category['catPermalink'].'">'.$category['catTitle'].'</a></li>';
                }
                echo '
                        </ul>
                    </li>
                    <li class="pull-right"><div id="google_translate_element"></div><script type="text/javascript">
                        function googleTranslateElementInit() {
                          new google.translate.TranslateElement({pageLanguage: \'en\', layout: google.translate.TranslateElement.FloatPosition.TOP_LEFT}, \'google_translate_element\');
                        }
                        </script><script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
                    </li>
                </ul>
                   ';
            ?>
              <!-- <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                  More <span class="caret"></span>
                </a>
                <ul class="dropdown-menu">
                  <li class="dropdown dropdown-submenu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Submenu</a>
                    <ul class="dropdown-menu">
                      <li class="dropdown dropdown-submenu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Sub Submenu</a>
                        <ul class="dropdown-menu">
                          <li><a href="#">Sub Submenu Link 1</a></li>
                        </ul>
                      </li>
                    </ul>
                  </li>
                </ul>
              </li> -->
          </div>
      </div>
    </nav>
    <?php
}

function PageCartSection($page = ''){
    ?>
    <div class="title"><a href="/cart" class="btn btn-warning btn-block">View Cart <i class="fa fa-chevron-circle-right"></i></a></div>
    <div class="cart-section" style="overflow-y: scroll;">
        <?php
        $_SESSION['CART'] = isset ($_SESSION['CART']) ? $_SESSION['CART'] : array();
        foreach ($_SESSION['CART'] as $sku => $product) {
            echo '
                <div class="box-product-outer" data-skuId="'.$sku.'">
                    <div class="box-product">
                      <div class="img-wrapper col-xs-4" title="'.$product['brand'].'" style="height:auto;">
                        <img alt="Product" src="/assets/images/icon.png" data-src="'.$product['imgSrc'].'">
                        <noscript><img alt="Product" src="'.$product['imgSrc'].'"></noscript>
                      </div>
                      <h6 title="'.$product['title'].'" class="col-xs-8">'.$product['title'].'</h6>
                    </div>
                </div>
                <div class="clearfix"></div>
            ';
        }
    echo '</div>';
}

function PageSideBox($page =''){
    ?>
    <!-- <a href="#top" class="back-top text-center" onclick="$('body,html').animate({scrollTop:0},500); return false">
      <i class="fa fa-angle-double-up"></i>
    </a>
    <div class="chooser chooser-hide">
      <div class="chooser-toggle"><button class="btn btn-warning" type="button"><i class="fa fa-paint-brush bigger-130"></i></button></div>
      <div class="chooser-content">
        <label>Color</label>
        <select name="color-chooser" id="color-chooser" class="form-control input-sm selectpicker">
          <option value="indigo">Indigo</option>
          <option value="red">Red</option>
          <option value="teal">Teal</option>
          <option value="brown">Brown</option>
        </select>
        <label class="m-t-1">Style</label>
        <select name="style-chooser" id="style-chooser" class="form-control input-sm selectpicker">
          <option value="flat">Flat</option>
          <option value="rounded">Rounded</option>
        </select>
      </div>
    </div> -->
    <?php
}

function PageFooter($page = ''){
    ?>
    <div id="footer" class="footer">
        <span class="text-center copyright">Copyright &copy; <?php echo date('Y').' '.CLIENT_TITLE.' | '.CLIENT_COMPANY; ?>. All right reserved</span>
        <a href="#loginModal" id="sellerBtn" class="btn theme-btn pull-right" data-toggle="modal" data-target="#loginModal">
            <i class="fa fa-shopping-bag"></i>
            Sell with Us
        </a>
        <!-- <div id="footer-links">
            <a id="footer-help" href="/help" target="_blank">Need Help?</a>
            <a href="/contact-us" target="_blank">Contact</a>
            <a href="/about-us" target="_blank">About</a>
            <a href="/privacy-policy" target="_blank">Privacy Policy</a>
            <a href="/terms" target="_blank">Terms of Use</a>
            <a href="/return-policy" target="_blank">Return Policy</a>
            <a href="/login/vendor" target="_blank">Vendors</a>
            <a href="/vendor" target="_blank">Trademark Protection</a>
        </div> -->
    </div>
    <?php
}

function PageJsInclude($page = ''){
    global $function;
    echo '
    <!-- jQuery (necessary for Bootstraps JavaScript plugins) -->
    <script type="text/javascript" src="'.CDN_JS.'/jquery.js?v=BestWebs.'.FILES_VERSION.'"></script>
    <script type="text/javascript" src="'.CDN_JS.'/jquery.unveil.js?v=BestWebs.'.FILES_VERSION.'"></script>
    <script type="text/javascript" src="'.CDN_JS.'/bootstrap.js?v=BestWebs.'.FILES_VERSION.'"></script>
    <!-- Plugins -->
    <script type="text/javascript" src="'.CDN_JS.'/bootstrap-select.js?v=BestWebs.'.FILES_VERSION.'"></script>
    <script type="text/javascript" src="'.CDN_JS.'/owl.carousel.js?v=BestWebs.'.FILES_VERSION.'"></script>
    <script type="text/javascript" src="'.CDN_JS.'/jquery.ez-plus.js?v=BestWebs.'.FILES_VERSION.'"></script>
    <script type="text/javascript" src="'.CDN_JS.'/jquery.bootstrap-touchspin.js?v=BestWebs.'.FILES_VERSION.'"></script>
    <script type="text/javascript" src="'.CDN_JS.'/jquery.raty-fa.js?v=BestWebs.'.FILES_VERSION.'"></script>
    <script type="text/javascript" src="'.CDN_JS.'/wizard.js?v=BestWebs.'.FILES_VERSION.'"></script>
    <script type="text/javascript" src="'.CDN_JS.'/bootstrap3-typeahead.js?v=BestWebs.'.FILES_VERSION.'"></script>
    <script type="text/javascript" src="'.CDN_JS.'/bootstrap-toolkit.js?v=BestWebs.'.FILES_VERSION.'"></script>
    <script type="text/javascript" src="'.CDN_JS.'/mimity.js?v=BestWebs.'.FILES_VERSION.'"></script>
    <script type="text/javascript" src="'.CDN_JS.'/mimity.detail.js?v=BestWebs.'.FILES_VERSION.'"></script
    <script type="text/javascript" src="'.CDN_JS.'/shoppo_hash.js?v=BestWebs.'.FILES_VERSION.'"></script>
    ';
    ?>
    <div id="loginModal" class="modal fade" role="dialog">
      <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-body">
                <div class="col-sm-8 or-separator">
                    <?php echo $function->getMessage(); ?>
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#Login" data-toggle="tab">Login</a></li>
                        <li><a href="#Register" data-toggle="tab">Register</a></li>
                    </ul>
                    <!-- Tab panes -->
                    <div class="tab-content">
                        <!-- Register Form -->
                        <div class="login-register-form m-b-3 tab-pane" id="Register">
                            <div class="title"><span><br>Create An Account</span></div>
                            <div class="row">
                                <form action="" method="post" enctype="multipart/form-data" name="register">
                                  <div class="form-group col-sm-12">
                                    <label for="nameInput">Name <sup>*</sup></label>
                                    <input class="form-control"  type="text" placeholder="Name" name="name" minlength="2" maxlength="100" required="">
                                  </div>
                                  <div class="form-group col-sm-6">
                                    <label for="emailInput">Email address <sup>*</sup></label>
                                    <input class="form-control"  type="email" placeholder="Email" name="email"  minlength="10" maxlength="100" required="">
                                  </div>
                                  <div class="form-group col-sm-6">
                                    <label for="addressInput">Mobile <sup>*</sup></label>
                                    <input class="form-control" id="mobile" type="tel" placeholder="Mobile" name="mobile" pattern="[0-9]{10}"  minlength="10" maxlength="10" required="">
                                  </div>
                                  <fieldset id="vendrForm">
                                    <div class="form-group col-xs-12">
                                      <label>Name of Shop <sup>*</sup></label>
                                      <input class="form-control" name="shop[name]" placeholder="Name of Shop" type="text" value="" required="" minlength="5" maxlength="100" />
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="form-group col-xs-12">
                                      <label>Address <sup>*</sup></label>
                                      <input class="form-control" name="shop[address]" placeholder="Address" type="text" value="" required="" minlength="10" maxlength="200" />
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="form-group col-xs-6">
                                      <label>City <sup>*</sup></label>
                                      <input class="form-control" name="shop[city]" placeholder="City" type="text" value="" required="" minlength="3" maxlength="100" />
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="form-group col-xs-6">
                                      <label>Pincode <sup>*</sup></label>
                                      <input class="form-control" name="shop[city_pin]" placeholder="Area Pincode" type="tel" value="" pattern="[0-9]{6}" required="" maxlength="6" minlength="6"/>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="form-group col-xs-6">
                                      <label>Work Email <sup>*</sup></label>
                                      <input class="form-control" name="shop[email]" placeholder="Work Email" type="email" value="" required="" minlength="10" maxlength="100"/>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="form-group col-xs-6">
                                      <label>Work Contact <sup>*</sup></label>
                                      <input class="form-control" name="shop[phone2]" placeholder="Work Contact" pattern="[0-9]{7,15}" type="tel" value="" minlength="7" required="" maxlength="15"/>
                                        <div class="clearfix"></div>
                                    </div>
                                  </fieldset>
                                  <div class="form-group col-sm-6">
                                    <label for="passwordInput">Password <sup>*</sup></label>
                                    <input class="form-control"  type="password" placeholder="Password" id="password" name="password"  minlength="6" maxlength="128" onchange="this.setCustomValidity(this.validity.patternMismatch ? 'Must Have atleast 6 Characters' : ''); if(this.checkValidity()) form.cpassword.pattern=this.value;" required="">
                                  </div>
                                  <div class="form-group col-sm-6">
                                    <label for="passwordConfirmInput">Confirm Password <sup>*</sup></label>
                                    <input class="form-control"  type="password" placeholder="Confirm Password" id="cpassword" name="cpassword"  minlength="6" maxlength="128" onchange="this.setCustomValidity(this.validity.patternMismatch ? 'Please Enter the same password as entered' : '');" required="">
                                  </div>
                                  <div class="col-xs-12">
                                    <div class="checkbox">
                                      <label>
                                        <input type="checkbox" required="" name="process" id="processForm" value="registerUser"><span> I agree with <a href="/tnc" target="_blank"><u>Terms and Conditions</u></a>.</span>
                                      </label>
                                    </div>
                                  </div>
                                  <div class="form-group col-xs-12">
                                    <button type="submit" class="btn btn-theme pull-right"><i class="fa fa-long-arrow-right"></i> Register</button>
                                  </div>
                                </form>
                            </div>
                        </div>
                        <!-- End Register Form -->
                        <!-- Login Form -->
                        <div class="login-register-form m-b-3 tab-pane active" id="Login">
                            <div class="title"><span><br>Already Registered ?</span></div>
                            <div class="row">
                                <form action="" method="post" enctype="multipart/form-data" name="login" onsubmit="this.password.value = login_hash(this.password.value);">
                                    <div class="form-group col-xs-12">
                                      <label for="emailInputLogin">Username <sup>*</sup></label>
                                      <input type="text" class="form-control" id="emailInputLogin" name="username" placeholder="Email or Phone" maxlength="100" minlength="10" required="">
                                    </div>
                                    <div class="form-group col-xs-12">
                                      <label for="passwordInputLogin">Password <sup>*</sup></label>
                                      <input type="password" class="form-control" id="passwordInputLogin" name="password" placeholder="Password" maxlength="128" minlength="6" required="">
                                    </div>
                                    <div class="checkbox col-xs-12">
                                      <label>
                                        <input type="checkbox"><span> Remember me</span>
                                      </label>
                                    </div>
                                    <div class="form-group col-xs-12">
                                        <input type="hidden" name="process" value="login">
                                        <input type="hidden" name="referer" value="<?php echo htmlentities($_SERVER['REQUEST_URI']); ?>">
                                        <button type="submit" class="btn btn-theme pull-right"><i class="fa fa-long-arrow-right"></i> Login</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!-- End Login Form -->
                    </div>
                    <div id="OR" class="hidden-xs">OR</div>
                </div>
                <div class="col-sm-4" id="socialLogin">
                    <div class="text-center sign-with">
                        <br><br><br>
                        <div class="col-md-12 title"><span>Sign In with</span></div>
                        <br><br><br><br><br>
                        <a href="/social-login/facebook" class="col-md-offset-1 col-md-9 btn btn-primary">Facebook</a>
                        <br><br><br>
                        <!-- <a href="#" class="col-md-offset-1 col-md-9 btn btn-danger">Google</a> -->
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
      </div>
    </div>
    <div id="productModal" class="modal fade" role="dialog">
      <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-body">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">X</span></button>
                  <div class="clearfix"></div>
                <div class="row">
                    <!-- Image List -->
                    <div class="col-sm-7 or-separator">
                        <div class="image-detail"  id="product_image">
                            <img src="" class="img-responsive" data-zoom-image="" alt="">
                        </div>
                        <div class="products-slider-detail owl-carousel owl-theme m-b-2" id="product_alt_images">

                        </div>
                        <!-- <div class="title"><span>Share to</span></div>
                        <div class="share-button m-b-3">
                            <button type="button" class="btn btn-primary"><i class="fa fa-facebook"></i></button>
                            <button type="button" class="btn btn-info"><i class="fa fa-twitter"></i></button>
                            <button type="button" class="btn btn-danger"><i class="fa fa-google-plus"></i></button>
                            <button type="button" class="btn btn-primary"><i class="fa fa-linkedin"></i></button>
                            <button type="button" class="btn btn-warning"><i class="fa fa-envelope"></i></button>
                        </div> -->
                    </div>
                    <!-- End Image List -->
                    <div class="col-sm-5">
                      <div class="title-detail" id="product_title"></div>
                      <table class="table table-detail">
                        <tbody>
                          <tr>
                            <td colspan="2" id="product_subtitle"></td>
                          </tr>
                          <tr>
                            <td>Brand</td>
                            <td  id="product_brand"></td>
                          </tr>
                          <tr>
                            <td>Price</td>
                            <td>
                              <h4 class="price">
                                <div>
                                    <span id="product_price" class="currency-sign"></span>
                                    <span class="label label-default arrowed" id="product_discount"></span>
                                </div>
                                <span class="price-old currency-sign" id="product_old_price"></span>
                              </h4>
                            </td>
                          </tr>
                          <tr>
                            <td>Availability</td>
                            <td  id="product_availability"></td>
                          </tr>
                          <tr>
                            <td>Quantity</td>
                            <td>
                              <div class="input-qty">
                                <input type="text" value="1" id="product_quantity" class="form-control text-center"/>
                              </div>
                            </td>
                          </tr>
                          <!-- <tr>
                            <td>Size</td>
                            <td>
                              <select class="selectpicker" id="product_size" data-width="80px">
                                <option value="S">S</option>
                                <option value="M">M</option>
                                <option value="L">L</option>
                                <option value="XL">XL</option>
                                <option value="XXL">XXL</option>
                              </select>
                            </td>
                          </tr>
                          <tr>
                            <td>Color</td>
                            <td id="product_color">
                              <div class="radio"><label><input type="radio" name="radio-product" checked="checked"><span>Red</span></label></div>
                              <div class="radio"><label><input type="radio" name="radio-product"><span>Green</span></label></div>
                            </td>
                          </tr> -->
                          <tr>
                            <td colspan="2 row">
                                <div class="col-xs-6">
                                    <button class="btn btn-lg btn-block btn-theme m-b-3 m-t-3 add-to-cart" id="" type="button"><i class="fa fa-shopping-cart"></i> Add to Cart</button>
                                </div>
                                <div class="col-xs-6">
                                    <button class="btn btn-lg btn-block btn-warning m-b-3 m-t-3 add-to-cart" buy-it="now" id="" type="button"><i class="fa fa-rocket"></i> Buy Now </button>
                                </div>
                            </td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                    <div class="clearfix"></div>
                    <div class="col-sm-12">

                      <!-- Nav tabs -->
                      <ul class="nav nav-tabs" role="tablist">
                        <li role="presentation" class="active"><a href="#product_overview" aria-controls="product_overview" role="tab" data-toggle="tab">Overview</a></li>
                        <li role="presentation"><a href="#product_description" aria-controls="product_description" role="tab" data-toggle="tab">Description</a></li>
                        <li role="presentation"><a href="#product_shipping" aria-controls="product_shipping" role="tab" data-toggle="tab">Shipping</a></li>
                      </ul>
                      <!-- End Nav tabs -->

                      <!-- Tab panes -->
                      <div class="tab-content tab-content-detail">

                          <!-- Description Tab Content -->
                          <div role="tabpanel" class="tab-pane active" id="product_overview">
                            <div class="well">
                              <p>
                                Description
                              </p>
                            </div>
                          </div>
                          <!-- End Description Tab Content -->

                          <!-- Detail Tab Content -->
                          <div role="tabpanel" class="tab-pane" id="product_description">
                            <div class="well">
                              <table class="table table-bordered">
                                <tbody>
                                  <tr>
                                    <td>Spec</td>
                                    <td>Value</td>
                                  </tr>
                                </tbody>
                              </table>
                            </div>
                          </div>
                          <!-- End Detail Tab Content -->

                          <!-- Review Tab Content -->
                          <div role="tabpanel" class="tab-pane" id="product_shipping">
                            <div class="well">
                              <table class="table table-bordered">
                                <tbody>
                                  <tr>
                                    <td>Delivery Charges</td>
                                    <td>Charges</td>
                                  </tr>
                                </tbody>
                              </table>
                            </div>
                          </div>
                          <!-- End Review Tab Content -->

                      </div>
                      <!-- End Tab panes -->
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
      </div>
    </div>
    <script type="text/javascript">
        $("img").unveil(200, function() {
          $(this).load(function() {
            this.style.opacity = 1;
          });
        });
    </script>
    <script type="text/javascript">
        function refreshCart(title, imgSrc, brand, prod){
            var isAlreadyInCart = false;
            $(".cart-section .box-product-outer").each(function() {
                var skuId = $(this).attr('data-skuId');
                if(prod === skuId){
                    isAlreadyInCart = true;
                }
            });
            if(! isAlreadyInCart){
                $(".cart-section").append(
                                '<div class="box-product-outer" data-skuId="'+prod+'">'+
                                '    <div class="box-product">'+
                                '      <div class="img-wrapper col-xs-4" title="'+brand+'" style="height:auto;">'+
                                '        <img alt="Product" src="'+imgSrc+'">'+
                                '      </div>'+
                                '      <h6 title="'+title+'" class="col-xs-8">'+title+'</h6>'+
                                '    </div>'+
                                '</div>'+
                                '<div class="clearfix"></div>');
            }
            return isAlreadyInCart;
        }

        $(function () {
            // ADD TO CART
            $("#productModal").on('click', '.add-to-cart', function() {
                var qty = $("#productModal").find("#product_quantity").val(),
                    title = $("#productModal").find("#product_title").html(),
                    imgSrc = $("#productModal").find("#product_image img").attr('src'),
                    brand = $("#productModal").find("#product_brand").html(),
                    el = $(this),
                    prod = $(this).attr('id'),
                    isBuyItNow = $(this).attr('buy-it') ? true : false,
                    isAlreadyInCart = false;
                $.ajax({
                    type: 'POST',
                    data: {
                        ajax: 'add-cart',
                        product: prod,
                        quantity: qty
                    },
                    beforeSend : function(){
                        el.html('<img src="/assets/images/loader.svg">');
                        el.attr('disabled', true);
                        el.parent().css('display', 'block;');
                    }
                })
                .done(function(data) {
                    if (data == 'false') {
                        el.html('Failed to add');
                        el.css({
                            'background-color': '#ff3636',
                            'color': '#fff'
                        });
                        return;
                    }
                    isAlreadyInCart = refreshCart(title, imgSrc, brand, prod);
                    el.html('<i class="fa fa-check-square-o"></i> Added');
                    if(! isAlreadyInCart){
                        var cartCount = $("#cart-count").html();
                        cartCount = parseInt(cartCount) + 1;
                        $("#cart-count").html(cartCount);
                    }
                    el.css({
                        'background-color': 'green',
                        'color': '#fff'
                    });
                    setTimeout(function(){
                        $('#productModal').modal('hide');
                    }, 1000);
                    if(isBuyItNow){
                        window.location = '/checkout';
                    }
                })
                .fail(function() {
                    el.html('Failed to add');
                    el.css({
                        'background-color': '#ff3636',
                        'color': '#fff'
                    });
                })
                .always(function() {
                    $('.cart-qty').val(1);
                    setTimeout(function(){
                        el.html('<i class="fa fa-shopping-cart"></i> Add to Cart');
                        el.removeAttr('style disabled');
                        el.parent().removeAttr('style');
                    },2000);
                });
            });

            // OPEN PRODUCT DETAIL
            $("#product-container").on('click', ".box-product", function(){
                var skuId = $(this).attr("data-skuId"),
                    catId = $(this).attr("data-catId");
                $.ajax({
                    type: "POST",
                    data: {
                        ajax: "productDetail",
                        skuId: skuId,
                        catId: catId
                    },
                })
                .done(function(content) {
                    content = $.parseJSON(content);
                    if(content["status"] === "success"){
                        $("#product_title").html(content["title"]);
                        $("#product_brand").html(content["brand"]);
                        $("#product_subtitle").html(content["subTitle"]);
                        $("#product_image").html('<img src="'+content["imgUrl"]+'" class="img-responsive" data-zoom-image="'+content["imgUrl"]+'" alt="">');
                        // $(".products-slider-detail").data('owlCarousel').destroy()
                        // $('.products-slider-detail').empty();
                        var images = content["spec"]["image"].length;
                        $("#product_alt_images").html('');
                        for (var i = 1; i < images; i++) {
                            if(! content["spec"]["image"][i]) continue;
                            $("#product_alt_images").append('<a href="#"><img src="'+content["spec"]["image"][i]+'" data-zoom-image="'+content["spec"]["image"][i]+'" alt="" class="img-thumbnail"></a>');
                        };
                        var products_slider_detail = $('.products-slider-detail');
                        var item_count = $('.products-slider-detail a').length;
                        products_slider_detail.owlCarousel({
                            margin:8,
                            dots:false,
                            nav:item_count < 8 ? false : true,
                            mouseDrag:item_count < 8 ? false : true,
                            touchDrag:item_count < 8 ? false : true,
                            navText:['<i class="fa fa-angle-left"></i>','<i class="fa fa-angle-right"></i>'],
                            responsive:{
                                0:{ items:8, }
                            }
                        });
                        $("#product_overview .well").html(content["spec"]["description"]);
                        $("#product_description .well").html(content["spec"]["spec"]);
                        $("#product_price").html(content["price"]);
                        $("#product_discount").html('-'+content["discount"]+'%');
                        $("#product_old_price").html(Math.round(parseInt(content['price']) * 100 / (100 - parseInt(content['discount']))));
                        if(content['stock'] > 5){
                            $("#product_availability").html('<span class="label label-success arrowed">Ready Stock</span>');
                        }else if(content['stock'] > 0){
                            $("#product_availability").html('<span class="label label-warning arrowed">Few Left</span>');
                        }else{
                            $("#product_availability").html('<span class="label label-danger arrowed">Out of Stock</span>');
                        }
                        $(".add-to-cart").attr('id', content['skuId']);
                        $("#productModal").modal("show");
                    }else{
                        alert("Something Wrong");
                    }
                })
                .fail(function() {
                    console.log("error");
                })
                .always(function() {
                    console.log("complete");
                });
            });

            $('#sellerBtn').click(function(event) {
              $('#processForm').val('registerVendor');
              $('#vendrForm').show().removeAttr('disabled');
              $('#socialLogin').hide().siblings().eq(0).attr('class', 'col-sm-12');
              $('#OR').hide();
            });

            $('#userBtn').click(function(event) {
              $('#processForm').val('registerUser');
              $('#vendrForm').hide().attr('disabled', true);
              $('#socialLogin').show().siblings().eq(0).attr('class', 'col-sm-8 or-separator');
              $('#OR').show();
            });
        });
    </script>
    <?php
    echo '<script type="text/javascript" src="'.CDN_JS.'/shoppo_hash.js?v=BestWebs.'.FILES_VERSION.'"></script>
        <script>';
        if (!isset($_SESSION['CART']) || (count($_SESSION['CART']) < 1)) {
            echo '
                    localStorage.clear();
            ';
        }
        if (isset($_SESSION['FORM'])) {
            foreach ($_SESSION['FORM'] as $key => $value) {
                if (is_array($value)) {
                    foreach ($value as $key1 => $value1) {
                        echo '
                            $(\'[name="'.$key.'['.$key1.']"]\').val("'.$value1.'");
                            ';
                    }
                }else{
                    echo '
                        $("[name='.$key.']").val("'.$value.'");
                        ';
                }
            }
            unset($_SESSION['FORM']);
        }
        if (isset($_SESSION['MODAL'])) {
            echo '
                $(function(){
                    $("'.$_SESSION['MODAL'].'").modal("show");
                });
                ';
            unset($_SESSION['MODAL']);
        }
    echo '</script>';
}

$metaArray = $function->getArray_pageMeta($page);

/*
    ## Sample PageMetaArray --> (below given 'other' part is for homepage, will be different for other pages)
    ## use json_encode($json) or json_decode($encodedJson, true);

    $json = array(
        'title' => 'Home | Something about shoppo',
        'keywords' => 'shopping, online, ecommerce',
        'description' => 'Shoppo is a platform for everything for your household',
        'slider' => array(
            array(
                'imgSrc' => 'slider1.png',
                'href' => '/product/1/1/Malai-kofta/cheesy-way-item',
                'title' => 'Irresistibly Smooth & Flawless Dish',
                'subtitle' => 'The One',
                'text' => 'Primer blurs the appearance of pores for a flawless-looking bas, helps to enhance complexion',
                'button' => 'Shop Now'
            ),
            array(
                'imgSrc' => 'slider1.png',
                'href' => '/product/1/1/Malai-kofta/cheesy-way-item',
                'title' => 'Irresistibly Smooth & Flawless Dish',
                'subtitle' => 'The Two',
                'text' => 'Primer blurs the appearance of pores for a flawless-looking bas, helps to enhance complexion',
                'button' => 'Shop Now'
            ),
            array(
                'imgSrc' => 'slider1.png',
                'href' => '/product/1/1/Malai-kofta/cheesy-way-item',
                'title' => 'Irresistibly Smooth & Flawless Dish',
                'subtitle' => 'The Three',
                'text' => 'Primer blurs the appearance of pores for a flawless-looking bas, helps to enhance complexion',
                'button' => 'Shop Now'
            )
        ),
        'other' => array(
            'top-categories' => array(
                array(
                    'imgSrc' => 'slider1.png',
                    'href' => '/product/1/1/Malai-kofta/cheesy-way-item',
                    'title' => 'Irresistibly Smooth & Flawless Dish',
                    'subtitle' => 'The One',
                    'text' => 'medium',
                    'button' => 'Shop Now'
                ),
                array(
                    'imgSrc' => 'slider1.png',
                    'href' => '/product/1/1/Malai-kofta/cheesy-way-item',
                    'title' => 'Irresistibly Smooth & Flawless Dish',
                    'subtitle' => 'The Two',
                    'text' => 'medium',
                    'button' => 'Shop Now'
                ),
                array(
                    'imgSrc' => 'slider1.png',
                    'href' => '/product/1/1/Malai-kofta/cheesy-way-item',
                    'title' => 'Irresistibly Smooth & Flawless Dish',
                    'subtitle' => 'The Three',
                    'text' => 'small',
                    'button' => 'Shop Now'
                ),
                array(
                    'imgSrc' => 'slider1.png',
                    'href' => '/product/1/1/Malai-kofta/cheesy-way-item',
                    'title' => 'Irresistibly Smooth & Flawless Dish',
                    'subtitle' => 'The Three',
                    'text' => 'small',
                    'button' => 'Shop Now'
                ),
                array(
                    'imgSrc' => 'slider1.png',
                    'href' => '/product/1/1/Malai-kofta/cheesy-way-item',
                    'title' => 'Irresistibly Smooth & Flawless Dish',
                    'subtitle' => 'The Three',
                    'text' => 'small',
                    'button' => 'Shop Now'
                )
            ),
            'banner' => array(
                'imgSrc' => 'banner.png',
                'href' => '/login',
                'title' => 'Buy every Household thing on single click',
                'subtitle' => 'Join Shoppo',
                'text' => '',
                'button' => 'Register'
            ),
            'trending' => '1,2,3,4,5,6,7,8,9,10'
        )
    );
*/