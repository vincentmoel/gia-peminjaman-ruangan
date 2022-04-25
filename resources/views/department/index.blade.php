@extends('template.main')

@section('container')
    <div class="mb-4">
        {{-- <a href="/departments/create" class="btn btn-add"><i class="bi bi-plus-circle"></i> Add Department</a> --}}
        <button type="button" class="btn btn-add" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
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
                </tr>
            @endforeach


        </tbody>
        <tfoot>
            <tr>
                <th>No</th>
                <th>Name</th>
                <th>Created At</th>
                <th>Updated At</th>

            </tr>
        </tfoot>
    </table>



    <!-- Modal Department -->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Add Department</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form>

                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="name" class="form-label">Department Name</label>
                            <input type="text" class="form-control" id="name">
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
        });
    </script>
@endsection
