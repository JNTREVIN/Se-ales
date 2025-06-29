function getParameterByName(name, url) {
    if (!url) url = window.location.href;
    name = name.replace(/[\[\]]/g, '\\$&');
    var regex = new RegExp('[?&]' + name + '(=([^&#]*)|&|#|$)'),
        results = regex.exec(url);
    if (!results) return null;
    if (!results[2]) return '';
    return decodeURIComponent(results[2].replace(/\+/g, ' '));
}
document.addEventListener('DOMContentLoaded', function() {
    var error = getParameterByName('error');
    if (error === '1') {
        document.getElementById('LLenarC').style.display = 'block';
    }
});

function redireccion(){
    var isAdmin = getParameterByName('admin');
    if (isAdmin === 'true') {
        location.href = "./php/admin.php";
    } else {
        location.href = "./sesion.html";
    }
}
function red(){
    location.href = "formulario.html";
}
function out(){
    location.href = "../logout.php";
}
function re(id) {
    location.href = "./cliente.php?id=" + id;
}

