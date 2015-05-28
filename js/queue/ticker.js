Stomp.WebSocketClass = SockJS;

// Connection parameters
var mq_username = "guest",
    mq_password = "guest",
    mq_url      = 'http://localhost:15674/stomp',
    mq_queue    = "/queue/ticker";

// This is where we print incomoing messages

function parseMessage(message) {
    return JSON.parse(message);
}


var source = Rx.Observable.create(function (observer) {
    var client = Stomp.client(mq_url);
    client.debug = null;
    client.connect(
        mq_username,
        mq_password,
        function on_connect() {
            $("#outputMessages").append('Connected to queue ticker<br />');
            client.subscribe(mq_queue, function(m) {
                observer.onNext(parseMessage(m.body));
            });
        },
        function() {
            client.disconnect();
            observer.onCompleted();
        }
    );

    // Any cleanup logic might go here
    return function () {
        $("#outputMessages").append('Connection for ticker closed');
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
        var tBody = '';
        x.forEach(function(elem) {
            tBody += createTableRow(elem);

        });
        $("#tickerData").find("tbody").html(tBody);
    },
    function (e) { console.log('onError: %s', e); },
    function () { console.log('onCompleted'); }
);

setTimeout(function() {
    var subscription = hotTicker.subscribe(observer);
}, 2000);
