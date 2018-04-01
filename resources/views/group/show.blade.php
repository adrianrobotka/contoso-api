@extends('layouts.frame')

@push('title', 'Csoport: ' . $group->name)

    @push('style_before')
        <link href="{{ url('/css/jquery.dataTables.min.css') }}" rel="stylesheet">
    @endpush

    @push('script_after')
        <script src="{{ url('/js/dataTables.bootstrap.min.js') }}"></script>
        <script>
            $(document).ready(function () {
                //DataTablesOptions["order"] = [1, "desc"];

                $('#data-table').DataTable(DataTablesOptions);
            });
        </script>
    @endpush

@section('content')
    <div class="container black">
        <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <a href="{{ url('admin/groups') }}">
                        <span class="glyphicon glyphicon-menu-left" aria-hidden="true"></span>
                    </a> Csoport: {{ $group->getName() }}
                </div>
                <div class="panel-body">

                    <div class="row col-sm-6">

                        <h3>Információ</h3>

                        <table class="table table-bordered">
                            <tr>
                                <th>Keresztév</th>
                                <td>{{ $group->getName() }}</td>
                            </tr>
                            <tr>
                                <th>Leírás</th>
                                <td>{{ $group->description }}</td>
                            </tr>
                        </table>

                        <a href="{{ route('groups.edit', $group->id) }}" class="btn btn-warning">
                            Szerkesztés
                        </a>

                        <a href="{{ route('groups.destroy', $group->id) }}/delete" class="btn btn-danger ">
                            Törlés</a>
                    </div>
                    <div class="row col-sm-8">

                        <h3>Résztvevők</h3>

                        <table class="table table-hover black" id="data-table">
                            <thead>
                            <tr>
                                <th>Keresztnév</th>
                                <th>Vezetéknév</th>
                                <th>Szervezet</th>
                                <th>Beosztás</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($participants as $participant)
                                <tr>
                                    <td>{{ $participant->first_name }}</td>
                                    <td>{{ $participant->last_name }}</td>
                                    <td>{{ $participant->company }}</td>
                                    <td>{{ $participant->work_title }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection