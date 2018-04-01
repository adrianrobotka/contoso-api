@extends('layouts.frame')

@push('title', 'Résztvevők képei')


@section('content')
    <div class="container">
        <div class="row col-md-12">
            <h1>Résztvevők képei</h1>

            @foreach($participants as $participant)

                <div class="row person-row">
                    <div class="name">
                        <a href="{{ route('participants.show', $participant['id']) }}">{{ $participant['name'] }}</a>
                    </div>

                    @foreach($participant['images'] as $image)

                        <div class="col-sm-4">
                            <div class="image-in-box">
                                <img src="{{ $image }}"/>
                            </div>
                        </div>

                    @endforeach
                </div>

            @endforeach

        </div>
    </div>

@endsection