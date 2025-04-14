<!DOCTYPE html>
<html>
<head>
    <title>You have got a new task</title>
</head>
<body style="background-color: #f7f7fb;
    min-height: 200px;
    padding: 30px 0;">
    <div style="width:100%;display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;">
        <div style="width:80%;margin:auto;background-color:white;border-radius:7px;padding: 10px 0;">
            <h1 style="color: black;text-align:center;">You have received a new task!</h1>
            <p class="fw-bold text-center">Your task info:</p>
            <ul style="list-style:none;">
                <li>
                    <span class="fw-bold">Title: </span> {{ $title }}
                </li>
                <li>
                    <span class="fw-bold">Created By: </span> {{ $by }}
                </li>
                <li>
                    <span class="fw-bold">Due Date: </span> {{ $due_date }}
                </li>
            </ul>
            <a style="color: black;text-align:center;" href="{{ $link }}">View</a>
        </div>
    </div>
    <a href="{{ config('app.url') }}" style="text-align: center">{{ config('app.name') }}</a>
</body>
</html>
