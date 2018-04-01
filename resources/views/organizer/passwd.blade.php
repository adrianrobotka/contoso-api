@extends('layouts.frame')

@push('title', 'Szervező: ' . $organizer->first_name . ' ' . $organizer->last_name)

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <a href="./">
                            <span class="glyphicon glyphicon-menu-left" aria-hidden="true"></span>
                        </a> Szervező: {{ $organizer->getName() }}
                    </div>
                    <div class="panel-body">
                        <form class="form-horizontal"
                              method="post"
                              action="{{ url('admin/organizers') }}/{{ $organizer->id }}/password"
                              role="form">

                            {{ csrf_field() }}
                            {{ method_field('PUT') }}

                            <div class="form-group">
                                <label for="new_pwd" class="col-md-4 control-label">Új jelszó</label>

                                <div class="col-md-6">
                                    <input id="new_pwd" type="password" class="form-control" name="new_pwd" required>
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