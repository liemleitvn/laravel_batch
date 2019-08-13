<!doctype html>
<html>
<head>
    <title>Permission denied</title>
</head>
<body>
    @if($message)
        <p>Error 403: {{ $message }}</p>
    @else
        <p>Error 403: You don't have permission to access this page</p>
    @endif
</body>
</html>
