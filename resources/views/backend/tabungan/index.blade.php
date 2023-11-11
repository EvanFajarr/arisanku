@extends('backend.template.master')

@section('name')
<div class="container">
    @include('pesan.pesan')
    <h2>Daftar Tabungan</h2>
    <button type="button" class="btn btn-primary mb-2" data-toggle="modal" data-target="#createModal">
        Tambah Tabungan
    </button>
    <table class="table">
        <thead>
            <tr>
                <th>No</th>
                <th>Name</th>
                {{-- <th>Nominal</th> --}}
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($tabungan as $key => $item)
            <tr>
                <td>{{ $key + 1 }}</td>
                <td>{{ $item->tabungan->name ?? 'no data' }}</td>

                {{-- <td>{{ $item->nominal}}</td> --}}
                <td>
                    <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#detailModal{{ $item->id }}">Detail Tabungan</button>

                    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal"
                        data-target="#editModal{{ $item->id }}">
                       Tambah
                    </button>
                    <form action="{{ route('tabungan.destroy', $item->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm"
                            onclick="return confirm('Apakah Anda yakin ingin menghapus tabungan ini?')">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
<!-- Modal Detail Tabungan -->
@foreach ($tabungan as $item)
<div class="modal fade" id="detailModal{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="detailModalLabel{{ $item->id }}" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="detailModalLabel{{ $item->id }}">Detail Tabungan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                @php
                $totalNominal = 0;
                @endphp
                <p>Name: {{ $item->tabungan->name ?? 'no data' }}</p>
                <p>Nominal:</p>
                <ul>
                    @foreach ($item->detailTabungan as $detail)
                        <li>{{ $detail->nominal }} | {{ $detail->created_at->diffForHumans() }} </li>
                        @php
                        $totalNominal += $detail->nominal;
                        @endphp
                    @endforeach

                </ul>
                <p>Total Nominal: {{ number_format($totalNominal) }}.000</p>
                <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#tarikSaldoModal{{ $item->id }}">Tarik Saldo</button>
                <a href="{{ route('tabungan.cetak-pdf', $item->id) }}" class="btn btn-secondary btn-sm">Cetak PDF</a>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
@endforeach
<!-- Modal Tarik Saldo -->
@foreach ($tabungan as $item)
<div class="modal fade" id="tarikSaldoModal{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="tarikSaldoModalLabel{{ $item->id }}" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tarikSaldoModalLabel{{ $item->id }}">Tarik Saldo</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Apakah Anda yakin ingin menarik saldo ini?</p>
            </div>
            <div class="modal-footer">
                <form action="{{ route('tarik-saldo', $item->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-danger">Tarik Saldo</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endforeach

<!-- Modal Create -->
<div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="createModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="{{ route('tabungan.store') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="createModalLabel">Tambah Tabungan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="user_id">User ID</label>
                        <select class="form-control" id="user_id" name="user_id" required>
                            <option value="">Pilih User</option>
                            @foreach ($peserta as $p)
                                <option value="{{ $p->id }}">{{ $p->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="nominal">Nominal</label>
                        <input type="text" class="form-control" id="nominal" name="nominal" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Modal Edit -->
@foreach ($tabungan as $item)
<div class="modal fade" id="editModal{{ $item->id }}" tabindex="-1" role="dialog"
    aria-labelledby="editModalLabel{{ $item->id }}" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="{{ route('tabungan.update', $item->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel{{ $item->id }}">Edit Tabungan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="nominal">Nominal</label>
                        @if ($item->detail_tabungan)
                            <input type="number" class="form-control" id="nominal" name="nominal" value="{{ $item->detail_tabungan->last() ? $item->detail_tabungan->last()->nominal : '' }}" required>
                        @else
                            <input type="number" class="form-control" id="nominal" name="nominal" required>
                        @endif
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
@endsection
