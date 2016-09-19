<center>
<form class="form-horizontal" role="form" method="POST" action="entrar">
	<input type="hidden" name="_token" value="{{ csrf_token() }}">

	<div class="form-group">
		<label class="col-md-4 control-label">Usuario</label>
		<div>
			<input type="email" class="form-control" name="i_usuario" value="">
		</div>
	</div>

	<div class="form-group">
		<label class="col-md-4 control-label">Contraseña</label>
		<div>
			<input type="password" class="form-control" name="i_contrasenia">
		</div>
	</div>

	<div class="form-group">
		<div>
			<div class="checkbox">
				<label>
					<input type="checkbox" name="i_recordar"> Recordarme
				</label>
			</div>
		</div>
	</div>

	<a href="restaurar-contrasenia">Olvide mi contraseña</a>

	<div class="form-group">
		<div>
			<button type="submit" class="btn btn-primary">Ingresar</button>
		</div>

</center>