var counta = document.getElementById('counta');
var display = 0;

function hideShow() {
    if (display == 1) {
        counta.style.display = 'block';
        display = 0;
    } else {
        counta.style.display = 'none';
        display = 1;
    }
}