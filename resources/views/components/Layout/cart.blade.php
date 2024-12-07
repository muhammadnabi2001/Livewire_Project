<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    @livewireStyles
</head>

<body>
    <!-- MDBootstrap CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.4.0/mdb.min.css" rel="stylesheet">
    <!-- Font Awesome Icons (agar ishlatilgan bo'lsa) -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="/path-to-your-local-folder/mdb.min.css" rel="stylesheet">

    <div class="container">
        <div class="row">
            <div class="col-12">
                
                
                
                {{$slot}}
                <!-- MDBootstrap JS -->
                @livewireScripts
            </div>

        </div>
    </div>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.4.0/mdb.min.js"></script>
    <!-- Font Awesome (agar kerak bo'lsa) -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/js/all.min.js"></script>
    <script src="/path-to-your-local-folder/mdb.min.js"></script>


</body>

</html>