<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8" />			
		<link href="<?=base_url('includes/css/controls.css')?>" rel="stylesheet" type="text/css">
		<link href="<?=base_url('includes/css/header.css')?>" rel="stylesheet" type="text/css">
		<link href="<?=base_url('includes/css/misc.css')?>" rel="stylesheet" type="text/css">
		<link href="<?=base_url('includes/css/front-page.css')?>" rel="stylesheet" type="text/css">
		<title>Room Allocator</title>
	</head>
	<body>
		<div id="whole-wrapper">
			<div id="page-header">				
				<div id="topbar-container">											
					<a id="site-title" href="<?=base_url()?>" class="floatleft">
						<h1>RAFA - Room Allocator For All</h1>	
					</a>
<?php if ($this->session->userdata('is_login')): ?>
					<ul id="user-actions">						
						<li>
							<a id="profile-logout" title="Sign Out" href="<?=site_url('/auth/logout')?>">
								<span class="octicon octicon-log-out"></span>
							</a>	
						</li>										
					</ul>						
<?php else: ?>
					<div class="header-actions">
	<?php if (uri_string()=='auth/login'): ?>
						<a class="button primary" href="<?=site_url('/auth/register')?>">Sign Up</a>
	<?php endif; ?>
  						<a class="button" href="<?=site_url('/auth/login')?>">Sign In</a>
					</div>						
<?php endif; ?>
				</div>
			</div>
			<div class="site clearfix">
				<div id="site-container" class="context-loader-container <?php if ($this->session->userdata('is_login')) echo "container";?>" data-pjax-container="">	