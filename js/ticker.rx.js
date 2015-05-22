/**
 * Implementation of a reactive JS ticker
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

var promise = new Promise(function(resolve, reject) {
    // do a thing, possibly async, then…

    if (true/* everything turned out fine */) {
        resolve("Stuff worked!");
    }
    else {
        reject(Error("It broke"));
    }
});

promise.then(function(result) {
    console.log(result); // "Stuff worked!"
}, function(err) {
    console.log(err); // Error: "It broke"
});