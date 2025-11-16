<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Registrasi Pemilik</title>
    <style>
    * {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  font-family: "Segoe UI", sans-serif;
}

body {
  background-color: #f5f6fa;
  color: #333;
}
table {
    width: 100%;
    margin: 1rem 0;
    background: white;
    border-radius: 8px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
}
td {
    padding: 1rem;
    text-align: left;
    border-bottom: 1px solid #ddd;
    border-left: 1px solid #ddd;
}
th {
    padding: 12px;
    background: blue;
    color: white;
    font-weight: 600;
}
.dashboard-container {
  display: flex;
  height: 100vh;
}

/* ===== SIDEBAR ===== */
.sidebar {
  width: 250px;
  background-color: #ffff;
  color: #000;
  display: flex;
  flex-direction: column;
  padding: 20px 0;
  position: fixed;
  height: 100%;
}

.sidebar-logo {
  text-align: center;
  font-size: 1.5em;
  font-weight: bold;
  margin-bottom: 20px;
}

.sidebar-menu {
  list-style: none;
  padding: 0;
}

.sidebar-menu li {
  margin: 5px 0;
}

.sidebar-menu a {
  display: block;
  padding: 12px 20px;
  color: #000;
  text-decoration: none;
  transition: 0.3s;
}

.sidebar-menu a:hover,
.sidebar-menu a.active {
  background-color: #2f3640;
  color: #fff;
}

.menu-header {
  margin-top: 15px;
  padding: 12px 20px;
  font-size: 0.9em;
  text-transform: uppercase;
  color: #aaa;
  letter-spacing: 1px;
}

.logout-btn {
  color: #ff4b5c !important;
  font-weight: bold;
}

/* ===== MAIN CONTENT ===== */
.main-content {
  margin-left: 250px;
  padding: 30px;
  width: 100%;
}

.main-header {
  background-color: #fff;
  padding: 15px 20px;
  border-radius: 8px;
  box-shadow: 0 2px 5px rgba(0,0,0,0.1);
  margin-bottom: 25px;
}

.content {
  background-color: #fff;
  padding: 25px;
  border-radius: 8px;
  box-shadow: 0 2px 5px rgba(0,0,0,0.1);
}

