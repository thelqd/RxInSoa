// parse a string to JSON
function parseMessage(message) {
    return JSON.parse(message);
}

// Get the Company name for given Ident
function mapCompanyName(ident) {
    var names = {
        AEG: "AEG",
        SIE: 'Siemens',
        DBB: 'Deutsche Bahn',
        EAS: 'Airbus'
    };
    return names[ident];
}

// Creates a single table row for ticker
function createTableRow(rowData) {
    var tBody = "<tr>";
    tBody += "<td>" + mapCompanyName(rowData.ident) + "</td>";
    tBody += "<td>" + rowData.ident + "</td>";
    tBody += "<td>" + rowData.value + "</td>";
    tBody += "</tr>";
    return tBody;
}

function writeDebugMessage(message) {
    $("#outputMessages").append(message+'<br />');
}

function showMessage(item) {
    $(item).next(".pmBody").toggle();
}

function createPmEntry(elem) {
    var pmBody = "",
        pmCount = parseInt($("#pmCount").html());
    pmBody += '<div class="pmBox">';
    pmBody += '<div class="pmTitle" onclick="showMessage(this)">';
    pmBody += elem.topic;
    pmBody += ' von '+ elem.sender;
    pmBody += '</div>';
    pmBody += '<div class="pmBody">';
    pmBody += elem.text;
    pmBody += '</div>';
    pmBody += '</div>';
    $("#pmResult").prepend(pmBody);

    pmCount++;
    $("#pmCount").html(pmCount);




}
