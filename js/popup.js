// popup.js
const section = document.querySelector("section"),
      overlay = document.querySelector(".overlay"),
      closeBtn = document.querySelector(".close-btn");

function showPopup() {
    section.classList.add("active");
}

overlay.addEventListener("click", () => section.classList.remove("active"));
closeBtn.addEventListener("click", () => section.classList.remove("active"));
