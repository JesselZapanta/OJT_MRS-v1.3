// SIDEBAR COLLAPSE
const toggleSidebar = document.querySelector("nav .toggle-sidebar");
const allSideDivider = document.querySelectorAll("#sidebar .divider");

if (sidebar.classList.contains("hide")) {
    allSideDivider.forEach((item) => {
        item.textContent = "-";
    });
} else {
    allSideDivider.forEach((item) => {
        item.textContent = item.dataset.text;
    });
}

toggleSidebar.addEventListener("click", function () {
    sidebar.classList.toggle("hide");

    if (sidebar.classList.contains("hide")) {
        allSideDivider.forEach((item) => {
            item.textContent = "-";
        });
    } else {
        allSideDivider.forEach((item) => {
            item.textContent = item.dataset.text;
        });
    }
});

// PROFILE DROPDOWN
const profile = document.querySelector("nav .profile");
const imgProfile = profile.querySelector("img");
const dropdownProfile = profile.querySelector(".profile-link");

imgProfile.addEventListener("click", function () {
    dropdownProfile.classList.toggle("show");
});

// MENU
const allMenu = document.querySelectorAll("main .content-data .head .menu");

allMenu.forEach((item) => {
    const icon = item.querySelector(".icon");
    const menuLink = item.querySelector(".menu-link");

    icon.addEventListener("click", function () {
        menuLink.classList.toggle("show");
    });
});

// Status

// Function to update status colors based on text
function updateStatusColor() {
    // Select all elements with the "status" class
    var statusElements = document.querySelectorAll(".status");

    statusElements.forEach(function (element) {
        var statusText = element.innerText.toLowerCase();

        // Remove any existing status classes
        element.classList.remove("pending", "declined", "approved");

        // Apply the appropriate class based on status text
        if (statusText === "pending") {
            element.classList.add("pending");
        } else if (statusText === "declined") {
            element.classList.add("declined");
        } else if (statusText === "approved") {
            element.classList.add("approved");
        }
    });
}

// Call the function on page load
updateStatusColor();
