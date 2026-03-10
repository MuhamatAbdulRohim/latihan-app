<html>
<head>
    <title>Nama Saya</title>
</head>
<body>
<p>ini paragraf</p>
<ul>
    @foreach($pengguna as $item)
        <li>{{$item->nama}} ({{$item->hoby}}) - {{$item->created_at}}</li>
    @endforeach
</ul>
</body>
</html>
