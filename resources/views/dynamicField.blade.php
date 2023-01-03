<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    @include('navBar')
    <form id="" action="/replace/{{$id}}">
        <div class="card" style="padding: 2%;border: 1px solid;margin: 6px;">
            
            @foreach($json as $j)
            <div class="form-group">

                <label for="recipient-name" class="col-form-label">{{$j->value}}:</label>
                <input type="text" class="form-control" id="{{$j->value}}" name="{{$j->value}}">
            </div>
            @endforeach
            <div class="form-group">
                <button id="go" type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
    </form>
</body>

</html>