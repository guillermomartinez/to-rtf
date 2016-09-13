<?php
class ToRtf
{
	public $fichero;//-- fichero de origen
	public $fsalida;//-- nombre del nuevo fichero
	public $dirsalida;//-- directorio del nuevo fichero
	public $retorno;//-- fichero (retorna el fichero modo descarga)| nombre (retorna el nombre del fichero)
	public $prefijo;//-- prefijo del nuevo fichero
	public $valores;//-- valores a reemplazar
	public $error;//-- retorna los errores
	function __construct ()
	{//-- CARGAMOS VALORES POR DEFECTO
		$this->fichero ='plantilla.rtf';
		$this->fsalida ='new.rtf';
		$this->dirsalida ='';
		$this->retorno = 'fichero'; 
		$this->prefijo = date('dmYHis');
		$this->valores = array();
		$this->error = '';		
	}
	function leerArchivo()
	{//-- CARGAMOS EL FICHERO EN UNA VARIABLE
		if(is_file($this->fichero)){
			$texto = file($this->fichero);
			$ntexto = sizeof($texto);
			$todo ='';
			for($n=0;$n<$ntexto;$n++)
			{
				$todo = $todo.$texto[$n];
			}
			return $todo;
		}else{
			$this->error = 'Archivo de Origen no existe';
			return false;
		}
	}
	function rtf(){		
		$this->fsalida = $this->prefijo.$this->fsalida;//-- DEFINIMOS EL NOMBRE DEL NUEVO FICHERO
		if($txtplantilla = $this->leerArchivo()){//-- COMPROBAMOS SI SE CARGO BIEN EL FICHERO
			$punt = fopen($this->dirsalida.$this->fsalida,"w");//-- CREAMOS EL NUEVO FICHERO
			if(is_array($this->valores) and count($this->valores)>0){				
				foreach($this->valores as $k=>$v){//-- REEMPLAZAMOS LAS VARIABLES					
					$v = utf8_decode($v);
					$txtplantilla = str_replace($k,$v,$txtplantilla);
				}
			}
			fputs($punt,$txtplantilla);//-- AGREGAMOS EL CONTENIDO AL NUEVO FICHERO
			fclose($punt);//- CERRAMOS LA CONEXION DEL FICHERO
			if($this->retorno=="fichero"){//-- RETORNA EN MODO DE DESCARGA
				header ("Content-Disposition: attachment; filename=".$this->fsalida."\n\n"); 
				header ("Content-Type: application/octet-stream");
				readfile($this->dirsalida.$this->fsalida);
			}elseif($this->retorno=="nombre"){//-- RETORNA EL NOMBRE DEL FICHERO
				return $this->fsalida;
			}
		}
	}
}
?>