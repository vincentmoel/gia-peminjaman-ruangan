@extends('template.main_no_header_footer')

@section('container')



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



    <div class="card text-center py-4 make-middle" style="width: 20rem; max-height: 350px !important" >
        <a href="/">
            <img src="/assets/img/logo.svg" alt="" width="100px" class="mx-auto mb-3">
        </a>
        <div class="card-body">
            <form>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Username</label>
                    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                </div>
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Password</label>
                    <input type="password" class="form-control" id="exampleInputPassword1">
                </div>
                
                <button type="submit" class="btn btn-success w-100">Login</button>
            </form>

        </div>
    </div>

    <style>
        .make-middle {
            
            position: absolute;
            top: 0;
            bottom: 0;
            left: 0;
            right: 0;

            margin: auto;
        }

    </style>


    <script>

    </script>
@endsection
