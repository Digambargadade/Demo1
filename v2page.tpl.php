<?php
 use Coconnex\Utils\Handlers\MessageHandler;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php print $language->language ?>"
  lang="<?php print $language->language ?>" dir="<?php print $language->dir ?>">

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
  <?php print $head;
  $isOrg = 0;
  global $user;
  $customer = new PlastCustomer($user->uid);
  // debug($customer,1);
  // $vars['exhibitor_data'] = $customer;

  // $exnid = getnidbyuid($user->uid);
  // $exInitial = get_profile_initials($exnid);
  // debug($user->roles,1);
  if (($user->roles[5] == 'organizer')) {
    $isOrg = 1;
    $exInitial = get_profile_initials($user->uid, $user->roles[5]);
  } else if ($user->roles[3] == 'exhibitor') {
    $exInitial = get_profile_initials($user->uid, $user->roles[3]);
  } else if ($user->roles[18] == 'startup') {
    $exInitial = get_profile_initials($user->uid, $user->roles[18]);
  }
  // echo "===".$exInitial;

  global $base_url;
  //$imgpath = base_path() . path_to_theme();
  //echo $imgpath;exit;
  ?>

  <?php
  $regData = unserialize($_SESSION['regData']);
  if ($regData['agency'] != '6' && !in_array("organizer", $user->roles)) { ?>
    <style>
      .navbar-nav>.Booking {
        display: none;
      }

      .navbar-nav>.Preview {
        display: block !important;
        background-color: none;
      }

      /*  .Accounts {
          display: none;
        } */
      .exhibitorstatusreport,
      .statementofaccount {
        display: none !important;
      }

      .dropdown-submenu>a:after {
        content: " ";
        float: right;
        width: 0;
        height: 0;
        border-color: transparent;
        border-style: solid;
        border-width: 5px 0 5px 5px;
        border-left-color: #ccc;
        margin-top: 5px;
        margin-right: -10px;
      }

      .dropdown-submenu:hover>a:after {
        border-left-color: #fff;
      }
    </style>
  <?php } else { ?>
    <style>
      .navbar-nav>.Preview {
        display: none;
      }
    </style>
  <?php }
  if ($regData['memberType'] != 'IN' && $regData['memberType'] != 'MIN' && !in_array("organizer", $user->roles)) { ?>
    <style>

    </style>
  <?php  }
  if ($_SESSION['subexlogin']['role'] == 'exhibitorshared') { ?>
    <!-- <style>
					.Sub{
						display:none;
					}

					.Booking{
						display:none;
					}

		.navbar-nav > .Preview
          {
              display: none !important;

          }
                       </style> -->
  <?php  }
  ?>



  <title><?php print $head_title ?></title>
  <?php print $styles ?>

  <?php print $scripts ?>
  <!--<script type="text/javascript" src="<?php echo $base_url; ?>/sites/all/modules/custom/addons/js/jquery-ui.js?D"></script>-->
  <!--[if lt IE 7]>
      <?php print phptemplate_get_ie_styles(); ?>
    <![endif]-->
  <?php
  global $base_url;   // Will point to http://www.example.com
  $themepath = $base_url . "/" . path_to_theme();
  $useragent = $_SERVER['HTTP_USER_AGENT'];

  if (preg_match('~MSIE|Internet Explorer~i', $useragent) || (strpos($useragent, 'Trident/7.0') !== false && strpos($useragent, 'rv:11.0') !== false)) { ?>
    <link rel="stylesheet" type="text/css" href="<?php print $themepath; ?>/assets/css/style-ie.css" />
  <?php
  }
  ?>
  <script language="javascript">
    var nodetype = "<?php
                    if (arg(2) == "edit") {
                      $node_type = arg(3);
                    } else {
                      $node_type = arg(2);
                    }
                    echo $node_type; ?>";
    var isorg = "<?php echo $isOrg ?>";
    $(document).ready(function() {
      $('a[title="Visa Form"]').attr('target', '_blank')
    })
  </script>
  <script src="<?php echo $base_url; ?>/sites/all/themes/plastindia/assets/js/jquery.form.js"></script>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link
    href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
    rel="stylesheet">
