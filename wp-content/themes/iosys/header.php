<!DOCTYPE html>
<!--[if lt IE 7]><html lang="en" class="no-js ie6"><![endif]--> 
<!--[if IE 7]><html lang="en" class="no-js ie7"><![endif]--> 
<!--[if IE 8]><html lang="en" class="no-js ie8"><![endif]--> 
<!--[if gt IE 8]><!--> 
<html lang="en" class="no-js">
<!--<![endif]-->

<head>
  <meta charset="<?php bloginfo( 'charset' ); ?>" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"> 
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" /> 
  <title><?php wp_title('|', true, 'right'); bloginfo('name');?></title>
  <link rel="stylesheet" href="css/bootstrap.min.css"> 
  <link rel="stylesheet" href="css/animate.css"> 
  <link rel="stylesheet" href="css/font-awesome.min.css">
  <link rel="stylesheet" href="css/jquery.easy-pie-chart.css">
  <link rel="stylesheet" href="css/styles.css">
  <link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_uri(); ?>" />

  <!-- REVOLUTION BANNER CSS SETTINGS --> 
  <link rel="stylesheet" type="text/css" href="rs-plugin/css/settings.css" media="screen" />

  <script src="js/modernizr.custom.32033.js"></script> 

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries --> 
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// --> 
  <!--[if lt IE 9]> 
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script> 
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script> 
  <![endif]--> 

<?php wp_head(); ?>
  
  <style>
      .home-ad{
          position: fixed;
          right: 20px;
          top:200px;
          border: 1px solid #f2f2f2;
          background: rgb(255, 255, 255);
          border-radius: 0;
          z-index: 9999;
      }
      .home-ad .close{
          float: right;
          color: #FFF;
          background: #6B6B6B;
          width: 20px;
          height: 20px;
          line-height: 16px;
          display: inline-block;
          font-size: 12px;
          font-weight: normal;
          text-align: center;
          text-decoration: none;
          text-shadow: none;
          margin-bottom: 5px;
      }
      .home-ad div#carbonads {
          padding: 10px;
          max-width: 150px;
      }
      .home-ad div#carbonads a.carbon-img {
          display: inline-block;
          float: left; 
      }
      .home-ad div#carbonads .carbon-wrap:after {
          content: "";
          display: block;
          clear: both; 
      }
      .home-ad div#carbonads .carbon-text {
          font-size: 12px;
          text-align: left;
          color: #333;
          display: block;
          padding-top: 10px;
          padding-bottom: 10px;
          clear: both;
      }
      .home-ad div#carbonads .carbon-text:hover {
          text-decoration: none; 
      }
      .home-ad div#carbonads .carbon-poweredby {
          font-size: 75%;
          color: #bebebe; 
      }
  </style>
</head>
<body>
  <!-- loding -->
  <div class="pre-loader">
    <div class="load-con">
      <img src="img/title-logo.png" class="animated fadeInDown" alt="株式会社イオシス">
      <div class="spinner">
        <div class="bounce1"></div>
        <div class="bounce2"></div>
        <div class="bounce3"></div>
      </div>
    </div>
  </div>
  
  <!-- page down -->
  <div class="go-down">
    <a href="#about">
      <i class="fa fa-angle-down fa-3x"></i>
    </a>
  </div>
    
  <!-- Wrap all page content here -->
  <div id="wrap" class="home">
    <header class="masthead">
      <div class="slider-container" id="slider">
        <div class="tp-banner-container">
          <div class="tp-banner">
            <ul>
              <li data-transition="slotfade-horizontal" data-slotamount="7" data-masterspeed="500">
                <!-- MAIN IMAGE -->
                <img src="img/dummy.png" data-lazyload="img/samples/slider-bk2.jpg" alt="slidebg1" data-bgfit="cover" data-bgposition="center center" data-bgrepeat="no-repeat">
                <!-- LAYERS -->

                <!-- LAYER NR. 1 -->
                <div class="tp-caption lfl fadeout" data-x="left" data-y="center" data-hoffset="0" data-voffset="0" data-speed="500" data-start="700" data-easing="Power4.easeOut">
                  <img src="img/samples/iphone.png" alt="">
                </div>
                <div class="tp-caption large_white_bold sft" data-x="520" data-y="center" data-hoffset="0" data-voffset="-120" data-speed="500" data-start="1200" data-easing="Power4.easeOut">
                  <h1>Welcome  To  Iosys</h1>
                </div>
                <div class="tp-caption large_white_light sfb" data-x="520" data-y="center" data-hoffset="0" data-voffset="-40" data-speed="1000" data-start="1300" data-easing="Power4.easeOut">
                    We Make
                </div>
                <div class="tp-caption large_white_light sfb" data-x="520" data-y="center" data-hoffset="0" data-voffset="10" data-speed="1000" data-start="1300" data-easing="Power4.easeOut">
                    A New Culture And Our Culture
                </div>
