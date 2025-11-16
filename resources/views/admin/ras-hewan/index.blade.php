<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
    <div class="dashboard-container">
        <aside class="sidebar">
          <h2 class="sidebar-logo">RSHP</h2>
          <ul class="sidebar-menu">
            <li><a href="{{ route('admin.dashboard') }}" >Dashboard</a></li>
                <li><a href="{{ route('admin.jenis-hewan.index') }}" >Jenis Hewan</a></li>
                <li><a href="{{ route('admin.pemilik.index') }}" >Pemilik</a></li>
                <li><a href="{{ route('admin.ras-hewan.index') }}" class="active">Ras Hewan</a></li>
                <li><a href="{{ route('admin.kategori.index') }}" >Kategori</a></li>
                <li><a href="{{ route('admin.kategori-klinis.index') }}" >Kategori Klinis</a></li>
                <li><a href="{{ route('admin.tindakan-terapi.index') }}">Tindakan & Terapi</a></li>
                <li><a href="{{ route('admin.user.index') }}">Manajemen User</a></li>
                <li><a href="{{ route('admin.role.index') }}">Manajemen Role</a></li>
                <li><a href="{{ route('admin.pet.index') }}" >Data Hewan Peliharaan</a></li>
                <li><a href="{{ route('admin.role-user.index') }}">Penetapan Role User</a></li>
                <li><a href="{{ route('logout') }}" class="logout-btn">Logout</a></li>
          </ul>
        </aside>
        <main class="main-content">
          <header class="main-header">
            <h1>Daftar Ras Hewan</h1>
          </header>
          
        <a href="{{ route('admin.ras-hewan.create') }}" class="btn-add" style="margin-bottom: 20px;">Tambah Data Pet</a>
    <table border="1" cellpadding="8" cellspacing="0" style="margin:auto; width:90%;">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama Ras</th>
                <th>Jenis Hewan</th>
            </tr>
        </thead>
        <tbody>
            @if (!empty($rasHewan))
                @foreach ($rasHewan as $index => $ras)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $ras -> nama_ras }}</td>
                        <td>{{ $ras ->jenisHewan-> nama_jenis_hewan }}</td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="3" style="text-align:center;">Tidak ada data jenis hewan.</td>
                </tr>
             @endif
        </tbody>
    </table>



        </main>
      </div>
    </div>
</body>
</html>
    


    
    



    