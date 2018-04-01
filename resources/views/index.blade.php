@extends('layouts.frame')

@push('title', 'Kezdőlap')

@section('content')
    <div class="container">
        <div class="row col-md-12">

            <div class="index-box">
                <h1>Contoso festival 2018</h1>

                <h2>Mi ez?</h2>

                <p>Pályamunkák egy arcfelismerésen alapúló beléptető rendszer megvalósítását
                    tárgyalja.</p>
                <p>
                    Elsődleges célunk, hogy bizonyos rendezvények (pl. szakmai
                    konferenciák) vendégeinek beléptetését egyszerűbbé és gyorsabbá tegyük, jelen esetben
                    a Contoso Festivalét.
                    A beléptetés előfeltétele a regisztráció, amit egy mobil alkalmazás biztosít.
                    Új résztvevőt így csak az applikáción keresztül regisztrálva fogadunk el, azonban a meglévő
                    résztvevők adatainak szerkesztésére és törlésére lehetőség van.
                </p>

                <p>Az Admin webfelületen a csoportok, szervezők és regisztráltak adminisztrációja történik,
                    illetve valós idejű információszerzés a helyszínről. Az adminisztrációs felületen
                    értesítést kaphat minden belépési kísérletről illetve azok sikerességéről. Ezek az
                    adatok szűrhetőek, megkönnyítve az adminisztrációt.</p>
                <p>
                    A belépés a jobb felső sarokban található "Admin" gomb megnyomása után történik.</p>
            </div>

        </div>
    </div>
@endsection