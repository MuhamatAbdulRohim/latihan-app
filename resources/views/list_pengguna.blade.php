<html>
<head>
    <title>Nama Saya</title>
</head>
<body>
<p>ini paragraf</p>
<ul>
    @foreach($pengguna as $item)
        <li>{{$item->email}} ({{$item->password}})</li>
    @endforeach
</ul>
</body>
</html>
