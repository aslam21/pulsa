<?php 

class M_portalpulsa extends CI_Model{

	public function __construct(){
        parent::__construct();

      }

	function cek_saldo(){
		$url = 'https://portalpulsa.com/api/connect/';

		$header = array(
		'portal-userid: P134347',
		'portal-key: cf47761f13a681c68fdce87fae71a925', // lihat hasil autogenerate di member area
		'portal-secret: 91078d5124ed0bb35dc4cb9ed1d1be94cf86eaea9cd9ccf92db386ff531bdd59', // lihat hasil autogenerate di member area
		);
		$data = array(
		'inquiry' => 'D', // konstan
		'bank' => 'bca', // bank tersedia: bca, bni, mandiri, bri, muamalat
		'nominal' => 100000, // jumlah request
		);

		$data = array(
		'inquiry' => 'S', // konstan
		);

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
		$result = curl_exec($ch);

		$output = json_decode($result, true);
		return $output;
	}

	function cek_code($code){
		$url = 'https://portalpulsa.com/api/connect/';

		$header = array(
		'portal-userid: P134347',
		'portal-key: cf47761f13a681c68fdce87fae71a925', // lihat hasil autogenerate di member area
		'portal-secret: 91078d5124ed0bb35dc4cb9ed1d1be94cf86eaea9cd9ccf92db386ff531bdd59', // lihat hasil autogenerate di member area
		);

		$data = array(
		'inquiry' => 'HARGA', // konstan
		'code' => $code, // pilihan: pln, pulsa, game
		);

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
		$result = curl_exec($ch);

		return $result;
	}

	function cek_harga($code){
		$url = 'https://portalpulsa.com/api/connect/';

		$header = array(
		'portal-userid: P134347',
		'portal-key: cf47761f13a681c68fdce87fae71a925', // lihat hasil autogenerate di member area
		'portal-secret: 91078d5124ed0bb35dc4cb9ed1d1be94cf86eaea9cd9ccf92db386ff531bdd59', // lihat hasil autogenerate di member area
		);

		$data = array(
		'inquiry' => 'HARGA', // konstan
		'code' => $code, // pilihan: pln, pulsa, game
		);

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
		$result = curl_exec($ch);

		return $result;
	}


}





 ?>