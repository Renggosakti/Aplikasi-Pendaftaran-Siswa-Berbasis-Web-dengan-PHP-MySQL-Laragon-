<?php
// index.php
require_once 'config.php';
?>
<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>Pendaftaran Siswa | Terminal Access</title>
  
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700;800;900&display=swap" rel="stylesheet">
  
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <div class="container">
    <div class="header">
      <div class="brand">
        <div class="logo">PS</div>
        <div>
          <div class="title neon">Sistem Pendaftaran Siswa</div>
          <div class="subtitle">Terminal Access: Data Management Interface</div>
        </div>
      </div>
      <div>
        <a class="btn btn-primary" href="form-daftar.php">➕ Input Data Baru</a>
        <a class="btn btn-ghost" href="list-siswa.php">Lihat Daftar (Grid View)</a>
      </div>
    </div>

    <div class="card" style="margin-bottom: 30px;">
      <h3 style="margin:0 0 10px 0; color: var(--text-light);">System Status Overview</h3>
      <p class="muted">Akses cepat ke metrik pendaftaran utama. Data diperbarui secara *real-time*.</p>
      
      <div class="grid" style="grid-template-columns: repeat(3, 1fr); gap: 20px; margin-top: 20px;">
        <div class="stat-box">
            <div style="font-size: 14px; color: var(--text-muted);">Total Record Files</div>
            <div class="neon" style="font-size: 32px; font-weight: 900; line-height: 1;">124</div>
        </div>
        <div class="stat-box">
            <div style="font-size: 14px; color: var(--text-muted);">New Entries Today</div>
            <div class="neon" style="color: var(--accent-2); font-size: 32px; font-weight: 900; line-height: 1;">8</div>
        </div>
        <div class="stat-box">
            <div style="font-size: 14px; color: var(--text-muted);">Database Ping</div>
            <div class="neon" style="color: #4ade80; font-size: 32px; font-weight: 900; line-height: 1;">OK</div>
        </div>
      </div>
    </div>
    
  </div>

  </body>
</html>