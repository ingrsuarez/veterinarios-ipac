

<body>
	


	<div class="login">
		
		<div class="login__logo" ><img src="<?php echo base_url(); ?>images/logo-color.png"></div>
		<h2>Login</h2>
		<p>Por favor ingrese su nombre de usuario y contraseña:</p>
		<form action="<?php echo site_url('pages/index'); ?>" method="POST">
			<br>
			<p>Usuario</p>
			<input type="text" name="username" value="" autofocus/>
			<br><br>
			<p>Password </p>
			<input type="password" name="password" value="" />
		
			<div><input class="submit" type="submit" value="Ingresar" />
				<label for="register">    -   </label>
			<input class="submit" form="register" type="submit" value="Registrarse" /></div>
		</form>
		<form id="register" action="<?php echo site_url('pages/registrar_usuario'); ?>" method="POST">
			
		</form>
	</div>

