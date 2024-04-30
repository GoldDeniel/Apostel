console.log("")
const orderButton = document.getElementById('orderButton');
const aszfCheckbox = document.getElementById('aszfCheckbox');

aszfCheckbox.addEventListener('change', function() {
    console.log('aszfCheckbox changed');
    if (aszfCheckbox.checked) {
        orderButton.hidden = false;
    } else {
        orderButton.hidden = true;
    }
}
);