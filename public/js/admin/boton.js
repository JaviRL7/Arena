var blueResult = document.getElementById("team_blue_result");
var redResult = document.getElementById("team_red_result");

resultToggle.addEventListener("change", function () {
    if (this.checked) {
        blueResult.value = "W";
        redResult.value = "L";
    } else {
        blueResult.value = "L";
        redResult.value = "W";
    }
});
