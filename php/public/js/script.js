const globalThemeColor = localStorage.getItem("themeColor");
if(globalThemeColor){
    document.documentElement.style.setProperty("--accent-color", globalThemeColor);
}
