function showPassword() {
    var x = document.getElementById("password");
    if (x.type === "password") {
        x.type = "text";
    } else {
        x.type = "password";
    }
}

function showPasswordConfirm() {
    var x = document.getElementById("password_confirm");
    if (x.type === "password") {
        x.type = "text";
    } else {
        x.type = "password";
    }
}