<?php
	require_once('sessioncontrol.php');
    require_once('../../inc/config.php');
	require_once('dbconnect.php');
	require('../fpdf/fpdf.php');

	$session = new sessioncontrol();
	
	$usuario_id = $_GET['id'];
	$usuario_nombre = $_GET['nombre'];

	$dbdata = array(
		'host' => DB_HOST,
		'user' => DB_USER,
		'pass' => DB_PASSWORD,
		'db' => DB_NAME
	);

	$database = new dbConnect();
	$database->connect($dbdata);

	$querystring = 'select * from(
						select 
							pilar.id, pilar.fecha as fecha, curso.fecha as hora, curso.titulo, pilar.salon from pilar_login 
							join pilar on pilar_login.pilar_id = pilar.id
							join curso on curso.pilar_id = pilar.id
							where login_id = '.$usuario_id.' 
						    
						union 

						select 
							pilar.id, pilar.fecha as fecha, curso.fecha as hora, curso.titulo, pilar.salon from pilar 
							join curso on curso.pilar_id = pilar.id
							where pilar.tipo = 1 
						) as dt order by fecha, hora, titulo ';
					
	$cursos = $database->getTableDataQuery($querystring);

	$querystring = 'select * from visita 
		join visita_login on visita_login.visita_id = visita.id 
		where visita_login.login_id = '.$usuario_id.' order by fecha';
					
	$visitas = $database->getTableDataQuery($querystring);

	//print_r($visitas);die;

	class PDF extends FPDF {
		private $usuario = '';

	   //Cabecera de página
	   function Header() {
	    	$this->Image('../resources/images/logolargo.png',10,0,190);
	   }

	   function setUsuario($_usuario){
	   		$this->usuario = $_usuario;
	   }

	   function Footer(){
			$this->SetY(-10);

			$this->SetFont('Arial','I',12);

			$this->Cell(0,10,$this->usuario,0,0,'R');
	   }

	   function TablaCursos($h, $data){

	   		$this->SetFillColor(0,42,105);
			$this->SetTextColor(255);
			$this->SetDrawColor(49,84,135);
			$this->SetLineWidth(.2);
			$this->SetFont('','B');

			$this->Cell(20,7,$h[0],1,0,'C',1);
			$this->Cell(15,7,$h[1],1,0,'C',1);
			$this->Cell(23,7,utf8_decode($h[2]),1,0,'C',1);
			$this->Cell(130,7,$h[3],1,0,'C',1);
			$this->Ln();

			$fill = true;

			$this->SetFillColor(224,235,255);
			$this->SetTextColor(0);
			$this->SetFont('');

			foreach ($data as $k => $v) {
				//print_r($v);die;
				$fill = ($fill == false) ?  true : false;

				$datetime = strtotime($v['fecha']);
				$date = date("d/m/Y", $datetime);
				$datetime = strtotime($v['hora']);
				$time = date("H:i", $datetime);

				$this->Cell(20,7,$date,'LR',0,'C',0);
				$this->Cell(15,7,$time,'LR',0,'C',0);
				$this->Cell(23,7,$v['salon'],'LR',0,'C',0);

				$string = (strlen($v['titulo']) > 80) ? substr($v['titulo'],0,80).'...' : $v['titulo'];

				$string = utf8_decode($string);

				$this->Cell(130,7,$string,'LR',0,'L',0); 
				$this->Ln();
			}
			$this->Cell(188,0,'','T');
	   }

	   function TablaVisitas($h, $data){

	   		$this->SetFillColor(0,42,105);
			$this->SetTextColor(255);
			$this->SetDrawColor(49,84,135);
			$this->SetLineWidth(.2);
			$this->SetFont('','B');

			$this->Cell(58,7,$h[0],1,0,'C',1);
			$this->Cell(20,7,$h[1],1,0,'C',1);
			$this->Cell(15,7,$h[2],1,0,'C',1);
			$this->Cell(69,7,$h[4],1,0,'C',1);
			$this->Cell(26,7,$h[5],1,0,'C',1);
			$this->Ln();

			$fill = true;

			$this->SetFillColor(224,235,255);
			$this->SetTextColor(0);
			$this->SetFont('');

			foreach ($data as $k => $v) {
				//print_r($v);die;
				$fill = ($fill == false) ?  true : false;

				$datetime = strtotime($v['fecha']);
				$date = date("d/m/Y", $datetime);
				$time = date("H:i", $datetime);

				$this->Cell(58,7,$v['lugar'],'LR',0,'C',0);
				$this->Cell(20,7,$date,'LR',0,'C',0);
				$this->Cell(15,7,$time,'LR',0,'C',0);

				$this->Cell(69,7,$v['contacto'],'LR',0,'C',0);
				$this->Cell(26,7,$v['telefono'],'LR',0,'C',0);

				/*$string = (strlen($v['titulo']) > 100) ? substr($v['titulo'],0,100).'...' : $v['titulo'];

				$string = utf8_decode($string);

				$this->Cell(148,7,$string,'LR',0,'L',0); */
				$this->Ln();
			}
			$this->Cell(188,0,'','T');
	   }
	}

	//Creación del objeto de la clase heredada
	$pdf=new PDF( );
	$pdf->AddPage();
	$pdf->SetFont('Times','',12);
	//Aquí escribimos lo que deseamos mostrar...
	$pdf->Line(13,32,200,32); 
	$pdf->setUsuario($usuario_nombre); 

	$pdf->SetFont('Times','',20);
	$pdf->SetXY(13, 40); // position of text1, numerical, of course, not x1 and y1
	$pdf->Write(0, 'Cursos');

	//Títulos de las columnas
	$header=array('Fecha','Hora','Salón','Charla');
	//$pdf->AliasNbPages();
	$pdf->SetY(48);
	$pdf->SetLeftMargin(13);
	//$pdf->AddPage();
	$pdf->SetFont('Times','',10);
	//print_r($cursos);die;
	$pdf->TablaCursos($header, $cursos);

	$H = $pdf->GetY() + 10;

	$pdf->SetFont('Times','',20);
	$pdf->SetXY(13, $H); // position of text1, numerical, of course, not x1 and y1
	$pdf->Write(0, 'Visitas');

	$header=array('Industria','Fecha', 'Hora', utf8_decode('Dirección'), 'Contacto', utf8_decode('Teléfono'));

	$pdf->SetY($H + 8);
	$pdf->SetLeftMargin(13);
	//$pdf->AddPage();
	$pdf->SetFont('Times','',10);
	//print_r($cursos);die;
	$pdf->TablaVisitas($header, $visitas);

	$pdf->Output($usuario_nombre.'.pdf','I');

?>