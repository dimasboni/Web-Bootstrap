<?php
// =============================
// KONEKSI DATABASE
// =============================
include 'koneksi.php';

// Mengecek database yang aktif, ditampilkan sebagai komentar HTML
$result = $conn->query("SELECT DATABASE() AS db_name");
if ($result) {
  $row = $result->fetch_assoc();
  echo "<!-- Database aktif: " . htmlspecialchars($row['db_name']) . " -->";
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Toko Koleksi Militer</title>

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Chart.js -->
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

  <!-- ====== CSS KUSTOM ====== -->
  <style>
    /* BODY & WARNA TEMA */
    body {
      background-color: #2e3b2e;
      color: #fff;
      font-family: Arial, sans-serif;
    }

    /* Navbar */
    .navbar {
      background-color: #1f2a1f !important;
    }
    .navbar-brand, .nav-link {
      color: #fff !important;
    }
    .navbar-toggler {
      border-color: #fff;
    }
    .navbar-toggler-icon {
      background-image: url("data:image/svg+xml;charset=utf8,%3Csvg viewBox='0 0 30 30' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath stroke='rgba%28255,255,255,1%29' stroke-width='2' stroke-linecap='round' stroke-miterlimit='10' d='M4 7h22M4 15h22M4 23h22'/%3E%3C/svg%3E");
    }

    /* Hero Section (video latar) */
    .hero {
      height: 100vh;
      position: relative;
      overflow: hidden;
      display: flex;
      align-items: center;
      justify-content: center;
    }
    .hero iframe {
      position: absolute;
      top: 0; left: 0;
      width: 100%;
      height: 100%;
      pointer-events: none;
      z-index: -1;
    }
    .hero-content {
      position: relative;
      z-index: 2;
      text-align: center;
      padding: 0 1rem;
      background: rgba(0,0,0,0.45);
      height: 70%;
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      gap:1rem;
      border-radius:8px;
    }

    /* Tombol custom */
    .btn-primary-custom {
      background-color: #145214;
      border: none;
      color: #fff;
    }
    .btn-primary-custom:hover {
      background-color: #1d731d;
      color: #fff;
    }

    /* Products Section */
    #products {
      padding: 4rem 1rem;
      background-color: #fff;
      color: #000;
    }
    #products h2 {
      text-align: center;
      margin-bottom: 2rem;
    }
    .card {
      border: none;
      transition: transform .3s, box-shadow .3s;
    }
    .card:hover {
      transform: translateY(-5px);
      box-shadow: 0 6px 20px rgba(0,0,0,0.15);
    }
    .card img {
      height: 200px;
      object-fit: cover;
    }

    /* Artikel / Sejarah */
    #artikel {
      padding: 4rem 1rem;
      background-color: #fff;
      color: #000;
    }
    #artikel h2 {
      text-align: center;
      margin-bottom: 2rem;
    }
    .article-images .col-md-6 {
      display: flex;
      align-items: center;
    }
    .article-images img {
      width: 100%;
      border-radius: 8px;
    }

    /* Tentang Kami */
    #about {
      padding: 4rem 1rem;
      background-color: #2e3b2e;
      color: #fff;
    }
    .chart-container {
      margin-top: 3rem;
      max-width: 600px;
      margin-left: auto;
      margin-right: auto;
    }

    /* Testimoni & Contact */
    #testimoni, #contact {
      padding: 4rem 1rem;
      background-color: #fff;
      color: #000;
    }

    /* Footer */
    footer {
      background: #1f2a1f;
      color: #fff;
      padding: 1rem;
      text-align: center;
    }

    /* Responsif HP */
    @media (max-width: 576px) {
      .hero {
        height: 60vh;
      }
      .card img {
        height: 150px;
      }
    }

/* ============================= */
/* KOMENTAR REALTIME */
/* ============================= */
#comments {
  padding: 4rem 1rem;
  background-color: #fff;
  color: #000;
}
#comments h2 {
  text-align: center;
  margin-bottom: 2rem;
}
.list-group-item {
  background-color: #f9f9f9;
  border-radius: 10px;
  padding: 1rem;
  border: 1px solid #ddd;
}
/* Hilangkan scrollbar di kotak komentar */
.komentar-box {
  overflow: hidden;
  resize: none; /* agar user tidak bisa ubah ukuran */
  height: auto;
}


     /* ============================= */
/* BAGIAN LAYANAN (#services) */
/* ============================= */
#services {
  background-color: #f2f2f2; /* background terang agar teks mudah terbaca */
  color: #000; /* teks hitam */
  padding: 4rem 1rem;
}

#services h2 {
  text-align: center;
  margin-bottom: 2rem;
  color: #000;
}

