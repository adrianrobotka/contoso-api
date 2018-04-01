@extends('layouts.frame')

@push('title', 'Szervezők')

    @push('style_before')
        <link href="{{ url('/css/jquery.dataTables.min.css') }}" rel="stylesheet">
    @endpush

    @push('script_after')
        <script src="{{ url('/js/dataTables.bootstrap.min.js') }}"></script>
        <script>
            $(document).ready(function () {
                DataTablesOptions["order"] = [3, "desc"];

                $('table').DataTable(DataTablesOptions);


                $(".clickable-row").click(function () {
                    window.location = $(this).data("href");
                });
            });
        </script>
    @endpush

@section('content')
    <div class="container">
        <h1>Szervezők</h1>
        <a href="./organizers/create" class="btn btn-primary" style="margin-bottom: 20px">
            Létrehozás
        </a>
        <table class="table table-hover" id="data-table">
            <thead>
            <tr>
                <th>Keresztnév</th>
                <th>Vezetéknév</th>
                <th>Email</th>
                <th>Regisztráció</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($organizers as $organizer)
                <tr class='clickable-row' data-href='{{ route('organizers.show', $organizer->id) }}'
                    style="cursor: pointer">
                    <td>{{ $organizer->first_name }}</td>
                    <td>{{ $organizer->last_name }}</td>
                    <td>{{ $organizer->email }}</td>
                    <td>{{ $organizer->created_at }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

@endsection