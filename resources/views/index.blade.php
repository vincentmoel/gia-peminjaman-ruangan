@extends('template.main')

@section('container')
    <div class="header-wrapper pb-3 mb-4">
        <h1>On Going Schedules</h1>
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

            </tr>
        </thead>
        <tbody>

            @php
                $no = 1;
            @endphp

            @foreach ($rents_active as $rent)
                <tr>
                    <td>{{ $no++ }}</td>
                    <td>{{ $rent->room->name }}</td>
                    <td>{{ $rent->division->name }}</td>
                    <td>{{ $rent->borrower_name }}</td>
                    <td>{{ $rent->phone }}</td>
                    @php
                        $from_date = date('d-m-Y H:i', strtotime($rent->from_date));
                        $until_date = date('d-m-Y H:i', strtotime($rent->until_date));
                    @endphp
                    <td>{{ $from_date }}</td>
                    <td>{{ $until_date }}</td>
                    <td>{{ $rent->description }}</td>
                   
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
            </tr>
        </tfoot>
    </table>



    

    <script>
        $(document).ready(function() {
            $('#data-table').DataTable();



        });

        
    </script>
@endsection
