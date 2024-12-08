document.getElementById("loginFormElement").addEventListener("submit", function(event) {
    event.preventDefault();

    // Get the username and password values
    const username = document.getElementById("username").value;
    const password = document.getElementById("password").value;

    // Simple validation (In a real app, you'd check against a database or API)
    if (username === "coffee" && password === "shop123") {
        alert("Login successful!");
        window.location.href = "menu.html";
    } else {
        document.getElementById("errorMessage").innerText = "Invalid username or password.";
    }
});

// Toggle between Login and Register forms
const loginToggle = document.getElementById("loginToggle");
const registerToggle = document.getElementById("registerToggle");
const loginForm = document.getElementById("loginForm");
const registerForm = document.getElementById("registerForm");

loginToggle.addEventListener("click", () => {
    loginForm.classList.remove("hidden");
    registerForm.classList.add("hidden");
    loginToggle.classList.add("active");
    registerToggle.classList.remove("active");
});

registerToggle.addEventListener("click", () => {
    registerForm.classList.remove("hidden");
    loginForm.classList.add("hidden");
    registerToggle.classList.add("active");
    loginToggle.classList.remove("active");
});
