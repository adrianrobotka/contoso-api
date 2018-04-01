@extends('layouts.frame')

@push('title', 'Szervező: ' . $organizer->first_name . ' ' . $organizer->last_name)

    @push('script_after')

        <script>
            $(document).ready(function () {

            });
        </script>
    @endpush

@section('content')
    <div class="container">
        <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <a href="{{ url('admin/organizers') }}">
                        <span class="glyphicon glyphicon-menu-left" aria-hidden="true"></span>
                    </a> Szervező: {{ $organizer->getName() }}
                </div>
                <div class="panel-body">

                    <div class="row col-sm-6">

                        <h3>Információ</h3>

                        <table class="table table-bordered">
                            <tr>
                                <th>Keresztév</th>
                                <td>{{ $organizer->first_name }}</td>
                            </tr>
                            <tr>
                                <th>Vezetéknév</th>
                                <td>{{ $organizer->last_name }}</td>
                            </tr>
                            <tr>
                                <th>Email</th>
                                <td>{{ $organizer->email }}</td>
                            </tr>
                            <tr>
                                <th>Regisztráció</th>
                                <td>{{ $organizer->created_at }}</td>
                            </tr>
                            <tr>
                                <th>Szerkesztve</th>
                                <td>{{ $organizer->updated_at }}</td>
                            </tr>
                        </table>

                        <a href="{{ url('admin/organizers') }}/{{ $organizer->id }}/password" class="btn btn-primary">
                            Jelszóváltoztatás
                        </a>

                        <a href="{{ url('admin/organizers') }}/{{ $organizer->id }}/edit" class="btn btn-warning">
                            Szerkesztés
                        </a>

                        <a href="{{ url('admin/organizers') }}/{{ $organizer->id }}/delete" class="btn btn-danger ">
                            Törlés
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection