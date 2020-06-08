<?php
require 'config.php';
require 'inc/session.php';
require 'inc/home_core.php';
if($_session->isLogged() == false)
	header('Location: index.php');

$_page = 1;

$role = $_session->get_user_role();
if($role != 1 && $role != 2)
	header('Location: items.php');

if(isset($_POST['act']) && $_POST['act'] == 'reqinfo') {
	$interval = $_POST['int'];
	
	$res = array(
		$_home->get_new_items($interval),
		$_home->get_checked_in($interval),
		$_home->get_checked_out($interval),
	);
	
	$_check_in_price = $_home->get_checked_in_price($interval);
	$_check_out_price = $_home->get_checked_out_price($interval);
	
	$res[] = '$'.$_check_in_price;
	$res[] = '$'.$_check_out_price;
	
	$res = implode('|', $res);
	
	echo $res;
	die();
}
?>
<!DOCTYPE HTML>
<html>
<?php require 'inc/head.php'; ?>
<body>
	<div id="main-wrapper">
		<?php require 'inc/header.php'; ?>
		
		<div class="wrapper-pad">
			<h2>SELAMAT DATANG </h2>
			<!--<ul id="selectors">
				<li class="selected" value="today">TODAY</li>
				<li value="this_week">THIS WEEK</li>
				<li value="this_month">THIS MONTH</li>
				<li value="this_year">THIS YEAR</li>
				<li value="all_time">ALL TIME</li>
			</ul> -->
			
			<div id="fdetails">
				<div class="element">
				
				</div>
			</div>
		</div>
		
		<div class="clear" style="margin-bottom:40px;height:1px;"></div>
		<div class="border" style="margin-bottom:30px;"></div>
		
		<div class="wrapper-pad">
			<h3>CLOCK</h3>
			<div id="f2details">
			<iframe scrolling="no" frameborder="no" clocktype="html5" style="overflow:hidden;border:0;margin:0;padding:0;width:450px;height:210px;"src="https://www.clocklink.com/html5embed.php?clock=048&timezone=JOG&color=blue&size=450&Title=&Message=&Target=&From=2019,1,1,0,0,0&Color=blue"></iframe>
			</div>
		</div>
		
		<div class="clear" style="height:50px;"></div>
	</div>
</body>
</html>