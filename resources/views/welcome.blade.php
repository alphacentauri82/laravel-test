<!DOCTYPE html>
<html>
    <head>
        <title>EJERCICIO</title>

       
    </head>
    <body>
		<h1 style="background: #004554;color: #fefefe;padding: 25px;text-align: center; margin: 0px;">EJERCIO DE PRUEBA</h1>
        <div style="width: 50%; float:left">
			<h4 style="background: #295863;color: #fefefe; margin: 0px;padding: 10px;text-align: center;">DATOS</h4>
			<form method="POST" method="post" enctype="multipart/form-data"  style="margin: 25px">
				<span style="padding-top: 10px;">COLOQUE SUS ACHIVO DE DATOS<span><br>
				<input type="file" name="Archivito" style="padding-top: 10px;"><br>
				<input type="submit" value="Subir Archivo" style="background: #004554;color: white;border: none;padding-block-end: 10px;padding-block-start: 10px;padding-inline-start: 20px;padding-inline-end: 20px;font-size: initial; margin: 25px;">
			</form>
		</div>
		<div style="width: 50%; float:right ">
			<h4 style="background: #195e6e;color: #fefefe; margin: 0px;padding: 10px;text-align: center;">RESULTADOS</h4>
			@foreach ($resp as $resp)
				<p style="padding: 15px;">{{ $resp }}</p>
			@endforeach
		</div>
    </body>
</html>
