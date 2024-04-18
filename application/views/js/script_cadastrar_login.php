<script>
function controleDialog(){

	Swal.fire({
	title: "Lembrete!",
	text: "Use seu melhor e-mail, pois é nele que ira as informações",
	icon: "info"
	});
}

function controleDialog1(){

Swal.fire({
title: "Oops...",
text: "A senha não confere",
icon: "warning"
});
}

	var emailInput = document.getElementById("email");
    emailInput.addEventListener("input", function() {
        var email = emailInput.value;
        if (!email.includes("@")) {
            emailInput.setCustomValidity("El correo electrónico debe contener '@'.");
        } else {
            emailInput.setCustomValidity("");
        }
    });

</script>