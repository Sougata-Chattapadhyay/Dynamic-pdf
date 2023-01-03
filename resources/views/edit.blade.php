<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script> -->
    <title>Edit Template</title>
</head>
<style>
    inpute#tmp_name {
        height: 35px;
    }
    #addHtml {
        width: 70%;
        padding: 1%;
    }

    #addKey {
        width: 30%;
        padding: 1%;
    }

    .card-header.ddd {
        display: flex;
    }

    textarea#exampleFormControlTextarea1 {
        height: 50vh;
    }
</style>

<body>
    @include('navBar')
    <div class="card">
        <h5 class="card-header">Edit Template : </h5>
        <div class="card-body">
            <div class="htmlkey">
                <form method="POST" action="{{url('edit/'.$record->id)}}">
                    @csrf
                    <div class="form-group">
                        <label for="exampleFormControlTextarea1">Template Name</label>
                        <input class="form-control" id="tmp_name" rows="3"  name="tmp_name" value="{{$record->tmp_name}}" />
                    </div>
                    <div style="display: flex;">
                        <div id="addHtml" class="card">
                            <div class="form-group">
                                <label for="exampleFormControlTextarea1">Enter the html</label>
                                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="html">{{$record->html}}</textarea>
                            </div>

                        </div>
                        <div id="addKey" class="card">
                            <div class="card-header ddd">
                                <h5>Enter the key:</h5>
                                <button class="btn btn-primary add ml-auto">+</button>
                            </div>
                            <input id="json" name="json" hidden>
                            <div class="card-body" id="inputF">

                            </div>
                        </div>
                    </div>
                    <div class="form-group mt-3">
                        <button onclick="createJson()" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="card-footer">

        </div>
    </div>
</body>
<script>
    var data = {!!json_encode($record->json) !!};
    var dataArray = JSON.parse(data);
</script>
<script>
    $(document).ready(function() {
        console.log("Length! : ", dataArray.length);
        console.log("Array ", dataArray[0]);
        var inputField = '';
        var count = 0;
        dataArray.forEach((i) => {
            count = count + 1;
            inputField = '<div><input class="inputFieldd mt-3" name="###' + count + '"  value="' + i.value + '"/></div>';
            $('#inputF').append(inputField);
        });

        $(".add").click(function() {
            event.preventDefault();
            console.log("Inner Html : ", $("#input").innerHTML);
            if (count == 0) {
                count = count + 1;
                inputField = '<div><input class="inputFieldd mt-3" name="###' + count + '" /></div>'
                $('#inputF').append(inputField);
                console.log("Field :", inputField);
            } else {
                count = count + 1;
                inputField = '<div><input class="inputFieldd mt-3" name="###' + count + '" /></div>';
                $('#inputF').append(inputField);
                console.log("else");
            }
        });
    });
</script>
<script>
    function createJson() {
        var json = [];
        jQuery('.inputFieldd').each(function(element, index) {
            console.log("Element : ", index.getAttribute('name'), " Index : ", index.value);
            var k = index.getAttribute('name');
            var value = index.value;

            // json[k] = value;
            json.push({
                key: k,
                value: value
            });
        });
        $("#json").val(JSON.stringify(json));
        // $('#saveJson').submit();
        console.log("json : ", $("#json").val());

    }
</script>

</html>