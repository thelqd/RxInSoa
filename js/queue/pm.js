var pmQueue = 'pm';

var pmSource = Rx.Observable.create(function (observer) {
    var client = Stomp.client(mq_url);
    client.debug = null;
    client.connect(
        mq_username,
        mq_password,
        function on_connect() {
            writeDebugMessage('Connected to queue pm');
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
        writeDebugMessage('Connection for queue pm closed');
        client.disconnect();
    }
}).map(function(message){
    return message.data;
}).filter(function(message) {
    return message.new == true;
});

/// Create observer
var pmObserver = Rx.Observer.create(
    function (x) {
        createPmEntry(x);
    },
    function (e) { console.log('pm error: %s', e); },
    function () { console.log('completed pm'); }
);

setTimeout(function() {
    var subscription = pmSource.subscribe(pmObserver);
}, 2000);


