/**
 * Created by ds on 20.05.15.
 */
// Use SockJS
Stomp.WebSocketClass = SockJS;

// Connection parameters
var mq_username = "guest",
    mq_password = "guest",
    mq_url      = 'http://localhost:15674/stomp',

// The queue we will read. The /topic/ queues are temporary
// queues that will be created when the client connects, and
// removed when the client disconnects. They will receive
// all messages published in the "amq.topic" exchange, with the
// given routing key, in this case "mymessages"
    mq_queue    = "/queue/ticker";

// This is where we print incomoing messages
var output;

function parseMessage(message) {
    return JSON.parse(message);
}
var source = Rx.Observable.create(function (observer) {
    var client = Stomp.client(mq_url);
    client.debug = null
    client.connect(
        mq_username,
        mq_password,
        function on_connect() {
            output.innerHTML += 'Connected to RabbitMQ-Web-Stomp<br />';
            client.subscribe(mq_queue, function(m) {
                observer.onNext(parseMessage(m.body));
            });
        },
        function() {
            output.innerHTML += 'Connection failed!<br />';
            client.disconnect();
            observer.onCompleted();
        }
    );

    // Any cleanup logic might go here
    return function () {
        console.log('disposed');
        client.disconnect();
    }
})
.map(function(message){
    var limit = $("#tickerFilter ").find(":selected").val();
    if(limit > 0) {
        var result = [];
        message.data.forEach(function(elem){
           if(elem.value >= limit) {
               result.push(elem);
           }
        });
        return result;
    }
    return message.data;
});

// Create and start Hot Subscription
hotTicker = source.publish();
hotTicker.connect();


/// Create observer
var observer = Rx.Observer.create(
    function (x) {
        x.forEach(function(elem) {
            output.innerHTML += elem.ident + ":" + elem.value + " - ";
        });
        output.innerHTML += '<br />';
    },
    function (e) { console.log('onError: %s', e); },
    function () { console.log('onCompleted'); }
);

setTimeout(function() {
    var subscription = hotTicker.subscribe(observer);
}, 2000);


window.onload = function () {
    // Fetch output panel
    output = document.getElementById("output");

    //connectWebSocket();

}

