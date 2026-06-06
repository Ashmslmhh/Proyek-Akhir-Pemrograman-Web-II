<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>BimTrack</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

<style>

body{
    background:#F7F7FC;
    margin:0;
}

.sidebar{
    width:240px;
    height:100vh;
    background:#6C63FF;
    position:fixed;
    left:0;
    top:0;
    padding:25px;
}

.logo{
    color:white;
    font-size:30px;
    font-weight:bold;
    margin-bottom:40px;
}

.sidebar-menu a{
    color:white;
    text-decoration:none;
    display:flex;
    gap:10px;
    padding:12px 15px;
    border-radius:14px;
    margin-bottom:10px;
}

.sidebar-menu a.active{
    background:rgba(255,255,255,.2);
}

.main{
    margin-left:240px;
    padding:30px;
}

</style>

</head>

<body>

@include('partials.sidebar')

<div class="main">
    @yield('content')
</div>

</body>
</html>