<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ isset($title) ? $title : "未命名" }}</title>
</head>
<body>

<?php
    $keys = array_keys(get_object_vars($result[0]));
?>
    <table>
        <tr>
            @foreach($keys as $key)
                <td>{{ $key }}</td>
            @endforeach
        </tr>
        @foreach($result as $item)
        <tr>
            @foreach($keys as $key)
                <td>{{ $item->$key }}</td>
            @endforeach
        </tr>
        @endforeach
    </table>

</body>
</html>