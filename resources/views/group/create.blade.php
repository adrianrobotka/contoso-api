@extends('layouts.frame')

@push('title', 'Új csoport')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <a href="./">
                            <span class="glyphicon glyphicon-menu-left" aria-hidden="true"></span>
                        </a> Új csoport
                    </div>
                    <div class="panel-body">
                        <form class="form-horizontal" role="form" action="{{route('groups.store')}}" method="post">
                            {{ csrf_field() }}

                            <div class="form-group">
                                <label for="name" class="col-md-4 control-label">Név</label>

                                <div class="col-md-6">
                                    <input id="name" class="form-control" name="name"
                                            required>

                                    @if ($errors->has('name'))
                                        <p class="text-danger">
                                            {{ $errors->first('name') }}
                                        </p>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="description" class="col-md-4 control-label">Leírás</label>

                                <div class="col-md-6">
                                    <input id="description" class="form-control" name="description"
                                            required>

                                    @if ($errors->has('description'))
                                        <p class="text-danger">
                                            {{ $errors->first('description') }}
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