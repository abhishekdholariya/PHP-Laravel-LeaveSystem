<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Leave Application</title>
    <style>
        a{
            text-decoration: none;
            color: #fff;
            background-color: #007bff;
            border-color: #007bff;
            padding: 8px 15px;
            border-radius: 5px;
            margin-top: 10px;
        }
    </style>
</head>

<body>

    <p>Dear {{ $hod_name }},</p>

    <p>
        I hope this email finds you well. I am writing to request your assistance in covering for a colleague who will
        be on leave from <b> {{ $from }} </b> to <b>{{ $to }}</b>. The leave is for the following
        reason: {{ $description }}
    </p>
    <br>
    <a href="{{$url}}" >
        view leave application
    </a>
    <br>
    <p></p>
    <p>
        I would like to request that you will work as substitute for the
        duration of the leave. I will be grateful if you can assist me with this matter.
    </p>

    <p>Regards,</p>
    <p>{{ $staff }}</p>
</body>

</html>
