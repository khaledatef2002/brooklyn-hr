<!DOCTYPE html>
<html>
<head>
    <title>We have created your account</title>
</head>
<body style="background-color: #f7f7fb;
    min-height: 200px;
    padding: 30px 0;">
    <div style="text-align: center; width:100%;display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;">
        <div style="width:80%;margin:auto;background-color:white;border-radius:7px;    padding: 10px 0;">
            <h1 style="color: black;">We have created your {{ $account_type }} account with the following info</h1>
            <p>
                <span class="fw-bold">Email: </span> {{ $email }}
            </p>
            <p>
                <span class="fw-bold">Password: </span> {{ $password }}
            </p>
            <a style="color: black;" href="{{ route('dashboard.index') }}">Click to login</a>
        </div>
    </div>
    <a href="{{ config('app.url') }}" style="text-align: center">{{ config('app.name') }}</a>
</body>
</html>