.btn-add {
    text-decoration: none;
    display: inline-block;
    padding: 12px 25px;
    background: linear-gradient(135deg, #007bff, #0056b3);
    color: #fff;
    font-size: 16px;
    border-radius: 10px;
    font-weight: 600;
    text-align: center;
    box-shadow: 0 6px 15px rgba(0, 123, 255, 0.3);
    transition: 0.3s;
}

.btn-add:hover {
    background: linear-gradient(135deg, #0056b3, #004080);
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.25);
}
.form-user input[type="text"],
.form-user input[type="email"],
.form-user input[type="password"] {
    width: 100%;
    padding: 12px 15px;
    margin-bottom: 4px;
    border: 1px solid #ccc;
    border-radius: 6px;
    font-size: 16px;
    box-sizing: border-box;
}

.form-user input[type="submit"] {
    width: 100%;
    padding: 12px 15px;
    background: linear-gradient(135deg, #007bff, #0056b3);
    color: white;
    font-size: 16px;
    font-weight: 600;
    border: none;
    border-radius: 6px;
    cursor: pointer;
}

.form-user input[type="submit"]:hover {
    background: linear-gradient(135deg, #0056b3, #004080);
}

.form-container {
    max-width: 500px;
    margin: 2rem auto;
    background: #fff;
    padding: 2rem;
    border-radius: 12px;
    box-shadow: 0 4px 15px rgba(0,0,0,0.1);
}

.form-container h3 {
    text-align: center;
    margin-bottom: 1.5rem;
    color: #2c3e50;
}

.form-container label {
    font-weight: 600;
    display: block;
    margin-bottom: 6px;
    color: #34495e;
}

.form-container input[type="text"],
.form-container input[type="email"],
.form-container input[type="password"],
.form-container select {
    width: 100%;
    padding: 12px 15px;
    margin-bottom: 1rem;
    border: 1px solid #ccc;
    border-radius: 8px;
    font-size: 16px;
    box-sizing: border-box;
    transition: border 0.3s ease, box-shadow 0.3s ease;
}

.form-container input:focus,
.form-container select:focus {
    border-color: #007bff;
    box-shadow: 0 0 6px rgba(0,123,255,0.3);
    outline: none;
}

.form-container button {
    width: 100%;
    padding: 12px 15px;
    background: linear-gradient(135deg, #007bff, #0056b3);
    color: #fff;
    font-size: 16px;
    font-weight: 600;
    border: none;
    border-radius: 8px;
    cursor: pointer;
    transition: 0.3s ease;
}

.form-container button:hover {
    background: linear-gradient(135deg, #0056b3, #004080);
}
td a {
    display: inline-block;
    margin: 6px 4px;
    padding: 8px 14px;
    font-size: 14px;
    font-weight: 600;
    border-radius: 6px;
    text-decoration: none;
    color: #fff;
}

td a.edit-btn {
    background: linear-gradient(135deg, #28a745, #218838);
    box-shadow: 0 3px 8px rgba(40, 167, 69, 0.3);
}
td a.edit-btn:hover {
    background: linear-gradient(135deg, #218838, #1e7e34);
}

td a.reset-btn {
    background: linear-gradient(135deg, #ffc107, #e0a800);
    box-shadow: 0 3px 8px rgba(255, 193, 7, 0.3);
    color: #fff;
}
 a.reset-btn:hover {
    background: linear-gradient(135deg, #e0a800, #c69500);
}
td a.delete-btn {
    background: linear-gradient(135deg, #a72828, #882121);
    box-shadow: 0 3px 8px rgba(167, 40, 40, 0.3);    
}
td a.delete-btn:hover {
    background: linear-gradient(135deg, #882121, #7e1e1e);
}


/* ===== RESPONSIVE ===== */
@media (max-width: 768px) {
  .sidebar {
    width: 200px;
  }

  .main-content {
    margin-left: 200px;
  }
}

@media (max-width: 600px) {
  .sidebar {
    position: fixed;
    left: -250px;
    transition: left 0.3s;
  }

  .sidebar.active {
    left: 0;
  }

  .main-content {
    margin-left: 0;
  }
}
    </style>
</head>
<body>
    <div>
    <div class="dashboard-container">
        <aside class="sidebar">
          <h2 class="sidebar-logo">RSHP</h2>
          <ul class="sidebar-menu">
            <li><a href="{{ route('resepsionis.dashboard') }}" >Dashboard</a></li>
                <li><a href="{{ route('resepsionis.registrasi.pemilik') }}" class="active">Registrasi Pemilik</a></li>
                <li><a href="{{ route('resepsionis.registrasi.pet') }}">Registrasi Pet</a></li>
                <li><a href="{{ route('resepsionis.registrasi.temudokter') }}">Registrasi Temu Dokter</a></li>
                <li><a href="{{ route('login') }}" class="logout-btn">Logout</a></li>
          </ul>
        </aside>
        <main class="main-content">

          <section class="content">
            <h2>Registrasi Pemilik Baru</h2>
        </section>
            {{-- <div class="form-container" style="margin-top: 80px;">
                <h3>Formulir Registrasi Pemilik</h3>
                <form method="post" class="form-user">
                    <label>Nama Lengkap:</label>
                    <input type="text" name="nama" required>

                    <label>Email:</label>
                    <input type="email" name="email" required>

                    <label>Password (default):</label>
                    <input type="password" name="password" required>

                    <label>Nomor WhatsApp:</label>
                    <input type="text" name="no_wa" required>

                    <label>Alamat:</label>
                    <textarea name="alamat" rows="3" style="width:100%; padding:10px; border:1px solid #ccc; border-radius:6px;" required></textarea>

                    <button type="submit" style="margin-top:15px;">Daftarkan Pemilik</button>
                </form>
            </div> --}}
            
        </main>
      </div>
    </div>
</body>
</html>
