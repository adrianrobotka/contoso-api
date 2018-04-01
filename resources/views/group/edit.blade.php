@extends('layouts.frame')

@push('title', 'Csoport: ' . $group->getName())
    @push('style_before')
        <link href="{{ url('/css/jquery.dataTables.min.css') }}" rel="stylesheet">
    @endpush

    @push('script_after')
        <script src="{{ url('/js/dataTables.bootstrap.min.js') }}"></script>
        <script>
            $(function () {
                var dataTableApi;
                DataTablesOptions["initComplete"] = function () {
                    dataTableApi = this.api();
                };

                $('table').DataTable(DataTablesOptions);

            });
        </script>
    @endpush

@section('content')
    <div class="container black">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <a href="./">
                            <span class="glyphicon glyphicon-menu-left" aria-hidden="true"></span>
                        </a> Csoport: {{ $group->getName() }}
                    </div>
                    <div class="panel-body">
                        <form class="form-horizontal"
                              method="post"
                              action="{{ url('admin/groups') }}/{{ $group->id }}"
                              role="form">
                            {{ csrf_field() }}
                            {{ method_field('PUT') }}

                            <div class="form-group">
                                <label for="name" class="col-md-4 control-label">Név</label>

                                <div class="col-md-6">
                                    <input id="name" class="form-control" name="name"
                                           value="{{ $group->name }}" required>

                                    @if ($errors->has('name'))
                                        <p class="text-danger">
                                            {{ $errors->first('name') }}
                                        </p>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group" style="margin-bottom: 60px">
                                <label for="description" class="col-md-4 control-label">Leírás</label>

                                <div class="col-md-6">
                                    <input id="description" class="form-control" name="description"
                                           value="{{ $group->description }}" required>

                                    @if ($errors->has('description'))
                                        <p class="text-danger">
                                            {{ $errors->first('description') }}
                                        </p>
                                    @endif
                                </div>
                            </div>

                            @if($group->id != 1)
                                <table class="table table-hover black">
                                    <thead>
                                    <tr>
                                        <th></th>
                                        <th>Keresztnév</th>
                                        <th>Vezetéknév</th>
                                        <th>Szervezet</th>
                                        <th>Beosztás</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($participants as $participant)
                                        <tr>
                                            <td>
                                                <input type="checkbox" name="participants[]"
                                                       value="{{ $participant->id }}"
                                                        {{ $participant->group_id == $group->id ? 'checked' : '' }} />
                                            </td>
                                            <td>{{ $participant->first_name }}</td>
                                            <td>{{ $participant->last_name }}</td>
                                            <td>{{ $participant->company }}</td>
                                            <td>{{ $participant->work_title }}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            @endif

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