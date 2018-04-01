@extends('layouts.frame')

@push('title', 'Résztvevő: ' . $participant->first_name . ' ' . $participant->last_name)

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
                    <a href="{{ url('admin/participants') }}">
                        <span class="glyphicon glyphicon-menu-left" aria-hidden="true"></span>
                    </a> Résztvevő: {{ $participant->getName() }}
                </div>
                <div class="panel-body">

                    <div class="row col-sm-6">

                        <h3>Információ</h3>

                        <table class="table table-bordered">
                            <tr>
                                <th>Keresztév</th>
                                <td>{{ $participant->first_name }}</td>
                            </tr>
                            <tr>
                                <th>Vezetéknév</th>
                                <td>{{ $participant->last_name }}</td>
                            </tr>
                            <tr>
                                <th>Email</th>
                                <td>{{ $participant->email }}</td>
                            </tr>
                            <tr>
                                <th>Születési idő</th>
                                <td>{{ $participant->birth }}</td>
                            </tr>
                            <tr>
                                <th>Szervezet</th>
                                <td>{{ $participant->company }}</td>
                            </tr>
                            <tr>
                                <th>Beosztás</th>
                                <td>{{ $participant->work_title }}</td>
                            </tr>
                            <tr>
                                <th>Regisztráció</th>
                                <td>{{ $participant->created_at }}</td>
                            </tr>
                            <tr>
                                <th>Szerkesztve</th>
                                <td>{{ $participant->updated_at }}</td>
                            </tr>
                        </table>

                        <a href="{{ url('admin/participants') }}/{{ $participant->id }}/edit" class="btn btn-warning">
                            Szerkesztés
                        </a>

                        <a href="{{ url('admin/participants') }}/{{ $participant->id }}/delete" class="btn btn-danger">
                            Törlés
                        </a>
                    </div>

                    <div class="row col-sm-12">

                        <h3>Képek</h3>

                        @foreach($images as $image)

                            <div class="col-sm-4">
                                <div class="image-in-box">
                                    <img src="{{ $image }}"/>
                                </div>
                            </div>

                        @endforeach

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection