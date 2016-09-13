# Crear word RTF con php
```
<?php
require('ToRtf.php');
$f = new ToRtf();
$f->fichero = 'plantilla.rtf';
$f->fsalida = 'nuevo.rtf';
$f->dirsalida = '';
$f->retorno = 'fichero';
$f->prefijo = 'pre_';
$f->valores = array(
	'#*DIRECCION*#' => "Av. Los Alamos 150",
	'#*CIUDAD*#' => "Lima",
	'#*NOMBRE*#' => "El Guille",
	'#*NOMBREDESTINO*#' => "A TI",
	'#*FECHA*#' => date('d/m/Y'),
	'#*EMPRESA*#' => "SOLUCIONES S.A.C.",
	'#*PUESTO*#' => "Administrador",
	'#*DIRECCIONDESTINO*#' => "Av. Los Nogales 200",
	'#*CIUDADDESTINO*#' => "Callao",
	);
$f->rtf();
?>
```
