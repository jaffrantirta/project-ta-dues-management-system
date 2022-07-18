<table>
    <thead>
    <tr>
        <th>Nama</th>
        <th>Email</th>
        <th>Telepon</th>
        <th>Jenis Kelamin</th>
        <th>Tanggal Lahir</th>
        <th>Umur</th>
        <th>Bergabung Pada (Tahun)</th>
        <th>Jabatan</th>
        <th>Status</th>
        <th>Keterangan</th>
    </tr>
    </thead>
    <tbody>
    @foreach($users as $i)
        <tr>
            <td>{{ $i->name }}</td>
            <td>{{ $i->email }}</td>
            <td>{{ $i->phone }}</td>
            <td>{{ $i->gender }}</td>
            <td>{{ $i->birth }}</td>
            <td>{{ $i->age }}</td>
            <td>{{ $i->join }}</td>
            <td>{{ $i->roles[0]->name }}</td>
            <td>{{ $i->status }}</td>
            <td>{{ $i->note }}</td>
        </tr>
    @endforeach
    </tbody>
</table>