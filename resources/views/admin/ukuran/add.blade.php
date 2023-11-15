@extends('layouts.app')
@section('content')
    <div class="page-heading">
        <h3>Input Data Sales</h3>
    </div>
    <div class="page-content">
        <section class="row">

            <div class="col-12 col-lg-12">
                <div class="card">
                    <div class="card-header">

                    </div>
                    <form action="{{ Route('admin.sales.create') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="mb-3">
                                <div class="form-group">
                                    <label for="nama_sales">Nama Sales :</label>
                                    <input type="text" name="nama_sales"
                                        class="form-control @error('nama_sales') is-invalid @enderror"
                                        placeholder="Nama Sales..">
                                    <div class="text-danger">
                                        @error('nama_sales')
                                            Nama sales tidak boleh kosong.
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <div class="form-group">
                                    <label for="no_telpon">Nomor Telpon :</label>
                                    <input type="text" name="no_telpon"
                                        class="form-control @error('no_telpon') is-invalid @enderror"
                                        placeholder="Nomor telpon..">
                                    <div class="text-danger">
                                        @error('no_telpon')
                                            Nomor telepon sales tidak boleh kosong.
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <!-- /.card-body -->
                            <div class="card-footer">
                                <a href="{{ route('admin.sales') }}" type="button" class="btn btn-warning"><i
                                        class='nav-icon fas fa-arrow-left'></i> &nbsp;
                                    Kembali</a>
                                <button type="submit" class="btn btn-primary"><i class="nav-icon fas fa-save"></i>
                                    &nbsp;
                                    Simpan</button>
                            </div>
                    </form>
                </div>
            </div>
        </section>
    </div>
@endsection
