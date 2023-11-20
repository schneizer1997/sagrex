<?php 
	define('JAVA_INC_URL','http://localhost:8080/JavaBridge/java/Java.inc'); 
 	require_once(JAVA_INC_URL);
 	set_time_limit(0);

 	 // créer une instance de la classe Java java.lang.System dans PHP
 		$system = new JavaClass('java.lang.System');
 		$class = new JavaClass("java.lang.Class");
 		$class->forName("com.mysql.jdbc.Driver");
 		$driverManager = new JavaClass("java.sql.DriverManager");
 		$conn = $driverManager->getConnection("jdbc:mysql://localhost:8012/dx_requestform2?user=root&password=");
 		//compilation
 		$compileManager = new JavaClass("net.sf.jasperreports.engine.JasperCompileManager");
 		$viewer = new JavaClass("net.sf.jasperreports.view.JasperViewer");
 		$report = $compileManager->compileReport("mwrfpdf.jrxml");
 		// fill
 		$fillManager = new JavaClass("net.sf.jasperreports.engine.JasperFillManager");
 		$params = new Java("java.util.HashMap");

 		$emptyDataSource = new Java("net.sf.jasperreports.engine.JREmptyDataSource");

 		$runmanager = new Java("net.sf.jasperreports.engine.JasperRunManager");

 		$jasperPrint = $fillManager->fillReport($report, $params, $conn);



	$format = $_GET['format'];

	switch ($format) 
	{
		case 'pdf':


			$outputPath = realpath(".")."\\"."report"."\\"."export.pdf";
			
			
			$exporter= new Java("net.sf.jasperreports.engine.export.JRPdfExporter");
			
			$exporter->setParameter(java("net.sf.jasperreports.engine.JRExporterParameter")->JASPER_PRINT,$jasperPrint);
			$exporter->setParameter(java("net.sf.jasperreports.engine.JRExporterParameter")->OUTPUT_FILE_NAME,$outputPath);

			header("Content-type: application/pdf");
			header("Content-Disposition: attachment; filename=export.pdf");

			readfile($outputPath);
			unlink($outputPath);

			$exporter->exportReport();
			break;
		case 'csv':
			
			$outputPath = realpath(".")."\\"."report"."\\"."export.csv";
			
			
			$exporter= new Java("net.sf.jasperreports.engine.export.JRCsvExporter");
			
			$exporter->setParameter(java("net.sf.jasperreports.engine.JRExporterParameter")->JASPER_PRINT,$jasperPrint);
			$exporter->setParameter(java("net.sf.jasperreports.engine.JRExporterParameter")->OUTPUT_FILE_NAME,$outputPath);

			header("Content-type: application/csv");
			header("Content-Disposition: attachment; filename=export.csv");

			readfile($outputPath);
			unlink($outputPath);

			$exporter->exportReport();
			break;
		case 'txt':

			$outputPath = realpath(".")."\\"."report"."\\"."export.txt";
					
			$exporter= new Java("net.sf.jasperreports.engine.export.JRTextExporter");


			$exporter->setParameter(java("net.sf.jasperreports.engine.export.JRTextExporterParameter")->PAGE_WIDTH,120);
			$exporter->setParameter(java("net.sf.jasperreports.engine.export.JRTextExporterParameter")->PAGE_HEIGHT,60);
			$exporter->setParameter(java("net.sf.jasperreports.engine.JRExporterParameter")->JASPER_PRINT,$jasperPrint);
			$exporter->setParameter(java("net.sf.jasperreports.engine.JRExporterParameter")->OUTPUT_FILE_NAME,$outputPath);

			header("Content-type: plain/text");
			header("Content-Disposition: attachment; filename=export.txt");

		
			$exporter->exportReport();

			readfile($outputPath);
			unlink($outputPath);

			break;
		case 'pptx':
			$outputPath = realpath(".")."\\"."report"."\\"."export.pptx";					
			$exporter= new Java("net.sf.jasperreports.engine.export.ooxml.JRPptxExporter");
			$exporter->setParameter(java("net.sf.jasperreports.engine.JRExporterParameter")->JASPER_PRINT,$jasperPrint);
			$exporter->setParameter(java("net.sf.jasperreports.engine.JRExporterParameter")->OUTPUT_FILE_NAME,$outputPath);
			header("Content-type: aapplication/vnd.ms-powerpoint");
			header("Content-Disposition: attachment; filename=export.pptx");
			$exporter->exportReport();

			readfile($outputPath);
			unlink($outputPath);
			break;
		case 'doc':
			$outputPath = realpath(".")."\\"."report"."\\"."export.docx";					
			$exporter= new Java("net.sf.jasperreports.engine.export.ooxml.JRDocxExporter");
			$exporter->setParameter(java("net.sf.jasperreports.engine.JRExporterParameter")->JASPER_PRINT,$jasperPrint);
			$exporter->setParameter(java("net.sf.jasperreports.engine.JRExporterParameter")->OUTPUT_FILE_NAME,$outputPath);
			header("Content-type: application/vnd.ms-word");
			header("Content-Disposition: attachment; filename=export.docx");
			$exporter->exportReport();

			readfile($outputPath);
			unlink($outputPath);
			break;
		
		default:
			# code...
			break;
	}
 ?>