<!DOCTYPE html>
<!--[if lt IE 7]><html lang="en" class="no-js ie6"><![endif]--> 
<!--[if IE 7]><html lang="en" class="no-js ie7"><![endif]--> 
<!--[if IE 8]><html lang="en" class="no-js ie8"><![endif]--> 
<!--[if gt IE 8]><!--> 
<html lang="ja" class="no-js"> 
<!--<![endif]-->

<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"> 
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" /> 
<title><?php wp_title('|', true, 'right'); bloginfo('name');?></title>
<link rel="stylesheet" href="css/bootstrap.min.css"> 
<link rel="stylesheet" href="css/animate.css"> 
<link rel="stylesheet" href="css/font-awesome.min.css"> 
<link rel="stylesheet" href="css/styles.css">
<link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_uri(); ?>" />

<!-- REVOLUTION BANNER CSS SETTINGS --> 
<link rel="stylesheet" type="text/css" href="rs-plugin/css/settings.css" media="screen" /> 
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>