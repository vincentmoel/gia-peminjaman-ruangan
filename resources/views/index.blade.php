@extends('template.main')

@section('container')
    <div class="header-wrapper pb-3 mb-4 d-flex justify-content-between">
        <h1>On Going Schedules</h1>
        <h2>
            <div id="runningTime"></div>
        </h2>
    </div>


    <table class="table" style="width:100%">
        <thead class="table-light">
            <tr>
                <th>No</th>
                <th>Room</th>
                <th>Division</th>
                <th>Borrower Name</th>
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
                <tr style="background-color: #d1e7dd">
                    <td>{{ $no++ }}</td>
                    <td>{{ $rent->room->name }}</td>
                    <td>{{ $rent->division->name }}</td>
                    <td>{{ $rent->borrower_name }}</td>
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
    </table>



    <script>
        $(document).ready(function() {

            setInterval(runningTime, 1000);


        });

            function runningTime() {
                $.ajax({
                    url: 'http://gia-peminjaman-ruangan.test/date',
                    method: 'GET',
                    success: function(data) {
                        $('#runningTime').html(data);
                    },
                });
            }
    </script>
@endsection
