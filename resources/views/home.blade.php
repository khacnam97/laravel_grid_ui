<!DOCTYPE html>
<html>
<head>
    <title>Talking with Pusher</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
</head>
<body>
<div class="container">
    <div class="content">
        <h1>Laravel 5 and Pusher is fun!</h1>
        <ul id="messages" class="list-group">
            @foreach($message as $mes)
                <li class='list-group-item'>{!! $mes->message . ' ' . $mes->created_at!!} </li>
            @endforeach
        </ul>
    </div>
    <form  action="{{route('message.send')}}">

        <div class="form-group row">
            <div class="col-md-6">
                <input id="message" type="text" class="form-control @error('message') is-invalid @enderror" name="message" value="{{ old('message') }}" autocomplete="message" autofocus>
            </div>
            <div class="col-md-6">
                <input id="id" type="hidden"  class="form-control @error('id') is-invalid @enderror" name="id" value="{{ $id }}" autocomplete="id" autofocus>
            </div>
        </div>

        <div class="form-group row mb-0">
            <div class="col-md-6 offset-md-4">
                <button id="idForm" type="" class="btn btn-primary">
                   Send
                </button>
            </div>
        </div>
    </form>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
<script src="https://js.pusher.com/3.1/pusher.min.js"></script>
<script>
    //instantiate a Pusher object with our Credential's key
    var pusher = new Pusher('4259d8c059891b5a9ba6', {
        cluster: 'ap1',
        encrypted: true
    });

    //Subscribe to the channel we specified in our Laravel Event
    let channels = ['messages.'+ {{ $id  }} + '.'+ {{auth()->user()->id}}, 'messages.'+ {{auth()->user()->id}} + '.'+ {{ $id  }}].map(channelName => pusher.subscribe(channelName));
    //Bind a function to a Event (the full Laravel class)
    let channel;
    for (channel of channels ){
        channel.bind('App\\Events\\NewMessage', addMessage)
    }
    function addMessage(data) {
        const event = new Date(data.message.created_at);
        var listItem = $("<li class='list-group-item'></li>");
        listItem.html(data.message.message + " " +  event.toLocaleDateString() + " "+ event.toLocaleTimeString());
        $('#messages').append(listItem);
    }
</script>
</body>
</html>
