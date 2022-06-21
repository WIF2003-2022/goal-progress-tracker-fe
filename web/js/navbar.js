const template = document.createElement("template");
template.innerHTML = `
  <div class="nav-wrapper">
    <div class="navbar">
      <div class="logo">
        <h4>
          Goal Progress <br />
          Tracker System
        </h4>
      </div>
      <i
        class="bi-chevron-left nav-link large"
        id="toggle-btn"
        tabindex="0"
      ></i>
      <h3 id="page-title"></h3>
      <div class="dropdown m-2 noti-dropdown">
        <i
          class="bi bi-bell-fill nav-link position-relative large"
          tabindex="0"
          data-bs-toggle="dropdown"
        >
          <span
            class="position-absolute translate-middle badge rounded-pill bg-danger no-select unread-num"
            style="font-size: 0.75rem; font-style:normal;left:75%;display:none;"
          >
            2
          </span>
        </i>
        <ul class="dropdown-menu dropdown-menu-end notifications" style="width:350px">
          <li><h6 class="dropdown-header">Notifications</h6></li>
        </ul>
      </div>
      <div class="dropdown m-2">
        <button
          class="btn dropdown-toggle"
          type="button"
          data-bs-toggle="dropdown"
        >
          <img
            class="avatar"
            id="profilePic"
          />
        </button>
        <ul class="dropdown-menu dropdown-menu-end" style="width:200px">
          <li>
            <a
              class="dropdown-item d-flex align-items-center"
              href="./profile.php"
            >
              <i class="bi bi-person-fill pe-3 large"></i>
              Profile
            </a>
          </li>
          <li>
            <a
              class="dropdown-item d-flex align-items-center"
              href="src/handleLogout.php"
            >
              <i class="bi bi-door-open-fill pe-3 large"></i>
              Sign Out
            </a>
          </li>
        </ul>
      </div>
    </div>
    <div class="sidebar" id='nav-div'>
      <nav class="nav nav-pills flex-column">
        <a
          class="nav-link"
          href="./index.php"
          data-bs-toggle="tooltip"
          title="Home"
        >
          <i class="bi-house-door-fill"></i>
          <span>Home</span>
        </a>
        <a
          class="nav-link"
          href="./goal.php"
          data-bs-toggle="tooltip"
          title="Goals"
        >
          <i class="bi-flag-fill"></i>
          <span>Goals</span>
        </a>
        <a
          class="nav-link"
          href="./visualisation.php"
          data-bs-toggle="tooltip"
          title="Report"
        >
          <i class="bi bi-clipboard2-data"></i>
          <span>Report</span>
        </a>
        <a
          class="nav-link"
          href="./social.php"
          data-bs-toggle="tooltip"
          title="Social"
        >
          <i class="bi-people-fill"></i>
          <span>Social</span>
        </a>
      </nav>
    </div>
  </div>
`;

class NavBar extends HTMLElement {
  connectedCallback() {
    this.appendChild(template.content.cloneNode(true));
    this.initPage();
    const mq = window.matchMedia("(max-width: 750px)");
    function changeBarType(mq) {
      let navDiv = document.querySelector("#nav-div");
      let nav = document.querySelector("nav");
      console.log(mq.matches);
      if (mq.matches) {
        navDiv.classList.remove("sidebar");
        navDiv.classList.add("bottombar");
        nav.classList = "nav nav-pills flex-row";
      } else {
        navDiv.classList.remove("bottombar");
        navDiv.classList.add("sidebar");
        nav.classList = "nav nav-pills flex-column";
      }
    }
    changeBarType(mq);
    // need to run once first because change event does not occur when the page first load up
    mq.addEventListener("change", changeBarType);
    const sidebarTooltip = this.initTooltip(".sidebar", "right", true);
    document.querySelector("#toggle-btn").addEventListener("click", () => {
      document.querySelector(".content-wrapper").classList.toggle("min");
      const isClosed = document
        .querySelector(".sidebar")
        .classList.toggle("min");
      const icon = document.querySelector("#toggle-btn");
      if (isClosed) {
        icon.classList.replace("bi-chevron-left", "bi-chevron-right");
      } else {
        icon.classList.replace("bi-chevron-right", "bi-chevron-left");
      }
      sidebarTooltip.forEach((element) => {
        if (isClosed) {
          element.enable();
        } else {
          element.disable();
        }
      });
    });
    const getPhoto = new XMLHttpRequest();
    getPhoto.responseType = "json";
    getPhoto.open("GET", "./src/getPhoto.php");
    getPhoto.send();
    getPhoto.onload = function () {
      let photo = "./images/default-user.png";
      if (getPhoto.response.photo && getPhoto.response.photo.length !== 0) {
        photo = getPhoto.response.photo;
      }
      document.querySelector("#profilePic").src = photo;
    };
    document
      .querySelector(".noti-dropdown")
      .addEventListener("hidden.bs.dropdown", () => {
        const updateNotification = new XMLHttpRequest();
        updateNotification.open("POST", "./src/handleNotifications.php");
        updateNotification.send();
        updateNotification.onload = () => {
          this.fetchNotification();
        };
      });
    this.fetchNotification();
  }

