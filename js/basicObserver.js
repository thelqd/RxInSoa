/**
 * Created by ds on 18.05.15.
 */
var source = Rx.Observable.create(function (observer) {
    // Yield a single value and complete
    observer.onNext(42);
    observer.onNext(56);
    observer.onNext(128);
    observer.onCompleted();

    // Any cleanup logic might go here
    return function () {
        console.log('disposed');
    }
});

/// Create observer
var observer = Rx.Observer.create(
    function (x) { console.log('onNext: %s', x); },
    function (e) { console.log('onError: %s', e); },
    function () { console.log('onCompleted'); });

// Prints out each item
var subscription = source.subscribe(observer);

console.log("-------------------------");
console.log('Current time: ' + Date.now());

var sourceTimer = Rx.Observable.timer(
    5000, /* 5 seconds */
    1000 /* 1 second */)
    .timestamp();

var subscriptionTimer = sourceTimer.subscribe(
    function (x) {
        if(x.value > 10) {
            subscriptionTimer.dispose();
        }
        console.log(x.value + ': ' + x.timestamp);
    });

console.log('Current time: ' + Date.now());

// Creates a sequence
var sourceHot = Rx.Observable.interval(1000);

// Convert the sequence into a hot sequence
var hot = sourceHot.publish();

// No value is pushed to 1st subscription at this point
var subscription1 = hot.subscribe(
    function (x) { console.log('Observer 1: onNext: %s', x); },
    function (e) { console.log('Observer 1: onError: %s', e); },
    function () { console.log('Observer 1: onCompleted'); });

console.log('Current Time after 1st subscription: ' + Date.now());

// Idle for 3 seconds
setTimeout(function () {

    // Hot is connected to source and starts pushing value to subscribers
    hot.connect();

    console.log('Current Time after connect: ' + Date.now());

    // Idle for another 3 seconds
    setTimeout(function () {

        console.log('Current Time after 2nd subscription: ' + Date.now());

        var subscription2 = hot.subscribe(
            function (x) { console.log('Observer 2: onNext: %s', x); },
            function (e) { console.log('Observer 2: onError: %s', e); },
            function () { console.log('Observer 2: onCompleted'); });
        setTimeout(function() {
            console.log("dispose sub2 after 10 sek");
            subscription2.dispose()
        }, 10000);

    }, 3000);
}, 1000);

setTimeout(function(){
    subscription1.dispose();
    console.log("disposed sub1");
}, 20000)

setTimeout(function() {
    console.log('Current Time after 3rd subscription: ' + Date.now());

    var subscription3 = hot.subscribe(
        function (x) { console.log('Observer 2: onNext: %s', x); },
        function (e) { console.log('Observer 2: onError: %s', e); },
        function () { console.log('Observer 2: onCompleted'); });
    //subscription3.dispose();
}, 25000)