<div id="sidebar" class="sidebar">

    <!-- Logo -->
    <div class="sidebar-header">

        <button id="sidebarToggle" class="toggle-btn">
            <i class="fa-solid fa-bars"></i>
        </button>

        <div class="logo">
            <span class="logo-text">Quiz Admin</span>
        </div>

    </div>

    <!-- Search -->
    <div class="sidebar-search">
        <input type="text" class="form-control" placeholder="Search menu...">
    </div>

    <!-- Menu -->
    <ul class="sidebar-menu accordion" id="sidebarAccordion">

        <!-- Dashboard -->
        <li>
            <a href="index.php">
                <div>
                    <i class="fa-solid fa-tachometer-alt"></i>
                    <span class="menu-text">Dashboard</span>
                </div>
            </a>
        </li>

        <!-- Quiz -->
        <li>
            <a href="Quiz-Result.php">
                <div>
                    <i class="fa-solid fa-chart-column"></i>
                    <span class="menu-text">Quiz Results</span>
                </div>
            </a>
        </li>

        <!-- QUESTIONS -->
        <li>

            <a class="collapsed" data-bs-toggle="collapse" href="#questionsMenu">
                <div>
                    <i class="fa-solid fa-circle-question"></i>
                    <span class="menu-text">Questions</span>
                </div>
                <i class="fa-solid fa-chevron-down arrow"></i>
            </a>

            <div id="questionsMenu" class="collapse" data-bs-parent="#sidebarAccordion">

                <ul>
                    <li>
                        <a href="Add-Questions.php">
                            <i class="fa-solid fa-plus"></i>
                            Add Questions
                        </a>
                    </li>

                    <li>
                        <a href="question.php">
                            <i class="fa-solid fa-list-check"></i>
                            Manage Questions
                        </a>
                    </li>
                </ul>

            </div>
        </li>

        <!-- SUBJECTS -->
        <li>

            <a class="collapsed" data-bs-toggle="collapse" href="#subjectMenu">
                <div>
                    <i class="fa-solid fa-book"></i>
                    <span class="menu-text">Subjects</span>
                </div>
                <i class="fa-solid fa-chevron-down arrow"></i>
            </a>

            <div id="subjectMenu" class="collapse" data-bs-parent="#sidebarAccordion">

                <ul>
                    <li>
                        <a href="Add-Subject.php">
                            <i class="fa-solid fa-plus"></i>
                            Add Subject
                        </a>
                    </li>

                    <li>
                        <a href="subject">
                            <i class="fa-solid fa-book-open"></i>
                            Manage Subject
                        </a>
                    </li>
                </ul>

            </div>
        </li>

        <!-- FACULTIES -->
        <li>

            <a class="collapsed" data-bs-toggle="collapse" href="#facultyMenu">
                <div>
                    <i class="fa-solid fa-building-columns"></i>
                    <span class="menu-text">Faculties</span>
                </div>
                <i class="fa-solid fa-chevron-down arrow"></i>
            </a>

            <div id="facultyMenu" class="collapse" data-bs-parent="#sidebarAccordion">

                <ul>
                    <li>
                        <a href="Add-Faculty.php">
                            <i class="fa-solid fa-plus"></i>
                            Add Faculty
                        </a>
                    </li>

                    <li>
                        <a href="faculty">
                            <i class="fa-solid fa-building-columns"></i>
                            Manage Faculties
                        </a>
                    </li>
                </ul>

            </div>
        </li>

        <!-- TEACHERS -->
        <li>

            <a class="collapsed" data-bs-toggle="collapse" href="#teacherMenu">
                <div>
                    <i class="fa-solid fa-user-tie"></i>
                    <span class="menu-text">Teachers</span>
                </div>
                <i class="fa-solid fa-chevron-down arrow"></i>
            </a>

            <div id="teacherMenu" class="collapse" data-bs-parent="#sidebarAccordion">

                <ul>
                    <li>
                        <a href="Add-Teacher.php">
                            <i class="fa-solid fa-user-plus"></i>
                            Add Teacher
                        </a>
                    </li>

                    <li>
                        <a href="teacher">
                            <i class="fa-solid fa-users-gear"></i>
                            Manage Teachers
                        </a>
                    </li>
                </ul>

            </div>
        </li>

        <!-- USERS -->
        <li>

            <a class="collapsed" data-bs-toggle="collapse" href="#userMenu">
                <div>
                    <i class="fa-solid fa-users"></i>
                    <span class="menu-text">Users</span>
                </div>
                <i class="fa-solid fa-chevron-down arrow"></i>
            </a>

            <div id="userMenu" class="collapse" data-bs-parent="#sidebarAccordion">

                <ul>
                    <li>
                        <a href="Add-Users.php">
                            <i class="fa-solid fa-user-plus"></i>
                            Create User
                        </a>
                    </li>

                    <li>
                        <a href="users">
                            <i class="fa-solid fa-users"></i>
                            Manage Users
                        </a>
                    </li>
                </ul>

            </div>
        </li>

    </ul>

    <!-- FOOTER -->
<div class="sidebar-footer">

    <a href="#">
        <div>
            <i class="fa-solid fa-gear"></i>
            <span class="menu-text">Settings</span>
        </div>
    </a>

    <a href="logout.php">
        <div>
            <i class="fa-solid fa-right-from-bracket"></i>
            <span class="menu-text">Logout</span>
        </div>
    </a>

</div>

</div>


<script>
  const sidebar = document.getElementById("sidebar");
const main = document.querySelector(".main");
const toggleBtn = document.getElementById("sidebarToggle");

let state = localStorage.getItem("sidebarState") || "full";

/*
States:
full = 280px
mini = 80px
*/

function applyState() {

    // reset
    sidebar.classList.remove("mini");
    main.classList.remove("mini");

    // apply mini mode
    if (state === "mini") {
        sidebar.classList.add("mini");
        main.classList.add("mini");
    }

    // save state
    localStorage.setItem("sidebarState", state);
}

applyState();

/* TOGGLE BUTTON (FULL <-> MINI ONLY) */
toggleBtn.addEventListener("click", () => {

    if (state === "full") {
        state = "mini";
    } else {
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
            if (other !== item) {
                let bsCollapse = bootstrap.Collapse.getInstance(other);
                if (bsCollapse) {
                    bsCollapse.hide();
                }
            }
        });

    });

});
</script>