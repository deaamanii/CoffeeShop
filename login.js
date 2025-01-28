// // Login functionality
// document.getElementById("loginFormElement").addEventListener("submit", function (event) {
//     event.preventDefault();

//     const formData = new FormData(this);

//     fetch('loginController.php', {
//         method: 'POST',
//         headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
//         body: new URLSearchParams({
//             username: 'your_username',
//             password: 'your_password',
//         }),
//     })
//         .then((response) => {
//             if (!response.ok) {
//                 throw new Error("Network response was not ok");
//             }
//             return response.json(); // Parse JSON response
//         })
//         .then((data) => {
//             if (data.error) {
//                 document.getElementById("errorMessage").style.color = "red";
//                 document.getElementById("errorMessage").innerText = data.error;
//             } else if (data.success) {
//                 document.getElementById("errorMessage").style.color = "green";
//                 document.getElementById("errorMessage").innerText = "Login successful!";
//                 setTimeout(() => {
//                     window.location.href = "menu.php"; // Redirect to the desired page
//                 }, 1000);
//             }
//         })
//         .catch((error) => {
//             console.error("Error:", error);
//             document.getElementById("errorMessage").style.color = "red";
//             document.getElementById("errorMessage").innerText =
//                 "An error occurred. Please try again later.";
//         });
// });

// // Registration functionality
// document.getElementById("registerFormElement").addEventListener("submit", function (event) {
//     event.preventDefault();

//     const formData = new FormData(this);

//     fetch("registerController.php", { // Ensure the path to PHP is correct
//         method: "POST",
//         body: formData,
//     })
//         .then((response) => {
//             if (!response.ok) {
//                 throw new Error("Network response was not ok");
//             }
//             return response.json(); // Parse JSON response
//         })
//         .then((data) => {
//             if (data.error) {
//                 document.getElementById("registerErrorMessage").style.color = "red";
//                 document.getElementById("registerErrorMessage").innerText = data.error;
//             } else if (data.success) {
//                 document.getElementById("registerErrorMessage").style.color = "green";
//                 document.getElementById("registerErrorMessage").innerText = data.success;
//                 setTimeout(() => {
//                     document.getElementById("registerToggle").click(); // Switch to login form
//                 }, 2000);
//             }
//         })
//         .catch((error) => {
//             console.error("Error:", error);
//             document.getElementById("registerErrorMessage").style.color = "red";
//             document.getElementById("registerErrorMessage").innerText =
//                 "An error occurred. Please try again later.";
//         });
// });

// // Toggle between Login and Register forms
// const loginToggle = document.getElementById("loginToggle");
// const registerToggle = document.getElementById("registerToggle");
// const loginForm = document.getElementById("loginForm");
// const registerForm = document.getElementById("registerForm");

// loginToggle.addEventListener("click", () => {
//     loginForm.classList.remove("hidden");
//     registerForm.classList.add("hidden");
//     loginToggle.classList.add("active");
//     registerToggle.classList.remove("active");
// });

// registerToggle.addEventListener("click", () => {
//     registerForm.classList.remove("hidden");
//     loginForm.classList.add("hidden");
//     registerToggle.classList.add("active");
//     loginToggle.classList.remove("active");
// });

// Funksioni për të shtuar event listener për validimin e të dhënave
// function validate() {
//     const elementList = document.getElementsByClassName("inputs-field");
//     for (let i = 0; i < elementList.length; i++) {
//         elementList[i].addEventListener("keyup", function (event) {
//             console.log(event.target.value);
//         });
//     }
// }

// // Funksioni për të validuar formularin e login ose regjistrimit
// function validateForm(number) {
//     const inputElements = document.getElementsByClassName("inputs");

//     if (number === 0) {
//         const usernameValue = inputElements[0].value;
//         const passwordValue = inputElements[1].value;

//         if (usernameValue.length < 5 || passwordValue.length < 6) {
//             alert("Ju lutem mbushni të gjitha të dhënat saktë (Username: 5 karaktere, Password: 6 karaktere).");
//         } else {
//             alert("U kyqët me sukses!");
//         }
//     } else if (number === 1) {
//         const rNameValue = inputElements[3].value;
//         const rLastnameValue = inputElements[4].value;
//         const rUsernameValue = inputElements[5].value;
//         const rPasswordValue = inputElements[6].value;

