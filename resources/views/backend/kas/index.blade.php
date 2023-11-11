
@extends('backend.template.master')

@section('name')
<div class="container">
    @include('pesan.pesan')
    <h2>Daftar Kas</h2>
    <div class="container">
        <div class="row">
            <div class="col-md-3 mb-2">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tambahKasModal">
                    Tambah Kas
                </button>
            </div>
            <div class="col-md-3 mb-2">
            <a href="{{ route('kas.export') }}" class="btn btn-success">Export Kas</a>
        </button>
            </div>
            <div class="col-md-6 mb-2">
                <form action="{{ route('kas.index') }}" method="GET" class="form-inline">
                    <div class="form-group">
                        <label for="tanggal" class="mr-2">Filter Tanggal:</label>
                        <input type="date" class="form-control datepicker" name="tanggal" id="tanggal" placeholder="Pilih Tanggal">
                    </div>
                    <button type="submit" class="btn btn-primary ml-2">Filter</button>
                </form>
            </div>
        </div>
    </div>


    <table class="table">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Peserta</th>
                <th>Tanggal Pembayaran</th>
                <th>Jumlah Pembayaran</th>
                <th>Status Pembayaran</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pembayaranKas as $key => $pembayaran)
            <tr>
                <td>{{ $key + 1 }}</td>
                <td>{{ $pembayaran->peserta->name }}</td>
                <td>{{ $pembayaran->tanggal_pembayaran }}</td>
                <td>Rp {{ number_format($pembayaran->jumlah_pembayaran, 0, ',', '.') }}</td>
                <td>{{ $pembayaran->status_pembayaran }}</td>
                <td>
                    <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#detailKasModal{{ $pembayaran->id }}">
                        Detail
                    </button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<!-- Modal Tambah Kas -->
<div class="modal fade" id="tambahKasModal" tabindex="-1" role="dialog" aria-labelledby="tambahKasModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
    <form action="{{ route('kas.proses-pembayaran', ['pesertaId' => $peserta->id]) }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="tambahKasModalLabel">Tambah Kas</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="peserta_id">Peserta</label>
                        <select class="form-control" id="peserta_id" name="peserta_id">
                            @foreach ($pesertaOptions as $pesertaId => $pesertaNama)
                            <option value="{{ $pesertaId }}">{{ $pesertaNama }}</option>
                            @endforeach
                        </select>
                        @error('peserta_id')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Detail Kas -->
@foreach ($pembayaranKas as $pembayaran)
<div class="modal fade" id="detailKasModal{{ $pembayaran->id }}" tabindex="-1" role="dialog" aria-labelledby="detailKasModalLabel{{ $pembayaran->id }}" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="detailKasModalLabel{{ $pembayaran->id }}">Detail Kas</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Nama Peserta: {{ $pembayaran->peserta->name }}</p>
                <p>Tanggal Pembayaran: {{ $pembayaran->tanggal_pembayaran }}</p>
                <p>Jumlah Pembayaran: Rp {{ number_format($pembayaran->jumlah_pembayaran, 0, ',', '.') }}</p>
                <p>Status Pembayaran: {{ $pembayaran->status_pembayaran }}</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<script>
    $(function () {
        $(".datepicker").datepicker({
            dateFormat: 'yy-mm-dd',
            changeMonth: true,
            changeYear: true,
        });
    });
</script>

@endforeach
@endsection


