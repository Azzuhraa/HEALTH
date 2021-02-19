<?php
$kategori_list = 'SELECT
					kategori.kategori,
					Count(berita.id_berita) AS jumlah,
					kategori.id_kategori
					FROM
					berita
					INNER JOIN kategori ON berita.id_kategori = kategori.id_kategori
					GROUP BY
					kategori.kategori,
					kategori.id_kategori';
$list_kategori = $mysqli->query($kategori_list) or die($mysqli->error);

$terkini = 'SELECT
berita.id_berita,
berita.judul,
berita.gambar,
berita.tgl_posting,
berita.id_admin,
admin.nama_lengkap
FROM
berita
INNER JOIN admin ON berita.id_admin = admin.id_admin
ORDER BY
berita.tgl_posting DESC
LIMIT 0, 5
';

$populer = 'SELECT
berita.id_berita,
berita.judul,
berita.gambar,
berita.tgl_posting,
admin.nama_lengkap,
berita.id_admin,
berita.dilihat
FROM
berita
INNER JOIN admin ON berita.id_admin = admin.id_admin
ORDER BY
berita.dilihat DESC
LIMIT 0, 5
';

$list_terkini = $mysqli->query($terkini) or die ($mysqli->error);

$list_populer = $mysqli->query($populer) or die ($mysqli->error);
?>
					<div class="col-md-4 sidebar">
						<div class="sidebar-item kategori">
							<h3 class="page-header">Kategori</h5>
							<ul class="nav nav-pills nav-stacked nav-kat">
							<?php while ($data_kat = $list_kategori->fetch_array()) { ?>

							<?php if (isset($_GET['kat']) && $data_kat['id_kategori'] == $_GET['id'] ) { ?>
								<li class="active">
									<a href="<?php echo $base_url."kategori.php?id=".$data_kat['id_kategori']."&amp;kat=".strtolower($data_kat['kategori']); ?>">
									<?php echo $data_kat['kategori']; ?> <span class="badge pull-right"><?php echo $data_kat['jumlah'] ?></span></a>
								</li>
							<?php } else { ?>
								<li>
									<a href="<?php echo $base_url."kategori.php?id=".$data_kat['id_kategori']."&amp;kat=".strtolower($data_kat['kategori']); ?>">
									<?php echo $data_kat['kategori']; ?> <span class="badge pull-right"><?php echo $data_kat['jumlah'] ?></span></a>
								</li>
							<?php } ?>
							<?php } ?>
							</ul>
						</div>
                        
                    <div class="sidebar-item">
                      <h3 class="page-header">Konsultasi</h3>
                      <ul class="news-list">
                        <li>
                        <div class="member-img">
                         <img src="../images/Irma.jpeg" class="img-fluid" alt="" width="80px" high="80px">

                           <a href="whatsapp://send?text=Hello Saya Ingin Berkonsultasi &phone=+6285261204669"><font color="#4B0082" face="Times New Roman"><b>Irma Agustina </b></font></a>
                           <br>
                            <span ><font color="#808080" face="Courier New"> Mahasiswi Kedokteran( Dokter Umum )</font></span>
                        </div>
                        </li>
                        
                        <li>
                        <div class="member-img">
                         <img src="../images/Fithry.jpeg" class="img-fluid" alt="" width="50px" high="60px">

                           <a href="whatsapp://send?text=Hello Saya Ingin Berkonsultasi &phone=+6282234369073"><font color="#4B0082" face="Times New Roman"><b>Fithriyyah</b></font></a>
                           <br>
                            <span ><font color="#808080" face="Courier New"> Perawat gigi</font></span>
                        </div>
                        </li>

                        <li>
                        <div class="member-img">
                         <img src="../images/Intan.jpeg" class="img-fluid" alt="" width="50px" high="50px">

                           <a href="whatsapp://send?text=Hello Saya Ingin Berkonsultasi &phone=+6289512983685 "><font color="#4B0082" face="Times New Roman"><b>Intan Furtuna Dewi</b></font></a>
                           <br>
                            <span ><font color="#808080" face="Courier New">Perawat Umum</font></span>
                        </div>
                        </li>


						<div class="sidebar-item">
							<h3 class="page-header">Populer</h3>
							<ul class="news-list">
							<?php while ($populer_list = $list_populer->fetch_array()) { ?>
								<li>
									<a <a href="<?php echo $base_url."detail.php?id=".$populer_list['id_berita']."&amp;judul=".strtolower(str_replace(" ", "-", $populer_list['judul'])); ?>">
										<img src="<?php echo $base_url."images/".$populer_list['gambar']; ?>" class="img-responsive wow fadeIn">
									</a>
									<p>Oleh: <a href="<?php echo $base_url."author.php?id=".$populer_list['id_admin']; ?>"><?php echo $populer_list['nama_lengkap']; ?></a>&nbsp;&nbsp;&ndash;&nbsp;&nbsp;<?php echo $populer_list['tgl_posting']; ?></p>
									<a href="<?php echo $base_url."detail.php?id=".$populer_list['id_berita']."&amp;judul=".strtolower(str_replace(" ", "-", $populer_list['judul'])); ?>">
										<?php echo $populer_list['judul']; ?>
									</a>
								</li>
							<?php } ?>
							</ul>
						</div>
						
					</div>