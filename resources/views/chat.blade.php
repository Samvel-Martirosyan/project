@extends('welcome')
@section('content')
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <div class="online-people">

    </div>

    <section class="msger">
        <header class="msger-header">
            <div class="msger-header-title">
                <i class="fas fa-comment-alt"></i> SimpleChat
            </div>
            <div class="msger-header-options">
                <span><i class="fas fa-cog"></i></span>
            </div>
        </header>

        <main class="msger-chat">

        </main>

        <div class="msger-inputarea">
            <input type="text" class="msger-input" placeholder="Enter your message..." disabled>
            <button type="button" class="msger-send-btn send-button">Send</button>
        </div>
    </section>

    <section class="setting" hidden>
        <header class="header-setting">
            <div class="header-title">
                <i class="fas fa-comment-alt"></i> SimpleChat
            </div>
            <div class="header-back">
                <span><i class="fa-solid fa-arrow-left"></i></span>
            </div>
        </header>

        <main class="main-setting">
            <label for="name" class="user-name-label">User Name: </label>
            <div>
                <input type="text" id="name" placeholder="Name">
                <label class="saved-label">Saved</label>
            </div>
            <button type="button">Save</button>
        </main>

        <div class="footer-setting"></div>
    </section>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>
    <script src="{{ asset('assets/plugin/socket.io-client-4.5.0/dist/socket.io.min.js')}}"></script>
    <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
        const socket = io("ws://localhost:8082");
        const form = document.querySelector('.msger-inputarea');
        const messageInput = document.querySelector('.msger-input');
        const chat = document.querySelector(".msger-chat");
        const button = document.querySelector('.send-button');
        let PERSON_NAME = localStorage.getItem('userName') ?? prompt('What is your name?');
        localStorage.setItem('userName', PERSON_NAME);

        let CHAT_FRIEND_ID = '';

        socket.emit('send-username', PERSON_NAME);

        socket.on('users', function (data) {
            $('.online-people .div').remove();
            for (const property in data.users) {
                if (data.users[property] === PERSON_NAME) {
                    const el = `<div class="div" data-id="${property}">${data.users[property]} : you</div>`;
                    $('.online-people').append(el);
                } else {
                    const el = `<div class="div" data-id="${property}">${data.users[property]}</div>`;
                    $('.online-people').append(el);
                }

                $('.div').click(function () {
                    CHAT_FRIEND_ID= $(this).attr('data-id');
                    $('.msger-input').prop('disabled', false)
                })
            }
        })

        socket.on('message', function (data) {
            const socketId = Object.keys(data)[0];
            data = data[socketId];
            if (! data[PERSON_NAME]) {
                const personName = Object.keys(data)[0];
                appendMessage(personName, 'left', data[personName]);
            }
        })

        button.addEventListener('click', function (event) {
            const myMessage = messageInput.value;
            if (!myMessage) return;

            appendMessage(PERSON_NAME, 'right', myMessage);
            messageInput.value = "";

            const message = {};
            const messageArr = {};
            message[PERSON_NAME] = myMessage;
            messageArr[CHAT_FRIEND_ID] = message;

            socket.emit('message', messageArr);
        });

        function appendMessage(name, side, text) {
            const msgHTML = `
                                <div class="msg ${side}-msg">
                                  <div class="msg-bubble">
                                    <div class="msg-info">
                                      <div class="msg-info-name">${name}</div>
                                      <div class="msg-info-time">${formatDate(new Date())}</div>
                                    </div>

                                    <div class="msg-text">${text}</div>
                                  </div>
                                </div>
                              `;

            chat.insertAdjacentHTML("beforeend", msgHTML);
            chat.scrollTop += 500;
        }

        function formatDate(date) {
            const h = "0" + date.getHours();
            const m = "0" + date.getMinutes();

            return `${h.slice(-2)}:${m.slice(-2)}`;
        }

        $('.msger-header-options').click(function () {
            $('.msger').css("display", 'none');
            $('.setting').prop('hidden', false);

            $('.main-setting input').val(PERSON_NAME);
        })

        $('.main-setting button').click(function () {
            const newName = $('.main-setting input').val();
            localStorage.setItem('userName', newName)
            PERSON_NAME = newName;
            $('.saved-label').css('display', 'block');
            setTimeout(() => { $('.saved-label').css('display', 'none') }, 4000);
        })

        $('.header-back').click(function () {
            $('.msger').css('display', 'flex');
            $('.setting').prop('hidden', true);
        })

        $('.msger-input').on('keypress',function(e) {
            if (e.keyCode === 13) {
                $(".send-button").click();
            }
        });
    </script>
@endsection
