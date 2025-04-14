<!DOCTYPE html>
<html>
<head>
    <title>Your task has been deleted</title>
</head>
<body style="background-color: #f7f7fb;
    min-height: 200px;
    padding: 30px 0;">
    <div style="width:100%;display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;">
        <div style="width:80%;margin:auto;background-color:white;border-radius:7px;padding: 10px 0;">
            <h1 style="color: black;text-align:center;">Your task has been deleted!</h1>
            <p style="text-align:center;">{{ $title }}</p>
        </div>
    </div>
    <a href="{{ config('app.url') }}" style="text-align: center">{{ config('app.name') }}</a>
</body>
</html>
