/*function showMessage(messageHTML) {
    $('#chat-box').append(messageHTML);
}
$(document).ready(function() {
    var websocket = new WebSocket("ws://192.168.1.7:8090/");
    websocket.onopen = function(event) {
        showMessage("<div class='chat-connection-ack'>Connection is established!</div>");
    }
    websocket.onmessage = function(event) {
        showMessage("<div>" + event.data + "</div>");
        $('#chat-message').val('');
    };
    websocket.onerror = function(event) {
        showMessage("<div class='error'>Problem due to some Error</div>");
    };
    websocket.onclose = function(event) {
        showMessage("<div class='chat-connection-ack'>Connection Closed</div>");
    };
    $('#frmChat').on("submit", function(event) {
        event.preventDefault();
        $('#chat-user').attr("type", "hidden");
        websocket.send($('#chat-message').val());
    });
    setInterval(function() { websocket.send('estoy presente'); }, 9000);
});*/