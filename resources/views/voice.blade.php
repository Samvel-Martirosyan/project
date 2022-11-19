@extends('welcome')
@section('content')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        .container {
            padding: 10px;
            display: flex;
        }
        .play {
            font-size: 100px;
            color: green;
            padding: 5px;
        }
        .play:hover, .stop:hover {
            cursor: pointer;
        }
        .stop {
            font-size: 100px;
            color: red;
            padding: 5px;
        }
    </style>
    <div style="display: none" class="token">{{csrf_token()}}</div>
    <div class="container">
        <div class="play"><i class="fa-regular fa-circle-play"></i></div>
        <div class="stop"><i class="fa-regular fa-circle-stop"></i></div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
        const playButton = document.querySelector('.play');
        const stopButton = document.querySelector('.stop');
        const token = document.querySelector('.token').innerHTML;

        const audioRecorder = {
            audioBlobs: [],
            mediaRecorder: null,
            streamBeingCaptured: null,
            start: function () {
                if (!(navigator.mediaDevices && navigator.mediaDevices.getUserMedia)) {
                    return Promise.reject(new Error('mediaDevices API or getUserMedia method is not supported in this browser.'));
                }
                else {
                    return navigator.mediaDevices.getUserMedia({ audio: true })
                        .then(stream => {
                            audioRecorder.streamBeingCaptured = stream;

                            audioRecorder.mediaRecorder = new MediaRecorder(stream);

                            audioRecorder.audioBlobs = [];

                            audioRecorder.mediaRecorder.addEventListener("dataavailable", event => {
                                audioRecorder.audioBlobs.push(event.data);
                            });

                            audioRecorder.mediaRecorder.start();
                        });
                }
            },

            stop: function () {
                return new Promise(resolve => {
                    let mimeType = audioRecorder.mediaRecorder.mimeType;

                    audioRecorder.mediaRecorder.addEventListener("stop", () => {
                        let audioBlob = new Blob(audioRecorder.audioBlobs, { type: mimeType });

                        resolve(audioBlob);
                    });

                    audioRecorder.mediaRecorder.stop();

                    audioRecorder.stopStream();
                });
            },

            stopStream: function() {
                audioRecorder.streamBeingCaptured.getTracks()
                    .forEach(track => track.stop());
            },

            download: function (audio) {
                const blob = new Blob([audio], {type:"octet-steam"});
                const href = URL.createObjectURL(blob);

                const a = Object.assign(document.createElement("a"), {
                    href,
                    style: "display:none",
                    download: "myAudio.mp3",
                });
                document.body.appendChild(a);

                a.click();
                URL.revokeObjectURL(href);
                a.remove();
            }
        };

        playButton.addEventListener('click', function () {
            audioRecorder.start()
                .then(() => {
                    console.log("Recording Audio...")
                })
                .catch(error => {
                    if (error.message.includes("mediaDevices API or getUserMedia method is not supported in this browser.")) {
                        console.log("To record audio, use browsers like Chrome and Firefox.");
                    }
                });

        })

        stopButton.addEventListener('click', function () {
            console.log("Stopping Audio Recording...")
            audioRecorder.stop()
                .then(audioAsblob => {
                    audioRecorder.download(audioAsblob)
                }).catch(error => {
                    switch (error.name) {
                        case 'InvalidStateError':
                            console.log("An InvalidStateError has occured.");
                            break;
                        default:
                            console.log("An error occured with the error name " + error.name);
                    }
                });

        })
    </script>
@endsection
