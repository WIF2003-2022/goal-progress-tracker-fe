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
      <i class="bi-chevron-left nav-link" id="toggle-btn" tabindex="0"></i>
      <i
        class="bi bi-bell-fill nav-link"
        tabindex="0"
        data-bs-toggle="tooltip"
        title="Notifications"
      ></i>
      <span class="translate-middle badge rounded-pill bg-danger">9+</span>
      <div class="dropdown me-1">
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
        <ul class="dropdown-menu">
          <li>
            <a class="dropdown-item" href="profile.html">
              Profile
            </a>
          </li>
          <li>
            <a class="dropdown-item" href="login.html">
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
          href="home.html"
          data-bs-toggle="tooltip"
          title="Home"
        >
          <i class="bi-house-door-fill"></i>
          <span>Home</span>
        </a>
        <a class="nav-link" href="goal.html" data-bs-toggle="tooltip" title="Goals">
        <i class="bi-flag-fill"></i>
        <span>Goals</span>
      </a>
      <a class="nav-link" href="visualisation.html" data-bs-toggle="tooltip" title="Report">
      <i class="bi bi-clipboard2-data"></i>
        <span>Report</span>
      </a>
        <a
          class="nav-link"
          href="mentee.html"
          data-bs-toggle="tooltip"
          title="Mentees"
        >
          <i class="bi-people-fill"></i>
          <span>Mentees</span>
        </a>
      </nav>
    </div>
  </div>
`;

class NavBar extends HTMLElement {
  connectedCallback() {
    const linkElem = document.createElement("link");
    linkElem.setAttribute("rel", "stylesheet");
    linkElem.setAttribute("href", "styles/navbar.css");
    document.getElementsByTagName("head")[0].appendChild(linkElem);
    this.appendChild(template.content.cloneNode(true));
    this.setActiveTab();
    this.initTooltip(".navbar i", "bottom");
    const sidebarTooltip = this.initTooltip(".sidebar a", "right", true);
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
      .call(document.querySelectorAll(`${path}[data-bs-toggle="tooltip"]`))
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

  setActiveTab() {
    const url = window.location.href;
    document.querySelectorAll(".sidebar .nav a").forEach((element) => {
      if (element.href === url) {
        element.classList.add("active");
      }
    });
  }
}

customElements.define("nav-bar", NavBar);
