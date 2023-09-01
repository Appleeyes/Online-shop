// Navbar Start

const bar = document.getElementById("bar");
const close = document.getElementById("close");
const nav = document.getElementById("navbar");

if (bar) {
  bar.addEventListener("click", () => {
    nav.classList.add("active");
  });
}

if (close) {
  close.addEventListener("click", () => {
    nav.classList.remove("active");
  });
}

// Navbar ends

// hide or show password

document.getElementById("showPassword").addEventListener("change", function () {
  var passwordInput = document.getElementById("password");
  if (this.checked) {
    passwordInput.type = "text";
  } else {
    passwordInput.type = "password";
  }
});

document.getElementById("showPassword1").addEventListener("change", function () {
  var passwordInput = document.getElementById("confirm_password");
  if (this.checked) {
    passwordInput.type = "text";
  } else {
    passwordInput.type = "password";
  }
});