<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Server error</title>

    <link rel="icon" href="{{ url('/favicon.png') }}"/>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">

    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style>
        html, body {
            width: 100%;
            height: 100%;
        }

        #outer {
            display: table;
            height: 100%;
            width: 100%;
        }

        #inner {
            display: table-cell;
            vertical-align: middle;
            text-align: center;
        }

    </style>
</head>
<body>

<div id="outer">
    <div id="inner">
        <h1>Internal error</h1>
        <p>Repairing in progress...</p>
        <p><a href="{{ url("/") }}"><span class="glyphicon glyphicon-left" aria-hidden="true"></span> Vissza</a></p>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
</body>
</html>