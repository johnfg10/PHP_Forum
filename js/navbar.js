window.onload = function (ev) {
    handleResize();
};

window.onresize = function (ev) {
    handleResize();
};

window.onclick = function(ev) {
    if (!ev.target.matches('.navbar-dropdown-btn')) {
        $(".navbar-dropdown-content").hide()
    }
};

function handleResize() {
    //console.info($(document).width());
    if($(document).width() < 991) {
        $("#userdiv").hide();
        $("#userItem").show()

    }else {
        $("#userdiv").show();
        $("#userItem").hide()
    }
}

function handleNavbarDropdownClick() {
    $(".navbar-dropdown-content").toggle();
}