@extends('template.main')

@section('container')
    <div class="header-wrapper pb-3 mb-4 d-flex justify-content-between">
        <h1 class="align-self-center">On Going Schedules</h1>
        <h2>
            <div>{{ date("l, d-m-Y") }}</div>
            <div id="runningTime" class="text-center fw-bolder" ></div>
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
                @php
                    $from_date_second = strtotime($rent->from_date);
                    $until_date_second = strtotime($rent->until_date);
                    $from_date = date('d-m-Y H:i', $from_date_second);
                    $until_date = date('d-m-Y H:i', $until_date_second);

                    $date_now = strtotime(date('d-m-Y H:i:s'));

                @endphp
                <tr @if($from_date_second <= $date_now && $date_now < $until_date_second) style="background-color: #d1e7dd" @endif>
                    <td>{{ $no++ }}</td>
                    <td>{{ $rent->room->name }}</td>
                    <td>{{ $rent->division->name }}</td>
                    <td>{{ $rent->borrower_name }}</td>
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
