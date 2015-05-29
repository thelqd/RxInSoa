$(document).ready(function() {
    writeDebugMessage("Starting interval callbacks for ticker every second");

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