</head>
<body<?php print phptemplate_body_class($left, $right); ?>>

  <!-- Layout -->
  <!--<div id="header-region" class="clear-block"><?php print $header; ?></div>-->
  <div id="header-region" class="clear-block">
    <div class="Header-img" style=" padding:0px 0px 0px 0px; margin:0px 0px;">
      <a href="https://www.indiamobilecongress.com" target="_blank">
        <img src="<?php echo $base_url; ?>/sites/all/themes/plastindia/images/imc-header-banner.jpeg"
          width="100%" border="0" alt="" title="" />
      </a>
      <?php /*?><?php print $breadcrumb; ?><?php */ ?>
    </div>
    <!-- <div class="BrasiliaForumText">
    	<a href="http://www.coconnex.com/" target="_blank" >Coconnex</a>&nbsp; >> &nbsp;<?php //echo l('Networking Tool', 'home')
                                                                                      ?>
    </div>-->
    <?php //print $header;

    ?>
  </div>


  <nav class="mb-1 navbar navbar-expand-lg navbar-dark themeColor lighten-1" role="navigation">
    <button class="navbar-toggler bg-dark" type="button" data-toggle="collapse" data-target="#navbarSupportedContent-555"
      aria-controls="navbarSupportedContent-555" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <a class="navbar-brand" href="#"></a>

    <div class="collapse navbar-collapse d-xl-flex" id="navbarSupportedContent-555">
      <ul class="navbar-nav mr-auto">
        <?php
        global $user;
        global $base_url;
        $loginuser = $user->name;
        $main_menu_tree = menu_tree_all_data('primary-links');
        $profileImg = $base_url . "/" . path_to_theme() . "/images/user_image_blank.jpg";
        // *** COMMENTS BELOW SHOULD BE REMOVED ***
        // echo "<pre>";
        //print_r($main_menu_tree);

        foreach ($main_menu_tree as $m) {
          if ($m['link']['hidden'] == 0) {
            $children = '';

            if ($m['link']['has_children']) {
              echo '<li class="dropdown ' . $m['link']['link_title'] . ' nav-item dropdown multi-level-dropdown ">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">' . $m['link']['link_title'] . '<em class="caret"></em></a>
						<ul class="dropdown-menu">';
              foreach ($m['below'] as $b) {
                echo $b['link']['below'];
                if ($b['link']['hidden'] == 0) {
                  echo '<li class="dropdown-item dropdown-submenu p-0 ' . $b['link']['options']['attributes']['class'] . ' ">'
                    . '<a href="' . $base_url . '/' . $b['link']['link_path'] . '" ';
                  if (!empty($b['below'])) {
                    echo 'data-toggle="dropdown" class="dropdown-toggle  w-100"';
                  }
                  echo '>' . $b['link']['link_title'] . '</a>';
                  if (!empty($b['below'])) { ?>
                    <ul class="dropdown-menu ml-2 rounded-0  border-0 z-depth-1">
                      <?php foreach ($b['below'] as $c) {
                      ?>
                        <li class="dropdown-item dropdown-submenu p-0">
                          <a href="<?php echo $base_url . "/" . $c['link']['link_path']; ?>" <?php if (!empty($c['below'])) {
                                                                                                echo 'data-toggle="dropdown" class="dropdown-toggle  w-100"';
                                                                                              } ?>><?php echo $c['link']['link_title']; ?></a>
                          <?php if (!empty($c['below'])) { ?>
                            <ul class="dropdown-menu ml-2 rounded-0  border-0 z-depth-1">
                              <?php foreach ($c['below'] as $d) {
                              ?>
                                <li class="dropdown-item p-0">
                                  <a href="<?php echo $base_url . "/" . $d['link']['link_path']; ?>"
                                    class="w-100"><?php echo $d['link']['link_title']; ?></a>
                                </li>

                              <?php } ?>
                            </ul>
                          <?php } ?>
                        </li>

                      <?php } ?>
                    </ul>
                <?php }
                  echo  '</li>';
                } ?>

        <?php }
              //echo '<li><a href="/'.drupal_lookup_path('alias',$b['link']['link_path']).'">'.$b['link']['link_title'].'</a></li>';
              echo '</ul>
						</li>';
            } else {
              if ($m['link']['link_title'] != 'Cart') {
                echo '<li class="nav-item ' . $m['link']['link_title'] . '"><a class="nav-link" href="' . $base_url . '/' . $m['link']['link_path'] . '">' . $m['link']['link_title'] . '</a></li>';
              } else {
                $ProductsCart = new ProductsCart();
                $nonOrderCartid = $ProductsCart->getcartcount(getnidbyuid($user->uid), 0);
                echo '<li class="nav-item ' . $m['link']['link_title'] . '"><a class="nav-link  green-gradient " href="' . $base_url . '/' . $m['link']['link_path'] . '"><i class="fa fa-shopping-cart"></i> ' . $m['link']['link_title'] . ' <span class="badge badge-danger" id="pagecartid"> ' . $nonOrderCartid . ' </span></a></li>';
              }
            }
          }
        }
        ?>
      </ul>
      <ul class="navbar-nav ml-auto d-none d-xl-block">
        <li>
          <?php if ($user->uid > 0 && in_array('exhibitor', $user->roles)) {
          ?>
            <a class="nav-link waves-effect waves-light myOrder d-none d-xl-block"
              href="<?php echo $base_url; ?>/order/list">
              <img class="mr-1 ml-2" src="/sites/all/themes/plastindia_registration/assets/img/task_white.svg" alt="">
              My Order</a>
            <a class="nav-link waves-effect waves-light myInvoices d-none d-xl-block pl-3"
              href="<?php echo $base_url; ?>/invoice/list">
              <img class="mr-1 ml-2" src="/sites/all/themes/plastindia_registration/assets/img/receipt_long_white.svg" alt="">
              My Invoices</a>

          <?php } ?>
        </li>
      </ul>
    </div>

    <?php if (!empty($user->uid)) {
      $useruid = $user->uid;
      /*if(isset($_SESSION['subexlogin'])){
		$loginuser=$_SESSION['subexlogin']['name'];
		$useruid=$_SESSION['subexlogin']['uid'];
	}*/
    ?>
      <ul class="navbar-nav ml-auto nav-flex-icons" id="profile-nav">
        <!--li>
                    <button type="button" class="btn btn-outline-secondary btn-sm btn-rounded waves-effect"><span  style="color:white;">My Schedule</span></button>
            </li-->
        <!-- <?php
              if (isset($_SESSION['orgLoggedIn']['loggedin']) && $_SESSION['orgLoggedIn']['loggedin'] == 1) {
                if ($user->uid > 0) {
              ?>
        <li class="nav-item myOrder"><a class="nav-link waves-effect waves-light" href="<?php echo $base_url; ?>/order/list">My Order</a></li>
        <li class="nav-item myInvoices"><a class="nav-link waves-effect waves-light" href="<?php echo $base_url; ?>/invoice/list">My Invoices</a></li>
        <li class="nav-item">
        <?php }
              } ?> -->
        <?php  //if(in_array('organizer',$user->roles)) {
        ?>
        <!-- <a class="nav-link waves-effect waves-light organiser-user" style="padding-right:9px;"><?php print $loginuser; ?></a> -->
        <?php //} 
        ?>
        </li>

        <li class="nav-item avatar dropdown">

          <?php //if(in_array('organizer',$user->roles)) {
          ?>
          <!-- <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink-55" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img src="<?php echo $profileImg; ?>" class="rounded-circle z-depth-0" alt=" image"><i class="fas fa-caret-down"></i>
        </a> -->

          <?php //} if(in_array('exhibitor',$user->roles)){ 
          ?>
          <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink-55" data-toggle="dropdown"
            aria-haspopup="true" aria-expanded="false">
            <div id="user_profile" class="d-flex" style="cursor:pointer">
              <div id="user_initials_container" class="user-initials-container">
                <div id="user_initials" class="user-initials">
                  <?php if (!empty($exInitial)) {
                    echo $exInitial;
                  } ?></div>

              </div>
              <?php
              // Check if the user is logged in and has the exhibitor role
              if ($user->uid > 0 && (in_array('exhibitor', $user->roles))) {
              ?>
                <?php
                // Check if the user is masquerading
                if (isset($_SESSION['orgLoggedIn'][loggedin]) && $_SESSION['orgLoggedIn'][loggedin] == 1) {

                ?>
                  <div id="user_menu_container" class="d-flex">
                    <div id="user_menu_hburger" class="d-flex d-xl-none">
                      <div class="mt-auto mb-auto">
                        <i class="fas fa-bars fa-2x text-white"></i>
                      </div>
                    </div>
                  </div>
              <?php }
              } ?>
            </div>
          </a>
          <?php //} 
          ?>

          <div class="dropdown-menu dropdown-menu-lg-right dropdown orgniser-masq-menu"
            aria-labelledby="navbarDropdownMenuLink-55"> <?php //print_r($user->roles);
                                                          ?>
       <!-- Profile Menu HTML -->
       
            <!-- <div class="pt-md-4 ms-4 d-flex profile-menu">
              <div class="mt-auto mb-auto">
                <a class="text-dark" href="/exhibitor/profile">
                  <img class="profile-icon" src="/sites/all/themes/plastindia_registration/assets/img/account_circle.svg" alt="">
                </a>
              </div>
              <div class="ms-2 mb-auto mt-auto">
                <h6 class="m-0 text-dark">Rohit Rane</h6>
                <a class="profile-edit" href="/exhibitor/profile">
                  <p class="m-0 text-dark">Exhibitor (<span class="text-primary">View/Edit</span>)</p>
                </a>
              </div>
            </div> -->

         <!-- Profile Menu HTML -->     

            <a class="dropdown-item" href="<?php echo $base_url; ?>/user/<?php echo $useruid; ?>/edit">
            <img class="mr-1 ml-2" src="/sites/all/themes/plastindia_registration/assets/img/settings.svg" alt="">
            Account
              Settings</a>
            <?php if (isset($user->roles[3]) == 'exhibitor' || isset($user->roles[4]) == 'exhibitorshared') {
              if ($user->roles[3] == 'exhibitor' || isset($user->roles[4]) == 'exhibitorshared' || $user->roles[18] == 'startup') {
                $URL_MYPROFILE = $base_url . "/user/" . $user->uid;
              }
              if ($user->roles[10] == 'tmp_exhibitor') {
                $URL_MYPROFILE = $base_url . "/user/" . $user->uid . "/edit/exhibitor";
              }
              /* if($_SESSION['subexlogin']['role']=='exhibitorshared')
                        {
                            $URL_MYPROFILE=$base_url."/user/".$useruid;
                        } */

            ?>
              <!--<a  class="dropdown-item" href="<?php echo $base_url; ?>/member/viewprofile/<?php echo $mem_nid; ?>" >My Profile</a>-->
              <a class="dropdown-item" href="<?php echo $URL_MYPROFILE; ?>">
              <img class="mr-1 ml-2" src="/sites/all/themes/plastindia_registration/assets/img/account_circle.svg" alt="">
              My Profile</a>
              <!--<a class="dropdown-item" href="<?php echo $base_url; ?>/user/<?php echo $user->uid; ?>/edit">Edit Profile</a>-->
            <?php } ?>

            <?php
            // if (isset($_SESSION['orgLoggedIn'][loggedin]) && $_SESSION['orgLoggedIn'][loggedin] == 1) {
            if ($user->uid > 0 && in_array('exhibitor', $user->roles)) {
            ?>
              <a class="nav-link waves-effect waves-light myOrder d-block d-xl-none"
                href="<?php echo $base_url; ?>/order/list">
                <img class="mr-1 ml-2" src="/sites/all/themes/plastindia_registration/assets/img/task.svg" alt="">
                My Order</a>
              <a class="nav-link waves-effect waves-light myInvoices d-block d-xl-none"
                href="<?php echo $base_url; ?>/invoice/list">
                <img class="mr-1 ml-2" src="/sites/all/themes/plastindia_registration/assets/img/receipt_long.svg" alt="">
                My Invoices</a>

            <?php } ?>
            <?php
            if (isset($_SESSION['orgLoggedIn']['loggedin']) && $_SESSION['orgLoggedIn']['loggedin'] == 1) {
              // if ($user->uid > 0 && in_array('exhibitor',$user->roles)) {
            ?>
              <!--<a class="dropdown-item" href="<?php echo '/masquerade/unswitch/back?token=' . drupal_get_token('masquerade/unswitch'); ?>">Back to Organiser login</a>-->
              <!-- <a class="dropdown-item" href="<?php echo $base_url; ?>/swuser/revoke">Back to Organiser login</a> -->
            <?php } ?>
            <a class="dropdown-item" href="<?php echo $base_url; ?>/logout">
            <img class="mr-1 ml-2" src="/sites/all/themes/plastindia_registration/assets/img/logout.svg" alt="">
            Logout</a>
          </div>
        </li>
      </ul>
    <?php } ?>

  </nav>
  <!-- multi Navbar ->
