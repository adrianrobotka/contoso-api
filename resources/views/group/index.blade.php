@extends('layouts.frame')

@push('title', 'Csoportok')

    @push('style_before')
        <link href="{{ url('/css/jquery.dataTables.min.css') }}" rel="stylesheet">
    @endpush

    @push('script_after')
        <script src="{{ url('/js/jquery.dataTables.min.js') }}"></script>
        <script src="{{ url('/js/dataTables.bootstrap.min.js') }}"></script>
        <script>
            $(document).ready(function () {
                var dataTableApi;
                DataTablesOptions["order"] = [0, "desc"];
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
        <h1>Csoportok</h1>
        <a href="./groups/create" class="btn btn-primary" style="margin-bottom: 20px">
            Létrehozás
        </a>
        <table class="table table-hover" id="data-table">
            <thead>
            <tr>
                <th>Név</th>
                <th>Leírás</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($groups as $group)
                <tr class='clickable-row' data-href='{{ route('groups.show', $group->id) }}'
                style="cursor: pointer">
                    <td>{{ $group->getName() }}</td>
                    <td>{{ $group->description }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

@endsection