#services .row .col-md-4 .p-3 {
  background-color: #ffffff; /* card putih */
  color: #000; /* teks hitam */
  border-radius: 10px; /* sudut card membulat */
  box-shadow: 0 4px 12px rgba(0,0,0,0.15); /* shadow ringan */
  padding: 1.5rem;
  transition: transform 0.3s, box-shadow 0.3s;
}

#services .row .col-md-4 .p-3:hover {
  transform: translateY(-5px);
  box-shadow: 0 8px 20px rgba(0,0,0,0.25);
}

#services p, #services h5 {
  font-size: 1rem; /* sedikit lebih besar untuk keterbacaan */
}
  </style>
</head>
<body>

  <!-- ============================= -->
  <!-- NAVBAR -->
  <!-- ============================= -->
  <nav class="navbar navbar-expand-lg">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">Toko Koleksi Militer</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item"><a class="nav-link" href="#hero">Home</a></li>
          <li class="nav-item"><a class="nav-link" href="#products">Produk</a></li>
          <li class="nav-item"><a class="nav-link" href="#artikel">Sejarah</a></li>
          <li class="nav-item"><a class="nav-link" href="#about">Tentang Kami</a></li>
          <li class="nav-item"><a class="nav-link" href="#testimoni">Testimoni</a></li>
          <li class="nav-item"><a class="nav-link" href="#contact">Form Pemesanan</a></li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- ============================= -->
  <!-- HERO SECTION -->
  <!-- ============================= -->
  <section class="hero" id="hero">
    <!-- Video background -->
    <iframe 
      src="https://www.youtube.com/embed/omv85cLfmxU?autoplay=1&mute=1&loop=1&playlist=omv85cLfmxU"
      title="Video Background"
      frameborder="0"
      allow="autoplay; fullscreen"
      allowfullscreen>
    </iframe>
    <div class="hero-content">
      <h1>Koleksi & Keamanan</h1>
      <p>Kami hadir untuk para kolektor. Produk ini tidak dilengkapi amunisi atau magazine dan hanya sebagai pajangan.</p>
      <a href="#products" class="btn btn-primary-custom">Lihat Produk</a>
    </div>
  </section>

  <!-- ============================= -->
  <!-- PRODUCTS SECTION -->
  <!-- ============================= -->
  <section id="products">
    <div class="container">
      <h2>Produk Senjata Koleksi</h2>
      <div class="row g-4">
        <?php
        // Loop menampilkan semua produk dari database
        $res = $conn->query("SELECT * FROM products");
        while ($p = $res->fetch_assoc()):
        ?>
        <div class="col-md-4">
          <div class="card">
            <img src="<?= htmlspecialchars($p['image_url']) ?>" class="card-img-top" alt="<?= htmlspecialchars($p['name']) ?>">
            <div class="card-body">
              <h5 class="card-title"><?= htmlspecialchars($p['name']) ?></h5>
              <p class="card-text"><?= htmlspecialchars($p['description']) ?></p>
            </div>
          </div>
        </div>
        <?php endwhile; ?>
      </div>
    </div>
  </section>

  <!-- ============================= -->
  <!-- ARTIKEL / SEJARAH -->
  <!-- ============================= -->
  <section id="artikel">
    <div class="container">
      <h2>Sejarah & Konteks Produk Ikonik</h2>
      <div class="row g-4 align-items-center mt-4">
        <div class="col-lg-6">
          <!-- Video sejarah -->
          <div class="ratio ratio-16x9">
            <iframe src="https://www.youtube.com/embed/_eQLFVpOYm4"
                    title="Sejarah AK-47"
                    allowfullscreen></iframe>
          </div>
          <p class="mt-3 text-secondary small">Sumber video: YouTube — dokumenter singkat tentang sejarah AK-47.</p>
        </div>
        <div class="col-lg-6">
          <p>
            Sejarah senjata api sangat terkait dengan inovasi teknis dan kebutuhan taktis zamannya.
            Beberapa model — seperti AK-47, M16, dan HK416 — tak hanya mengubah taktik militer, tetapi juga meninggalkan jejak pada budaya dan koleksi sejarah.
          </p>
          <p>
            Di sini kami menghadirkan replika untuk tujuan edukasi dan koleksi: fokus pada nilai sejarah, craftsmanship, dan pelestarian narasi masa lalu — bukan pada penggunaan aktif atau distribusi amunisi.
          </p>
          <div class="row article-images g-3 mt-3">
            <div class="col-md-6">
              <img src="https://upload.wikimedia.org/wikipedia/commons/b/b5/M16A2.jpg" alt="M16 Rifle" class="img-fluid">
            </div>
            <div class="col-md-6">
              <img src="https://upload.wikimedia.org/wikipedia/commons/9/92/HK416N.png" alt="HK416" class="img-fluid">
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- ============================= -->
  <!-- LAYANAN -->
  <!-- ============================= -->
  <section id="services">
    <div class="container py-5">
      <h2 class="text-center mb-4">Layanan Kami</h2>
      <div class="row">
        <?php
        // Loop menampilkan layanan dari database
        $rs = $conn->query("SELECT * FROM service");
        while ($s = $rs->fetch_assoc()):
        ?>
        <div class="col-md-4 mb-3">
          <div class="p-3 bg-light rounded shadow-sm">
            <h5><?= htmlspecialchars($s['judul']) ?></h5>
            <p><?= htmlspecialchars($s['deskripsi']) ?></p>
          </div>
        </div>
        <?php endwhile; ?>
      </div>
    </div>
  </section>

  <!-- ============================= -->
  <!-- TENTANG KAMI -->
  <!-- ============================= -->
  <section id="about">
    <div class="container">
      <h2>Tentang Kami</h2>
      <p>Kami adalah penyedia replika senjata koleksi berkualitas tinggi...</p>

      <!-- Grafik ChartJS -->
      <div class="chart-container">
        <h4 class="text-center mb-3">Persentase Jenis Kolektor Berdasarkan Konsumen</h4>
        <canvas id="kolektorChart"></canvas>
      </div>
    </div>
  </section>

  <!-- ============================= -->
  <!-- TESTIMONI -->
  <!-- ============================= -->
  <section id="testimoni">
    <div class="container">
      <h2>Testimoni Pelanggan</h2>
      <div class="row g-4">
        <div class="col-md-4">
          <div class="p-3 bg-light rounded shadow-sm">
            <p>"Produk sangat detail dan realistis. Cocok sekali untuk koleksi saya!"</p>
            <small>- Andi, Kolektor</small>
          </div>
        </div>
        <div class="col-md-4">
          <div class="p-3 bg-light rounded shadow-sm">
            <p>"Pengiriman cepat dan kualitas di atas ekspektasi."</p>
            <small>- Budi, Pecinta Militer</small>
          </div>
        </div>
        <div class="col-md-4">
          <div class="p-3 bg-light rounded shadow-sm">
            <p>"Replika yang sangat mirip dengan aslinya, recommended!"</p>
            <small>- Citra, Kolektor</small>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- ============================= -->
