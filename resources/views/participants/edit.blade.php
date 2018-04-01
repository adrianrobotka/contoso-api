@extends('layouts.frame')

@push('title', 'Résztvevő: ' . $participant->first_name . ' ' . $participant->last_name)

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <a href="./">
                            <span class="glyphicon glyphicon-menu-left" aria-hidden="true"></span>
                        </a> Résztvevő: {{ $participant->getName() }}
                    </div>
                    <div class="panel-body">
                        <form class="form-horizontal"
                              method="post"
                              action="{{ url('admin/participants') }}/{{ $participant->id }}"
                              role="form">
                            {{ csrf_field() }}
                            {{ method_field('PUT') }}

                            <div class="form-group">
                                <label for="first_name" class="col-md-4 control-label">Keresztnév</label>

                                <div class="col-md-6">
                                    <input id="first_name" class="form-control" name="first_name"
                                           value="{{ $participant->first_name }}" required>

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
                                           value="{{ $participant->last_name }}" required>

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
                                           value="{{ $participant->email }}" required>

                                    @if ($errors->has('email'))
                                        <p class="text-danger">
                                            {{ $errors->first('email') }}
                                        </p>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="birth" class="col-md-4 control-label">Születési idő</label>

                                <div class="col-md-6">
                                    <input id="birth" class="form-control" name="birth"
                                           value="{{ $participant->birth }}" required>

                                    @if ($errors->has('birth'))
                                        <p class="text-danger">
                                            {{ $errors->first('birth') }}
                                        </p>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="company" class="col-md-4 control-label">Szervezet</label>

                                <div class="col-md-6">
                                    <input id="company" class="form-control" name="company"
                                           value="{{ $participant->company }}" required>

                                    @if ($errors->has('company'))
                                        <p class="text-danger">
                                            {{ $errors->first('company') }}
                                        </p>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="work_title" class="col-md-4 control-label">Beosztás</label>

                                <div class="col-md-6">
                                    <input id="work_title" class="form-control" name="work_title"
                                           value="{{ $participant->work_title }}" required>

                                    @if ($errors->has('work_title'))
                                        <p class="text-danger">
                                            {{ $errors->first('work_title') }}
                                        </p>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-8 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        Mentés
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