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
      <div class="dropdown m-2">
        <i
          class="bi bi-bell-fill nav-link position-relative large"
          tabindex="0"
          data-bs-toggle="dropdown"
        >
          <span
            class="position-absolute translate-middle badge rounded-pill bg-danger no-select"
            style="font-size: 0.75rem; font-style:normal;left:75%;"
          >
            2
          </span>
        </i>
        <ul class="dropdown-menu dropdown-menu-end" style="width:350px">
          <li><h6 class="dropdown-header">Notifications</h6></li>
          <li>
            <a href="#" class="dropdown-item">
              <div class="d-flex w-100 align-items-center">
                <span class="bg-info rounded-circle notification-icon">
                  <i class="bi bi-info-circle"></i>
                </span>
                <div class="d-flex flex-column ms-2">
                  <p class="text-wrap m-0">
                    Some placeholder content in a paragraph.
                  </p>
                  <small class="font-weight-light text-muted">1 hour ago</small>
                </div>
              </div>
            </a>
          </li>
          <li>
            <a href="#" class="dropdown-item">
              <div class="d-flex w-100 align-items-center">
                <span class="bg-info rounded-circle notification-icon">
                  <i class="bi bi-info-circle"></i>
                </span>
                <div class="d-flex flex-column ms-2">
                  <p class="text-wrap m-0">
                    Some placeholder content in a paragraph.
                  </p>
                  <small class="font-weight-light text-muted">
                    2 hours ago
                  </small>
                </div>
              </div>
            </a>
          </li>
        </ul>
      </div>
      <div class="dropdown m-2">
        <button
          class="btn dropdown-toggle"
          type="button"
          data-bs-toggle="dropdown"
        >
          <img
            src="https://www.biography.com/.image/ar_1:1%2Cc_fill%2Ccs_srgb%2Cg_face%2Cq_auto:good%2Cw_300/MTU0NjQzOTk4OTQ4OTkyMzQy/ansel-elgort-poses-for-a-portrait-during-the-baby-driver-premiere-2017-sxsw-conference-and-festivals-on-march-11-2017-in-austin-texas-photo-by-matt-winkelmeyer_getty-imagesfor-sxsw-square.jpg"
            class="avatar"
          />
        </button>
        <ul class="dropdown-menu dropdown-menu-end" style="width:200px">
          <li>
            <a
              class="dropdown-item d-flex align-items-center"
              href="./profile.html"
            >
              <i class="bi bi-person-fill pe-3 large"></i>
              Profile
            </a>
          </li>
          <li>
            <a
              class="dropdown-item d-flex align-items-center"
              href="./login.html"
              onclick="sessionStorage.clear()"
            >
              <i class="bi bi-door-open-fill pe-3 large"></i>
              Sign Out
            </a>
          </li>
        </ul>
      </div>
    </div>
    <div class="sidebar">
      <nav class="nav nav-pills flex-column">
        <a
          class="nav-link"
          href="./index.html"
          data-bs-toggle="tooltip"
          title="Home"
        >
          <i class="bi-house-door-fill"></i>
          <span>Home</span>
        </a>
        <a
          class="nav-link"
          href="./goal.html"
          data-bs-toggle="tooltip"
          title="Goals"
        >
          <i class="bi-flag-fill"></i>
          <span>Goals</span>
        </a>
        <a
          class="nav-link"
          href="./visualisation.html"
          data-bs-toggle="tooltip"
          title="Report"
        >
          <i class="bi bi-clipboard2-data"></i>
          <span>Report</span>
        </a>
        <a
          class="nav-link"
          href="./social.html"
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
    const file = /(?!.*\/).+\.html/.exec(url)[0];
    const pageTitleElem = document.querySelector("#page-title");
    switch (file) {
      case "goal.html":
        this.setActiveTab("Goals");
        pageTitleElem.textContent = "Goals";
        break;
      case "goal-add.html":
        this.setActiveTab("Goals");
        pageTitleElem.textContent = "Add New Goals";
        break;
      case "action-main.html":
        this.setActiveTab("Goals");
        pageTitleElem.textContent = "Action Plans";
        break;
      case "activity.html":
        this.setActiveTab("Goals");
        pageTitleElem.textContent = "Activities";
        break;
      case "action-main-add.html":
        this.setActiveTab("Goals");
        pageTitleElem.textContent = "Add Action Plans";
        break;
      case "action-main-edit.html":
        this.setActiveTab("Goals");
        pageTitleElem.textContent = "Edit Action Plans";
        break;
      case "activity-add.html":
        this.setActiveTab("Goals");
        pageTitleElem.textContent = "Add Activities";
        break;
      case "activity-edit.html":
        this.setActiveTab("Goals");
        pageTitleElem.textContent = "Edit Activities";
        break;
      case "visualisation.html":
        this.setActiveTab("Report");
        pageTitleElem.textContent = "Report";
        break;
      case "visualisation-details.html":
        this.setActiveTab("Report");
        pageTitleElem.textContent = "Details";
        break;
      case "social.html":
        this.setActiveTab("Social");
        pageTitleElem.textContent = "Social";
        break;
      case "social-goal.html":
        this.setActiveTab("Social");
        pageTitleElem.textContent = "Your Mentor/Mentee: Goal List";
        break;
      case "social-actionplan.html":
        this.setActiveTab("Social");
        pageTitleElem.textContent = "Your Mentor/Mentee: Action Plan";
        break;
      case "social-activity.html":
        this.setActiveTab("Social");
        pageTitleElem.textContent = "Your Mentor/Mentee: Activity";
        break;
      case "profile.html":
        pageTitleElem.textContent = "Profile";
        break;
      case "edit-profile.html":
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
