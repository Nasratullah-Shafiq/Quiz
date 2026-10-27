document.addEventListener("DOMContentLoaded", function () {

    const sidebar = document.getElementById("sidebar");
    const main = document.querySelector(".main");
    const toggleBtn = document.getElementById("sidebarToggle");

    // Load saved state
    let state = localStorage.getItem("sidebarState") || "full";

    function applyState() {

        // reset
        sidebar.classList.remove("semi", "hidden");
        main.classList.remove("semi", "hidden");

        if (state === "semi") {
            sidebar.classList.add("semi");
            main.classList.add("semi");
        }

        if (state === "hidden") {
            sidebar.classList.add("hidden");
            main.classList.add("hidden");
        }

        localStorage.setItem("sidebarState", state);
    }

    applyState();

    // TOGGLE BUTTON (3 STATES CYCLE)
    toggleBtn.addEventListener("click", function () {

        if (state === "full") {
            state = "semi";
        }
        else if (state === "semi") {
            state = "hidden";
        }
        else {
            state = "full";
        }

        applyState();
    });

    // =========================
    // ACCORDION CONTROL (ONE OPEN ONLY)
    // =========================

    const collapses = document.querySelectorAll(".collapse");

    collapses.forEach((item) => {

        item.addEventListener("show.bs.collapse", function () {

            collapses.forEach((other) => {

                if (other !== item) {

                    const bs = bootstrap.Collapse.getInstance(other);

                    if (bs) bs.hide();

                }

            });

        });

    });

});