<?php include 'koneksi.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portofolio Mahasiswa TI UIR</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&family=JetBrains+Mono:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <nav class="navbar">
        <div class="nav-logo">My<span>Portfolio</span></div>
        <ul class="nav-links">
            <li><a href="#hero">Home</a></li>
            <li><a href="#about">About</a></li>
            <li><a href="#education">Education</a></li>
            <li><a href="#contact">Contact</a></li>
            <li><a href="#todo-app">Todo List</a></li>
        </ul>
        <button id="theme-toggle" class="btn-theme">🌙 Mode</button>
    </nav>

    <main class="container">
        
        <section id="hero" class="hero-section">
            <div class="profile-glow">
                <img src="image/LatarBelakangMerah.jpeg" alt="Foto Profil" class="profile-img">
            </div>
            <div class="hero-text">
                <span class="badge">Informatics Engineering</span>
                <h2>Halo, Saya Mahasiswa TI</h2>
                <p>Web Developer | Student at Universitas Islam Riau</p>
            </div>
        </section>

        <article id="about" class="about-section">
            <h2>Tentang Saya</h2>
            <div class="card">
                <p>Saya adalah mahasiswa Teknik Informatika yang sedang mempelajari dan mendalami pengembangan teknologi pengembangan web khususnya di sisi <span>frontend</span> menggunakan HTML5, CSS3, dan integrasi <span>backend</span> berbasis PHP serta MySQL untuk menuntaskan tugas Pemograman Web.</p>
            </div>
        </article>

        <section id="education" class="edu-section">
            <h2>Riwayat Pendidikan</h2>
            <div class="card table-responsive">
                <table class="edu-table">
                    <thead>
                        <tr>
                            <th>Tahun</th>
                            <th>Institusi</th>
                            <th>Jurusan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="year-cell">2024 - Sekarang</td>
                            <td>Universitas Islam Riau</td>
                            <td>Teknik Informatika</td>
                        </tr>
                        <tr>
                            <td class="year-cell">2020 - 2023</td>
                            <td>SMA Negeri 1 Tembilahan Kota</td>
                            <td>IPS</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </section>

        <div class="main-grid">
            
            <section id="contact" class="contact-section">
                <h2>Hubungi Saya</h2>
                <div class="card">
                    <form action="proses_kontak.php" method="POST" class="contact-form">
                        <div class="form-group">
                            <label for="name">Nama Lengkap</label>
                            <input type="text" id="name" name="nama" placeholder="Masukkan nama Anda" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" id="email" name="email" placeholder="contoh@email.com" required>
                        </div>
                        <div class="form-group">
                            <label for="message">Pesan</label>
                            <textarea id="message" name="pesan" rows="4" placeholder="Tulis pesan Anda di sini" required></textarea>
                        </div>
                        <button type="submit" name="kirim_pesan" class="btn-submit">Kirim Pesan</button>
                    </form>
                </div>
            </section>

            <section id="todo-app" class="todo-wrapper">
                <h2>My Tasks</h2>
                <div class="card">
                    <form action="proses_todo.php" method="POST" class="todo-input-group">
                        <input type="text" name="task_text" placeholder="Add a new task..." required>
                        <button type="submit" name="add_task" class="btn-add">Add</button>
                    </form>

                    <ul id="todo-list">
                        <?php
                        $query = mysqli_query($conn, "SELECT * FROM todos ORDER BY id DESC");
                        while ($row = mysqli_fetch_assoc($query)) {
                            $item_class = ($row['completed'] == 1) ? 'completed' : 'normal';
                            $text_class = ($row['completed'] == 1) ? 'done' : '';
                        ?>
                            <li class="todo-item <?php echo $item_class; ?>">
                                <a href="proses_todo.php?toggle=<?php echo $row['id']; ?>&status=<?php echo $row['completed']; ?>" class="todo-text <?php echo $text_class; ?>">
                                    <?php echo htmlspecialchars($row['task_text']); ?>
                                </a>
                                <a href="proses_todo.php?delete=<?php echo $row['id']; ?>" class="todo-delete-btn">
                                    &times;
                                </a>
                            </li>
                        <?php } ?>
                    </ul>
                </div>
            </section>

        </div>
    </main>

    <footer class="main-footer">
        <p>&copy; 2026 Teknik Informatika UIR. Disusun oleh Asisten Dosen.</p>
    </footer>

    <script>
        const themeToggle = document.getElementById('theme-toggle');
        
        if (localStorage.getItem('theme') === 'light') {
            document.body.classList.remove('dark');
            themeToggle.textContent = "🌙 Dark";
        } else {
            document.body.classList.add('dark');
            themeToggle.textContent = "☀️ Light";
        }

        themeToggle.addEventListener('click', () => {
            document.body.classList.toggle('dark');
            if(document.body.classList.contains('dark')) {
                themeToggle.textContent = "☀️ Light";
                localStorage.setItem('theme', 'dark');
            } else {
                themeToggle.textContent = "🌙 Dark";
                localStorage.setItem('theme', 'light');
            }
        });
    </script>
</body>
</html>