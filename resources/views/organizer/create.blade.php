@extends('layouts.frame')

@push('title', 'Új szervező')


@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <a href="./">
                            <span class="glyphicon glyphicon-menu-left" aria-hidden="true"></span>
                        </a> Új szervező
                    </div>
                    <div class="panel-body">
                        <form class="form-horizontal" role="form" action="{{route('organizers.store')}}" method="post">
                            {{ csrf_field() }}

                            <div class="form-group">
                                <label for="first_name" class="col-md-4 control-label">Keresztnév</label>

                                <div class="col-md-6">
                                    <input id="first_name" class="form-control" name="first_name"
                                           required>

                                    @if ($errors->has('first_name'))
                                        <p class="text-danger">
                                            {{ $errors->first('first_name') }}
                                        </p>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="last_name" class="col-md-4 control-label">Vezetéknév</label>

                                <div class="col-md-6">
                                    <input id="last_name" class="form-control" name="last_name"
                                           required>

                                    @if ($errors->has('last_name'))
                                        <p class="text-danger">
                                            {{ $errors->first('last_name') }}
                                        </p>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="email" class="col-md-4 control-label">Email</label>

                                <div class="col-md-6">
                                    <input id="email" class="form-control" name="email"
                                           required>

                                    @if ($errors->has('email'))
                                        <p class="text-danger">
                                            {{ $errors->first('email') }}
                                        </p>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="passwd" class="col-md-4 control-label">Jelszó</label>

                                <div class="col-md-6">
                                    <input type="password" id="passwd" class="form-control" name="passwd"
                                           required>

                                    @if ($errors->has('passwd'))
                                        <p class="text-danger">
                                            {{ $errors->first('passwd') }}
                                        </p>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-8 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        Létrehozás
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection