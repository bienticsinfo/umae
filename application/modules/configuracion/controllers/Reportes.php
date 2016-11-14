<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Reportes
 *
 * @author felipe de jesus
 */
require_once APPPATH.'modules/config/controllers/Config.php';
require_once APPPATH.'third_party/PHPExcel/PHPExcel.php';
class Reportes extends Config{
    public function contratos() {
        mysql_set_charset('utf8');
        $sql_=  $this->contratos_mdl->_get_contratos();
        date_default_timezone_set('America/Mexico_City');
		// Se crea el objeto PHPExcel
		$objPHPExcel = new PHPExcel();

		// Se asignan las propiedades del libro
		$objPHPExcel->getProperties()
                        ->setCreator("Departamento de Conservación")
                        ->setLastModifiedBy("Departamento de Conservación")
                        ->setTitle('Reporte de Contratos Creados')
			->setSubject("Reporte de Contratos Creados")
			->setDescription("Reporte de Contratos Creados");
		
		$titulosColumnas = array('N° Contrato','Area Solicitante', 'Tipo de Contrato', 'Fecha Inicio/Fin', 'Descripción');
		
		$objPHPExcel->setActiveSheetIndex(0)
        		    ->mergeCells('A1:E1');
						
		// Se agregan los titulos del reporte
		$objPHPExcel->setActiveSheetIndex(0)
                            ->setCellValue('A1','Reporte de Contratos Creados')
        		    ->setCellValue('A3',  $titulosColumnas[0])
		            ->setCellValue('B3',  $titulosColumnas[1])
        		    ->setCellValue('C3',  $titulosColumnas[2])
                            ->setCellValue('D3',  $titulosColumnas[3])
                            ->setCellValue('E3',  $titulosColumnas[4]);
		
		//Se agregan los datos de los alumnos
		$i = 4;
                foreach ($sql_ as $value) {
			$objPHPExcel->setActiveSheetIndex(0)
        		    ->setCellValue('A'.$i, $value['contrato_id'])
		            ->setCellValue('B'.$i, $value['contrato_area_solicitante'])
        		    ->setCellValue('C'.$i, $value['contrato_tipo']) 
                            ->setCellValue('D'.$i, $value['contrato_fecha_inicio'].'-'.$value['contrato_fecha_fin'])
                            ->setCellValue('E'.$i, $value['contrato_descripcion']);
                    $i++;
                }

		
		$estiloTituloReporte = array(
        	'font' => array(
	        	'name'      => 'Verdana',
    	        'bold'      => true,
        	    'italic'    => false,
                'strike'    => false,
               	'size' =>16,
	            	'color'     => array(
    	            	'rgb' => 'FFFFFF'
        	       	)
            ),
	        'fill' => array(
				'type'	=> PHPExcel_Style_Fill::FILL_SOLID,
				'color'	=> array('argb' => 'FF220835')
			),
            'borders' => array(
               	'allborders' => array(
                	'style' => PHPExcel_Style_Border::BORDER_NONE                    
               	)
            ), 
            'alignment' =>  array(
        			'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
        			'vertical'   => PHPExcel_Style_Alignment::VERTICAL_CENTER,
        			'rotation'   => 0,
        			'wrap'          => TRUE
    		)
        );

		$estiloTituloColumnas = array(
            'font' => array(
                'name'      => 'Arial',
                'bold'      => true,                          
                'color'     => array(
                    'rgb' => 'FFFFFF'
                )
            ),
            'fill' 	=> array(
				'type'		=> PHPExcel_Style_Fill::FILL_GRADIENT_LINEAR,
				'rotation'   => 90,
        		'startcolor' => array(
            		'rgb' => 'c47cf2'
        		),
        		'endcolor'   => array(
            		'argb' => 'FF431a5d'
        		)
			),
            'borders' => array(
            	'top'     => array(
                    'style' => PHPExcel_Style_Border::BORDER_MEDIUM ,
                    'color' => array(
                        'rgb' => '143860'
                    )
                ),
                'bottom'     => array(
                    'style' => PHPExcel_Style_Border::BORDER_MEDIUM ,
                    'color' => array(
                        'rgb' => '143860'
                    )
                )
            ),
                    'alignment' =>  array(
                            'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                            'vertical'   => PHPExcel_Style_Alignment::VERTICAL_CENTER,
                            'wrap'          => TRUE
            ));

            $estiloInformacion = new PHPExcel_Style();
            $estiloInformacion->applyFromArray(
                    array(
                    'font' => array(
            'name'      => 'Arial',               
            'color'     => array(
                    'rgb' => '000000'
            )
            ),
            'fill' 	=> array(
                            'type'		=> PHPExcel_Style_Fill::FILL_SOLID,
                            'color'		=> array('argb' => 'FFd9b7f4')
                    ),
            'borders' => array(
                'left'     => array(
                'style' => PHPExcel_Style_Border::BORDER_THIN ,
                'color' => array('rgb' => '3a2a47')
                )                
            ))); 
            $objPHPExcel->getActiveSheet()->getStyle('A1:E1')->applyFromArray($estiloTituloReporte);
            $objPHPExcel->getActiveSheet()->getStyle('A3:E3')->applyFromArray($estiloTituloColumnas);		
            $objPHPExcel->getActiveSheet()->setSharedStyle($estiloInformacion, "A4:E".($i-1));

            for($i = 'A'; $i <= 'E'; $i++){
                    $objPHPExcel->setActiveSheetIndex(0)			
                            ->getColumnDimension($i)->setAutoSize(TRUE);
            }
            // Se asigna el nombre a la hoja
            $objPHPExcel->getActiveSheet()->setTitle('Contratos Creados');
            // Se activa la hoja para que sea la que se muestre cuando el archivo se abre
            $objPHPExcel->setActiveSheetIndex(0);
            // Inmovilizar paneles 
            //$objPHPExcel->getActiveSheet(0)->freezePane('A4');
            $objPHPExcel->getActiveSheet(0)->freezePaneByColumnAndRow(0,4);
            // Se manda el archivo al navegador web, con el nombre que se indica (Excel2007)
            header("Content-type: text/html; charset=utf-8");
            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header('Content-Disposition: attachment;filename="Reporte de Contratos Creados.xlsx"');
            header('Cache-Control: max-age=0');

            $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
            $objWriter->save('php://output');
            exit;
    }
    public function proveedores() {
        mysql_set_charset('utf8');
        $sql_=  $this->contratos_mdl->_get_proveedores();
        date_default_timezone_set('America/Mexico_City');
		// Se crea el objeto PHPExcel
		$objPHPExcel = new PHPExcel();

		// Se asignan las propiedades del libro
		$objPHPExcel->getProperties()
                        ->setCreator("Departamento de Conservación")
                        ->setLastModifiedBy("Departamento de Conservación")
                        ->setTitle('Reporte de Proveedores')
			->setSubject("Reporte de Proveedores")
			->setDescription("Reporte de Proveedores");
		
		$titulosColumnas = array('Tipo de Persona','N° Proveedor', 'Nombre persona Física/Representante legal.',' RFC ','Código postal','Dirección principal','Teléfono principal fijo.','Registro infonavit.','Giro');
		
		$objPHPExcel->setActiveSheetIndex(0)
        		    ->mergeCells('A1:H1');
						
		// Se agregan los titulos del reporte
		$objPHPExcel->setActiveSheetIndex(0)
                            ->setCellValue('A1','Reporte de Proveedores')
        		    ->setCellValue('A3',  $titulosColumnas[0])
		            ->setCellValue('B3',  $titulosColumnas[1])
        		    ->setCellValue('C3',  $titulosColumnas[2])
                            ->setCellValue('D3',  $titulosColumnas[3])
                            ->setCellValue('E3',  $titulosColumnas[4])
                            ->setCellValue('F3',  $titulosColumnas[5])
                            ->setCellValue('G3',  $titulosColumnas[6])
                            ->setCellValue('H3',  $titulosColumnas[7]);
                
		
		//Se agregan los datos de los alumnos
		$i = 4;
                foreach ($sql_ as $value) {
			$objPHPExcel->setActiveSheetIndex(0)
        		    ->setCellValue('A'.$i, $value['prov_tipo'])
		            ->setCellValue('B'.$i, $value['prov_num'])
        		    ->setCellValue('C'.$i, $value['prov_nombre']) 
                            ->setCellValue('D'.$i, $value['prov_rfc'])
                            ->setCellValue('E'.$i, $value['prov_codigo_postal'])
                            ->setCellValue('F'.$i, $value['prov_direccion_principal'])
                            ->setCellValue('G'.$i, $value['prov_telefono_p_fijo'])
                            ->setCellValue('H'.$i, $value['prov_registro_infonavit']);
                    $i++;
                }

		
		$estiloTituloReporte = array(
        	'font' => array(
	        	'name'      => 'Verdana',
    	        'bold'      => true,
        	    'italic'    => false,
                'strike'    => false,
               	'size' =>16,
	            	'color'     => array(
    	            	'rgb' => 'FFFFFF'
        	       	)
            ),
	        'fill' => array(
				'type'	=> PHPExcel_Style_Fill::FILL_SOLID,
				'color'	=> array('argb' => 'FF220835')
			),
            'borders' => array(
               	'allborders' => array(
                	'style' => PHPExcel_Style_Border::BORDER_NONE                    
               	)
            ), 
            'alignment' =>  array(
        			'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
        			'vertical'   => PHPExcel_Style_Alignment::VERTICAL_CENTER,
        			'rotation'   => 0,
        			'wrap'          => TRUE
    		)
        );

		$estiloTituloColumnas = array(
            'font' => array(
                'name'      => 'Arial',
                'bold'      => true,                          
                'color'     => array(
                    'rgb' => 'FFFFFF'
                )
            ),
            'fill' 	=> array(
				'type'		=> PHPExcel_Style_Fill::FILL_GRADIENT_LINEAR,
				'rotation'   => 90,
        		'startcolor' => array(
            		'rgb' => 'c47cf2'
        		),
        		'endcolor'   => array(
            		'argb' => 'FF431a5d'
        		)
			),
            'borders' => array(
            	'top'     => array(
                    'style' => PHPExcel_Style_Border::BORDER_MEDIUM ,
                    'color' => array(
                        'rgb' => '143860'
                    )
                ),
                'bottom'     => array(
                    'style' => PHPExcel_Style_Border::BORDER_MEDIUM ,
                    'color' => array(
                        'rgb' => '143860'
                    )
                )
            ),
                    'alignment' =>  array(
                            'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                            'vertical'   => PHPExcel_Style_Alignment::VERTICAL_CENTER,
                            'wrap'          => TRUE
            ));

            $estiloInformacion = new PHPExcel_Style();
            $estiloInformacion->applyFromArray(
                    array(
                    'font' => array(
            'name'      => 'Arial',               
            'color'     => array(
                    'rgb' => '000000'
            )
            ),
            'fill' 	=> array(
                            'type'		=> PHPExcel_Style_Fill::FILL_SOLID,
                            'color'		=> array('argb' => 'FFd9b7f4')
                    ),
            'borders' => array(
                'left'     => array(
                'style' => PHPExcel_Style_Border::BORDER_THIN ,
                'color' => array('rgb' => '3a2a47')
                )                
            ))); 
            $objPHPExcel->getActiveSheet()->getStyle('A1:H1')->applyFromArray($estiloTituloReporte);
            $objPHPExcel->getActiveSheet()->getStyle('A3:H3')->applyFromArray($estiloTituloColumnas);		
            $objPHPExcel->getActiveSheet()->setSharedStyle($estiloInformacion, "A4:H".($i-1));

            for($i = 'A'; $i <= 'H'; $i++){
                    $objPHPExcel->setActiveSheetIndex(0)			
                            ->getColumnDimension($i)->setAutoSize(TRUE);
            }
            // Se asigna el nombre a la hoja
            $objPHPExcel->getActiveSheet()->setTitle('Reporte de Proveedores');
            // Se activa la hoja para que sea la que se muestre cuando el archivo se abre
            $objPHPExcel->setActiveSheetIndex(0);
            // Inmovilizar paneles 
            //$objPHPExcel->getActiveSheet(0)->freezePane('A4');
            $objPHPExcel->getActiveSheet(0)->freezePaneByColumnAndRow(0,4);
            // Se manda el archivo al navegador web, con el nombre que se indica (Excel2007)
            header("Content-type: text/html; charset=utf-8");
            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header('Content-Disposition: attachment;filename="Reporte de Proveedores.xlsx"');
            header('Cache-Control: max-age=0');

            $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
            $objWriter->save('php://output');
            exit;
    }
}
