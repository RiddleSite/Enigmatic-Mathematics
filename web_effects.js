function countryChanged(nameSelect)
{
    console.log(nameSelect);
    if (nameSelect) {
        USOptionValue = document.getElementById("USOption").value;
        if (USOptionValue == nameSelect.value) {
            document.getElementById("stateDropLabel").style.display = "inline";
            document.getElementById("stateDrop").style.display = "inline-block";
        }
        else {
            document.getElementById("stateDropLabel").style.display = "none";
            document.getElementById("stateDrop").style.display = "none";
        }
    }
    else {
            document.getElementById("stateDropLabel").style.display = "inline";
            document.getElementById("stateDrop").style.display = "inline-block";
    }
}

function toggle(element, newOrOld) {
    var id = element.id;
    var oldSelect = document.getElementById("selectedAge");
    var inputTracker = document.getElementById("newOrOld");
    if (newOrOld == 'new'){
        if (id == 'selected') {
            return 0;
        }
        else {
            oldSelect.id = "nullAge";
            oldSelect.className = "sortAgeButtonBlank";
            element.className = "sortAgeButtonSelected";
            element.id = "selectedAge";
            inputTracker.value = "new";
        }
    }
    else {
        if (id == 'selected'){
            return 0;
        }
        else {
            oldSelect.id = "nullAge";
            oldSelect.className = "sortAgeButtonBlank";
            element.className = "sortAgeButtonSelected";
            element.id = "selectedAge";
            inputTracker.value = "old";
        }
    }
}

function changeInputName(element) {
    var value = element.value;
    var textbox = document.getElementById("searchyInput");
    if (value == "ID") {
        textbox.name = "id";
    }
    else if (value == "Author") {
        textbox.name = "author";
    }
    else if (value == "Keyword") {
        textbox.name = "keyword";
    }
}