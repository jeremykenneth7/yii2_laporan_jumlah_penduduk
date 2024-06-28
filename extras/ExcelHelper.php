<?php

namespace app\extras;

use PhpOffice\PhpSpreadsheet\Reader\Xlsx as ReaderXlsx;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx as WriterXlsx;

abstract class ExcelHelper
{
	public static function sheetLoader($template, &$reader = null)
	{
		$reader = new ReaderXlsx;
		return $reader->load($template);
	}

	public static function sheetAlter(Worksheet $worksheet, $alters, $ymin, $ymax, $xmin, $xmax)
	{
		for ($y = $ymin; $y < $ymax; $y++) {
			for ($x = $xmin; $x <= $xmax; $x++) {
				$old = $worksheet->getCell("$x$y")->getValue();
				if (empty($old)) {
					continue;
				}
				$new = strtr($old, $alters);
				$worksheet->getCell("$x$y")->setValue($new);
			}
		}
	}

	public static function writerResult(Spreadsheet $spreadsheet, $download, $newHeaders = [])
	{
		$oldHeaders = [
			'mime' => 'Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
			'file' => 'Content-Disposition: attachment; filename="' . $download . '"',
		];
		$headers = array_merge($oldHeaders, $newHeaders);
		foreach ($headers as $header) {
			if (is_string($header)) {
				call_user_func('header', $header);
			}
			if (is_array($header)) {
				call_user_func_array('header', $header);
			}
		}

		$writer = new WriterXlsx($spreadsheet);
		$writer->save('php://output');
		exit;
	}
}
