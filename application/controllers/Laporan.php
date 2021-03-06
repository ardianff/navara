<?php
defined('BASEPATH') or exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Laporan extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		check_level_pemakai();
		check_level_admin();
		check_session();
		$this->load->model('home_m');
	}
	public function rekap_kondisi()
	{
		$data = [];
		$data['title'] = "Rekap Kondisi Kendaraan Dinas";
		if ($this->input->get()) {
			$dari = date('Y-m-d', strtotime($this->input->get('dari')));
			$sampai = date('Y-m-d', strtotime($this->input->get('sampai')));
			$get_dari = date('d-m-Y', strtotime($dari));
			$get_sampai = date('d-m-Y', strtotime($sampai));
			$data['dari'] = $dari;
			$data['sampai'] = $sampai;
			$data['rekap'] = $this->home_m->data_rekap($dari, $sampai);
			$data['title'] = 'Rekap Kondisi Kendaraan Dinas Dari Tanggal ' . $get_dari . ' Sampai ' . $get_sampai . '';
		}
		$this->load->view('admin/template/header');
		$this->load->view('admin/laporan/datakondisi', $data);
		$this->load->view('admin/template/footer');
	}
	public function rekap_servis()
	{
		$data = [];
		$data['title'] = "Rekap Servis Kendaraan Dinas";
		if ($this->input->get()) {
			$tahun = ($this->input->get('tahun'));
			$data['tahun'] = $tahun;
			$data['rekap'] = $this->home_m->data_servis($tahun);
			print_r($this->db->last_query());
			$data['title'] = 'Rekap Servis Kendaraan Dinas Dari Tahun ' . $tahun . '';
		}
		$this->load->view('admin/template/header');
		$this->load->view('admin/laporan/dataservis', $data);
		$this->load->view('admin/template/footer');
	}
	public function export_excel()
	{
		$tahun = $this->input->get('tahun');
		$spreadsheet = new Spreadsheet();
		$sheet = $spreadsheet->getActiveSheet();
		// Buat sebuah variabel untuk menampung pengaturan style dari header tabel
		$style_col = [
			'font' => ['bold' => true], // Set font nya jadi bold
			'alignment' => [
				'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER, // Set text jadi ditengah secara horizontal (center)
				'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
			],
			'borders' => [
				'top' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN], // Set border top dengan garis tipis
				'right' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],  // Set border right dengan garis tipis
				'bottom' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN], // Set border bottom dengan garis tipis
				'left' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN], // Set border left dengan garis tipis
			],
			'numberFormat' => [
				'formatCode' => \PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_CURRENCY_EUR
			]
		];
		// Buat sebuah variabel untuk menampung pengaturan style dari isi tabel
		$style_row = [
			'alignment' => [
				'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
			],
			'borders' => [
				'top' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN], // Set border top dengan garis tipis
				'right' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],  // Set border right dengan garis tipis
				'bottom' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN], // Set border bottom dengan garis tipis
				'left' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN] // Set border left dengan garis tipis
			]
		];
		$sheet->setCellValue('A1', "RINCIAN SERVICE BENGKEL"); // Set kolom A1 dengan tulisan "DATA SISWA"
		$sheet->mergeCells('A1:G1'); // Set Merge Cell pada kolom A1 sampai E1
		$sheet->getStyle('A1')->getFont()->setSize(14)->setBold(true); // Set bold kolom A1
		$sheet->getStyle('A1')->getAlignment()->setHorizontal('center');
		// Buat header tabel nya pada baris ke 3
		$sheet->setCellValue('A3', "NO"); // Set kolom A3 dengan tulisan "NO"
		$sheet->setCellValue('B3', "JENIS KENDARAAN"); // Set kolom B3 dengan tulisan "NIS"
		$sheet->setCellValue('C3', "MERK"); // Set kolom C3 dengan tulisan "NAMA"
		$sheet->setCellValue('D3', "TIPE");
		$sheet->setCellValue('E3', "NO POLISI"); // Set kolom D3 dengan tulisan "JENIS KELAMIN"
		$sheet->setCellValue('F3', "PEMAKAI"); // Set kolom E3 dengan tulisan "ALAMAT"
		$sheet->setCellValue('G3', "PAGU");
		// Apply style header yang telah kita buat tadi ke masing-masing kolom header
		$sheet->getStyle('A3')->applyFromArray($style_col);
		$sheet->getStyle('B3')->applyFromArray($style_col);
		$sheet->getStyle('C3')->applyFromArray($style_col);
		$sheet->getStyle('D3')->applyFromArray($style_col);
		$sheet->getStyle('E3')->applyFromArray($style_col);
		$sheet->getStyle('F3')->applyFromArray($style_col);
		$sheet->getStyle('G3')->applyFromArray($style_col);

		$sheet->getStyle('A3:A1000')->getAlignment()->setHorizontal('center');
		$sheet->getStyle('B3:B1000')->getAlignment()->setHorizontal('center');
		$sheet->getStyle('C3:C1000')->getAlignment()->setHorizontal('center');
		$sheet->getStyle('D3:D1000')->getAlignment()->setHorizontal('center');
		$sheet->getStyle('E3:E1000')->getAlignment()->setHorizontal('center');
		$sheet->getStyle('F3:F1000')->getAlignment()->setHorizontal('center');
		$sheet->getStyle('G3:F1000')->getAlignment()->setHorizontal('center');

		$sheet->getStyle('G3:G1000')
			->getNumberFormat()
			->setFormatCode(PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_ACCOUNTING_IDR);

		$data_rincian = $this->home_m->data_servis($tahun);
		// print_r($data_rincian);
		// die();

		// Panggil function view yang ada di SiswaModel untuk menampilkan semua data siswanya
		// $siswa = $this->SiswaModel->view();
		$no = 1; // Untuk penomoran tabel, di awal set dengan 1
		$numrow = 4; // Set baris pertama untuk isi tabel adalah baris ke 4
		foreach ($data_rincian as $data) { // Lakukan looping pada variabel siswa
			$sheet->setCellValue('A' . $numrow, $no);
			$sheet->setCellValue('B' . $numrow, strtoupper($data['jenis']));
			$sheet->setCellValue('C' . $numrow, strtoupper($data['merk']));
			$sheet->setCellValue('D' . $numrow, strtoupper($data['tipe']));
			$sheet->setCellValue('E' . $numrow, strtoupper($data['no_polisi']));
			$sheet->setCellValue('F' . $numrow, $data['name']);
			if ($data['pagu_awal'] == '') {
				$sheet->setCellValue('G' . $numrow, '0');
			} else {
				$sheet->setCellValue('G' . $numrow, $data['pagu_awal']);
			}

			// Apply style row yang telah kita buat tadi ke masing-masing baris (isi tabel)
			$sheet->getStyle('A' . $numrow)->applyFromArray($style_row);
			$sheet->getStyle('B' . $numrow)->applyFromArray($style_row);
			$sheet->getStyle('C' . $numrow)->applyFromArray($style_row);
			$sheet->getStyle('D' . $numrow)->applyFromArray($style_row);
			$sheet->getStyle('E' . $numrow)->applyFromArray($style_row);
			$sheet->getStyle('F' . $numrow)->applyFromArray($style_row);
			$sheet->getStyle('G' . $numrow)->applyFromArray($style_row);

			$no++; // Tambah 1 setiap kali looping
			$numrow++; // Tambah 1 setiap kali looping
		}
		// Set width kolom
		$sheet->getColumnDimension('A')->setAutoSize(true);
		$sheet->getColumnDimension('B')->setAutoSize(true);
		$sheet->getColumnDimension('C')->setAutoSize(true); // Set width kolom C
		$sheet->getColumnDimension('D')->setAutoSize(true); // Set width kolom D
		$sheet->getColumnDimension('E')->setWidth(15); // Set width kolom E
		$sheet->getColumnDimension('F')->setAutoSize(true); // Set width kolom E
		$sheet->getColumnDimension('G')->setWidth(15); // Set width kolom E

		// Set height semua kolom menjadi auto (mengikuti height isi dari kolommnya, jadi otomatis)
		$sheet->getDefaultRowDimension()->setRowHeight(-1);
		// Set orientasi kertas jadi LANDSCAPE
		$sheet->getPageSetup()->setOrientation(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_LANDSCAPE);
		// Set judul file excel nya
		$sheet->setTitle("Rincian Service Bengkel");
		$tahun = '2022';
		// Proses file excel
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		// header("Content-type: application/vnd.ms-excel");
		header('Content-Disposition: attachment; filename="Rincian Service Bengkel Tahun ' . $tahun . '.xlsx"'); // Set nama file excel nya
		header('Cache-Control: max-age=0');
		$writer = new Xlsx($spreadsheet);
		$writer->save('php://output');
		exit();
	}
}