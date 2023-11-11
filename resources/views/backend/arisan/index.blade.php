@extends('backend.template.master')

@section('name')
<!-- resources/views/arisan/index.blade.php -->

<!-- Tombol untuk memicu modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#createModal">
    Buat Arisan
</button>
@include('pesan.pesan')
<!-- Modal Create -->
<div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createModalLabel">Buat Arisan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('arisan.store') }}">
                    @csrf

                    {{-- <div class="form-group">
                        <label for="tempat_pelaksanaan">Tempat Pelaksanaan</label>
                        <input type="text" class="form-control" id="tempat_pelaksanaan" name="tempat_pelaksanaan" required>
                    </div> --}}
                    <div class="form-group">
                        <label for="tempat_pelaksanaan">tempat pelaksanaan</label>
                        <select class="form-control" id=tempat_pelaksanaan" name="tempat_pelaksanaan" required>
                            <option value="">pilih tempat pelaksanaan</option>
                            @foreach($tempat as $tempats)
                                <option value="{{ $tempats->id }}">Rumah {{ $tempats->name }}</option>
                                @endforeach

                        </select>
                    </div>
                    <div class="form-group">
                        <label for="nominal">Nominal</label>
                        <input type="text" class="form-control" id="nominal" name="nominal" required>
                    </div>
                    <div class="form-group">
                        <label for="tanggal_pelaksanaan">Tanggal Pelaksanaan</label>
                        <input type="date" class="form-control" id="tanggal_pelaksanaan" name="tanggal_pelaksanaan" required>
                    </div>

                    <div class="form-group">
                        <label for="keterangan">Keterangan</label>
                        <textarea class="form-control" id="keterangan" name="keterangan" required></textarea>
                    </div>

                    <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>

<table class="table table-striped mt-3">
    <thead>
        <tr>
            <th>ID</th>
            <th>Tanggal</th>
            <th>Nominal</th>
            <th>Tempat</th>
            <th>Keterangan</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach($arisan as $item)
        <tr>
            <td>{{ $item->id }}</td>
            <td>{{ $item->tanggal_pelaksanaan }}</td>
            <td>{{ $item->nominal }}</td>
            <td>Rumah {{ $item->peserta->name }}</td>
            <td>{{ $item->keterangan }}</td>
            <td>
                <button type="button" class="btn btn-info btn-sm tambah-peserta-btn" data-toggle="modal" data-target="#editModal{{ $item->id }}" id="tambahPesertaButton{{ $item->id }}" data-timestamp="{{ $item->created_at->timestamp }}">
                    Tambah Peserta
                  </button>

                <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#detailModal{{ $item->id }}">
                    View Details
                </button>
                <form action="{{ route('arisan.destroy', $item->id) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm"
                        onclick="return confirm('Apakah Anda yakin ingin menghapus arisan ini?')">Hapus</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
</div>
{{-- <div class="col-sm-3 text-center">
    <a href="{{url('/school/'.$course->school->seo_url.'/courses/'.$course->course->seo_url)}}" class="btn btn-secondary btn-shadow btn-xs mr-2 " >Pay</a>
                                                                                                                  </div> --}}

@foreach ($arisan as $item)
<div class="modal fade" id="editModal{{ $item->id }}" tabindex="-1" role="dialog"
    aria-labelledby="editModalLabel{{ $item->id }}" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="{{ route('arisan.update', $item->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel{{ $item->id }}">Tambah Peserta</h5>
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
                    <div class="form-group">
                        <label for="nominal">Nominal</label>
                            <input type="number" class="form-control" id="nominal" name="nominal" value="{{ $item->nominal }}" required readonly>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach


@foreach ($arisan as $item)
    <div class="modal fade" id="detailModal{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="#detailModal{{ $item->id }}" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="#detailModal{{ $item->id }}">Detail Arisan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>

                </div>
                <div class="modal-body">
                    @php
                    $totalNominal = 0;
                    @endphp
                   <table class="table">
                    <thead>
                        <tr>
                            <th>Nominal</th>
                            <th>Peserta ID</th>
                            <th>Peserta Name</th>
                            <th>Tanggal</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>

                        @if (isset($arisanDetails[$item->id]))
                            @foreach ($arisanDetails[$item->id] as $detail)
                            <tr>
                                <td>{{ $detail->nominal }}</td>
                                <td>{{ $detail->peserta->id }}</td>
                                <td>{{ $detail->peserta->name }}</td>
                                <td>{{ $detail->created_at->format('d/m/y') }}</td>
                                <td>
                                    @php
                                    $pemenangArisan = \App\Models\PemenangArisan::where('arisan_id', $item->id)->first();
                                @endphp
                                   @if (!$pemenangArisan)
                                    <form action="{{ route('arisan.deletePeserta', $detail->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm"
                                            onclick="return confirm('Apakah Anda yakin ingin menghapus pserta ini dari arisan?')">Hapus</button>
                                    </form>
                                        @endif
                                </td>
                            </tr>
                                @php
                                $totalNominal += $detail->nominal;
                                @endphp
                            @endforeach
                        @endif
                    </tbody>
                </table>
                @php
            $jumlah = isset($detail->nominal) ? $detail->nominal * $totalUsers : 0;
                @endphp
                    <p>Total Nominal: {{ number_format($totalNominal) }}.000/{{ number_format($jumlah) }}.000</p>
                </div>
                @php
                $pemenangArisan = \App\Models\PemenangArisan::where('arisan_id', $item->id)->first();
            @endphp
             @if ($pemenangArisan ?? '-')
       <center>      <h5>Pemenang Arisan: {{ $pemenangArisan->peserta->name ?? '-' }}</h5> </center>
         @endif



                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    @if (!$pemenangArisan)
                    <form action="{{ route('arisan.kocok', $item->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-primary">Kocok</button>
                    </form>

                    @endif
                </div>
            </div>
        </div>
    </div>




{{-- add evan --}}

 {{-- <a href="{{ route('admin.' . $module . '.create') }}" type="button" class="btn btn-labeled btn-primary m-b-5"> --}}


@endforeach

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var currentTime = new Date().getTime();

        var twoHoursAgo = currentTime - (2 * 60 * 60 * 1000);

        var tambahPesertaButtons = document.getElementsByClassName('tambah-peserta-btn');

        Array.from(tambahPesertaButtons).forEach(function(button) {
            var itemTimestamp = button.getAttribute('data-timestamp') * 1000;

            if (itemTimestamp < twoHoursAgo) {
                button.disabled = true;
            }
        });
    });
</script>





@endsection
