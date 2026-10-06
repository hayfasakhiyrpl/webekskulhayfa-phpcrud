<?php
$id = $_GET['id'] ?? 0;
$file = "data/datapeserta.json";
$data = file_exists($file) ? (json_decode(file_get_contents($file), true) ?? []) : [];
$edit = null;
foreach ($data as $r) {
    if (($r['id'] ?? 0) == $id) {
        $edit = $r;
        break;
    }
}
if (!$edit) {
    echo '<div class="alert alert-danger m-3">CV tidak ditemukan</div>';
    return;
}
$fotoLama = $edit['foto'] ?? 'default.png';
$pathLama = "assets/image/peserta/" . $fotoLama;
if (!file_exists($pathLama)) $pathLama = "assets/dist/img/avatar.png";
?>
<div class="card card-warning card-outline shadow">
    <div class="card-header bg-warning text-white">
        <h5>Edit CV #<?= $edit['id'] ?> - <?= htmlspecialchars($edit['nama_lengkap'] ?? '') ?></h5>
    </div>
    <div class="card-body">
        <form method="POST" action="proses/prosescvdigital.php?aksi=edit" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?= $edit['id'] ?>">
            <div class="row">
                <div class="col-md-8">
                    <div class="row">
                        <div class="col-md-6 mb-3"><label>Nama Lengkap *</label><input type="text" name="nama_lengkap" value="<?= htmlspecialchars($edit['nama_lengkap'] ?? '') ?>" class="form-control" required></div>
                        <div class="col-md-3 mb-3"><label>Tempat Lahir *</label><input type="text" name="tempat_lahir" value="<?= htmlspecialchars($edit['tempat_lahir'] ?? '') ?>" class="form-control" required></div>
                        <div class="col-md-3 mb-3"><label>Tanggal Lahir *</label><input type="date" name="tanggal_lahir" value="<?= htmlspecialchars($edit['tanggal_lahir'] ?? '') ?>" class="form-control" required></div>
                    </div>
                    <div class="mb-3"><label>Alamat *</label><textarea name="alamat" class="form-control" required><?= htmlspecialchars($edit['alamat'] ?? '') ?></textarea></div>
                    <div class="row">
                        <div class="col-md-6 mb-3"><label>Email *</label><input type="email" name="email" value="<?= htmlspecialchars($edit['email'] ?? '') ?>" class="form-control" required></div>
                        <div class="col-md-6 mb-3"><label>No HP *</label><input type="text" name="no_hp" value="<?= htmlspecialchars($edit['no_hp'] ?? '') ?>" class="form-control" required></div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3"><label>Sekolah *</label><input type="text" name="sekolah" value="<?= htmlspecialchars($edit['sekolah'] ?? '') ?>" class="form-control" required></div>
                        <div class="col-md-6 mb-3"><label>Jurusan *</label><input type="text" name="jurusan" value="<?= htmlspecialchars($edit['jurusan'] ?? '') ?>" class="form-control" required></div>
                    </div>
                    <div class="mb-3"><label>Skill (pisahkan koma) *</label><input type="text" name="skills" value="<?= htmlspecialchars(implode(', ', $edit['skills'] ?? [])) ?>" class="form-control" required></div>
                    <div class="mb-3"><label>Cita-cita *</label><input type="text" name="cita_cita" value="<?= htmlspecialchars($edit['cita_cita'] ?? '') ?>" class="form-control" required></div>
                </div>
                <div class="col-md-4 text-center">
                    <label>Foto Saat Ini</label><br>
                    <img src="<?= $pathLama ?>" class="img-thumbnail" style="width:150px;height:180px;object-fit:cover"><br>
                    <small class="badge badge-info mt-2"><?= htmlspecialchars($fotoLama) ?></small>
                    <div class="mt-3 text-left">
                        <label>Ganti Foto (opsional)</label>
                        <div class="custom-file"><input type="file" name="foto" class="custom-file-input" id="fotoEditCV" accept="image/*" onchange="previewFoto(this,'prevEditCV')"><label class="custom-file-label">Pilih foto baru...</label></div>
                        <img id="prevEditCV" src="#" class="img-thumbnail mt-2" style="width:150px;height:180px;object-fit:cover;display:none">
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-warning btn-block">Update CV</button>
            <a href="index.php?halaman=cvdigital" class="btn btn-secondary btn-block">Kembali</a>
        </form>
    </div>
</div>
<script>
    function previewFoto(i, p) {
        const pr = document.getElementById(p);
        if (i.files[0]) {
            pr.style.display = 'block';
            pr.src = URL.createObjectURL(i.files[0]);
            i.nextElementSibling.innerText = i.files[0].name;
        }
    }
</script>


