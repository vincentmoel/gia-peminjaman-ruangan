@extends('template.main')

@section('container')
    @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif



    <div class="mb-4">
        {{-- <a href="/departments/create" class="btn btn-add"><i class="bi bi-plus-circle"></i> Add Department</a> --}}
        <button type="button" class="btn btn-add" data-bs-toggle="modal" data-bs-target="#addDepartmentModal">
            <i class="bi bi-plus-circle"></i> Add Department
        </button>
    </div>



    <table id="example" class="display" style="width:100%">
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
                    <td>
                        <button class="btn btn-primary" id="btn-edit-department" data-bs-toggle="modal" data-bs-target="#editDepartmentModal" data-name="{{ $department->name }}">Edit</button>
                        <form action="/departments/{{ $department->id }}" method="POST" class="d-inline">
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
                <th>Name</th>
                <th>Created At</th>
                <th>Updated At</th>
                <th>Action</th>
            </tr>
        </tfoot>
    </table>



    <!-- Modal Department -->
    <div class="modal fade" id="addDepartmentModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="addDepartmentModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addDepartmentModalLabel">Add Department</h5>
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
    <div class="modal fade" id="editDepartmentModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="addDepartmentModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addDepartmentModalLabel">Edit Department</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="/departments/" method="POST" id="form-edit">
                    @method('PUT')
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="name" class="form-label">Department Name</label>
                            <input type="text" name="name" id="name-edit"
                                class="form-control @error('name') is-invalid @enderror">
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
            $('#example').DataTable();
            @if (count($errors) > 0)
                $('#addDepartmentModal').modal('show');
            @endif

            $('#editDepartmentModal').on('show.bs.modal', function(e) {
                var departmentName = $(e.relatedTarget).data('name');
                $(e.currentTarget).find('input[name="name"]').val(departmentName);
                $(e.currentTarget).find('form[id="form-edit"]').attr('action','/departments/'+{{ $department->id }});
            });

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
