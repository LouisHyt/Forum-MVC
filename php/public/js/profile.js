const themeColor = document.querySelector("#themeColor");
const currentColor = document.querySelector(".current-color");

const applyButton = document.querySelector("button.apply");
const resetButton = document.querySelector("button.reset");


const baseColor = "#4F9AE1";
const colorThemeSaved = localStorage.getItem("themeColor");

themeColor.value = colorThemeSaved ? colorThemeSaved : baseColor;
currentColor.textContent = colorThemeSaved ? colorThemeSaved : baseColor;


themeColor.addEventListener("input", e => {
    const color = e.target.value;
    currentColor.textContent = color;
    document.documentElement.style.setProperty("--accent-color", color);
})

applyButton.addEventListener("click", () => {
    const selectedColor = themeColor.value;
    localStorage.setItem("themeColor", selectedColor);
})


resetButton.addEventListener("click", () => {
    themeColor.value = baseColor;
    currentColor.textContent = baseColor;
    document.documentElement.style.setProperty("--accent-color", baseColor);
    localStorage.removeItem("themeColor", baseColor);
})