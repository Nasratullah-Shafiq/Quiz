const navbar = document.querySelector(".top-navbar");

function applyState(){

    sidebar.classList.remove("mini");
    main.classList.remove("mini");

    if(navbar){
        navbar.classList.remove("mini");
    }

    if(state==="mini"){

        sidebar.classList.add("mini");
        main.classList.add("mini");

        if(navbar){
            navbar.classList.add("mini");
        }

    }

    localStorage.setItem("sidebarState",state);

}