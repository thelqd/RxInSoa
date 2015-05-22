$(document).ready(function() {

    var $input = $('#input'),
        $results = $('#results');

    /* Only get the value from each key up */
    var keyups = Rx.Observable.fromEvent($input, 'keyup')
        .map(function (e) {
            return e.target.value;
        })
        .filter(function (text) {
            return text.length > 2;
        });

    /* Now debounce the input for 500ms */
    var debounced = keyups
        .debounce(500 /* ms */);

    /* Now get only distinct values, so we eliminate the arrows and other control characters */
    var distinct = debounced
        .distinctUntilChanged();

    function searchWikipedia(term) {
        return $.ajax({
            url: 'http://en.wikipedia.org/w/api.php',
            dataType: 'jsonp',
            data: {
                action: 'opensearch',
                format: 'json',
                search: term
            }
        }).promise();
    }

    var suggestions = distinct
        .flatMapLatest(searchWikipedia);

    suggestions.forEach(
        function (data) {
            $results
                .empty()
                .append($.map(data[1], function (value) {
                return $('<li>').text(value);
            }));
        },
        function (error) {
            $results
                .empty()
                .append($('<li>'))
                .text('Error:' + error);
        });


});