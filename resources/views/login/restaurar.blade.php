<center>
	<h1>Indique el usuario que desea recuperar</h1>
<form class="form-horizontal" role="form" method="POST" action="r">
	<input type="hidden" name="_token" value="{{ csrf_token() }}">

	<div class="form-group">
		<label class="col-md-4 control-label">Usuario</label>
		<div>
			<input type="email" class="form-control" name="i_usuario" value="">
		</div>
	</div>

	<div class="form-group">
		<div>
			<button type="submit" class="btn btn-primary">Restaurar</button>
		</div>

</center>