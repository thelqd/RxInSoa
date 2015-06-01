$(document).ready(function() {

    var input = $('#autoComplete');

    var autoCompleteSource = Rx.Observable.fromEvent(input, 'keyup')
        .map(function (e) {
            return e.target.value;
        })
        .filter(function (text) {
            return text.length > 2;
        })
        .debounce(500)
        .distinctUntilChanged()
        .flatMapLatest(function(keyword){
            return $.ajax({
                url: 'soa/daemon.php',
                dataType: 'json',
                data: {
                    job: 'autocomplete',
                    keyword: keyword
                }
            }).promise();
        });

    autoCompleteSource.forEach(
        function (data) {
            if(data.data.length > 0) {
                var overlay = $("#autoCompleteOverlay");
                overlay.hide().empty();
                for (var i in data.data) {
                    overlay.append(
                        "<li class='menuItem' onclick='selectItem(this)'>" +
                        data.data[i] +
                        "</li>"
                    );
                }
                overlay.show();
            }
        },
        function (error) {
            writeDebugMessage('error:'+ error);
        });

});