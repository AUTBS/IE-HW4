<!DOCTYPE html>
<html>
<head>
    <title>IE Project 4</title>
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('Stylesheets/ComposeEmail.css')}}" >
</head>
<body>
<div id="container">
    <div class="forms">
        <form id="send" action="/send" method="POST"  enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="titles">
                <h5>To:</h5>
                <h5>Subject:</h5>
                <h5>Text:</h5>
                <h5 id="attach">Attachment:</h5>
                <input id="submit" type="submit" value="Send">
            </div>

            <div class="inputs">
                <input type="text" id="to" name="to" value="{{ old('to') }}">
                @if($error == 1)
                <div>just send message to your contacts</div>
                @endif
                <input type="text" name="subject" value="{{ old('subject') }}">
                <textarea rows="10" cols="70" name="text"></textarea>
                <input type="file" name="attachment">
            </div>
        </form>
    </div>
</div>
</body>
</html>
<script>
    document.getElementById("submit").onclick = function(){

        window.location.replace("/");
    };
</script>