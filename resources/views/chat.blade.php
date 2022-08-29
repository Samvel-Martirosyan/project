@extends('welcome')
@section('content')
    Message: <input type="text" id="message">
    <button id="send-message">Send message</button>

    <script>
        const button = document.getElementById('send-message');

        button.addEventListener('click', function () {
            const message = document.querySelector('#message').value;
            socketIo.emit('message', {message: message});
        })
    </script>
@endsection
