const showLogIn = document.getElementById("showLogIn");
const showSignIn = document.getElementById("showSignIn");
const logIn = document.getElementById("logIn");
const signIn = document.getElementById("signIn");

showLogIn.addEventListener("click", () => {
  signIn.style.display = "none";
  logIn.style.display = "block";
});

showSignIn.addEventListener("click", () => {
  logIn.style.display = "none";
  signIn.style.display = "block";
});