<nav class="mb-1 navbar navbar-expand-lg navbar-dark secondary-color lighten-1">
  <a class="navbar-brand" href="#">Navbar</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent-555"
    aria-controls="navbarSupportedContent-555" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarSupportedContent-555">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="#">Home
          <span class="sr-only">(current)</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Features</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Pricing</a>
      </li>
       <!-- Dropdown ->
      <li class="nav-item dropdown multi-level-dropdown">
        <a href="#" id="menu" data-toggle="dropdown" class="nav-link dropdown-toggle w-100">Dropdown</a>
        <ul class="dropdown-menu mt-2 rounded-0 border-0 z-depth-1">
          <li class="dropdown-item dropdown-submenu p-0">
            <a href="#" data-toggle="dropdown" class="dropdown-toggle  w-100">Click Me Too! </a>
            <ul class="dropdown-menu ml-2 rounded-0  border-0 z-depth-1">
              <li class="dropdown-item p-0">
                <a href="#" class="w-100">Hey</a>
              </li>
              <li class="dropdown-item p-0">
                <a href="#" class="w-100">Hi</a>
              </li>
                <li class="dropdown-item dropdown-submenu p-0">
                <a href="#" data-toggle="dropdown" class="dropdown-toggle w-100">Hello </a>
                <ul class="dropdown-menu mr-2 rounded-0  border-0 z-depth-1 ">
                  <li class="dropdown-item p-0">
                    <a href="#" class=" w-100">Some</a>
                  </li>
                  <li class="dropdown-item p-0">
                    <a href="#" class="w-100">Text</a>
                  </li>
                </ul>
              </li>
            </ul>
          </li>
          <li class="dropdown-item dropdown-submenu">
            <a href="#" data-toggle="dropdown" class="dropdown-toggle w-100">Click me </a>
            <ul class="dropdown-menu mr-2 rounded-0 border-0 z-depth-1 r-100 ">
              <li class="dropdown-item p-0">
                <a href="#" class="w-100">How</a>
              </li>
              <li class="dropdown-item p-0">
                <a href="#" class="w-100">are</a>
              </li>
              <li class="dropdown-item p-0">
                <a href="#" class="w-100">you </a>
              </li>
            </ul>
          </li>
        </ul>
      </li>
    </ul>
    <ul class="navbar-nav ml-auto nav-flex-icons">
      <li class="nav-item">
        <a class="nav-link waves-effect waves-light">1
          <i class="fas fa-envelope"></i>
        </a>
      </li>
      <li class="nav-item avatar dropdown">
        <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink-55" data-toggle="dropdown"
          aria-haspopup="true" aria-expanded="false">
          <img src="https://mdbootstrap.com/img/Photos/Avatars/avatar-2.jpg" class="rounded-circle z-depth-0"
            alt="avatar image">
        </a>
        <div class="dropdown-menu dropdown-menu-lg-right dropdown-secondary"
          aria-labelledby="navbarDropdownMenuLink-55">
          <a class="dropdown-item" href="#">Action</a>
          <a class="dropdown-item" href="#">Another action</a>
          <a class="dropdown-item" href="#">Something else here</a>
        </div>
      </li>
    </ul>
  </div>
