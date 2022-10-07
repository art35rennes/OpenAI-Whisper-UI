<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    <meta http-equiv="x-ua-compatible" content="ie=edge"/>
    <title>@yield("title")</title>
    <!-- MDB icon -->
    <link rel="icon"
          href="" type="image/x-icon"/>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"/>
    <!-- Google Fonts Roboto -->
    <link
        rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap"
    />
    <!-- MDB ESSENTIAL -->
    <link rel="stylesheet" href="{{URL::asset("storage/css/mdb.min.css")}}"/>
    <!-- MDB PLUGINS -->
    <link rel="stylesheet" href="{{URL::asset("storage/plugins/css/all.min.css")}}"/>
    <!-- Custom styles -->
    <style>

    </style>
</head>

<body id="body">

@yield("body")

</body>

<!-- MDB ESSENTIAL -->
<script type="text/javascript" src="{{URL::asset("storage/js/mdb.min.js")}}"></script>
<!-- MDB PLUGINS -->
<script type="text/javascript" src="{{URL::asset("storage/plugins/js/all.min.js")}}"></script>
<!-- Custom scripts -->
@yield("js")
</html>
