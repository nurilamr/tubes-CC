<h2>Pembayaran</h2>

<?php  

$queryx     =   "SELECT * FROM detail_pendaftaran WHERE id_user = $id";
$execx      =   mysqli_query($conn, $queryx);
if($execx){
    $daftar = mysqli_fetch_array($execx);

}else{
    echo 'gagal';
}	

?>


<div class="row"> 	
    <div class="col-sm-12 col-md-8 col-lg-10 col-lg-offset-1">
        <div class="card" style="margin-top: 50px">
            <div class="card-header" data-background-color="blue">
                <h4 class="title">Pembayaran</h4>
                <p class="category">Isi Form pendaftaran dengan benar</p>
            </div>
            <div class="card-content">
            
            <h4><b>Print Kwitansi biaya pendaftaran yang harus dibayarkan. Ketentuan setelah pembayaran sebagai berikut:</b></h4>
            <ol>
            	<li>Siswa akan membayar uang pendaftaran untuk tahun pertamanya</li>
            	<li>Biaya pendaftaran akan ditentukan sesuai dengan kriteria reguler atau afirmasi dan akan langsung diberitahukan oleh sistem</li>
            </ol>    

            <h4><b>Biaya yang harus dibayarkan tergantung dari jenis kelasnya (reguler/afirmasi), kententuan sebagai berikut: </b></h4>
			<ol>
				<li><b>reguler : </b></li>
				<table class="table table-responsive table-hove">
					<thead>
						<tr>
							<th>Jenis Pengeluaran</th>
							<th align="right">Biaya</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>Uang pangkal gedung</td>
							<td align="right">350.000</td>
						</tr>
						<tr>
							<td>Uang Administrasi dan Seragam</td>
							<td align="right">400.000</td>
						</tr>
						<tr>
							<td>Uang pembayaran bulan 1 (pertama)</td>
							<td align="right">80.000</td>
						</tr>
						<tr>
							<td align="center"><b>Total</b></td>
							<td align="right"><b>Rp.830.000</b></td>
						</tr>
					</tbody>
				</table>
				
				<li><b> afirmasi : </b></li>
				<table class="table table-responsive table-hove">
					<thead>
						<tr>
							<th>Jenis Pengeluaran</th>
							<th align="right">Biaya</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>Uang pangkal gedung</td>
							<td align="right">250.000</td>
						</tr>
						<tr>
							<td>Uang Administrasi dan Seragam </td>
							<td align="right">100.000</td>
						</tr>
						<tr>
							<td>Uang pembayaran bulan 1 (pertama)</td>
							<td align="right">50.000</td>
						</tr>
						<tr>
							<td align="center"><b>Total</b></td>
							<td align="right"><b>Rp.400.000</b></td>
						</tr>
					</tbody>
				</table>
			</ol>
					
			<?php  
			if ($daftar['status_pendaftaran'] == 1) {
    
			    // echo '<a href="../assets/uploads/kwitansi-pembayaran.jpeg" class="btn btn-primary btn-md pull-left" download><i class="fa fa-print"></i> Cetak biaya yang harus dibayar untuk pendaftaran</a>';
				if ($daftar['metode_pembayaran_pendaftaran'] != "") {
					echo '<a href="index.php?page=13&metode_pembayaran='.$daftar['metode_pembayaran_pendaftaran'].'&status=true" class="btn btn-primary btn-md pull-left"><i class="fa fa-print"></i> Cetak biaya yang harus dibayar untuk pendaftaran</a>';
				}else{
					echo '<a href="#" class="btn btn-primary btn-md pull-left" download data-toggle="modal" data-target="#myModal"><i class="fa fa-print"></i> Cetak biaya yang harus dibayar untuk pendaftaran</a>';	
				}

			    

			    echo '<br><br>';
			}else if ($daftar['status_pendaftaran'] == 2) {
                            echo "<div class='alert alert-warning alert-dismissable'>
                              <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                              <strong>Anda sudah melakukan pembayaran</strong> 
                            </div>";
            }else if($daftar['status_pendaftaran'] == 0){
                echo "<div class='alert alert-warning alert-dismissable'>
                  <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                  <strong>Persyaratan sudah lengkap. tunggu konfirmasi admin paling lambat 2 hari kerja</strong> 
                </div>";
            }else if ($daftar['status_pendaftaran'] == 4){
			    echo "<div class='alert alert-warning alert-dismissable'>
			      <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
			      <strong>Pembayaran Pendaftaran sudah Lunas</strong>
			    </div>";
			}else if($daftar['status_pendaftaran'] == 3){
				echo "<div class='alert alert-warning alert-dismissable'>
			      <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
			      <strong>Pembayaran Pendaftaran Lunas di Cicilan ke -1</strong>
			    </div>";
			}else {
				echo "<div class='alert alert-warning alert-dismissable'>
			      <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
			      <strong>Pendaftaran anda belum dikonfirmasi oleh Admin.</strong> Tunggu konfirmasi admin untuk tahap selanjutnya.
			    </div>";
			}

			?>
                

            </div>
        </div>
    </div>
</div>



<!-- MODAL -->

<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Pilih Metode Pembayaran</h4>
        </div>
        <div class="modal-body">
        <form action="index.php?page=13" method="get">
        	<input type="hidden" name="page" value="13">
          <div class="form-group">
              <label for="">Metode Pembayaran</label>
              <select name="metode_pembayaran" class="form-group">
                  <option value="0">Lunas</option>
                  <option value="1">Cicil (2x)</option>
              </select>
          </div>
        </div>
        <div class="modal-footer">
          <button class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i>Close</button>
          <button type="submit" class="btn btn-primary"><i class="fa fa-check"></i>Pilih</button>
          </form>
        </div>
      </div>
      
    </div>
</div>