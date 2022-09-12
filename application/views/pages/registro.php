	
	<div class="container__register"></div>
	<div class="container__register">
		<form action="<?php echo site_url('pages/registrar_usuario'); ?>" method="POST">

			<h3 class="container_title"><i class="fa-solid fa-user"></i>REGISTRO NUEVO USUARIO</h3>
			<div class="pedidosT">
			

			<table class="pedidosT">
				<tr>
					<th class="td-label"><label  for="usuario">Nombre:</label></th>
					<td><input class="register__input" type="text" name="nombre" required autofocus><i class="fa-regular fa-id-card"></i></td>
					<th class="td-label"><label for="usuario">Apellido:</label></th>
					<td><input class="register__input" type="text" name="apellido" required></td>
					
				</tr>
				<tr>
					<th class="td-label"><label for="usuario">Mail:  </label></th>
					<td><input type="email" class="register__input" name="email" required><i class="fa-solid fa-envelope"></i></td>
					
				</tr>
				<tr>
					<th class="td-label"><label for="usuario">Clave:  </label></th>
					<td><input type="password" class="register__input" minlength="8" name="clave" title="Debe contener al menos una mayuscula, un número y 8 caracteres como mínimo!" required><i class="fa-solid fa-key"></i></td>
					<th class="td-label"><label for="usuario">Confirme la clave:  </label></th>
					<td><input type="password" class="register__input" minlength="8" name="clave_confirmada" title="Debe contener al menos una mayuscula, un número y 8 caracteres como mínimo!" required></td>
					
				</tr>
				<tr>
					<th class="td-label"><label for="usuario">Teléfono: </label></th>
					<td><input type="text" class="register__input" name="telefono" title="Ingrese su número de contacto!" required><i class="fa-solid fa-square-phone"></i></td>
				</tr>
				<tr>
					<th class="td-label"><label for="usuario">CUIT:</label></th>
					<td><input class="register__input" type="text" minlength="11" maxlength="11" title="Ingrese su cuit, sin espacios ni guiones!" required><i class="fa-solid fa-language"></i></th>
					<th class="td-label"><label for="usuario">Domicilio: </label></th>
					<td><input class="register__input" type="text" name="domicilio"></td>
				</tr>
				<tr>
					<th class="td-label"><label  for="usuario">Ciudad:</label></th>
					<td><input class="register__input" type="text" name="ciudad"><i class="fa-solid fa-building-flag"></i></td>
					<th class="td-label"><label for="usuario">Provincia: </label></th>
					<td><input class="register__input" type="text" name="provincia"></td>
				</tr>
				<tr>
					<th class="td-label"><label for="usuario">Fecha de nacimiento: </label></th>
					<td><input class="register__input" type="date" name="fecha_nacimiento" title="Ingrese su fecha de nacimiento!" required><i class="fa-solid fa-cake-candles"></i></td>
				</tr>
				<tr>
					<th class="td-label"><label for="usuario">Tipo: </label></th>
					<td>
					<select class="register__input" name="tipo" id="tipo" required>
							<option value="1">Paciente</option>
							<option value="2">Médico</option>
							<option value="3">Veterinario</option>
							<option value="4">Administrativo</option>
						</select>
						<i class="fa-solid fa-user-tie"></i>
					</td>
					<th class="td-label"><label for="matricula">Matrícula: </label></th>
					<td><input class="register__input" type="number" name="matricula" maxlength="10" style="width: 80px;"></td>
				</tr>
				
			</table>
			</div>
			<div class="pedidosT" ><button type="submit" class="btn btn-insert">Registrar Usuario</button></div>
		</form>
	</div>
