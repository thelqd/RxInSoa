/**
 * Created by ds on 20.05.15.
 */
// Use SockJS
Stomp.WebSocketClass = SockJS;

// Connection parameters
var mq_username = "guest",
    mq_password = "guest",
    mq_vhost    = "/",
    mq_url      = 'http://localhost:15674/stomp',

// The queue we will read. The /topic/ queues are temporary
// queues that will be created when the client connects, and
// removed when the client disconnects. They will receive
// all messages published in the "amq.topic" exchange, with the
// given routing key, in this case "mymessages"
    mq_queue    = "/queue/ticker";

// This is where we print incomoing messages
var output;



// This will be called upon a connection error
function on_connect_error(error) {
    output.innerHTML += 'Connection failed!<br />';

    if(error == "Whoops! Lost connection to " + mq_url) {
        console.log("reconnect");
        connectWebSocket();
    }
}

// This will be called upon arrival of a message
function on_message(m) {
    console.log('message received');
    console.log(m);
    output.innerHTML += m.body + '<br />';
}


function connectWebSocket() {
    var client = Stomp.client(mq_url);
    client.connect(
        mq_username,
        mq_password,
        function on_connect() {
            output.innerHTML += 'Connected to RabbitMQ-Web-Stomp<br />';
            console.log(client);
            client.subscribe(mq_queue, on_message);
        },
        on_connect_error
    );
}

window.onload = function () {
    // Fetch output panel
    output = document.getElementById("output");

    connectWebSocket();

}
