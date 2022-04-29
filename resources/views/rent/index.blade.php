@extends('template.main')

@section('container')
    <div class="header-wrapper pb-3 mb-4">
        <h1>rents</h1>
    </div>



    @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif



    <div class="mb-4">
        {{-- <a href="/rents/create" class="btn btn-add"><i class="bi bi-plus-circle"></i> Add rent</a> --}}
        <button type="button" class="btn btn-add" data-bs-toggle="modal" data-bs-target="#addDataModal">
            <i class="bi bi-plus-circle"></i> Add rent
        </button>
    </div>



    <table id="data-table" class="display" style="width:100%">
        <thead>
            <tr>
                <th>No</th>
                <th>Room</th>
                <th>Division</th>
                <th>Borrower Name</th>
                <th>Phone</th>
                <th>From Date</th>
                <th>Until Date</th>
                <th>Description</th>
                <th>Created At</th>
                <th>Updated At</th>
                <th>Action</th>

            </tr>
        </thead>
        <tbody>

            @php
                $no = 1;
            @endphp

            @foreach ($rents as $rent)
                <tr>
                    <td>{{ $no++ }}</td>
                    <td>{{ $rent->room->name }}</td>
                    <td>{{ $rent->division->name }}</td>
                    <td>{{ $rent->borrower_name }}</td>
                    <td>{{ $rent->phone }}</td>
                    @php
                        $from_date = date('d-m-Y H:i:s', strtotime($rent->from_date));
                        $until_date = date('d-m-Y H:i:s', strtotime($rent->until_date));
                    @endphp
                    <td>{{ $from_date }}</td>
                    <td>{{ $until_date }}</td>
                    <td>{{ $rent->description }}</td>
                    <td>{{ date_format($rent->created_at, 'd-m-Y H:i:s') }}</td>
                    <td>{{ date_format($rent->updated_at, 'd-m-Y H:i:s') }}</td>
                    <td>
                        <a href="/rents/{{ $rent->id }}/edit" class="btn btn-primary">Edit</a>
                        <form action="/rents/{{ $rent->id }}" method="POST" class="d-inline">
                            @method('DELETE')
                            @csrf
                            <button class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach


        </tbody>
        <tfoot>
            <tr>
                <th>No</th>
                <th>Room</th>
                <th>Division</th>
                <th>Borrower Name</th>
                <th>Phone</th>
                <th>From Date</th>
                <th>Until Date</th>
                <th>Description</th>
                <th>Created At</th>
                <th>Updated At</th>
                <th>Action</th>
            </tr>
        </tfoot>
    </table>



    <!-- Add Data Modal -->
    <div class="modal fade" id="addDataModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="addDataModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addDataModalLabel">Add rent</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="/rents" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="borrower_name" class="form-label">Rent Name</label>
                            <input type="text" name="borrower_name" class="form-control @error('borrower_name') is-invalid @enderror">
                            @error('borrower_name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="phone" class="form-label">Rent Name</label>
                            <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror">
                            @error('phone')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Rent Name</label>
                            <input type="text" name="description" class="form-control @error('description') is-invalid @enderror">
                            @error('description')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="reset" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-success">Submit</button>
                    </div>
                </form>

            </div>
        </div>
    </div>






    <script>
        $(document).ready(function() {
            $('#data-table').DataTable();
            @if (count($errors) > 0)
                $('#addDataModal').modal('show');
            @endif


        });




        // document.getElementById("toastbtn").onclick = function() {
        //     var toastElList = [].slice.call(document.querySelectorAll('.toast'))
        //     var toastList = toastElList.map(function(toastEl) {
        //         return new bootstrap.Toast(toastEl)
        //     })
        //     toastList.forEach(toast => toast.show())
        // }
    </script>
@endsection
