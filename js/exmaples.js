// Create Observable
var integerRange = Rx.Observable.range(1, 5);

// Create Observer
var observer = Rx.Observer.create(
    function (x) { console.log('onNext: %s', x); },
    function (e) { console.log('onError: %s', e); },
    function () { console.log('onCompleted'); }
);

// Subscribe Observer
var subscription = integerRange.subscribe(observer);


console.log(integerRange);


var forLoop = Rx.Observable.generate(
    0,
    function (x) { return x <= 10; },
    function (x) { return x + 2; },
    function (x) { return x; }
);

console.log(forLoop);

var faculty = Rx.Observable.range(1, 5)
.reduce(function (n, x) {
    return n * x;
}, 1);


console.log(faculty);

Rx.Observable
    .range(1, 3)
    .flatMap(function(x) {
        return [x * x,
            x * x * x];
    },
    function(x, y, indexX, indexY)
    {
        return { x : x, y : y, indexX : indexX, indexY : indexY };
    }
);