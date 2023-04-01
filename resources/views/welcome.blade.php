<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Socket chat app</title>

    <!-- Fonts -->
    <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <!-- Styles -->
    <style>
        .chat-row{
            margin: 50px;

        }
        ul{
            margin: 0;
            padding: 0;
            list-style: none;
        }
       ul li{
                padding: 10px;
                background: rgb(250, 223, 223);
                margin-bottom: 20px;
        }
        ul li:nth-child(2n-2){
            background: rgb(223, 233, 255);
            
        }
        .chat-input{
            border: 2px solid grey;
            border-radius: 20px;
            background: grey;
            color: white;
        }
    </style>

</head>

<body>
    <div class="container">
        <div class="row chat-row">
            <div class="chat-content">
                <ul>
                </ul>
            </div>
            <div class="chat-section">
                <div class="chat-box">
                    <div id="chatinput" class="chat-input bg-grey" contenteditable="">
                        

                    </div>
                </div>
            </div>
        </div>
    </div>






    <script src="https://code.jquery.com/jquery-3.6.3.js" integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM=" crossorigin="anonymous"></script>
    <script src="https://cdn.socket.io/4.5.4/socket.io.min.js" integrity="sha384-/KNQL8Nu5gCHLqwqfQjA689Hhoqgi2S84SNUxC3roTe4EhJ9AfLkp8QiQcU8AMzI" crossorigin="anonymous"></script>

    <script>
        $(function(){
            let ip = "127.0.0.1";
            let port ="3000";
            let socket = io(ip + ':'+ port);
            // socket.on('connection')

            let chatinput = $('#chatinput');
            chatinput.keypress(function(e){
                let message = $(this).html();
                console.log(message);
                if(e.which === 13 && !e.shiftKey){
                    socket.emit('sendChatToServer',message);
                    chatinput.html(' ');
                    return false;
                    
                }
            });
            socket.on('sendChatToClient', (message)=>{
                $('.chat-content ul').append(`<li> ${message} </li>`);

            })

        });
    </script>
</body>

</html>
