
<!-- This class comes from space.min.css. It is automatically included by the framework. -->
<div class="intro padding-left-30">
	<h2>This page doesn't use bootstrap layout. It is defineded in register_users.php.</h2>
</div>


<!-- A custom form example -->
<div class="padding-left-30">
	<br /><br />
	<h2>Custom Form Example</h2>
	<h4>Click submit for more information.</h4>
	<form method="post" action="<?php echo site_url('/register-users/do-register/'); ?>">
		<p>
			<label>Name: </label>
			<input type="text" name="name" value="" />
		</p>
		
		<p>
			<label>Email: </label>
			<input type="text" name="email" value="" />
		</p>
		
		<p>
			<input type="submit" value="Submit" name="submit" class="btn-submit" />
		</p>
	</form>
</div>