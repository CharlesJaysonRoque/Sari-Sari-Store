<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body {
            font-family: system-ui;
            margin: 0;
            background-color: AliceBlue;
        }

        .Hor {
            display: flex;
            min-height: 100vh;
        }

        .G1 {
            width: 240px;
            min-height: 100vh;
            background: linear-gradient(to right, #007300, #03a103, #00c400);
        }

        .Justify {
            display: flex;
            flex-direction: column;
            flex: 1;
        }

        .Ver {
            display: flex;
            flex: 1;
            justify-content: center;
        }

        .content {
            width: 90%;
            max-width: 1100px;
            padding: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background: white;
        }

        tr {
            border: 1px solid black;
        }

        td, th {
            padding: 14px 28px;
            text-align: left;
            white-space: nowrap;
        }

        td:nth-child(even), th:nth-child(even) {
            background-color: #deffde;
        }

        th {
            font-weight: 600;
        }

        .hide-scroll{
            max-height:52vh;
            overflow-y: auto;

            scrollbar-width:none;      /* Firefox */
            -ms-overflow-style:none;   /* IE/Edge */
        }

        .G1.G1.hide-scroll::-webkit-scrollbar{
            display:none;
        }

        ::-webkit-scrollbar {
        width: 20px;
        }

        ::-webkit-scrollbar-track {
        box-shadow: inset 0 0 5px #00000000;
        border-radius: 10px;
        }

        ::-webkit-scrollbar-thumb {
        background: #00000000;
        border-radius: 10px;
        }
    </style>
</head>
<body class="Hor">
    <div class="G1">
        @include('sidebar')
    </div>
    <div class="Justify">
        <div class="Ver">
            <div class="content">
                @yield('content')
            </div>
        </div>
        @include('footer')
    </div>
</body>
</html>
