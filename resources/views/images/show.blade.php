@extends('layouts.frame')

@push('title', 'Részvevő: ' . $participant->first_name . ' ' . $participant->last_name)

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
                    </a> Participant: {{ $participant->getName() }}
                </div>
                <div class="panel-body">

                    <div class="row col-sm-6">

                        <h3>Information</h3>

                        <table class="table table-bordered">
                            <tr>
                                <th>First name</th>
                                <td>{{ $participant->first_name }}</td>
                            </tr>
                            <tr>
                                <th>Last name</th>
                                <td>{{ $participant->last_name }}</td>
                            </tr>
                            <tr>
                                <th>Email</th>
                                <td>{{ $participant->email }}</td>
                            </tr>
                            <tr>
                                <th>Birth</th>
                                <td>{{ $participant->birth }}</td>
                            </tr>
                            <tr>
                                <th>Company</th>
                                <td>{{ $participant->company }}</td>
                            </tr>
                            <tr>
                                <th>Work title</th>
                                <td>{{ $participant->work_title }}</td>
                            </tr>
                            <tr>
                                <th>Registration</th>
                                <td>{{ $participant->created_at }}</td>
                            </tr>
                            <tr>
                                <th>Updated at</th>
                                <td>{{ $participant->updated_at }}</td>
                            </tr>
                        </table>

                        <a href="./{{ $participant->id }}/edit" class="btn btn-warning">
                            Edit
                        </a>
                    </div>

                    <div class="row col-sm-12">

                        <h3>Images</h3>

                        @foreach($images as $image)

                            <div class="col-sm-6">
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