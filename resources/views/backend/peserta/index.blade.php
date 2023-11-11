<!-- resources/views/peserta/index.blade.php -->
@extends('backend.template.master')



@section('name')
<div class="container">
    @include('pesan.pesan')
    <h2>Peserta Management</h2>
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#createPesertaModal">
        Add Peserta
    </button>

    <table class="table table-striped mt-3">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>

                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($peserta as $item)
            <tr>
                <td>{{ $item->id }}</td>
                <td>{{ $item->name }}</td>
                <td>{{ $item->email }}</td>

                <td>
                    <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#editPesertaModal-{{ $item->id }}">
                        Edit
                    </button>
                    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#pesertaDetailModal-{{ $item->id }}">
                        View Details
                    </button>
                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deletePesertaModal-{{ $item->id }}">
                        Delete
                    </button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<!-- Create Peserta Modal -->
<div class="modal fade" id="createPesertaModal" tabindex="-1" role="dialog" aria-labelledby="createPesertaModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createPesertaModalLabel">Add Peserta</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Create Peserta Form Goes Here -->
                <form action="{{ route('peserta.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="alamat">Alamat</label>
                        <input type="text" class="form-control" id="alamat" name="alamat" required>
                    </div>
                    <div class="form-group">
                        <label for="no_hp">No. HP</label>
                        <input type="text" class="form-control" id="no_hp" name="no_hp" required>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Add Peserta</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Edit Peserta Modals (One for each peserta) -->
@foreach($peserta as $item)
<div class="modal fade" id="editPesertaModal-{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="editPesertaModalLabel-{{ $item->id }}" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editPesertaModalLabel-{{ $item->id }}">Edit Peserta</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Edit Peserta Form Goes Here -->
                <form action="{{ route('peserta.update', $item->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="edit-name">Name</label>
                        <input type="text" class="form-control" id="edit-name" name="name" value="{{ $item->name }}" required>
                    </div>
                    <div class="form-group">
                        <label for="edit-email">Email</label>
                        <input type="email" class="form-control" id="edit-email" name="email" value="{{ $item->email }}" required>
                    </div>
                    <div class="form-group">
                        <label for="edit-alamat">Alamat</label>
                        <input type="text" class="form-control" id="edit-alamat" name="alamat" value="{{ $item->alamat }}" required>
                    </div>
                    <div class="form-group">
                        <label for="edit-no_hp">No. HP</label>
                        <input type="text" class="form-control" id="edit-no_hp" name="no_hp" value="{{ $item->no_hp }}" required>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Update Peserta</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endforeach

<!-- Modals for Peserta Details (One for each peserta) -->
@foreach($peserta as $item)
<div class="modal fade" id="pesertaDetailModal-{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="pesertaDetailModalLabel-{{ $item->id }}" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="pesertaDetailModalLabel-{{ $item->id }}">Peserta Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table">
                    <tbody>
                        <tr>
                            <th>ID:</th>
                            <td>{{ $item->id }}</td>
                        </tr>
                        <tr>
                            <th>Name:</th>
                            <td>{{ $item->name }}</td>
                        </tr>
                        <tr>
                            <th>Email:</th>
                            <td>{{ $item->email }}</td>
                        </tr>
                        <tr>
                            <th>Alamat:</th>
                            <td>{{ $item->alamat }}</td>
                        </tr>
                        <tr>
                            <th>No. HP:</th>
                            <td>{{ $item->no_hp }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
@endforeach
<!-- Delete Peserta Modals (One for each peserta) -->
@foreach($peserta as $item)
<div class="modal fade" id="deletePesertaModal-{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="deletePesertaModalLabel-{{ $item->id }}" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deletePesertaModalLabel-{{ $item->id }}">Delete Peserta</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete this peserta?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <form action="{{ route('peserta.destroy', $item->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endforeach

@endsection
