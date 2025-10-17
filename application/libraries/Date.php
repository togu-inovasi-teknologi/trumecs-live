<?php if (! defined('BASEPATH')) exit('No direct script access allowed');

class Date
{

	var $CI;

	public function __construct()
	{
		// Do something with $params
		$this->CI = &get_instance();
		$this->hari = array('1' => 'Senin', '2' => 'Selasa', '3' => 'Rabu', '4' => 'Kamis', '5' => 'Jumat', '6' => 'Sabtu', '7' => 'Minggu');
		$this->bulan = array('1' => 'Januari', '2' => 'Februari', '3' => 'Maret', '4' => 'April', '5' => 'Mei', '6' => 'Juni', '7' => 'Juli', '8' => 'Agustus', '9' => 'September', '10' => 'Oktober', '11' => 'November', '12' => 'Desember');
		$this->bulanPendek = array('1' => 'Jan', '2' => 'Feb', '3' => 'Mar', '4' => 'Apr', '5' => 'Mei', '6' => 'Jun', '7' => 'Jul', '8' => 'Agt', '9' => 'Sep', '10' => 'Okt', '11' => 'Nov', '12' => 'Des');
	}

	public function format_day_name($tanggal)
	{
		$tglIni = strtotime(date('Y-m-d'));
		$tglLalu = strtotime($tanggal);

		$tanggal = explode('-', $tanggal);
		$tgl = $tanggal[2];
		$bln = number_format($tanggal[1], 0, ',', '.');
		$thn = $tanggal[0];

		$hariIni = date('N');
		$selisih = ($tglIni - $tglLalu) / 86400;

		$selisih = $hariIni + 7 - ($selisih) % 7;
		if ($selisih > 7) {
			$selisih = $selisih - 7;
		};
		if ($selisih == 0) {
			$selisih = 7;
		};
		$hari = $this->hari[$selisih];

		$tanggal = $hari . ', ' . $tgl . ' ' . $this->bulan[$bln] . ' ' . $thn;
		return $tanggal;
	}

	public function format_day_time($tanggal)
	{
		$tglIni = strtotime(date('Y-m-d'));
		$tglLalu = strtotime($tanggal);

		$waktu = explode(' ', $tanggal);
		$tanggal = explode('-', $waktu[0]);
		$tgl = $tanggal[2];
		$bln = number_format($tanggal[1], 0, ',', '.');
		$thn = $tanggal[0];

		$hariIni = date('N');
		$selisih = ($tglIni - $tglLalu) / 86400;

		$selisih = $hariIni + 7 - ($selisih) % 7;
		if ($selisih > 7) {
			$selisih = $selisih - 7;
		};
		if ($selisih == 0) {
			$selisih = 7;
		};
		$hari = $this->hari[$selisih];

		$tanggal = $hari . ', ' . $tgl . ' ' . $this->bulan[$bln] . ' ' . $thn . ' ' . $waktu[1];
		return $tanggal;
	}

	public function format_pendek($date)
	{
		$var = explode(' ', $date);
		$var = explode('-', $var[0]);

		$result = $var[2] . ' ' . $this->bulanPendek[number_format($var[1], 0, ',', '.')] . ' ' . $var[0];
		return $result;
	}

	public function format_panjang_waktu($date)
	{
		$var = explode(' ', $date);
		$waktu = $var[1];
		$kalender = explode('-', $var[0]);

		$result = $kalender[2] . ' ' . $this->bulan[number_format($kalender[1], 0, ',', '.')] . ' ' . $kalender[0] . ' ' . $waktu;
		return $result;
	}

	public function format_press_detail($date)
	{
		$var = explode(' ', $date);
		$time = $var[1];
		$var = explode('-', $var[0]);

		$result = date('D', mktime(0, 0, 0, $var[1], $var[2], $var[0])) . ', ' . $var[2] . '/' . $var[1] . '/' . substr($var[0], 2, 2) . ' - ' . substr($time, 0, 5);
		return $result;
	}

	public function counting_date($startdate, $enddate)
	{
		$selisih = abs(strtotime($startdate) - strtotime($enddate));
		$tgmulai = explode(' ', $startdate);
		$startdate = new DateTime($startdate);
		$enddate = new DateTime($enddate);
		$interval = $enddate->diff($startdate);

		if ($selisih < 86400):
			$tanggal = $interval->format('%h jam');
		elseif ($selisih < 518400):
			$tanggal = $interval->format('%a hari');
		elseif ($selisih < 2592000):
			$tanggal = (int)$interval->format('%a');
			$tanggal = round($tanggal / 7) . " minggu";
		else:
			$this->CI->load->helper('date');
			$tanggal = $this->format_pendek($tgmulai[0]);
		endif;

		return $tanggal;
	}

	public function counting_date_bid($startdate, $enddate)
	{
		$selisih = strtotime($startdate) - strtotime($enddate);
		if ($selisih < 0) {
			$selisih = abs(strtotime($startdate) - strtotime($enddate));
			$tgmulai = explode(' ', $startdate);
			$startdate = new DateTime($startdate);
			$enddate = new DateTime($enddate);
			$interval = $enddate->diff($startdate);

			$tanggal = explode(',', $interval->format('%a,%h,%i,%s'));
		} else {
			$tanggal = array(0, 0, 0, 0);
		}


		return $tanggal;
	}
	public function format_month($month)
	{
		$bulan = $this->bulan;
		return isset($bulan[$month]) ? $bulan[$month] : 'gagal';
	}
}
