@extends('template.main')

@section('container')
    <script type="text/javascript" src="/assets/vendor/daterangepicker/moment.min.js"></script>
    <script type="text/javascript" src="/assets/vendor/daterangepicker/daterangepicker.min.js"></script>
    <link rel="stylesheet" href="/assets/vendor/daterangepicker/daterangepicker.css">


    <div class="header-wrapper pb-3 mb-4">
        <h1>Rents</h1>
    </div>


    @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if (session()->has('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <div>
                <div class="mb-2">{{ session('error') }} with</div>
                <div>
                    <div class="row">
                        @foreach (session('data') as $data)
                            @php
                                $from_date = date('d-m-Y H:i', strtotime($data->from_date));
                                $until_date = date('d-m-Y H:i', strtotime($data->until_date));
                            @endphp
                            <li>{{ $data->division->name }} | {{ $data->borrower_name }} | {{ $data->description }} |
                                <strong>{{ $from_date }} to {{ $until_date }}</strong>
                            </li>
                        @endforeach
                    </div>
                </div>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif





    <div class="mb-4">
        <button type="button" class="btn btn-add" data-bs-toggle="modal" data-bs-target="#addDataModal">
            <i class="bi bi-plus-circle"></i> Add Rent
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
                        $from_date = date('d-m-Y H:i', strtotime($rent->from_date));
                        $until_date = date('d-m-Y H:i', strtotime($rent->until_date));
                    @endphp
                    <td>{{ $from_date }}</td>
                    <td>{{ $until_date }}</td>
                    <td>{{ $rent->description }}</td>
                    <td class="text-center text-xxl-start">
                        <a href="/rents/{{ $rent->id }}/edit" class="btn btn-primary mb-1 mb-xxl-0"><i
                                class="bi bi-pencil-square"></i></a>
                        <form action="/rents/{{ $rent->id }}" method="POST" class="d-inline" id="form-delete">
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
                <th>Room</th>
                <th>Division</th>
                <th>Borrower Name</th>
                <th>Phone</th>
                <th>From Date</th>
                <th>Until Date</th>
                <th>Description</th>
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
                    <h5 class="modal-title" id="addDataModalLabel">Add Rent</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <form action="/rents" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="room_id" class="form-label">Room</label>
                            <select class="form-select @error('room_id') is-invalid @enderror" id="room_id"
                                aria-label="Default select example" name="room_id">
                                <option value="" selected disabled>Choose One</option>
                                @foreach ($rooms as $room)
                                    @if (old('room_id') == $room->id)
                                        <option value="{{ $room->id }}" selected>{{ $room->name }}</option>
                                    @else
                                        <option value="{{ $room->id }}">{{ $room->name }}</option>
                                    @endif
                                @endforeach
                            </select>
                            @error('room_id')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="borrower_name" class="form-label">Borrower Name</label>
                            <input type="text" name="borrower_name"
                                class="form-control @error('borrower_name') is-invalid @enderror" id="borrower_name"
                                value="{{ old('borrower_name') }}">
                            @error('borrower_name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="phone" class="form-label">Phone</label>
                            <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror"
                                id="phone" value="{{ old('phone') }}">
                            @error('phone')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="division_id" class="form-label">Division</label>
                            <select class="form-select @error('division_id') is-invalid @enderror" id="division_id"
                                aria-label="Default select example" name="division_id">
                                <option value="" selected disabled>Choose Borrower Division</option>
                                @foreach ($divisions as $division)
                                    @if (old('division_id') == $division->id)
                                        <option value="{{ $division->id }}" selected>{{ $division->name }}</option>
                                    @else
                                        <option value="{{ $division->id }}">{{ $division->name }}</option>
                                    @endif
                                @endforeach
                            </select>
                            @error('division_id')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <input type="text" name="description"
                                class="form-control @error('description') is-invalid @enderror" id="description"
                                value="{{ old('description') }}">
                            @error('description')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="from_date" class="form-label">From Date</label>
                            <input type="text" name="from_date" value="{{ old('from_date') }}"
                                class="form-control @error('from_date') is-invalid @enderror" id="from_date"
                                value="{{ old('from_date') }}">

                            @error('from_date')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="until_date" class="form-label">Until Date</label>
                            <input type="text" name="until_date"
                                class="form-control @error('until_date') is-invalid @enderror" id="until_date"
                                value="{{ old('until_date') }}">

                            @error('until_date')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div>
                            <button type="button" id="check-availability" class="btn btn-primary">Check
                                Availability</button>
                            <span class="ms-2 d-none" id="availability-message"><i class="bi bi-check-circle-fill"
                                    style="color: green"></i> Room is
                                Available!</span>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-end text-center">
                        <button type="reset" class="btn btn-secondary">Clear Form</button>
                        <button type="submit" class="btn btn-success" disabled id="submit-rent">Submit</button>
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

        $('#from_date,#until_date').daterangepicker({
            "singleDatePicker": true,
            "timePicker": true,
            "timePicker24Hour": true,
            "autoApply": true,
            "locale": {
                "direction": "ltr",
                "format": "MM/DD/YYYY HH:mm",
                "separator": " - ",
                "applyLabel": "Apply",
                "cancelLabel": "Cancel",
                "fromLabel": "From",
                "toLabel": "To",
                "customRangeLabel": "Custom",
                "daysOfWeek": [
                    "Su",
                    "Mo",
                    "Tu",
                    "We",
                    "Th",
                    "Fr",
                    "Sa"
                ],
                "monthNames": [
                    "January",
                    "February",
                    "March",
                    "April",
                    "May",
                    "June",
                    "July",
                    "August",
                    "September",
                    "October",
                    "November",
                    "December"
                ],
                "firstDay": 1
            },
            "linkedCalendars": false,
            "startDate": "{{ date('m/d/Y H:i') }}",
            "drops": "up"
        }, function(start, end, label) {
            console.log(
                "New date range selected: ' + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD') + ' (predefined range: ' + label + ')"
            );
        });

        $("#check-availability").click(function(e) {
            e.preventDefault();
            $.ajax({
                type: "POST",
                url: "/rents/check-availability",
                data: {
                    _token: "{{ csrf_token() }}",
                    from_date: $("input[name=from_date]").val(),
                    until_date: $("input[name=until_date]").val(),
                    room_id: $("select[name=room_id] option:selected").val()
                },
                beforeSend: function() {
                    $('.invalid-feedback').remove();
                    $('input').removeClass('is-invalid');
                    $('select').removeClass('is-invalid');
                    $('#submit-rent').prop("disabled", true);
                    $('#availability-message').addClass("d-none");
                    

                },
                success: function(jqXHR) {
                    if(jqXHR.code == 200)
                    {
                        $('#submit-rent').prop("disabled", false);
                        $('#availability-message').removeClass("d-none");
                    }
                    else if(jqXHR.code == 422)
                    {
                        console.log('asd');
                    }
                },
                error: function(jqXHR) {
                    if (jqXHR.status == 422) {
                        var errors = jqXHR.responseJSON.errors;
                        for (error in errors) {
                            $("#" + error).addClass('is-invalid');
                            $("#" + error).after(
                                '<div class="invalid-feedback">' + errors[error] + '</div>'
                            );
                        }

                    }
                }
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
