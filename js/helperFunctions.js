

function showAlert(alertType, msg) {
    let alertPlaceholder = document.querySelector('.alerts');
    let alert = document.createElement('div');
    alert.className = 'alert ';
    alert.className += alertType;
    alert.className += ' overlap ';
    alert.className += ' d-flex justify-content-center ';
    alert.setAttribute("role", "alert");
    alert.innerText = msg;
    alertPlaceholder.append(alert);
    setTimeout(() => {
        alertPlaceholder.removeChild(alert);
    },4000);
}