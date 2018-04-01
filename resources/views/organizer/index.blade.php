@extends('layouts.frame')

@push('title', 'Organizers')

@push('style_before')
<link href="{{ url('/css/jquery.dataTables.min.css') }}" rel="stylesheet">
@endpush

@push('script_after')
<script src="{{ url('/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ url('/js/dataTables.bootstrap.min.js') }}"></script>
<script>
    $(document).ready(function () {
        $('#data-table').DataTable({
            "paging": false,
            "order": [[3, "desc"]],
        });
    });
</script>
@endpush

@section('content')
    <div class="container">
        <h1>Organizers</h1>
        <table class="table table-hover" id="data-table">
            <thead>
            <tr>
                <th>First name</th>
                <th>Last name</th>
                <th>Email</th>
                <th>Registration</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($organizers as $organizer)
                <tr>
                    <td>{{ $organizer->first_name }}</td>
                    <td>{{ $organizer->last_name }}</td>
                    <td>{{ $organizer->email }}</td>
                    <td>{{ $organizer->created_at }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

@endsection