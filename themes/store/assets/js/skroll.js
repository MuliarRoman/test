var lastScrollTop = 0;
var myBlock = document.getElementById("myBlock");

window.addEventListener("scroll", function() {
    var currentScroll = window.pageYOffset || document.documentElement.scrollTop;
    if (currentScroll > lastScrollTop) {
        // Прокручування вниз
        myBlock.classList.add("hidden");
        console.log("1232123131");
    } else {
        // Прокручування вверх
        myBlock.classList.remove("hidden");
        console.log("1232123131");
    }
    lastScrollTop = currentScroll;

    console.log("1232123131");
}, false);