│ │ └── lihat.php # Detail CV
<?php
// pages/cvdigital/lihat.php - View CV dengan foto kanan atas
$id = $_GET['id'] ?? 0;
$file = "data/datapeserta.json";
$data = file_exists($file) ? (json_decode(file_get_contents($file), true) ?? []) : [];
$view = null;
foreach ($data as $row) {
    if ($row['id'] == $id) {
        $view = $row;
        break;
    }
}

if (!$view) {
    echo '<div class="alert alert-danger m-4">Data CV dengan ID ' . $id . ' tidak ditemukan. <a href="index.php?halaman=cvdigital">Kembali</a></div>';
    return;
}
$foto = $view['foto'] ?? 'default.png';
$pathFoto = "assets/image/peserta/" . $foto;
if (!file_exists($pathFoto)) $pathFoto = "assets/image/peserta/default.png";
?>
<div class="card card-primary card-outline shadow-lg">
    <div class="card-header">
        <h5 class="mb-0"><i class="fas fa-id-card mr-2"></i> Curriculum Vitae Digital</h5>
    </div>
    <div class="card-body p-4" id="areaCV">
        <!-- HEADER CV + FOTO KANAN ATAS -->
        <div class="row border-bottom pb-3 mb-3">
            <div class="col-md-8">
                <h2 class="font-weight-bold mb-0"><?= htmlspecialchars($view['nama_lengkap']) ?></h2>
                <p class="text-muted mb-1"><?= htmlspecialchars($view['cita_cita']) ?></p>
                <small class="text-muted">ID CV: #<?= $view['id'] ?> | Dibuat: <?= $view['tanggal_buat'] ?></small>
            </div>
            <div class="col-md-4 text-right">
                <img src="<?= $pathFoto ?>" alt="Foto <?= htmlspecialchars($view['nama_lengkap']) ?>"
                    class="img-thumbnail shadow" style="width:140px; height:180px; object-fit:cover;">
                <div class="mt-2"><small class="badge badge-info"><?= $foto ?></small></div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <h6 class="text-primary"><i class="fas fa-user mr-1"></i> Data Pribadi</h6>
                <table class="table table-sm table-borderless">
                    <tr>
                        <td width="130">Tempat Lahir</td>
                        <td>: <?= htmlspecialchars($view['tempat_lahir']) ?></td>
                    </tr>
                    <tr>
                        <td>Tanggal Lahir</td>
                        <td>: <?= date('d F Y', strtotime($view['tanggal_lahir'])) ?></td>
                    </tr>
                    <tr>
                        <td>Alamat</td>
                        <td>: <?= nl2br(htmlspecialchars($view['alamat'])) ?></td>
                    </tr>
                    <tr>
                        <td>Email</td>
                        <td>: <?= htmlspecialchars($view['email']) ?></td>
                    </tr>
                    <tr>
                        <td>No HP</td>
                        <td>: <?= htmlspecialchars($view['no_hp']) ?></td>
                    </tr>
                </table>
            </div>
            <div class="col-md-6">
                <h6 class="text-primary"><i class="fas fa-graduation-cap mr-1"></i> Pendidikan</h6>
                <table class="table table-sm table-borderless">
                    <tr>
                        <td width="130">Sekolah</td>
                        <td>: <?= htmlspecialchars($view['sekolah']) ?></td>
                    </tr>
                    <tr>
                        <td>Jurusan</td>
                        <td>: <?= htmlspecialchars($view['jurusan']) ?></td>
                    </tr>
                    <tr>
                        <td>Cita-cita</td>
                        <td>: <b><?= htmlspecialchars($view['cita_cita']) ?></b></td>
                    </tr>
                </table>

                <h6 class="text-primary mt-4"><i class="fas fa-code mr-1"></i> Keahlian</h6>
                <div>
                    <?php foreach ($view['skills'] as $skill): ?>
                        <span class="badge badge-success mr-1 mb-1 p-2"><?= htmlspecialchars(trim($skill)) ?></span>
                    <?php endforeach; ?>
                </div>
                <small class="text-muted d-block mt-1">Materi: Array & Perulangan</small>
            </div>
        </div>

        <div class="alert alert-light border mt-4">
            <small><i class="fas fa-info-circle mr-1"></i> Data ini disimpan di <code>data/datapeserta.json</code> dengan foto sebagai string <code><?= htmlspecialchars($view['foto']) ?></code> yang file fisiknya ada di <code>assets/image/peserta/</code>. Materi: Function, isset(), empty(), $_POST, $_FILES</small>
        </div>
    </div>
    <div class="card-footer text-right">
        <a href="index.php?halaman=cvdigital" class="btn btn-secondary"><i class="fas fa-arrow-left mr-1"></i> Kembali ke Daftar</a>
        <button onclick="window.print()" class="btn btn-primary"><i class="fas fa-print mr-1"></i> Cetak CV</button>
        <a href="index.php?halaman=editcv&id=<?= $view['id'] ?>" class="btn btn-warning"><i class="fas fa-edit mr-1"></i> Edit</a>
    </div>
</div>