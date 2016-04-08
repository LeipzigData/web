<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title><?php wp_title('|', 1, 'right'); ?> <?php bloginfo('name'); ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<!-- <link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" /> -->

<link rel="Stylesheet" type="text/css" href="<?php echo get_stylesheet_directory_uri();?>/reset.css" />
<link rel="Stylesheet" type="text/css" href="<?php echo get_stylesheet_directory_uri();?>/style.css?t=<?php filemtime(bloginfo('stylesheet_url')); ?>" />

<?php #wp_head(); ?>
</head>

<body>

<div id="page">
    <div id="header">
        <div id="header-bar">www.leipzig-data.de</div>
        <div id="header-img"></div>
        <div id="header-menu">
            <?php wp_nav_menu(array('theme_location' => 'header-menu-left', 'container_class' => 'header-menu-left', 'menu_id' => 'left')); ?>
            <div id="left-slant"></div>        
            <?php wp_nav_menu(array('theme_location' => 'header-menu-right', 'container_class' => 'header-menu-right', 'menu_id' => 'right')); ?>        
            <div id="right-slant"></div>
        </div>        
    </div>
    
    
