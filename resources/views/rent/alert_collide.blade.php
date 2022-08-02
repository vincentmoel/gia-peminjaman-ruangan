<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <div>
        <div class="mb-2">Collide with</div>
        <div>
            <div class="row">
                @foreach ($datas as $data)
                    @php
                        $from_date = date('d-m-Y H:i', strtotime($data->from_date));
                        $until_date = date('d-m-Y H:i', strtotime($data->until_date));
                    @endphp
                    <li>
                        {{ $data->division->name }} | <strong>{{ $from_date }} to {{ $until_date }}</strong>
                    </li>
                @endforeach
            </div>
        </div>
    </div>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>