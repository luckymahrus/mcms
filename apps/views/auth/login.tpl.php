<!--
/***
 *
 * LOGIN.PHP 
 *
 * author		: Lucky Mahrus
 * copyright	: Tama Komunika Persada (c) 2012
 * license		: http://www.luckymahrus.com/
 * created		: 2013 February 7th / 10:57:00
 * last edit	: 2013 February 7th / 10:57:00
 * edited by	: Lucky Mahrus
 * version		: 2.0
 *
 */
-->

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="robots" content="noindex, nofollow">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title>{page_title}</title>
<link rel="stylesheet" href="<?=base_url()?>assets/templates/default/css/style.css" type="text/css" />

<script type="text/javascript" src="<?=base_url()?>assets/templates/default/js/plugins/jquery-1.7.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/templates/default/js/plugins/jquery-ui-1.8.16.custom.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/templates/default/js/plugins/jquery.alerts.js"></script>
<script type="text/javascript">
$(document).ready(function(){
	$('.loginform button').hover(function(){
		$(this).stop().switchClass('default','hover');
	},function(){
		$(this).stop().switchClass('hover','default');
	});
		
	$('#submit').click(function() {
		var form_data = {
			identity : $('#identity').val(),
			password : $('#password').val(),
			ajax : '1'
		};
		$.ajax({
			url: "<?php echo base_url('auth/ajax_login'); ?>",
			type: 'POST',
			async : false,
			data: form_data,
			success: function(msg) {
				//alert(msg);
				jAlert(msg, 'Login Status');
				if(msg == "Login Success")
				{
					window.location.replace("<?php echo base_url('dashboard'); ?>");
				}
			}
		});
		return false;
	});
	$( "#dialog" ).dialog({
		autoOpen: false,
		show: "blind",
		hide: "explode"
	});
});
</script>
<!--[if lt IE 9]>
	<script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>
<![endif]-->
</head>

<body class="login">

<div class="loginbox radius3">
	<div class="loginboxinner radius3">
    	<div class="loginheader">
        	<div class="logo"><img src="<?=base_url()?>assets/images/logo.png" alt="" /></div>
    	</div><!--loginheader-->

        <div class="loginform">
        	<div class="loginerror" id="loginerror"><p>Invalid username or password</p></div>
            <?php echo form_open(base_url('auth/login'), array('name' => 'login', 'id' => 'login','autocomplete' => 'off')); ?>
            	<p>
					<?php
                    echo form_label('Username / Email', 'identity', array('class' => 'bebas'));
                    echo form_input(array('name'=>'identity','id'=>'identity','class'=>'radius2','autocomplete' => 'off'));
                    ?>
                </p>
                <p>
					<?php
                    echo form_label('Password', 'password', array('class' => 'bebas'));
                    echo form_password(array('name'=>'password','id'=>'password','class'=>'radius2','autocomplete' => 'off'));
                    ?>
                </p>
                <p>
					<button class="radius3 bebas" name="submit" id="submit" value="Login">Sign in</button>
                </p>
                <p><a href="<?=base_url()?>lostpassword" class="whitelink small">Can't access your account?</a></p>
            <?php echo form_close(); ?>
        </div><!--loginform-->
    </div><!--loginboxinner-->
</div><!--loginbox-->

<div id="dialog" title="Basic modal dialog">
	<p>Adding the modal overlay screen makes the dialog look more prominent because it dims out the page content.</p>
</div>
<!-- Page rendered in {elapsed_time} seconds -->
</body>
</html>
