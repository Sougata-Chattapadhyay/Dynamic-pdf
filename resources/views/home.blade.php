<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
</head>

<body>
    @include('navBar')
    <div class="float-right m-2"><a href="/Create"><button class="btn btn-success">Create</button></a></div>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">Id</th>
                <th scope="col">Template Name</th>
                <th scope="col">View</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($records as $data)
            <tr>
                <th scope="row">{{$data->id}}</th>
                <td>{{$data->tmp_name}}</td>
                <td>
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalLong-{{$data->id}}">
                    <i class="fa-solid fa-magnifying-glass"></i>
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="exampleModalLong-{{$data->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">Format</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            {!!$data->html!!}
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            
                        </div>
                        </div>
                    </div>
                    </div>
                    
                </td>
                <td>
                    <a href="/edit/{{$data->id}}"><button class="btn btn-primary">Edit</button></a>
                    <a href="/delete/{{$data->id}}"><button class="btn btn-danger">Delete</button></a>
                    <a href="/getValue/{{$data->id}}"><button class="btn btn-success">Download</button></a>
                </td>
            </tr>
            @endforeach

        </tbody>
    </table>
</body>

</html>