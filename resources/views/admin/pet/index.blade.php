<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Pet</title>
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
            border-collapse: collapse;
        }
        
        td {
            padding: 1rem;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        
        th {
            padding: 12px;
            background: blue;
            color: white;
            font-weight: 600;
            text-align: left;
        }
        
        .dashboard-container {
            display: flex;
            min-height: 100vh;
        }

        .sidebar {
            width: 250px;
            background-color: #ffff;
            color: #000;
            display: flex;
            flex-direction: column;
            padding: 20px 0;
            position: fixed;
            height: 100%;
            box-shadow: 2px 0 5px rgba(0,0,0,0.1);
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

        .logout-btn {
            color: #ff4b5c !important;
            font-weight: bold;
        }

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
            border: none;
            cursor: pointer;
        }

        .btn-add:hover {
            background: linear-gradient(135deg, #0056b3, #004080);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.25);
        }

        .alert {
            padding: 12px 20px;
            border-radius: 5px;
            margin-bottom: 20px;
        }

        .alert-success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }

        .badge {
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 12px;
            font-weight: 600;
        }

        .badge-primary {
            background-color: #007bff;
            color: white;
        }

        .badge-pink {
            background-color: #e83e8c;
            color: white;
        }
    </style>
</head>
<body>
    <div class="dashboard-container">
        <aside class="sidebar">
            <h2 class="sidebar-logo">RSHP</h2>
            <ul class="sidebar-menu">
                <li><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li><a href="{{ route('admin.jenis-hewan.index') }}">Jenis Hewan</a></li>
                <li><a href="{{ route('admin.pemilik.index') }}">Pemilik</a></li>
                <li><a href="{{ route('admin.ras-hewan.index') }}">Ras Hewan</a></li>
                <li><a href="{{ route('admin.kategori.index') }}">Kategori</a></li>
                <li><a href="{{ route('admin.kategori-klinis.index') }}">Kategori Klinis</a></li>
                <li><a href="{{ route('admin.tindakan-terapi.index') }}">Tindakan & Terapi</a></li>
                <li><a href="{{ route('admin.user.index') }}">Manajemen User</a></li>
                <li><a href="{{ route('admin.role.index') }}">Manajemen Role</a></li>
                <li><a href="{{ route('admin.pet.index') }}" class="active">Data Hewan Peliharaan</a></li>
                <li><a href="{{ route('admin.role-user.index') }}">Penetapan Role User</a></li>
                <li><a href="{{ route('login') }}" class="logout-btn">Logout</a></li>
            </ul>
        </aside>
        
        <main class="main-content">
            <header class="main-header">
                <h1>Daftar Hewan Peliharaan (Pet)</h1>
            </header>

            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <a href="{{ route('admin.pet.create') }}" class="btn-add" style="margin-bottom: 20px;">
                Tambah Data Pet
            </a>
            
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Pet</th>
                        <th>Pemilik</th>
                        <th>Ras Hewan</th>
                        <th>Jenis Kelamin</th>
                        <th>Tanggal Lahir</th>
                        <th>Warna/Tanda</th>
                    </tr>
                </thead>
                <tbody>
                    @if (!empty($pet) && count($pet) > 0)
                        @foreach ($pet as $index => $item)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td><strong>{{ $item->nama }}</strong></td>
                                <td>{{ $item->pemilik->user->nama }}</td>
                                <td>
                                    {{ $item->rasHewan->nama_ras }}
                                    <br>
                                    <small style="color: #6c757d;">
                                        ({{ $item->rasHewan->jenisHewan->nama_jenis_hewan }})
                                    </small>
                                </td>
                                <td>
                                    @if($item->jenis_kelamin == '1')
                                        <span class="badge badge-primary">Jantan</span>
                                    @else
                                        <span class="badge badge-pink">Betina</span>
                                    @endif
                                </td>
                                <td>{{ date('d/m/Y', strtotime($item->tanggal_lahir)) }}</td>
                                <td>{{ $item->warna_tanda }}</td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="7" style="text-align:center;">Tidak ada data pet.</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </main>
    </div>
</body>
</html>