<!-- FITUR KOMENTAR REALTIME -->
<!-- ============================= -->
<section id="comments">
  <div class="container">
    <h2>Komentar Pengunjung</h2>

    <!-- Form komentar -->
    <form id="formKomentar" class="mb-4">
      <div class="mb-3">
        <label for="namaKomentar" class="form-label">Nama</label>
        <input type="text" id="namaKomentar" name="namaKomentar" class="form-control" maxlength="50" required>
  <div class="mb-3">
    <label for="emailKomentar" class="form-label">Email</label>
    <input type="email" id="emailKomentar" name="emailKomentar" class="form-control" maxlength="100" required>
  </div>

  <div class="mb-3">
    <label for="isiKomentar" class="form-label">Komentar</label>
    <textarea id="isiKomentar" class="form-control komentar-box" rows="3" maxlength="250" required></textarea>
    <small class="text-muted d-block text-end" id="charCount">0 / 250</small>
  </div>

  <button type="submit" class="btn btn-primary-custom">Kirim Komentar</button>
</form>
    

    <!-- Tempat tampil komentar -->
    <div id="daftarKomentar" class="list-group"></div>
  </div>
</section>


  <!-- ============================= -->
  <!-- FORM KONTAK / PEMESANAN -->
  <!-- ============================= -->
  <section id="contact">
    <div class="container">
      <h2>Form Pemesanan dan Konsultasi</h2>

      <!-- Notifikasi status -->
      <?php if (isset($_GET['status']) && $_GET['status'] === 'ok'): ?>
        <div class="alert alert-success">Terima kasih, pesan Anda terkirim.</div>
      <?php elseif (isset($_GET['status']) && $_GET['status'] === 'error'): ?>
        <div class="alert alert-danger">Isi semua bidang sebelum mengirim.</div>
      <?php endif; ?>

      <form id="contactForm" action="simpan_contact.php" method="POST">
        <div class="mb-3">
          <label for="name" class="form-label">Nama</label>
          <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <div class="mb-3">
          <label for="email" class="form-label">Email</label>
          <input type="email" class="form-control" id="email" name="email" required>
        </div>
        <div class="mb-3">
          <label for="message" class="form-label">Pesan / Produk yang diinginkan</label>
          <textarea class="form-control" id="message" name="message" rows="4" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary-custom">Kirim</button>
      </form>
    </div>
  </section>

  <!-- ============================= -->
  <!-- FOOTER -->
  <!-- ============================= -->
  <footer>
    <p>&copy; 2025 Toko Koleksi Militer - Hanya untuk Koleksi, Bukan untuk Digunakan</p>
  </footer>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

  <!-- SCRIPT CHART.JS -->
  <script>
    let kolektorChart;
    const warnaDasar = [
      'rgba(76, 175, 80, 0.9)',
      'rgba(33, 150, 243, 0.9)',
      'rgba(255, 193, 7, 0.9)',
      'rgba(233, 30, 99, 0.9)',
      'rgba(156, 39, 176, 0.9)',
      'rgba(244, 67, 54, 0.9)'
    ];

    function initChart(labels = [], values = []) {
      const ctx = document.getElementById('kolektorChart').getContext('2d');
      kolektorChart = new Chart(ctx, {
        type: 'doughnut',
        data: {
          labels,
          datasets: [{
            data: values,
            backgroundColor: labels.map((_, i) => warnaDasar[i % warnaDasar.length]),
            borderColor: '#fff',
            borderWidth: 2
          }]
        },
        options: {
          plugins: {
            legend: { position: 'bottom', labels: { color: '#fff' } }
          }
        }
      });
    }

    function fetchStatsAndUpdate() {
      fetch('get_stats.php')
        .then(r => r.json())
        .then(data => {
          const labels = data.map(x => x.label);
          const values = data.map(x => Number(x.value));
          if (!kolektorChart) initChart(labels, values);
          else {
            kolektorChart.data.labels = labels;
            kolektorChart.data.datasets[0].data = values;
            kolektorChart.update();
          }
        })
        .catch(err => console.error('Error loading stats:', err));
    }

    fetchStatsAndUpdate();
    setInterval(fetchStatsAndUpdate, 5000);
  </script>

