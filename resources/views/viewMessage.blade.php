@extends('welcome')
@section('content')
    <div class="chat-dashboard">

    </div>
    <script>
        setTimeout(()=> {
            socketIo.on('message', function (data) {
                document.querySelector('.chat-dashboard').innerHTML = `<p>${data.message}</p>`;
            })
        }, 1)

    </script>
@endsection
