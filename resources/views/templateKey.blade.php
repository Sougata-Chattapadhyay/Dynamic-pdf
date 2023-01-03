<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>


    <title>Template Keys</title>
</head>

<body>
    @include('navBar')
    <div class="card">
        <h5 class="card-header ml-auto">
            <button class="btn btn-primary add">+</button>
        </h5>
        <form id="saveJson" action="/saveJson">
            <input id="json" name="json" hidden>
            <div class="card-body" id="inputF">

            </div>
        </form>
        <div class="card-footer">
            <button class="btn btn-success" onclick="createJson()">submit</button>
        </div>
    </div>
</body>
<script>
    $(document).ready(function() {
        // var inputField = "";
        count = 0;
        $(".add").click(function() {
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
        $('#saveJson').submit();
        // console.log("json : ", $("#json").val());

    }
</script>

</html>