  fetchNotification() {
    const getNotification = new XMLHttpRequest();
    getNotification.responseType = "json";
    getNotification.open("GET", "./src/handleNotifications.php");
    getNotification.send();
    getNotification.onload = function () {
      const parent = document.querySelector(".notifications");
      parent.innerHTML = `<li><h6 class="dropdown-header">Notifications</h6></li>`;
      let unread = 0;
      getNotification.response.forEach((notification) => {
        const listItem = document.createElement("li");
        if (notification.n_status === "1") {
          listItem.style.backgroundColor = "lightcyan";
          unread++;
        }
        listItem.innerHTML = `
        <a href="./social-goal.php?userID=${
          notification.mentee_id
        }&role=Mentor&sort=date&orderD=ASC&orderP=ASC&valueD=Earliest_Due&valueP=Least_Progress" class="dropdown-item">
          <div class="d-flex w-100 align-items-center">
            <span class="bg-info rounded-circle notification-icon">
              <i class="bi bi-info-circle"></i>
            </span>
            <div class="d-flex flex-column ms-2">
              <p class="text-wrap m-0">
                ${notification.n_text}
              </p>
              <small class="font-weight-light text-muted">
                ${new Date(notification.n_timestamp).toDateString()}
              </small>
            </div>
          </div>
        </a>`;
        parent.appendChild(listItem);
      });
      const badge = document.querySelector(".unread-num");
      badge.textContent = unread;
      if (unread !== 0) {
        badge.style.display = "initial";
      } else {
        badge.style.display = "none";
      }
    };
  }

  initTooltip(path, placement, disable = false) {
    return [].slice
      .call(document.querySelectorAll(`${path} [data-bs-toggle="tooltip"]`))
      .map((element) => {
        const tooltip = new bootstrap.Tooltip(element, {
          placement: placement,
          trigger: "hover",
          delay: { show: 500, hide: 0 },
        });
        if (disable) tooltip.disable();
        return tooltip;
      });
  }

  initPage() {
    const url = window.location.href;
    const file = /(?!.*\/).+\.(?:html|php)/.exec(url)[0];
    const pageTitleElem = document.querySelector("#page-title");
    switch (file) {
      case "goal.php":
        this.setActiveTab("Goals");
        pageTitleElem.textContent = "Goals";
        break;
      case "goal-add-main.php":
        this.setActiveTab("Goals");
        pageTitleElem.textContent = "Add New Goals";
        break;
      case "goal-details.php":
        this.setActiveTab("Goals");
        pageTitleElem.textContent = "Goal Details";
        break;
      case "action-main.php":
        this.setActiveTab("Goals");
        pageTitleElem.textContent = "Action Plans";
        break;
      case "activity.php":
        this.setActiveTab("Goals");
        pageTitleElem.textContent = "Activities";
        break;
      case "action-main-add.php":
        this.setActiveTab("Goals");
        pageTitleElem.textContent = "Add Action Plans";
        break;
      case "action-main-edit.php":
        this.setActiveTab("Goals");
        pageTitleElem.textContent = "Edit Action Plans";
        break;
      case "activity-add.php":
        this.setActiveTab("Goals");
        pageTitleElem.textContent = "Add Activities";
        break;
      case "activity-edit.php":
        this.setActiveTab("Goals");
        pageTitleElem.textContent = "Edit Activities";
        break;
      case "visualisation.php":
        this.setActiveTab("Report");
        pageTitleElem.textContent = "Report";
        break;
      case "visualisation-details.php":
        this.setActiveTab("Report");
        pageTitleElem.textContent = "Details";
        break;
      case "social.php":
        this.setActiveTab("Social");
        pageTitleElem.textContent = "Social";
        break;
      case "social-goal.php":
        this.setActiveTab("Social");
        pageTitleElem.textContent = "Goals";
        break;
      case "social-actionplan.php":
        this.setActiveTab("Social");
        pageTitleElem.textContent = "Action Plans";
        break;
      case "social-activity.php":
        this.setActiveTab("Social");
        pageTitleElem.textContent = "Activities";
        break;
      case "profile.php":
        pageTitleElem.textContent = "Profile";
        break;
      case "edit-profile.php":
        pageTitleElem.textContent = "Edit Profile";
        break;
      default:
        this.setActiveTab("Home");
        pageTitleElem.textContent = "Home";
    }
  }

  setActiveTab(title) {
    document.querySelector(`a[title="${title}"]`).classList.add("active");
  }
}

customElements.define("nav-bar", NavBar);
