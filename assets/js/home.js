document.addEventListener("DOMContentLoaded", () => {
    const hours = new Date().getHours();
    let greet = "Hello";
    if (hours < 12) greet = "Good Morning 🌞";
    else if (hours < 18) greet = "Good Afternoon ☀️";
    else greet = "Good Evening 🌙";

    const header = document.querySelector("header p");
    if (header) header.innerHTML = greet + ", " + header.innerHTML;
});
