@extends('template.main')

@section('container')

<div class="mb-4">
    <a href="/departments/create" class="btn btn-add"><i class="bi bi-plus-circle"></i> Add Department</a>
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
            <td>{{ date_format($department->created_at,"d-m-Y H:i:s"); }}</td>
            <td>{{ date_format($department->updated_at,"d-m-Y H:i:s"); }}</td>
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


<script>
    $(document).ready(function() {
        $('#example').DataTable();
    });
</script>


@endsection
