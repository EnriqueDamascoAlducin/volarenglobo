<?php
	class Conection
	{
		private $server;
		private $user;
		private $pass;
		private $db;
		private $con;
		public $sel;
		public $from;
		public $where;
       	public function Conection()
       	{
	       	$this->server="localhost";
			$this->user="root";
			$this->pass="";
			$this->db="volarenglobo";  
			try
			{
				$con= new PDO('mysql:host='. $this->server .';dbname='. $this->db .'',
					$this->user, 
					$this->pass,
					array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
			} catch (PDOException $e) 
			{
			  $con= $e;
			  echo "error de conexion";
			}
	  		return $con;
        }
        function conectar()
        {

			$conexion = new Conection();
		    $this->con=$conexion->Conection();
        }
       
		function consultas($campos,$tabla,$filtro,$tipo="")
		{
			$this->where=" WHERE ";
			if($filtro==""){
				$this->where="";
			}
			$this->from=" FROM ";
		    if($tipo=="select" || $tipo=="SELECT" || $tipo=="undefined" || $tipo==""){
		    	if ($campos=="SHOW FULL COLUMNS" || $campos== "show full columns") 
				{
					$this->sel="";
				}else
				{
					$this ->sel ="SELECT ";
				}
				$query=$this->sel.$campos.$this->from.$tabla.$this->where.$filtro;
				try{
					$data= $this->con->query($query)->fetchALL (PDO::FETCH_OBJ);
				} catch (Exception $e) {
					$data ="";
				}
		    }else if($tipo=="INSERT" || $tipo=="insert"){
		    	$query="INSERT INTO ". $tabla ." (".$campos.") VALUES (".$filtro.");";
		    	$data= $this->con->query("SET FOREIGN_KEY_CHECKS=0;". " ".$query);
		    	echo "Registro Agregado";
		    }else if($tipo=="UPDATE" || $tipo=="update"){
		    	$query=" UPDATE ".$tabla." SET ". $campos ." Where ".$filtro;
		    	$data= $this->con->query($query);
		    	echo "Registro Actualizado";
		    }else if($tipo=="delete" || $tipo=="DELETE"){
		    	$query=" delete from ".$tabla."  Where ".$filtro;
		    	$data= $this->con->query($query);
		    	echo "Registro Actualizado";
		    }
			return $data;
		}
		function create_table($tabla, $primaria,$extras,$foranea)
		{
			$conexion = new Conection();
		    $con=$conexion->Conection();
			$query=" Create table  IF NOT EXISTS ". $tabla ." ( ";
			$query= $query.$primaria." INT(11) NULL AUTO_INCREMENT COMMENT 'Llave Primaria' PRIMARY KEY, ";

			foreach ($extras as $extra) {
				$query2=$extra["campo"]." ".$extra["tipo"]." NULL COMMENT '".$extra["comentario"]."', "; 
				$query=$query.$query2;
			}
			$query=$query."register DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Registro' ,";
			$query =$query."status INT(11) NOT NULL DEFAULT '1' COMMENT 'Status' ";
			$query=$query." ) ENGINE = InnoDB";
			try {
				   $con->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );//Error Handling
				if($con->query($query)==true){
					echo "Tabla Creada <br>";
					if($foranea!="")
					{
						if($con->query($foranea))
					{
						echo "Llaves Foráneas Creadas";
						}else{
							echo "error con las foraneas";
						}
					}
					
				}else{
					echo "La Tabla ya existe";
				}
			} catch (Exception $e) {
				echo $e->getMessage();
			}
		}
		function extra_query($consulta)
		{	
			$data= $this->con->query($consulta);
			echo "Consulta Ejecutada";
		}
		function getconect(){
			return $this->con;
		}
    }

    $cons= new Conection();
    $cons->conectar();
?>
