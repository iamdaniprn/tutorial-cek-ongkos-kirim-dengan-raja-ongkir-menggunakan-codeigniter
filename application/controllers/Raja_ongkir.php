<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Raja_ongkir extends CI_Controller {

	public function __construct()
	{
      	parent::__construct();
	}

	public function index()
	{
		$this->load->view('raja_ongkir/data_raja_ongkir');
	}

	public function ambil_kota($asal_provinsi)
	{
		$curl = curl_init();
		curl_setopt_array($curl, array(
		  CURLOPT_URL => "http://api.rajaongkir.com/starter/city?province=$asal_provinsi",
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => "",
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 30,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => "GET",
		  CURLOPT_HTTPHEADER => array(
				"content-type: application/x-www-form-urlencoded",
				"key:78647d1d17f800a2c032bd13a6ab6c64"
		  ),
		));

		$response = curl_exec($curl);
		$err = curl_error($curl);
		
		curl_close($curl);
		
		if($err){
			echo "cURL Error #:" . $err;
		}else{
			$data = json_decode($response, true);
		}
		
		for ($i=0; $i < count($data['rajaongkir']['results']); $i++) {
			echo "<option value='".$data['rajaongkir']['results'][$i]['city_id']."'>".$data['rajaongkir']['results'][$i]['city_name']." (".$data['rajaongkir']['results'][$i]['type']." - ".$data['rajaongkir']['results'][$i]['postal_code'].")</option>";
		}
	}

	public function cek_ongkir()
	{
		$origin      = $this->input->get('origin');
		$destination = $this->input->get('destination');
		$berat 	     = $this->input->get('berat');
		$courier 	 = $this->input->get('courier');

		$data = array(
			'origin' => $origin,
			'destination' => $destination, 
			'berat' => $berat, 
			'courier' => $courier 
		);
		
		$this->load->view('raja_ongkir/cek_ongkir', $data);
	}

}
