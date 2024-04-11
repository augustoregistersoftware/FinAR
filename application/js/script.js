console.log("Script loaded");

function goValida(id) {
    (async () => {
        var id_login = id;
         const { value: password } = await Swal.fire({
            title: "Digite A Senha",
            input: "password",
            inputLabel: "Password",
            inputPlaceholder: "Enter your password",
            inputAttributes: {
            maxlength: "10",
            autocapitalize: "off",
            autocorrect: "off"
            }
        });
        if (password === "9846") {
            senha(id_login);
        }else{
            Swal.fire({
            title: "Oops...",
            text: "Senha Incorreta!",
            icon: "error"
            });
        }
    })()
}



