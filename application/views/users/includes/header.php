<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Mosaddek">
    <meta name="keyword" content="FlatLab, Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">
    <link rel="shortcut icon" href="img/favicon.html">
    <title><?=$title;?></title>
    <!-- Bootstrap core CSS -->
    <link href="<?=base_url()?>css/bootstrap.min.css" rel="stylesheet">
    <link href="<?=base_url()?>css/bootstrap-reset.css" rel="stylesheet">
    <!--external css-->
    <link href="<?=base_url()?>assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <!--<link href="<?=base_url()?>assets/jquery-easy-pie-chart/jquery.easy-pie-chart.css" rel="stylesheet" type="text/css" media="screen"/>-->
    <!--<link rel="stylesheet" href="<?=base_url()?>css/owl.carousel.css" type="text/css">-->
  	<link href="<?=base_url()?>assets/advanced-datatable/media/css/demo_page.css" rel="stylesheet" />
  	<link href="<?=base_url()?>assets/advanced-datatable/media/css/demo_table.css" rel="stylesheet" />
    <!--<link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/bootstrap-datepicker/css/datepicker.css" />-->
    <!--<link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/bootstrap-datetimepicker/css/datetimepicker.css" />-->
  	<link rel="stylesheet" href="<?=base_url()?>assets/data-tables/DT_bootstrap.css" />
    
    <!--right slidebar-->
    <link href="<?=base_url()?>css/slidebars.css" rel="stylesheet">
    
    <!--Form Wizard-->
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>css/jquery.steps.css" />
    
    <!-- Custom styles for this template -->
    <link href="<?=base_url()?>css/style.css" rel="stylesheet">
    <link href="<?=base_url()?>css/style-responsive.css" rel="stylesheet" />



  </head>
  <body>
	<?php echo $this->session->flashdata('msg'); ?>
    <section id="container" >
        <!--header start-->
        <header class="header white-bg">
                <div class="sidebar-toggle-box">
                    <div class="fa fa-bars tooltips" data-placement="right" data-original-title="Toggle Navigation"></div>
                </div>
              <!--logo start-->
              <a href="<?=base_url().'Dashboard'?>" class="logo">NORA<span>HS</span></a>
              <!--logo end-->

              <div class="nav notify-row " id="top_menu">
                  <!--  notification start -->
                  <ul class="nav top-menu">
                      <!-- settings start -->

                      <!-- notification dropdown end -->
                  </ul>
                  <!--  notification end -->
              </div>
              <div class="top-nav ">
                  <!--search & user info start-->
                  <ul class="nav pull-right top-menu">
                      <!-- user login dropdown start-->
                      <li class="dropdown">
                          <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                              <i class="fa fa-tasks"></i>
                              <span class="badge bg-success">6</span>
                          </a>
                          <ul class="dropdown-menu extended tasks-bar " >
                              <div class="notify-arrow notify-arrow-green"></div>
                              <li>
                                  <p class="green">You have 6 pending tasks</p>
                              </li>
                              <li>
                                  <a href="#">
                                      <div class="task-info">
                                          <div class="desc">Dashboard v1.3</div>
                                          <div class="percent">40%</div>
                                      </div>
                                      <div class="progress progress-striped">
                                          <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%">
                                              <span class="sr-only">40% Complete (success)</span>
                                          </div>
                                      </div>
                                  </a>
                              </li>
                              <li>
                                  <a href="#">
                                      <div class="task-info">
                                          <div class="desc">Database Update</div>
                                          <div class="percent">60%</div>
                                      </div>
                                      <div class="progress progress-striped">
                                          <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%">
                                              <span class="sr-only">60% Complete (warning)</span>
                                          </div>
                                      </div>
                                  </a>
                              </li>
                              <li>
                                  <a href="#">
                                      <div class="task-info">
                                          <div class="desc">Iphone Development</div>
                                          <div class="percent">87%</div>
                                      </div>
                                      <div class="progress progress-striped">
                                          <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: 87%">
                                              <span class="sr-only">87% Complete</span>
                                          </div>
                                      </div>
                                  </a>
                              </li>
                              <li>
                                  <a href="#">
                                      <div class="task-info">
                                          <div class="desc">Mobile App</div>
                                          <div class="percent">33%</div>
                                      </div>
                                      <div class="progress progress-striped">
                                          <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: 33%">
                                              <span class="sr-only">33% Complete (danger)</span>
                                          </div>
                                      </div>
                                  </a>
                              </li>
                              <li>
                                  <a href="#">
                                      <div class="task-info">
                                          <div class="desc">Dashboard v1.3</div>
                                          <div class="percent">45%</div>
                                      </div>
                                      <div class="progress progress-striped active">
                                          <div class="progress-bar"  role="progressbar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100" style="width: 45%">
                                              <span class="sr-only">45% Complete</span>
                                          </div>
                                      </div>

                                  </a>
                              </li>
                              <li class="external">
                                  <a href="#">See All Tasks</a>
                              </li>
                          </ul>
                      </li>
                      <!-- settings end -->
                      <!-- inbox dropdown start-->
                      <li id="header_inbox_bar" class="dropdown">
                          <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                              <i class="fa fa-envelope-o"></i>
                              <span class="badge bg-important">5</span>
                          </a>
                          <ul class="dropdown-menu extended inbox">
                              <div class="notify-arrow notify-arrow-red"></div>
                              <li>
                                  <p class="red">You have 5 new messages</p>
                              </li>
                              <li>
                                  <a href="#">
                                      <span class="photo"><img alt="avatar" src="<?=base_url()?>img/avatar-mini.jpg"></span>
                                      <span class="subject">
                                      <span class="from">Jonathan Smith</span>
                                      <span class="time">Just now</span>
                                      </span>
                                      <span class="message">
                                          Hello, this is an example msg.
                                      </span>
                                  </a>
                              </li>
                              <li>
                                  <a href="#">
                                      <span class="photo"><img alt="avatar" src="<?=base_url()?>img/avatar-mini2.jpg"></span>
                                      <span class="subject">
                                      <span class="from">Jhon Doe</span>
                                      <span class="time">10 mins</span>
                                      </span>
                                      <span class="message">
                                       Hi, Jhon Doe Bhai how are you ?
                                      </span>
                                  </a>
                              </li>
                              <li>
                                  <a href="#">
                                      <span class="photo"><img alt="avatar" src="<?=base_url()?>img/avatar-mini3.jpg"></span>
                                      <span class="subject">
                                      <span class="from">Jason Stathum</span>
                                      <span class="time">3 hrs</span>
                                      </span>
                                      <span class="message">
                                          This is awesome dashboard.
                                      </span>
                                  </a>
                              </li>
                              <li>
                                  <a href="#">
                                      <span class="photo"><img alt="avatar" src="<?=base_url()?>img/avatar-mini4.jpg"></span>
                                      <span class="subject">
                                      <span class="from">Jondi Rose</span>
                                      <span class="time">Just now</span>
                                      </span>
                                      <span class="message">
                                          Hello, this is metrolab
                                      </span>
                                  </a>
                              </li>
                              <li>
                                  <a href="#">See all messages</a>
                              </li>
                          </ul>
                      </li>
                      <!-- inbox dropdown end -->
                      <!-- notification dropdown start-->
                      <li id="header_notification_bar" class="dropdown">
                          <a data-toggle="dropdown" class="dropdown-toggle" href="#">

                              <i class="fa fa-bell-o"></i>
                              <span class="badge bg-warning">7</span>
                          </a>
                          <ul class="dropdown-menu extended notification">
                              <div class="notify-arrow notify-arrow-yellow"></div>
                              <li>
                                  <p class="yellow">You have 7 new notifications</p>
                              </li>
                              <li>
                                  <a href="#">
                                      <span class="label label-danger"><i class="fa fa-bolt"></i></span>
                                      Server #3 overloaded.
                                      <span class="small italic">34 mins</span>
                                  </a>
                              </li>
                              <li>
                                  <a href="#">
                                      <span class="label label-warning"><i class="fa fa-bell"></i></span>
                                      Server #10 not respoding.
                                      <span class="small italic">1 Hours</span>
                                  </a>
                              </li>
                              <li>
                                  <a href="#">
                                      <span class="label label-danger"><i class="fa fa-bolt"></i></span>
                                      Database overloaded 24%.
                                      <span class="small italic">4 hrs</span>
                                  </a>
                              </li>
                              <li>
                                  <a href="#">
                                      <span class="label label-success"><i class="fa fa-plus"></i></span>
                                      New user registered.
                                      <span class="small italic">Just now</span>
                                  </a>
                              </li>
                              <li>
                                  <a href="#">
                                      <span class="label label-info"><i class="fa fa-bullhorn"></i></span>
                                      Application error.
                                      <span class="small italic">10 mins</span>
                                  </a>
                              </li>
                              <li>
                                  <a href="#">See all notifications</a>
                              </li>
                          </ul>
                      </li>
                      <li class="dropdown">
                          <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                              <img alt="" width="30"src="<?=base_url()?>img/doctor.png">
                              <span class="username"><?php echo $this->session->userdata("user_firstname") ?></span>
                              <b class="caret"></b>
                          </a>
                          <ul class="dropdown-menu extended logout">
                              <div class="log-arrow-up"></div>
                              <li><a href="#"><i class=" fa fa-suitcase"></i>Profile</a></li>
                              <li><a href="#"><i class="fa fa-cog"></i> Settings</a></li>
                              <li><a href="#"><i class="fa fa-bell-o"></i> Notification</a></li>
                              <li><a href="<?=base_url()?>Dashboard/Logout"><i class="fa fa-key"></i> Log Out</a></li>
                          </ul>
                      </li>

                      <!-- user login dropdown end -->
                  </ul>


                  <!--search & user info end-->
              </div>
          </header>
          <!--header end-->
          <!--sidebar start-->
          <aside>
              <div id="sidebar"  class="nav-collapse ">
                  <!-- sidebar menu start-->
                  <ul class="sidebar-menu" id="nav-accordion">
                      <li>
                          <a class="active" href="<?=base_url()?>Dashboard">
                              <i class="fa fa-dashboard"></i>
                              <span>Dashboard</span>
                          </a>
                      </li>

                      <?php
                       foreach($tasks as $task){
                      echo "<li class='sub-menu'>";
                      echo "<a href='javascript:;'>";
                      echo "<i class='".$task['task_logo']."'></i>";
                      echo "<span>".$task['task_name']."</span>";
                      echo "</a>";
                      echo "<ul class='sub'>";
                        foreach($permissions as $permission)
                        {
                          if($permission['task_id']==$task['task_id'])
                          {
                              echo "<li><a href='".base_url().$permission['permission_link']."'>".$permission['permission_name']."</a></li>";
                          }
                        }
                     echo "</ul>";
                    }
                      ?>
                      </li>
                  </ul>
                  <!-- sidebar menu end-->
              </div>
          </aside>
