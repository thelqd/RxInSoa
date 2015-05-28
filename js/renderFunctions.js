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