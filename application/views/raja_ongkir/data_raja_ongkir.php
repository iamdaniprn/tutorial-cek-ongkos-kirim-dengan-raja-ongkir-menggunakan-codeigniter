<!DOCTYPE html>
<html>
<head>
	<title>Belajar Mengambil Data Raja Ongkos Kirim</title>
	<link rel="stylesheet" href="<?php echo base_url() ?>assets/css/bootstrap.min.css">
</head>
<body>
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<h3>Belajar Mengambil Data Raja Ongkos Kirim <strong>@hayu_ngoding</strong></h3>
			</div>

			<div class="col-md-6">
				<div class="card">
					<div class="card-header">
						<b>Silahkan Isikan Data Yang Diperlukan</b>
					</div>
					<div class="card-body">
						<div class="form-group">
						    <label for="exampleInputEmail1">Pilih Provinsi Asal Pengiriman</label>
						    <select class="form-control form-control-sm" name="asal_provinsi" id="asal_provinsi" >
						    	<option value="" selected="" disabled="">- Pilih -</option>
								<?php $this->load->view('raja_ongkir/asal_provinsi'); ?>
						    </select>
						</div>

						<div class="form-group">
						    <label for="exampleInputEmail1">Pilih Kota/Kabupaten Asal Pengiriman</label>
						    <select class="form-control form-control-sm" name="asal_kota" id="asal_kota">
						    	<option value="" selected="" disabled="">- Pilih -</option>
						    </select>
						</div>

						<div class="form-group">
						    <label for="exampleInputEmail1">Pilih Provinsi Tujuan</label>
						    <select class="form-control form-control-sm" name="tujuan_provinsi" id="tujuan_provinsi">
						    	<option value="" selected="" disabled="">- Pilih -</option>
								<?php $this->load->view('raja_ongkir/tujuan_provinsi'); ?>
						    </select>
						</div>

						<div class="form-group">
						    <label for="exampleInputEmail1">Pilih Kota/Kabupaten Tujuan</label>
						    <select class="form-control form-control-sm" name="tujuan_kota" id="tujuan_kota">
						    	<option value="" selected="" disabled="">- Pilih -</option>
						    </select>
						</div>

						<div class="form-group">
						    <label for="exampleInputEmail1">Masukkan Berat Barang/Produk (gram)</label>
						    <input type="text" class="form-control form-control-sm" name="berat" id="berat" value="100">
						    <small>* dalam satuan gram</small>
						</div>

						<div class="form-group">
						    <label for="exampleInputEmail1">Pilih Kurir</label>
						    <select class="form-control form-control-sm" name="kurir" id="kurir">
								<option value="">- Pilih -</option>
								<option value="jne">JNE</option>
								<option value="pos">POS</option>
								<option value="tiki">TIKI</option>
							</select>
						</div>

						<button class="btn btn-primary" type="button" onclick="tampil_data('data')">Lihat Ongkos Kirim</button>

					</div>
				</div>
			</div>

			<div class="col-md-6">
				<div class="card">
					<div class="card-header">
						<b>Hasil Ongkos Kirim</b>
					</div>
					<div class="card-body">
						<div id="hasil"></div>
					</div>
				</div>
			</div>
		</div>
	</div>

</body>
</html>

<script src="<?php echo base_url()?>assets/js/jquery-3.4.1.min.js"></script>

<script type="text/javascript">

	function tampil_data(act) {
		var w = $('#asal_kota').val();
		var x = $('#tujuan_kota').val();
		var y = $('#berat').val();
		var z = $('#kurir').val();

		// alert(w);
		$.ajax({
			url: "<?php echo base_url(); ?>index.php/raja_ongkir/cek_ongkir",
			type: "GET",
			data : {origin: w, destination: x, berat: y, courier: z},
			success: function (ajaxData) {
				$("#hasil").html(ajaxData);
			}
		});
	};

	$(document).ready(function() {
		$("#asal_provinsi").click(function() {
			$.post("<?php echo base_url(); ?>index.php/raja_ongkir/ambil_kota/"+$('#asal_provinsi').val(),function(obj) {
				$('#asal_kota').html(obj);
			});			
		});

		$("#tujuan_provinsi").click(function() {
			$.post("<?php echo base_url(); ?>index.php/raja_ongkir/ambil_kota/"+$('#tujuan_provinsi').val(),function(obj) {
				$('#tujuan_kota').html(obj);
			});			
		});
	});
</script>