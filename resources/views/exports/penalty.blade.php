<table>
    <thead>
    <tr>
        <th>Nama</th>
        <th>Acara</th>
        <th>Tanggal Acara</th>
        <th>Denda</th>
        <th>Status Pembayaran</th>
    </tr>
    </thead>
    <tbody>
    @foreach($penalties as $i)
        <tr>
            <td>{{ $i->user->name }}</td>
            <td>{{ $i->event->name }}</td>
            <td>{{ $i->event->date_time }}</td>
            <td>{{ $i->fee_text }}</td>
            <td>{{ $i->paid_text }}</td>
        </tr>
    @endforeach
    </tbody>
</table>