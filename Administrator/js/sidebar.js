const sidebar = document.getElementById("sidebar");
const main = document.querySelector(".main");
const toggleBtn = document.getElementById("sidebarToggle");

let state = localStorage.getItem("sidebarState") || "full";

/*
States:
full   = 280px
mini   = 80px
hidden = off canvas
*/

function applyState(){

    sidebar.classList.remove("mini","hidden");
    main.classList.remove("mini","hidden");

    if(state === "mini"){
        sidebar.classList.add("mini");
        main.classList.add("mini");
    }

    if(state === "hidden"){
        sidebar.classList.add("hidden");
        main.classList.add("hidden");
    }

    localStorage.setItem("sidebarState", state);
}

applyState();

/* TOGGLE BUTTON */
toggleBtn.addEventListener("click", () => {

    if(state === "full"){
        state = "mini";
    }
    else if(state === "mini"){
        state = "hidden";
    }
    else{
        state = "full";
    }

    applyState();
});

/* =========================
   ACCORDION FIX
   ONLY ONE OPEN AT A TIME
========================= */

const collapses = document.querySelectorAll(".collapse");

collapses.forEach(item => {

    item.addEventListener("show.bs.collapse", function () {

        collapses.forEach(other => {
            if(other !== item){
                let bsCollapse = bootstrap.Collapse.getInstance(other);
                if(bsCollapse){
                    bsCollapse.hide();
                }
            }
        });

    });

});