//         if (
//             rNameValue.length < 3 ||
//             rLastnameValue.length < 3 ||
//             rUsernameValue.length < 5 ||
//             rPasswordValue.length < 6
//         ) {
//             alert("Ju lutem mbushni të gjitha të dhënat saktë (Emri/Mbiemri: 3 karaktere, Username: 5, Password: 6).");
//         } else {
//             alert("Regjistrimi u krye me sukses!");
//         }
//     }
// }

// // Funksioni për të ndryshuar midis formularëve të login dhe regjistrimit
// function changeForm(number) {
//     const forms = document.getElementsByClassName("forms");
//     if (number === 0) {
//         forms[0].classList.remove("hidden");
//         forms[0].classList.add("form-style");
//         forms[1].classList.add("hidden");
//         forms[1].classList.remove("form-style");
//     } else if (number === 1) {
//         forms[1].classList.remove("hidden");
//         forms[1].classList.add("form-style");
//         forms[0].classList.add("hidden");
//         forms[0].classList.remove("form-style");
//     }
// }

// // Funksionet për validimin e fushave individuale
// function validateField(inputElement, minLength) {
//     if (inputElement.value.length < minLength) {
//         inputElement.style.border = "solid 1px red";
//     } else {
//         inputElement.style.border = "";
//     }
// }

// // Shto event listener për validimin e fushave
// const username = document.querySelector("#username-input");
// const password = document.querySelector("#password-input");
// const emri = document.querySelector("#emri-input");
// const mbiemri = document.querySelector("#mbiemri-input");
// const rusername = document.querySelector("#rusername-input");
// const rpassword = document.querySelector("#rpassword-input");

// if (username) {
//     username.addEventListener("keyup", () => validateField(username, 5));
// }

// if (password) {
//     password.addEventListener("keyup", () => validateField(password, 6));
// }

// if (emri) {
//     emri.addEventListener("keyup", () => validateField(emri, 3));
// }

// if (mbiemri) {
//     mbiemri.addEventListener("keyup", () => validateField(mbiemri, 3));
// }

// if (rusername) {
//     rusername.addEventListener("keyup", () => validateField(rusername, 5));
// }

// if (rpassword) {
//     rpassword.addEventListener("keyup", () => validateField(rpassword, 6));
// }


// document.addEventListener("DOMContentLoaded", function () {
//     const registerForm = document.querySelector("#registerFormElement");
//     const registerErrorMessage = document.querySelector("#registerErrorMessage");

//     registerForm.addEventListener("submit", function (event) {
//         event.preventDefault();

//         const username = document.querySelector("#username").value.trim();
//         const email = document.querySelector("#email").value.trim();
//         const password = document.querySelector("#password").value.trim();
//         const confirmPassword = document.querySelector("#confirmPassword").value.trim();

//         // Create a FormData object
//         const formData = new FormData();
//         formData.append("username", username);
//         formData.append("email", email);
//         formData.append("password", password);
//         formData.append("confirmPassword", confirmPassword);

//         // Send the form data to the server using fetch
//         fetch('registerController.php', {
//             method: 'POST',
//             body: formData
//         })
//             .then((response) => response.json())
//             .then((data) => {
//                 if (data.success) {
//                     registerErrorMessage.textContent = "Registration successful! Redirecting...";
//                     registerErrorMessage.style.color = "green";
//                     setTimeout(() => {
//                         window.location.href = "index.php"; // Ose vendos URL-në ku dëshiron të ridrejtohesh
//                     }, 1000);
//                 } else {
//                     registerErrorMessage.textContent = data.error;
//                     registerErrorMessage.style.color = "red";
//                 }
//             })
//             .catch((error) => {
//                 console.error("Error:", error);
//                 registerErrorMessage.textContent = "An unexpected error occurred.";
//                 registerErrorMessage.style.color = "red";
//             });
//     });
// });