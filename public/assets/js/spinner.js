var pre = document.createElement("div");
pre.innerHTML = '<div class="loader-wrapper w-100 h-100"><div class="loader">Loading...</div></div>';
document.body.insertBefore(pre, document.body.firstChild);

document.addEventListener("DOMContentLoaded", function(event) {
    document.body.className += " loaded"
});
