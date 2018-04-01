@extends('layouts.frame')

@push('title', 'Résztvevők')

@push('style_before')
<link href="{{ url('/css/jquery.dataTables.min.css') }}" rel="stylesheet">
@endpush

@push('script_after')
<script src="{{ url('/js/dataTables.bootstrap.min.js') }}"></script>
<script>
    $(document).ready(function () {
        var dataTableApi;
        DataTablesOptions["order"] = [7, "desc"];
        DataTablesOptions["initComplete"] = function () {
            dataTableApi = this.api();
        };

        $('table').DataTable(DataTablesOptions);


        $(".clickable-row").click(function () {
            window.location = $(this).data("href");
        });
    });
</script>
@endpush

@section('content')
    <div class="container">
        <div class="row col-md-12">
            <h1>Résztvevők</h1>

            <table class="table table-hover" id="data-table">
                <thead>
                <tr>
                    <th>Keresztnév</th>
                    <th>Vezetéknév</th>
                    <th>Email</th>
                    <th>Születési idő</th>
                    <th>Szervezet</th>
                    <th>Beosztás</th>
                    <th>Képek</th>
                    <th>Csoport</th>
                    <th>Regisztráció</th>
                </tr>
                </thead>
                <tbody>
                @foreach($participants as $participant)
                    <tr class='clickable-row' data-href='{{ route('participants.show', $participant->id) }}'
                        style="cursor: pointer">
                        <td>{{ $participant->first_name }}</td>
                        <td>{{ $participant->last_name }}</td>
                        <td>{{ $participant->email }}</td>
                        <td>{{ $participant->birth }}</td>
                        <td>{{ $participant->company }}</td>
                        <td>{{ $participant->work_title }}</td>
                        <td>{{ $participant->images()->count() }}</td>
                        <td>{{ $participant->group_name }}</td>
                        <td>{{ $participant->created_at }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>

        </div>
    </div>

@endsection