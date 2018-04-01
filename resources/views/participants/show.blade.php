@extends('layouts.frame')

@push('title', 'Participant: ' . $participant->first_name . ' ' . $participant->last_name)

@push('script_after')

<script>
    $(document).ready(function () {
        $('#remove-participant').click(function () {
            if (!window.confirm("Are you sure, you want to delete this participant?")) {
                return;
            }

            $.ajax({
                url: '{{ route('participant.index') }}/' + $(this).data('id'),
                type: 'DELETE',
                success: function (result) {
                    window.location.href = '{{ route('participant.index') }}';
                }
            });
        });

        $('.remove-permission').click(function () {
            if (!window.confirm("Are you sure, you want to remove this permission?")) {
                return;
            }

            var id = $(this).data('id');
            $.ajax({
                url: '{{ route('permission.index') }}/' + id,
                type: 'DELETE',
                success: function (result) {
                    window.location.href = '{{ route('participant.show', $participant->id) }}';
                }
            });
        });
    });
</script>
@endpush

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <a href="{{ route('participant.index') }}">
                            <span class="glyphicon glyphicon-menu-left" aria-hidden="true"></span>
                        </a> Participant: {{ $participant->name }}
                    </div>
                    <div class="panel-body">

                        <div class="col-sm-6">

                            <h3>Information</h3>

                            <table class="table table-bordered">
                                <tr>
                                    <th>Name</th>
                                    <td>{{ $participant->name }}</td>
                                </tr>
                                <tr>
                                    <th>Email</th>
                                    <td>{{ $participant->email }}</td>
                                </tr>
                                <tr>
                                    <th>Registration</th>
                                    <td>{{ $participant->created_at }}</td>
                                </tr>
                            </table>
                        </div>

                        <div class="col-sm-9">
                            <h3>Permissions</h3>

                            @php($permissionRelations = $participant->permissionRelations()->get())

                            @if(sizeof($permissionRelations) == 0)
                                <p>Participant has no permissions.</p>
                            @else
                                <table class="table table-hover">
                                    <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Description</th>
                                        <th>Date</th>
                                        @can('delete', \App\PermissionRelation::class)
                                            <th>Delete</th>
                                        @endcan
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($permissionRelations as $permissionRelation)
                                        @php($permission = $permissionRelation->permission()->first())

                                        <tr>
                                            <td>{{ $permission->name }}</td>
                                            <td>{{ $permission->description }}</td>
                                            <td>{{ $permissionRelation->created_at }}</td>
                                            @can('create', \App\PermissionRelation::class)
                                                <th>
                                                    <a href="#" class="remove-permission"
                                                       data-id="{{ $permissionRelation->id }}"
                                                       style="color: red;">
                                                        <span class="glyphicon glyphicon-remove"
                                                              aria-hidden="true"></span> Delete
                                                    </a>
                                                </th>
                                            @endcan
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            @endif

                            @can('create', \App\PermissionRelation::class)
                                <form class="form-inline" role="form" method="POST"
                                      action="{{ route('permission.store') }}">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="participant-id" value="{{ $participant->id }}">
                                    <select class="form-control input-sm" name="permission-id" required>
                                        @foreach ($permissions as $permission)
                                            <option value="{{ $permission->id }}">{{ $permission->name }}
                                                ({{ $permission->description }})
                                            </option>
                                        @endforeach
                                    </select>

                                    <div class="form-group">
                                        <button type="submit" class="btn btn-success btn-sm">
                                            Add
                                        </button>
                                    </div>
                                </form>
                            @endcan

                        </div>

                        @can('view', \App\ParticipantInventoryItem::class)
                            <div class="col-sm-12">
                                <h3 id="inventory">Inventory</h3>
                                @if(sizeof($items) == 0)
                                    <p>Participant has no inventory items.</p>
                                @else
                                    @can('superDelete', \App\ParticipantInventoryItem::class)
                                        <p>* If you remove an item, it won't be refunded.</p>
                                    @endcan

                                    <table class="table table-hover">
                                        <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Description</th>
                                            @can('superDelete', \App\ParticipantInventoryItem::class)
                                                <td>Delete</td>
                                            @endcan
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach ($items as $item)
                                            <tr>
                                                <td>{{ $item->name }}</td>
                                                <td>{{ $item->description }}</td>
                                                @can('superDelete', \App\ParticipantInventoryItem::class)
                                                    <td>
                                                        <a href="#" class="remove-item" data-id="{{ $item->id }}"
                                                           style="color: red;">
                                                        <span class="glyphicon glyphicon-remove"
                                                              aria-hidden="true"></span>
                                                        </a>
                                                    </td>
                                                @endcan
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                @endif
                            </div>
                        @endcan

                        @can('update', $participant)
                            <div class="row col-sm-12">
                                <hr>
                            </div>

                            <div class="row col-sm-12">
                                <a class="btn btn-primary btn-xs"
                                   href="{{ route('participant.edit', $participant->id) }}">
                                    <span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
                                    Edit
                                </a>

                                @can('delete', $participant)
                                    <div style="float:right;">
                                        <button class="btn btn-danger btn-xs" id="remove-participant"
                                                data-id="{{ $participant->id }}">
                                            <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                                            Delete
                                        </button>
                                    </div>
                                @endcan
                            </div>
                        @endcan
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection