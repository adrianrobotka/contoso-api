@extends('layouts.frame')

@push('title', 'User: ' . $organizer->name)

@push('script_after')

<script>
    $(function () {
        $('form').on('submit', function (e) {
            e.preventDefault();
            var data = $(this).serializeArray();

            $.ajax({
                url: "{{ route('organizer.update', $organizer->id) }}",
                method: 'PUT',
                data: data,
                success: function () {
                    console.log("update sent");
                    window.location.href = '{{ route('organizer.show', $organizer->id) }}';
                },
                error: function () {
                    alert("Cannot update");
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
                        <a href="{{ route('organizer.show', $organizer->id) }}">
                            <span class="glyphicon glyphicon-menu-left" aria-hidden="true"></span>
                        </a> User: {{ $organizer->name }}
                    </div>
                    <div class="panel-body">
                        <form class="form-horizontal" role="form">
                            {{ csrf_field() }}

                            <div class="form-group">
                                <label for="name" class="col-md-4 control-label">Username</label>

                                <div class="col-md-6">
                                    <input id="name" class="form-control" name="name"
                                           value="{{ $organizer->name }}" required autofocus>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="email" class="col-md-4 control-label">Email</label>

                                <div class="col-md-6">
                                    <input id="email" class="form-control" name="email"
                                           value="{{ $organizer->email }}" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-8 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        Update
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