<!--                <div class="tp-caption large_white_light sfb" data-x="520" data-y="center" data-hoffset="0" data-voffset="60" data-speed="1000" data-start="1300" data-easing="Power4.easeOut">
              Websites, Bradings & Web Apps
                </div>
                <div class="tp-caption sfb hidden-xs" data-x="520" data-y="center" data-hoffset="0" data-voffset="150" data-speed="1000" data-start="1700" data-easing="Power4.easeOut">
                  <a href="#about" class="btn btn-primary btn-lg">LEARN MORE</a>
                </div>-->
              </li>
              
              <li data-transition="slotfade-horizontal" data-slotamount="7" data-masterspeed="500">
                <!-- MAIN IMAGE -->
                <img src="img/dummy.png" data-lazyload="img/samples/slider-bk.jpg" alt="slidebg1" data-bgfit="cover" data-bgposition="center center" data-bgrepeat="no-repeat">
                <!-- LAYERS -->
                <div class="tp-caption italic large_white_light sft hidden-xs" data-x="left" data-y="center" data-hoffset="0" data-voffset="-100" data-speed="700" data-start="1300" data-easing="Power4.easeOut">
                    We Develop
                </div>
                <div class="tp-caption italic large_white_light sfl hidden-xs" data-x="left" data-y="center" data-hoffset="0" data-voffset="-50" data-speed="700" data-start="1500" data-easing="Power4.easeOut">
                    Strong .
                </div>
                <div class="tp-caption italic large_white_light sfb hidden-xs" data-x="left" data-y="center" data-hoffset="147" data-voffset="-50" data-speed="700" data-start="1700" data-easing="Power4.easeOut">
                    Beautiful .
                </div>
                <div class="tp-caption italic large_white_light sfr hidden-xs" data-x="left" data-y="center" data-hoffset="335" data-voffset="-50" data-speed="700" data-start="1900" data-easing="Power4.easeOut">
                    Functional
                </div>
<!--                <div class="tp-caption lfb " data-x="left" data-y="center" data-hoffset="0" data-voffset="25" data-speed="1000" data-start="1900" data-easing="Power4.easeOut">
                  <a href="#about" class="btn btn-naked">Learn More About Us <span class="fa fa-angle-right"></span></a>
                </div>-->
              </li>
<!--              <li data-transition="slotfade-horizontal" data-slotamount="7" data-masterspeed="500">
                 MAIN IMAGE 
                <img src="img/dummy.png" data-lazyload="img/samples/slider-bk3.jpg" alt="slidebg1" data-bgfit="cover" data-bgposition="center center" data-bgrepeat="no-repeat">
                 LAYERS 

                 LAYER NR. 1 
                <div class="tp-caption sft fadeout" data-x="center" data-y="center" data-hoffset="0" data-voffset="0" data-speed="500" data-start="700" data-easing="Power4.easeOut">
                  <img src="img/samples/macbook-bl.png" class="macbook-image" alt="">
                </div>

                <div class="tp-caption large_white_light italic sfb hidden-xs" data-x="left" data-y="center" data-hoffset="0" data-voffset="0" data-speed="1000" data-start="1300" data-easing="Power4.easeOut">
                  <a href="#portfolio" class="btn btn-naked">Check Our Work</a>
                </div>
                <div class="tp-caption italic large_white_light sft hidden-xs" data-x="right" data-y="center" data-hoffset="0" data-voffset="0" data-speed="1000" data-start="1300" data-easing="Power4.easeOut">
                  <a href="#team" class="btn btn-naked">Meet The Team</a>
                </div>
              </li>-->
              
            </ul>
            <div class="tp-bannertimer"></div>
          </div>
        </div>
      </div>

      <!-- Fixed navbar -->
      <div class="navbar navbar-static-top" id="nav" role="navigation">
        <div class="container">
          <!-- logo -->
          <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
              <span class="sr-only">Toggle navigation</span>
              <i class="fa fa-align-justify"></i>
            </button>
            <a class="navbar-brand" href="#">
                <img src="<?php apply_filters('get_logo', null); // ロゴ ?>" alt="<?php echo bloginfo('name'); ?>">
            </a>
          </div>

          <!-- Collect the nav links, forms, and other content for toggling -->
          <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-right">
              <li class="active"><a href="#slider">Home</a></li>
              <li><a href="#about">ご挨拶</a></li>
              <li><a href="#services">イオシスでやってること</a></li>
              <li><a href="#recruit">一緒に働きませんか</a></li>
              <li><a href="#company">会社概要</a></li>
              <li><a href="#get-in-touch">お問い合わせ</a></li>
              <li class="social-nav visible-lg">
                <a href="#"><i class="fa fa-twitter"></i></a>
                <a href="#"><i class="fa fa-facebook"></i></a>
                <a href="#"><i class="fa fa-google-plus"></i></a>
                <a href="#"><i class="fa fa-linkedin"></i></a>
              </li>
            </ul>
          </div>
          <!-- /.navbar-collapse -->
        </div>
        <!--/.container -->
      </div>
      <!--/.navbar -->

    </header>