@extends('layouts.frame')

@push('title', 'Monitor')

    @push('script_after')
        <script src="{{ url('/js/pusher.min.js') }}"></script>
        <script>
            // TODO Enable pusher logging - don't include this in production
            Pusher.logToConsole = true;

            let pusher = new Pusher("{{ env('PUSHER_APP_KEY') }}", {
                cluster: 'eu',
                encrypted: true
            });
        </script>
        <script src="{{ url('/js/dashboard.js') }}"></script>
    @endpush

@section('content')
    <div class="container">
        <div class="event-boxes">

            {{-------- generated ---------}}

        </div>

        <div class="event-boxes-samples">

            {{------------------------------- VALID identity ---------------------------------}}

            <div class="event-box row sample valid-identity">
                <div class="col-sm-3">
                    <span class="type-text">Sikeres azonosítás</span><br/>
                    <span class="group-row">Név: <span class="name">?</span></span><br/>
                    <span class="group-row">Csoport: <span class="group">?</span></span><br/>
                    <span class="gate-row">Kapu: <span class="gate">?</span></span>
                </div>

                <div class="col-sm-6 images">
                    <img class="image1" src=""/>

                    <img class="image2" src=""/>

                    <img class="image3" src=""/>
                </div>

                <div class="col-sm-1 confidence-row">
                    <span><span class="confidence">?</span> %</span>
                </div>
                <div class="col-sm-2 date-row">
                    <span><span class="date">?</span></span>
                </div>
            </div>

            {{------------------------------- selected but VALID identity ---------------------------------}}

            <div class="event-box row sample selected-identity">
                <div class="col-sm-3">
                    <span class="type-text">Kiválasztott azonosítás</span><br/>
                    <span class="group-row">Név: <span class="name">?</span></span><br/>
                    <span class="group-row">Csoport: <span class="group">?</span></span><br/>
                    <span class="gate-row">Kapu: <span class="gate">?</span></span>
                </div>

                <div class="col-sm-6 images">
                    <img class="image1" src=""/>

                    <img class="image2" src=""/>

                    <img class="image3" src=""/>
                </div>

                <div class="col-sm-1 confidence-row">
                    <span><span class="confidence">?</span> %</span>
                </div>
                <div class="col-sm-2 date-row">
                    <span><span class="date">?</span></span>
                </div>
            </div>

            {{------------------------------- NO identity ---------------------------------}}

            <div class="event-box row sample no-identity">
                <div class="col-sm-3">
                    <span class="type-text">Sikertelen azonosítás</span><br/>
                    <span class="gate-row">Kapu: <span class="gate">?</span></span>
                </div>

                <div class="col-sm-1">
                </div>

                <div class="col-sm-6">

                </div>
                <div class="col-sm-2 date-row">
                    <span><span class="date">?</span></span>
                </div>
            </div>

            {{------------------------------- indefinite identity ---------------------------------}}

            <div class="event-box row sample indefinite-identity">
                <span class="type-text">Kétséges azonosítás</span><br/>

                <span class="gate-row">Kapu: <span class="gate">?</span></span>
                <div class="date-row">
                    <span class="date">?</span>
                </div>

                <div class="indefinites"></div>
            </div>

            <div class="row col-xs-12 sample indefinite-participant">
                <div class="col-sm-3">
                    <span class="group-row">Név: <span class="name">?</span></span><br/>
                    <span class="group-row">Csoport: <span class="group">?</span></span><br/>
                </div>

                <div class="col-sm-6 images">
                    <img class="image1" src=""/>

                    <img class="image2" src=""/>

                    <img class="image3" src=""/>
                </div>

                <div class="col-sm-1 confidence-row">
                    <span><span class="confidence">?</span> %</span>
                </div>
            </div>

        </div>

    </div>
@endsection