// Login functionality
document.getElementById("loginFormElement").addEventListener("submit", function (event) {
    event.preventDefault();

    const formData = new FormData(this);

    fetch("loginController.php", { // Ensure the path to PHP is correct
        method: "POST",
        body: formData,
    })
        .then((response) => {
            if (!response.ok) {
                throw new Error("Network response was not ok");
            }
            return response.json(); // Parse JSON response
        })
        .then((data) => {
            if (data.error) {
                document.getElementById("errorMessage").style.color = "red";
                document.getElementById("errorMessage").innerText = data.error;
            } else if (data.success) {
                document.getElementById("errorMessage").style.color = "green";
                document.getElementById("errorMessage").innerText = "Login successful!";
                setTimeout(() => {
                    window.location.href = "menu.html"; // Redirect to the desired page
                }, 1000);
            }
        })
        .catch((error) => {
            console.error("Error:", error);
            document.getElementById("errorMessage").style.color = "red";
            document.getElementById("errorMessage").innerText =
                "An error occurred. Please try again later.";
        });
});

// Registration functionality
document.getElementById("registerFormElement").addEventListener("submit", function (event) {
    event.preventDefault();

    const formData = new FormData(this);

    fetch("registerController.php", { // Ensure the path to PHP is correct
        method: "POST",
        body: formData,
    })
        .then((response) => {
            if (!response.ok) {
                throw new Error("Network response was not ok");
            }
            return response.json(); // Parse JSON response
        })
        .then((data) => {
            if (data.error) {
                document.getElementById("registerErrorMessage").style.color = "red";
                document.getElementById("registerErrorMessage").innerText = data.error;
            } else if (data.success) {
                document.getElementById("registerErrorMessage").style.color = "green";
                document.getElementById("registerErrorMessage").innerText = data.success;
                setTimeout(() => {
                    document.getElementById("registerToggle").click(); // Switch to login form
                }, 2000);
            }
        })
        .catch((error) => {
            console.error("Error:", error);
            document.getElementById("registerErrorMessage").style.color = "red";
            document.getElementById("registerErrorMessage").innerText =
                "An error occurred. Please try again later.";
        });
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
