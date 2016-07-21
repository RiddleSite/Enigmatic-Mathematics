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