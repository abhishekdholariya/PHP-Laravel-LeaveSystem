<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Leave Approved</title>
    <style>
        a {
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
    <p>Dear {{ $name }},</p>

    <p>
        I hope this email finds you well. I am writing to inform you that your leave application has been approved by
        {{ $approved_by }}({{ $role }}).
        The leave is for the following reason: {{ $description }}
    </p>
    <br>
    <p>
        I have forwarded to you the leave application for your approval.
    </p>
    <a href="{{ $url }}">
        view leave application
    </a>
    <br>
    <p></p>

    <p>Regards,</p>
    <p>
        {{ $approved_by }}({{ $role }})
    </p>
</body>

</html>
