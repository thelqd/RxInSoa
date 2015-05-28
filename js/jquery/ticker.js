$(document).ready(function() {
    $("#outputMessages").append("Starting interval callbacks for ticker <br />");

    setInterval(function() {
        $.get("soa/daemon.php", {job: 'ticker'}, function(ticker) {
            var limit = $("#tickerFilter ").find(":selected").val();
            var tBody = '';
            $.each(ticker.data, function(index, elem) {
                if(limit > 0) {
                    if(elem.value >= limit) {
                        tBody += createTableRow(elem);
                    }
                } else {
                    tBody += createTableRow(elem);
                }
            });
            $("#tickerData").find("tbody").html(tBody);
        }, 'json')
    }, 1000);
});
