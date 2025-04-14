<!DOCTYPE html>
<html>
<head>
    <title>We have received your internship request!
    </title>
</head>
<body style="background-color: #f7f7fb;
    min-height: 200px;
    padding: 30px 0;">
    <div style="width:100%;display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;">
        <div style="width:80%;margin:auto;background-color:white;border-radius:7px;    padding: 10px 0;">
            <h1 style="color: black;text-align: center;">We have received your internship request!</h1>
            <p class="fw-bold">Your request info:</p>
            <ul style="list-style:none;">
                <li>
                    <span class="fw-bold">Full Name: </span> {{ $form_data->first_name }} {{ $form_data->last_name }}
                </li>
                <li>
                    <span class="fw-bold">Email: </span> {{ $form_data->email }}
                </li>
                <li>
                    <span class="fw-bold">Phone Number: </span> {{ $form_data->phone_number }}
                </li>
                <li>
                    <span class="fw-bold">Date of birth: </span> {{ $form_data->date_of_birth }}
                </li>
                <li>
                    <span class="fw-bold">CV: </span> <a href="{{ asset('storage/' . $form_data->cv) }}">view</a>
                </li>
            </ul>
        </div>
    </div>
    <a href="{{ config('app.url') }}" style="text-align: center">{{ config('app.name') }}</a>
</body>
</html>
