<table>
    <thead>
        <tr>
            <th>ms_generus_id</th>
            <th>nama_generus</th>
            <th>nomor_kartu</th>
        </tr>
    </thead>

    <tbody>
        @foreach ($generus as $item)
        <tr>
            <td>
                {{ $item->ms_generus_id }}
            </td>

            <td>
                {{ $item->nama_generus }}
            </td>

            <td>
                {{ $item->nomor_kartu }}
            </td>
        </tr>
        @endforeach
    </tbody>
</table>