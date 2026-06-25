<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <style>
        body { font-family: Arial, sans-serif; font-size: 12px; }
        h2 { text-align: center; margin-bottom: 20px; }
        table { width: 100%; border-collapse: collapse; }
        th { background-color: #4f46e5; color: white; padding: 8px; text-align: left; }
        td { padding: 7px 8px; border-bottom: 1px solid #e5e7eb; }
        tr:nth-child(even) { background-color: #f9fafb; }
        .aktif { color: green; font-weight: bold; }
        .tidak-aktif { color: red; font-weight: bold; }
    </style>
</head>
<body>
    <h2>Data Klien</h2>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Klien</th>
                <th>Perusahaan</th>
                <th>Email</th>
                <th>No. Telpon</th>
                <th>Status</th>
                <th>Tanggal</th>
                <th>Alamat</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($klien as $i => $item)
            <tr>
                <td>{{ $i + 1 }}</td>
                <td>{{ $item->nama_klien }}</td>
                <td>{{ $item->nama_perusahaan }}</td>
                <td>{{ $item->email ?? '-' }}</td>
                <td>{{ $item->no_telpon ?? '-' }}</td>
                <td class="{{ $item->status === 'Aktif' ? 'aktif' : 'tidak-aktif' }}">{{ $item->status }}</td>
                <td>{{ $item->tanggal_kerjasama ? \Carbon\Carbon::parse($item->tanggal_kerjasama)->format('d M Y') : '-' }}</td>
                <td>{{ $item->alamat ?? '-' }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>