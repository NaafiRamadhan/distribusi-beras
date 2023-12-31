<!DOCTYPE html>
<html lang="en">

<head>
    <title>Surat Jalan {{ $kode_distribusi }}</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>

    <Center>
        <h3>UD. SUMBER REJEKI SEJATI</h3>
        <p>Balung, Jember</p>
        @foreach ($distribusi as $distribusi)
            <h4>nota # <span>{{ $distribusi->kode_distribusi }}</span></h4>
        @endforeach
    </Center>
    <br>
    <div class="row">

        @foreach ($toko as $toko)
            <div class="col-sm-6">

                {{-- <h5 class="inv-title-1">Tanggal nota : <p>
                        {{ Carbon\Carbon::parse($distribusi->tanggal_distribusi)->format('M d, Y') }}
                    </p>
                </h5> --}}
            </div>
            <ul style="list-style:none;">
                <li> Tanggal : {{ Carbon\Carbon::parse($distribusi->tanggal_distribusi)->format('M d, Y') }}</li>
                <li> Pembeli : {{ $toko->nama_toko }}</li>
                <li> No. Telp : {{ $toko->nomor_tlp }}</li>
                <li> Alamat : {{ $toko->alamat }}</li>
            </ul>
            {{-- <p><b>{{ $toko->nama_toko }}</b> ({{ $toko->nomor_tlp }}),{{ $toko->alamat }} </p> --}}
        @endforeach
    </div>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th class="text-center">No.</th>
                <th>Beras</th>
                <th>Harga</th>
                <th>Jumlah (qty)</th>
                <th>Subtotal</th>
            </tr>
        </thead>

        <tbody class="table-group-divider">
            @foreach ($distribusi->detailDistribusi as $distribusi)
                <tr>
                    <td class="text-center">{{ $loop->iteration }}</td>
                    <td>{{ $distribusi->nama_beras }}</td>
                    <td>Rp. {{ number_format($distribusi->harga, 0, '.', '.') }}</td>
                    <td>{{ $distribusi->jumlah_beras }}</td>
                    <td>Rp. {{ number_format($distribusi->sub_total, 0, '.', '.') }}</td>
                </tr>
            @endforeach

            <tr>
                <td colspan="4"><strong>Total</strong></td>
                <td><strong>Rp.{{ number_format($total_harga->total_harga, 0, '.', '.') }}</strong></td>
            </tr>

        </tbody>
    </table>
    <p class="text-end">Tanda terima</p>
</body>

</html>
