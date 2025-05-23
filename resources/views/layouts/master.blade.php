<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('page-title') - {{ __('admin.Dashboard') }}</title>
    @include('layouts.head-assets')
    @yield('page-head')
    
</head>

<body id="page-top">

    <button id="chatbot-icon"><i class="fas fa-comments"></i></button>

    <div id="chat-window" style="display: none;">
        <div class="close-chat" style="position: absolute; right: 10px; top: 10px; cursor: pointer; font-size: 20px;">&times;</div>
        <div class="messages">
            <div class="left message">
                <img src="{{asset('assets/img/undraw_profile_1.svg')}}" alt="Avatar">
                <p class="mt-4">{{ __('admin.Chatbot') }}</p>
            </div>
        </div>
        <div class="bottom">
            <form id="chat-form" method="POST" style="display: flex;">
                <input type="text" id="message" class="form-control" name="message" placeholder="Enter message..." required style="flex: 1;">
                <i class="fas fa-arrow-right mt-2" id="send-icon" style="color: lightblue; cursor: not-allowed; font-size: 24px; margin-left: 10px;" title="Type a message to send"></i>
                <button type="submit" id="send-button" style="display:none;"></button>
            </form>
        </div>
    </div>


    
    @include('layouts.sidebar')

    @yield('page-content')

    @include('layouts.footer')

    @include('layouts.footer-assets')

    @yield('page-scripts')

    <script>
        
        let chatHistory = [];
    
        document.getElementById('chatbot-icon').onclick = function() {
            const chatWindow = document.getElementById('chat-window');
            chatWindow.style.display = chatWindow.style.display === 'none' ? 'block' : 'none';
            if (chatWindow.style.display === 'block') {
                document.getElementById('message').focus();
                renderChatHistory(); 
            }
        };
    
        function renderChatHistory() {
            chatHistory.forEach(item => {
                const messageClass = item.isUser ? 'right message' : 'left message';
                const content = item.isUser 
                    ? `<p>${item.content}</p>` 
                    : `<p>${item.content}</p>`;
                $(".messages").append(`<div class="${messageClass}">${content}</div>`);
            });
            $(".messages").scrollTop($(".messages")[0].scrollHeight);
        }
    
        $("#send-icon").click(function(event) {
            event.preventDefault();
            sendMessage();
        });
    
        function sendMessage() {
            const messageInput = $("#message");
            const messageContent = messageInput.val().trim();
            if (messageContent === '') return;
    
            messageInput.prop('disabled', true);
            $("#send-button").prop('disabled', true);
    
            chatHistory.push({ isUser: true, content: messageContent });
    
            // Send AJAX request
            $.ajax({
                url: '/admin/chat',
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                },
                data: {
                    "message": messageContent
                },
                success: function(response) {                    
                    const botReply = response.candidates[0].content.parts[0].text;
                    chatHistory.push({ isUser: false, content: botReply });
    
                    renderChatHistory();
                    messageInput.val('');
                    updateSendIconState(); 
                },
                error: function(response) {
                    console.error(response);
                },
                complete: function() {
                    messageInput.prop('disabled', false);
                    $("#send-button").prop('disabled', false);
                }
            });
        }
            $("#message").on('input', function() {
            updateSendIconState();
        });
    
        function updateSendIconState() {
            const messageInput = $("#message").val().trim();
            const sendIcon = $("#send-icon");
            if (messageInput) {
                sendIcon.css('color', 'blue');
                sendIcon.css('cursor', 'pointer');
                sendIcon.prop('onclick', null).off('click').click(function(event) {
                    event.preventDefault();
                    sendMessage();
                });
            } else {
                sendIcon.css('color', 'lightblue');
                sendIcon.css('cursor', 'not-allowed');
                sendIcon.prop('onclick', null).off('click');
            }
        }
    
        $(".close-chat").click(function() {
            $("#chat-window").hide();
        });

        
    </script>

  <script>
    
    var myModal = new bootstrap.Modal(document.getElementById('customizer-modal'));

    // Show the modal when the customizer icon is clicked
    document.getElementById("customizer-icon").onclick = function () {
            myModal.show();
    };

    document.addEventListener("DOMContentLoaded", function () {
    const darkModeToggle = document.getElementById("dark-mode-toggle");
    const sidebarColorSelect = document.getElementById("sidebar-color");

    const sidebar = document.querySelector(".sidebar");

    if (localStorage.getItem("darkMode") === "enabled") {
        document.body.classList.add("dark-mode");
        darkModeToggle.checked = true;
    }

    if (localStorage.getItem("sidebarColor")) {
        sidebar.classList.remove("bg-blue-500","bg-gray-800");
        sidebar.classList.add(localStorage.getItem("sidebarColor"));
        sidebarColorSelect.value = localStorage.getItem("sidebarColor");
    }

    darkModeToggle.addEventListener("change", function () {
        document.body.classList.toggle("dark-mode");
        localStorage.setItem("darkMode", document.body.classList.contains("dark-mode") ? "enabled" : "disabled");
    });

    sidebarColorSelect.addEventListener("change", function () {
        const selectedColor = this.value;
        sidebar.classList.remove("bg-blue-500", "bg-gray-800");
        sidebar.classList.add(selectedColor);

        // Store in localStorage
        localStorage.setItem("sidebarColor", selectedColor);
    });

    
});
    
    document.querySelector(".btn-close").addEventListener("click", function() {
         myModal.hide();
    });

  </script>


</body>
</html>
