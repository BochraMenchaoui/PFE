$("textarea").keydown(function (e) {
    // Enter pressed
    if (e.keyCode == 13) {
        //method to prevent from default behaviour
        e.preventDefault();
        document.getElementById("sendMessage").click();
    }
});