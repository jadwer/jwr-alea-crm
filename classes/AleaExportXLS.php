<?php

namespace JWR\Alea {
    require(WP_PLUGIN_DIR . '/jwr-alea-crm/vendor/autoload.php');

    use PhpOffice\PhpSpreadsheet\{Spreadsheet, IOFactory, Style\Fill, Style\Alignment};

    class AleaExportXLS
    {
        public static function createExportPage()
        {
            Utils::createPage("Export page", "export", "export", "jwr-alea-crm-blank", "templates/blank.php");
        }
        public static function deleteExportPage()
        {
            Utils::deletePage("jwr-alea-crm-blank");
        }

        public static function exportPage()
        {
            if (isset($_POST['export']) && $_POST['export'] != '') {
                ob_start();

                $period = UTILS::escape($_POST['period']);
                $anio = UTILS::escape($_POST['anio']);
                $type = UTILS::escape($_POST['type']);

                $data = ob_get_clean();
                SELF::exportXLS($period, $anio, $type);
                exit;
            } else {
                wp_redirect(get_home_url());
            }
        }

        public static function exportXLS($period, $anio, $type)
        {
            global $wpdb;
            $invoice = new Factura();
            $facturas = $invoice->getFacturasByTrimestreFiltered($period, $anio, $type);

            $objPHPExcel    =   new Spreadsheet();
            $objPHPExcel->setActiveSheetIndex(0);
            $objPHPExcel->getActiveSheet()->getStyle("A1:H1")->getFont()->setBold(true)
                ->setName('Verdana')
                ->setSize(10)
                ->getColor()->setRGB('ffffff');
            $objPHPExcel->getActiveSheet()->getColumnDimension("A")->setWidth(15);
            $objPHPExcel->getActiveSheet()->getColumnDimension("B")->setWidth(20);
            $objPHPExcel->getActiveSheet()->getColumnDimension("C")->setWidth(30);
            $objPHPExcel->getActiveSheet()->getColumnDimension("D")->setWidth(15);
            $objPHPExcel->getActiveSheet()->getColumnDimension("E")->setWidth(30);
            $objPHPExcel->getActiveSheet()->getColumnDimension("F")->setWidth(15);
            $objPHPExcel->getActiveSheet()->getColumnDimension("G")->setWidth(15);
            $objPHPExcel->getActiveSheet()->getColumnDimension("H")->setWidth(15);


            $styleArray = [
                'font' => [
                    'bold' => true,
                ],
                'alignment' => [
                    'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                ],
                'borders' => [
                    'top' => [
                        'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    ],
                ],
                'fill' => [
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'startColor' => [
                        'argb' => 'FFdcd7ca',
                    ],
                ],
            ];
            $objPHPExcel->getActiveSheet()->getStyle("A1:H1")->applyFromArray($styleArray);

            // Add some data
            $objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('A1', 'FECHA')
                ->setCellValue('B1', 'FACTURA')
                ->setCellValue('C1', 'NOMBRE Y APELLIDOS')
                ->setCellValue('D1', 'NIF')
                ->setCellValue('E1', 'DIRECCION')
                ->setCellValue('F1', 'BASE')
                ->setCellValue('G1', 'IVA')
                ->setCellValue('H1', 'TOTAL');


            $price = array();
            $rowCount   =   2;
            foreach ($facturas as $factura) {

                $price[] = $factura->getPrecio();
                $total[] = $factura->getTotal();
                $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('A' . $rowCount, $factura->getFecha())
                    ->setCellValue('B' . $rowCount, $factura->getReferencia())
                    ->setCellValue('C' . $rowCount, $factura->getNombre() . ' ' . $factura->getApellidos())
                    ->setCellValue('D' . $rowCount, $factura->getNif())
                    ->setCellValue('E' . $rowCount, $factura->getDireccion())
                    ->setCellValue('F' . $rowCount, $factura->getPrecio())
                    ->setCellValue('G' . $rowCount, $factura->getIVA())
                    ->setCellValue('H' . $rowCount, $factura->getTotal());
                $rowCount++;
            }
            $objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('F' . $rowCount, array_sum($price))
                ->setCellValue('G' . $rowCount, '0.00')
                ->setCellValue('H' . $rowCount, array_sum($total));
                $objPHPExcel->getActiveSheet()->getStyle("F{$rowCount}:H{$rowCount}")->applyFromArray($styleArray);

            // Rename worksheet
            $objPHPExcel->getActiveSheet()->setTitle('Simple');


            // Set active sheet index to the first sheet, so Excel opens this as the first sheet
            $objPHPExcel->setActiveSheetIndex(0);

            ob_start();
            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header('Content-Disposition: attachment;filename="myfile.xlsx"');
            header('Cache-Control: max-age=0');

            $writer = IOFactory::createWriter($objPHPExcel, 'Xlsx');
            $data = ob_get_clean();
            $writer->save('php://output');

            exit;
        }
    } // EOC
} // namespace
