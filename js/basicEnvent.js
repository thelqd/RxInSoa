/*var move = Rx.Observable.fromEvent(document, 'mousemove');

var points = move.map(function (e) {
    return { x: e.clientX, y: e.clientY };
});

points.subscribe(
    function (pos) {
        console.log('Mouse at point ' + pos.x + ', ' + pos.y);
    });

var source1 = Rx.Observable.interval(2000).take(5);
var proj = Rx.Observable.range(100, 3);
var resultSeq = source1.flatMap(proj);

var subscription = resultSeq.subscribe(
    function (x) { console.log('onNext: ' + x); },
    function (e) { console.log('onError: ' + e.message); },
    function () { console.log('onCompleted'); });

    */
var move = Rx.Observable.fromEvent(document, 'mousemove');

var overfirstbisector = move.map(function (e) {
    return { x: e.clientX, y: e.clientY };
}).filter(function (pos) {
        return pos.x === pos.y;
    }).subscribe(function (pos) {
        console.log('mouse at ' + pos.x + ', ' + pos.y);
});


