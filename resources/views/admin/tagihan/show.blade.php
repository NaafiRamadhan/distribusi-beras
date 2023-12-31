@extends('layouts.app')

@section('content')
    <div class="page-heading">
        <div class="row">
            <div class="col-md-6">
                <h3>Detail Tagihan</h3>
            </div>

        </div>
    </div>
    <div class="page-content">
        <section class="row">
            <div class="col-12 col-lg-12">
                <div class="card">

                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <h4>Nota Pembayaran: {{ $distribusi->kode_distribusi }}</h4>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-6">
                                <p>Nama Toko : {{ $toko->nama_toko }}</p>
                                <p>Alamat : {{ $toko->alamat }}</p>
                                <p>Sales : {{ $toko->sales }}</p>
                            </div>
                            <div class="col-md-6">
                                <p>Tanggal Order : {{ $distribusi->tanggal_distribusi }}</p>
                                <p>Tonase Orderan : {{ $distribusi->jumlah_distribusi }} KG</p>
                                <p>Yang Harus Dibayar : Rp. {{ number_format($distribusi->total_harga, 0, '.', '.') }}</p>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-12">
                                <table class="table table-bordered text-center">
                                    <thead>
                                        <tr>
                                            <th>Nama Beras</th>
                                            <th>Jumlah (QTY)</th>
                                            <th>Harga (satuan)</th>
                                            <th>Subtotal</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $totalHarga = 0;
                                        @endphp
                                        @foreach ($detailDistribusi as $detail)
                                            <tr>
                                                <td>{{ $detail->nama_beras }}</td>
                                                <td>{{ $detail->jumlah_beras }}</td>
                                                <td>Rp. {{ number_format($detail->harga, 0, '.', '.') }}</td>
                                                <td>Rp. {{ number_format($detail->sub_total, 0, '.', '.') }}</td>
                                            </tr>
                                            @php
                                                $totalHarga += $detail->sub_total;
                                            @endphp
                                        @endforeach
                                        <tr>
                                            <td class="text-end" colspan="3">
                                                <strong>Total :</strong>
                                            </td>
                                            <td>Rp. {{ number_format($totalHarga, 0, '.', '.') }}</td>
                                        </tr>
                                        <tr>
                                            <td class="text-end" colspan="3">
                                                <strong>Diskon :</strong>
                                            </td>
                                            <td>Rp.
                                                {{ number_format($totalHarga - $distribusi->total_harga, 0, '.', '.') }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-end" colspan="3">
                                                <strong>Total Harga :</strong>
                                            </td>
                                            <td>Rp.
                                                {{ number_format($distribusi->total_harga, 0, '.', '.') }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                                <h4>Riwayat Pembayaran</h4>
                                <table class="table table-bordered text-center">
                                    <thead>
                                        <tr>
                                            <th class="text-center">No.</th>
                                            <th>Tanggal Pembayaran</th>
                                            <th>Metode Pembayaran</th>
                                            <th>Jumlah Pembayaran</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $totalHarga = 0;
                                        @endphp
                                        @foreach ($detailDistribusi as $detail)
                                            <tr>
                                                <td class="text-center">{{ $loop->iteration }}</td>

                                            </tr>
                                            @php
                                                $totalHarga += $detail->sub_total;
                                            @endphp
                                        @endforeach
                                        <tr>
                                            <td class="text-end" colspan="3">
                                                <strong>Total Harga :</strong>
                                            </td>
                                            <td>Rp.
                                                {{ number_format($distribusi->total_harga, 0, '.', '.') }}</td>
                                        </tr>
                                        <tr>
                                            <td class="text-end" colspan="3">
                                                <strong>Sisa Pembayaran :</strong>
                                            </td>
                                            <td></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                                aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Pembayaran</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form id="formPembayaran">
                                                <div class="form-group">
                                                    <input type="hidden" id="id_distribusi" name="id_distribusi"
                                                        value="{{ $distribusi->id_distribusi }}">
                                                    <label for="tanggalPembayaran">Tanggal Pembayaran:</label>
                                                    <input type="date" class="form-control" id="tanggalPembayaran"
                                                        name="tanggalPembayaran" value="{{ date('Y-m-d') }}" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="jumlahPembayaran">Jumlah Pembayaran:</label>
                                                    <input type="number" placeholder="50000" class="form-control"
                                                        id="jumlahPembayaran" name="jumlahPembayaran" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="metodePembayaran">Metode Pembayaran:</label>
                                                    <select class="form-control" id="metodePembayaran"
                                                        name="metodePembayaran" required>
                                                        <option value="tunai">Tunai</option>
                                                        <option value="transfer">Transfer</option>
                                                    </select>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Close</button>
                                            <button type="button" class="btn btn-primary">Bayar</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="text-end">
                                <a href="{{ route('admin.tagihan') }}" class="btn btn-warning"><i
                                        class='nav-icon fas fa-arrow-left'></i>
                                    &nbsp;
                                    Kembali
                                </a>
                                <a data-bs-toggle="modal" data-bs-target="#exampleModal" class="btn btn-success ">Bayar</i>
                                </a>
                                <a href="#" class="btn btn-primary ">Print</i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <h4>Nota Pembayaran: {{ $distribusi->kode_distribusi }}</h4>
                            </div>
                            <div class="col-md-6 text-end">
                                <a href="{{ route('distribution') }}" class="btn btn-primary">
                                    Kembali
                                </a>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-6">
                                <p>Nama Toko: {{ $toko->nama_toko }}</p>
                                <p>Jumlah Keseluruhan Distribusi: {{ $distribusi->jumlah_distribusi }} KG</p>
                                <p>Total Harga: {{ $distribusi->total_harga }}</p>
                            </div>
                            <div class="col-md-6">
                                <p>Tanggal Kirim Beras : {{ $distribusi->tanggal_distribusi }}</p>
                                <p>Tanggal Tengat Waktu: </p>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-12">
                                <table class="table table-bordered text-center">
                                    <thead>
                                        <tr>
                                            <th>Tanggal Bayar</th>
                                            <th>Metode Pembayaran</th>
                                            <th>Jumlah yang dibayar</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $totalPembayaran = 0;
                                        @endphp
                                        @foreach ($bayar as $pembayaran)
                                            <tr>
                                                @if ($pembayaran->tanggal_pembayaran != null)
                                                    <td>{{ $pembayaran->tanggal_pembayaran }}</td>
                                                    <td>{{ $pembayaran->metode_pembayaran }}</td>
                                                    <td>{{ $pembayaran->jumlah_pembayaran }}</td>
                                                    @php
                                                        $totalPembayaran += $pembayaran->jumlah_pembayaran;
                                                    @endphp
                                                @endif
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                @php
                                    $sisaPembayaran = $distribusi->total_harga - $totalPembayaran;
                                @endphp
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                @if ($sisaPembayaran > 0)
                                    <p>Sisa yang harus dibayar: {{ $sisaPembayaran }}</p>
                                @else
                                    <p id="status">Status: Lunas</p>
                                @endif
                            </div>
                            <div class="col-6 text-end">
                                <a id="bayarButton" href="#" class="btn btn-success btn-sm" data-toggle="modal"
                                    data-target="#pembayaranModal">Bayar</a>
                                <a href="#" class="btn btn-warning btn-sm">Print</a>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="pembayaranModal" tabindex="-1" role="dialog"
                        aria-labelledby="pembayaranModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="pembayaranModalLabel">Form Pembayaran</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>

                                <div class="modal-body">
                                    <form id="formPembayaran">
                                        <div class="form-group">
                                            <input type="hidden" id="id_distribusi" name="id_distribusi"
                                                value="{{ $distribusi->id_distribusi }}">
                                            <label for="tanggalPembayaran">Tanggal Pembayaran:</label>
                                            <input type="date" class="form-control" id="tanggalPembayaran"
                                                name="tanggalPembayaran" value="{{ date('Y-m-d') }}" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="jumlahPembayaran">Jumlah Pembayaran:</label>
                                            <input type="number"
                                                placeholder="Sisa yang harus dibayar: {{ $sisaPembayaran }}"
                                                class="form-control" id="jumlahPembayaran" name="jumlahPembayaran"
                                                required>
                                        </div>
                                        <div class="form-group">
                                            <label for="metodePembayaran">Metode Pembayaran:</label>
                                            <select class="form-control" id="metodePembayaran" name="metodePembayaran"
                                                required>
                                                <option value="tunai">Tunai</option>
                                                <option value="transfer">Transfer</option>
                                            </select>
                                        </div>
                                    </form>
                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                    <button id="simpanPembayaran" class="btn btn-primary" disable>Simpan
                                        Pembayaran</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> --}}
            </div>
        </section>
    </div>

    {{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function() {
            $("#btnBayar").click(function() {
                $("#pembayaranModal").modal("show");
            });

            if ($('p#status').length) {
                $('#bayarButton').prop('disabled', true);
            }
        });

        const btnCheckout = document.getElementById('simpanPembayaran');
        btnCheckout.disabled = true;

        // Mengambil semua elemen input yang perlu diisi
        const tanggalPembayaranInput = document.getElementById('tanggalPembayaran');
        const jumlahPembayaranInput = document.getElementById('jumlahPembayaran');
        const metodePembayaranInput = document.getElementById('metodePembayaran');

        // Mendengarkan perubahan pada setiap input
        tanggalPembayaranInput.addEventListener('input', enableCheckoutButton);
        jumlahPembayaranInput.addEventListener('input', enableCheckoutButton);
        metodePembayaranInput.addEventListener('input', enableCheckoutButton);

        // Fungsi untuk memeriksa apakah semua input telah diisi
        function enableCheckoutButton() {
            if (
                tanggalPembayaranInput.value &&
                jumlahPembayaranInput.value &&
                metodePembayaranInput.value
            ) {
                // Semua input telah diisi, aktifkan tombol "Simpan Pembayaran"
                btnCheckout.disabled = false;
            } else {
                // Salah satu atau semua input belum diisi, nonaktifkan tombol "Simpan Pembayaran"
                btnCheckout.disabled = true;
            }
        }

        document.getElementById('simpanPembayaran').addEventListener('click', function() {
            var tanggalPembayaran = tanggalPembayaranInput.value;
            var jumlahPembayaran = jumlahPembayaranInput.value;
            var metodePembayaran = metodePembayaranInput.value;
            var id_distribusi = document.getElementById('id_distribusi').value;

            // Kirim data ke server menggunakan AJAX
            $.ajax({
                type: 'POST',
                url: '{{ url('/admin/pembayaran/store') }}', // Ganti dengan URL yang sesuai di aplikasi Anda
                data: {
                    id_distribusi: id_distribusi,
                    tanggalPembayaran: tanggalPembayaran,
                    jumlahPembayaran: jumlahPembayaran,
                    metodePembayaran: metodePembayaran,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    // Pembayaran berhasil disimpan
                    Swal.fire('Success', 'Pembayaran Berhasil', 'success')
                        .then((result) => {
                            if (result.isConfirmed) {
                                window.location.reload();
                            }
                        });
                },
                error: function(xhr, textStatus, errorThrown) {
                    console.error('Error:', errorThrown);
                    Swal.fire({
                        icon: 'error',
                        title: 'Terjadi kesalahan',
                        text: 'Pembayaran Gagal',
                    });
                }
            });
        });
    </script> --}}
@endsection
