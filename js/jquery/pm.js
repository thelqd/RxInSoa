$(document).ready(function() {
    writeDebugMessage("Starting interval callbacks for pm every 2 seconds");

    setInterval(function() {
        $.get("soa/daemon.php", {job: 'pm'}, function(pm) {
            if(pm.data.new == true) {
                createPmEntry(pm.data)
            }
        }, 'json')
    }, 2000);
});