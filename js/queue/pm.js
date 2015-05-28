var pmQueue = 'pm';

var pmSource = Rx.Observable.create(function (observer) {
    var client = Stomp.client(mq_url);
    client.debug = null;
    client.connect(
        mq_username,
        mq_password,
        function on_connect() {
            $("#outputMessages").append('Connected to queue pm<br />');
            client.subscribe(pmQueue, function(m) {
                observer.onNext(parseMessage(m.body));
            });
        },
        function() {
            client.disconnect();
            observer.onCompleted();
        }
    );

    return function () {
        $("#outputMessages").append('Connection for queue closed');
        client.disconnect();
    }
}).map(function(message){

    return message.data[0];
}).filter(function(message) {
    console.log(message);

    return message.new == true;
});

/// Create observer
var pmObserver = Rx.Observer.create(
    function (x) {
        console.log('observer:');
        console.log(x);
    },
    function (e) { console.log('onError: %s', e); },
    function () { console.log('completed pm'); }
);

setTimeout(function() {
    var subscription = pmSource.subscribe(pmObserver);
}, 2000);


