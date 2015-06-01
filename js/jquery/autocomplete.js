$(document).ready(function() {
    $("#autoComplete").typeWatch({
        callback:function() {
            var request = $.ajax({
                url: 'soa/daemon.php',
                dataType: 'json',
                data: {
                    job: 'autocomplete',
                    keyword: $(this).val()
                }
            }).promise();

            request.then(function(response) {
                if(response.data.length > 0) {
                    var overlay = $("#autoCompleteOverlay");
                    overlay.hide().empty();
                    for (var i in response.data) {
                        overlay.append(
                            "<li class='menuItem' onclick='selectItem(this)'>" +
                            response.data[i] +
                            "</li>"
                        );
                    }
                    overlay.show();
                }
            },
            function(jqXHR, textStatus) {
                writeDebugMessage("Autocomplete request failed: " + textStatus);
            });

        },
        wait:500,
        highlight:false,
        captureLength:3
    });
});