document.addEventListener("DOMContentLoaded", function() {
    const signUpButton = document.getElementById("signUp");
    const signInButton = document.getElementById("signIn");
    const container = document.querySelector(".container");
    const signUpForm = document.getElementById("signupForm");
    const signInForm = document.getElementById("signinForm");

    signUpButton.addEventListener("click", () => {
        signInForm.style.display = "none";
        signUpForm.style.display = "block";
        signUpButton.style.display = "none";
        signInButton.style.display = "block";
    });

    signInButton.addEventListener("click", () => {
        signUpForm.style.display = "none";
        signInForm.style.display = "block";
        signInButton.style.display = "none";
        signUpButton.style.display = "block";
    });

    // Por defecto, muestra el formulario de inicio de sesión
    signUpForm.style.display = "none";
    signInButton.style.display = "none";
});
