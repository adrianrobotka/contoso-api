@extends('layouts.frame')

@push('title', 'Napló')

    @push('style_before')
        <link href="{{ url('/css/jquery.dataTables.min.css') }}" rel="stylesheet">
    @endpush

    @push('script_after')
        <script src="{{ url('/js/dataTables.bootstrap.min.js') }}"></script>
        <script>
            $(document).ready(function () {
                DataTablesOptions["order"] = [5, "desc"];

                $('table').DataTable(DataTablesOptions);


                $(".clickable-row").click(function () {
                    window.location = $(this).data("href");
                });
            });
        </script>
    @endpush

@section('content')
    <div class="container">
        <h1>Beléptetési napló</h1>

        <table class="table table-hover" id="data-table">
            <thead>
            <tr>
                <th>Esemény</th>
                <th>Résztvevő</th>
                <th>%</th>
                <th>Kapu</th>
                <th>Leírás</th>
                <th>Dátum</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($logs as $log)
                <tr>
                    <td>{{ $log->eventName() }}</td>
                    <td>{!! $log->participant_id == null ? 'nem egyértelmű': $log->niceParticipant() !!}</td>
                    <td>{{ $log->confidence == null ? '-': ($log->confidence * 100).' %' }}</td>
                    <td>{{ $log->gate == null ? 'ismeretlen': $log->gate }}</td>
                    <td>{!! $log->comment == null ? '-': $log->niceComment() !!}</td>
                    <td>{{ $log->created_at }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

@endsection