<center><h1>Registro de Destinos</h1><BR>
<form action="registrado-hoteles" method="post">
	<input type="hidden" name="_token" value="{{ csrf_token() }}">
	<label>Nombre:</label>
		<input type="text" maxlength="20" class="form-control" placeholder="Nombre del Hotel" name="i_nombre" required>
	</br>
	<label>Ubicacion:</label>
		<input type="text" maxlength="20" class="form-control" placeholder="Nombre del Hotel" name="i_nombre" required>
	</br>
	<label>Descripcion del Lugar:</label>
		<textarea name ="i_descripcion"placeholder="Describa el lugar"></textarea>
	</br>
	<label>Lugares Emblematicos:</label>
		<textarea name ="i_lugares"placeholder="Indique Sitios de Interes Turistico"></textarea>
	</br>
	<label>Estado:</label>
		<select class="form-control m-bot15" name="s_estado">
		</select>
    </br>
    <label>Dirección:</label>
   		<input type="text" maxlength="20" class="form-control" placeholder="Nombre del Hotel" name="i_direccion"  required>
			<div class="ec-stars-wrapper">
			<label>Indique La Categoria del hotel a registrar:</label>

			<input type="radio" name="i_categoria" title="Categoria de 1 estrellas" value="1">&#9733;
			<input type="radio" name="i_categoria" title="Categoria de 2 estrellas" value="2">&#9733; &#9733;
			<input type="radio" name="i_categoria" title="Categoria de 3 estrellas" value="3">&#9733; &#9733; &#9733;
			<input type="radio" name="i_categoria" title="Categoria de 4 estrellas" value="4">&#9733; &#9733; &#9733; &#9733;
			<input type="radio" name="i_categoria" title="Categoria de 5 estrellas" value="5">&#9733; &#9733; &#9733; &#9733; &#9733;

			</div>
	<label>Servicios que ofrece el Hotel (Seleccion Multiple):</label>
	<br>
	<select name="s_servicios[]" size = 2 multiple= "multiple" >
	</select>
	<br>
	<input type="submit" value="Registrar">
</form>
</center>