<script>
// ======= KOMENTAR REALTIME (letakkan setelah section komentar) =======

const form = document.getElementById('formKomentar');
const daftar = document.getElementById('daftarKomentar');
const isiKomentar = document.getElementById('isiKomentar');
const charCount = document.getElementById('charCount');

// muat komentar (dari ambil_komentar.php yang sekarang mengeluarkan JSON)
function muatKomentar() {
  fetch('ambil_komentar.php')
    .then(res => res.json())
    .then(data => {
      daftar.innerHTML = '';
      data.forEach(k => {
        const item = document.createElement('div');
        item.className = 'list-group-item mb-2';
        item.innerHTML = `
          <strong>${k.name}</strong><br>
          <small class="text-muted">${k.created_at}</small>
          <p class="mt-2 mb-0">${k.comment}</p>
        `;
        daftar.appendChild(item);
      });
    })
    .catch(err => {
      console.error('Gagal memuat komentar:', err);
    });
}

// submit via AJAX
form.addEventListener('submit', function(e) {
  e.preventDefault();

  const nama = document.getElementById('namaKomentar').value.trim();
  const email = document.getElementById('emailKomentar').value.trim();
  const komentar = isiKomentar.value.trim();

  // validasi sisi-client (panjang)
  if (!nama || !email || !komentar) {
    alert('Isi semua kolom sebelum mengirim komentar.');
    return;
  }
  if (nama.length > 50 || komentar.length > 250) {
    alert('Nama max 50 karakter dan komentar max 250 karakter.');
    return;
  }

  fetch('simpan_komentar_ajax.php', {
    method: 'POST',
    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
    body: `namaKomentar=${encodeURIComponent(nama)}&emailKomentar=${encodeURIComponent(email)}&isiKomentar=${encodeURIComponent(komentar)}`
  })
  .then(res => res.json())
  .then(data => {
    if (data.success) {
      // clear textarea
      isiKomentar.value = '';
      // langsung update list komentar
      muatKomentar();
    } else {
      alert(data.error || data.message || 'Gagal mengirim komentar.');
    }
  })
  .catch(err => {
    console.error('Error saat mengirim komentar:', err);
    alert('Terjadi kesalahan saat mengirim.');
  });
});

// hitung karakter dan auto-expand textarea tanpa scrollbar
isiKomentar.addEventListener('input', () => {
  charCount.textContent = `${isiKomentar.value.length} / 250`;
  isiKomentar.style.height = 'auto';
  isiKomentar.style.height = isiKomentar.scrollHeight + 'px';
});

// jalankan pertama kali dan jalankan periodik untuk update
muatKomentar();
setInterval(muatKomentar, 5000); // update setiap 5 detik
</script>



</body>
</html>
