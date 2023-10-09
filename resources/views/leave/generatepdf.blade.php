<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <title>Report</title>
</head>
<body>
    <h1>{{$title}}</h1>
    <h3>{{$date}}</h3>
    <div class="row layout-top-spacing card">
        <div class="col-12 card-body">
            <div class="table-responsive">
                <table class="table table-hover table-bordered table-sm">
                    <thead>
                        <tr class="bg-white">
                            <th scope="col">Id</th>
                            <th scope="col">Name</th>
                            <th scope="col">From </th>
                            <th scope="col">To</th>
                            <th scope="col">Description</th>
                            <th scope="col">Type</th>
                            <th scope="col">status</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($leaves as $leave)
                    <tr>
                        <td>{{$leave->id}}</td>
                        <td>{{$leave->user->name ?? '' }}</td>
                        <td>{{$leave->from}}</td>
                        <td>{{$leave->to}}</td>
                        <td>{{$leave->description}}</td>
                        <td>{{$leave->type}}</td>
                        <td>{{$leave->status}}</td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</body>
</html>