</nav>
<!--/multi end Navbar -->

  <!-- masquerading Bar  -->
  <?php
  // Check if the user is logged in and has the exhibitor role
  if ($user->uid > 0 && (in_array('exhibitor', $user->roles) || in_array('startup', $user->roles))) {
  ?>
    <?php
    // Check if the user is masquerading
    if (isset($_SESSION['orgLoggedIn'][loggedin]) && $_SESSION['orgLoggedIn'][loggedin] == 1) {

    ?>
      <div class="mx-3">
        <div class="masquerading-info d-block d-md-flex mt-4">
          <div class="content-msg mt-auto mb-auto "><img class="mr-2"
              src="/sites/all/themes/plastindia_registration/assets/img/supervised_user_circle.svg" alt=""><span>You
              are now masquerading as (<?php echo $customer->legalName; ?>) <img
                src="/sites/all/themes/plastindia_registration/assets/img/help_outline.svg" alt=""></span> </div>
          <a class=" ml-0 ml-md-4 text-white mr-2 mt-3 mt-md-0" href="<?php echo $base_url; ?>/swuser/revoke" title="Back to Organiser"><i
              class="fas fa-angle-left pr-2"></i>Back to organiser</a>
        </div>
      </div>
  <?php }
  } ?>


  <!-- masquerading Bar  -->


  <div class="container-fluid" class="clear-block">
    <!--id="container"-->
    <br />
    <div class="card remove-shadow">
      <div class="card-body">

        <!--<div id="header">


        <?php if (isset($primary_links)) : ?>
          <? php // print theme('links', $primary_links, array('class' => 'links primary-links'))
          ?>
        <?php endif; ?>
        <?php if (isset($secondary_links)) : ?>
          <?php print theme('links', $secondary_links, array('class' => 'links secondary-links')) ?>
        <?php endif; ?>

    <!--div id="header-region" class="clear-block"> <?php print $header; ?></div-->

        <?php if ($left): ?>
          <div id="sidebar-left" class="sidebar">
            <?php if ($search_box): ?><div class="block block-theme"><?php print $search_box ?></div>
            <?php endif; ?>
            <?php print $left ?>
          </div>
        <?php endif; ?>

        <div id="center">
          <div id="squeeze">
            <div class="right-corner">
              <div class="left-corner">
                <!-- <?php print $breadcrumb; ?>-->
                <!--<?php if ($mission): print '<div id="mission">' . $mission . '</div>';
                    endif; ?>-->
                <?php if ($tabs): print '<div id="tabs-wrapper" class="clear-block">';
                endif; ?>
                <?php if ($title): print '<h2' . ($tabs ? ' class="with-tabs"' : '') . '>' . $title . '</h2>';
                endif; ?>
                <?php if ($tabs): print '<ul class="tabs primary">' . $tabs . '</ul></div>';
                endif; ?>
                <?php if ($tabs2): print '<ul class="tabs secondary">' . $tabs2 . '</ul>';
                endif; ?>
                <?php // if ($show_messages && $messages): print $messages;
                //endif;
                ?>
                <?php print $help; ?>
                <div class="progress md-progress">
                  <div class="progress-bar brand" role="progressbar" style="width: 6%"
                    aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                <div class="clear-block">
                  <?php print $content ?>
                </div>
                <?php print $feed_icons ?>


              </div>
            </div>
          </div> <!-- /.left-corner, /.right-corner, /#squeeze, /#center -->

          <?php if ($right): ?>
            <div id="sidebar-right" class="sidebar">
              <?php if (!$left && $search_box): ?><div class="block block-theme"><?php print $search_box ?>
                </div><?php endif; ?>
              <?php print $right ?>
            </div>
          <?php endif; ?>

        </div>
      </div>

      <?php include_once(dirname(dirname(dirname(__FILE__))) . "/modules/custom/bookingcart/templates/edir_pageredirect.tpl.php"); ?>

    </div>

  </div>
  <br>
  <!-- /layout -->
  <div id="footer"><?php print $footer_message . $footer ?></div>



  <?php print $closure ?>

  <?php print $closure ?> <?php echo $_SESSION['videoobjects'];
                          unset($_SESSION['videoobjects']); ?>
  <div id="adpMask_adpC" class="black_overlay" style="display:none;">&nbsp;</div>
  <script type="text/javascript" src="<?php echo $base_url; ?>/sites/all/themes/plastindia/assets/js/mdb.min.js">
  </script>
  <?php MessageHandler::render(); ?>
  </body>
  <script>
    // Material Select Initialization
    $(document).ready(function() {
      $('.mdb-select').materialSelect();

      // $('#edit-notify').attr('checked', false);
      //$('#edit-notify').val(0);
    });
  </script>

  <span id="baseUrlCheck" style="display:none"><?php echo $base_url; ?></span>
  <script>
    $('.multi-level-dropdown .dropdown-submenu > a').on("mouseenter", function(e) {
      var submenu = $(this);
      $('.multi-level-dropdown .dropdown-submenu .dropdown-menu').removeClass('show');
      submenu.next('.dropdown-menu').addClass('show');
      e.stopPropagation();
      return false;
    });

    $('.multi-level-dropdown .dropdown').on("hidden.bs.dropdown", function() {
      // hide any open menus when parent closes
      $('.multi-level-dropdown .dropdown-menu.show').removeClass('show');
      return false;
    });
  </script>

</html>