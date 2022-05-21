@extends('template.main')

@section('container')
    <div class="header-wrapper pb-3 mb-4">
        <h1>Departments</h1>
    </div>



    @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif



    <div class="mb-4">
        {{-- <a href="/departments/create" class="btn btn-add"><i class="bi bi-plus-circle"></i> Add Department</a> --}}
        <button type="button" class="btn btn-add" data-bs-toggle="modal" data-bs-target="#addDataModal">
            <i class="bi bi-plus-circle"></i> Add Department
        </button>
    </div>



    <table id="data-table" class="display" style="width:100%">
        <thead>
            <tr>
                <th>No</th>
                <th>Name</th>
                <th>Created At</th>
                <th>Updated At</th>
                <th>Action</th>

            </tr>
        </thead>
        <tbody>

            @php
                $no = 1;
            @endphp

            @foreach ($departments as $department)
                <tr>
                    <td>{{ $no++ }}</td>
                    <td>{{ $department->name }}</td>
                    <td>{{ date_format($department->created_at, 'd-m-Y H:i:s') }}</td>
                    <td>{{ date_format($department->updated_at, 'd-m-Y H:i:s') }}</td>
                    <td class="text-sm-center text-md-start">
                        <a href="/departments/{{ $department->id }}/edit" class="btn btn-primary mb-1 mb-md-0"><i class="bi bi-pencil-square"></i></a>
                        <form action="/departments/{{ $department->id }}" method="POST" class="d-inline" id="form-delete">
                            @method('DELETE')
                            @csrf
                            <button class="btn btn-danger"><i class="bi bi-trash3-fill"></i></button>
                        </form>
                    </td>
                </tr>
            @endforeach


        </tbody>
        <tfoot>
            <tr>
                <th>No</th>
                <th>Name</th>
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
                    <h5 class="modal-title" id="addDataModalLabel">Add Department</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="/departments" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="name" class="form-label">Department Name</label>
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror">
                            @error('name')
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
