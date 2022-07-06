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
        <th>Status</th>
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
            <td>{{ $i->status }}</td>
        </tr>
    @endforeach
    </tbody>
</table>