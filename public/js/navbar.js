class NavBar extends HTMLElement {
  constructor() {
    super();
    this.innerHTML = `
      <div class="sidebar">
        <div class="header">
          <div class="logo">
            Goal Progress
            <br />
            Tracker System
          </div>
          <i class="bi-list nav-link" id="toggle-btn"></i>
        </div>
        <nav class="nav nav-pills flex-column">
          <a class="nav-link" href="index.html" data-bs-toggle="tooltip" title="Home">
            <i class="bi-house-door-fill"></i>
            <span class="description">Home</span>
          </a>
          <a class="nav-link" href="#" data-bs-toggle="tooltip" title="Goals">
            <i class="bi-flag-fill"></i>
            <span class="description">Goals</span>
          </a>
          <a class="nav-link" href="#" data-bs-toggle="tooltip" title="Reminders">
            <i class="bi-alarm-fill"></i>
            <span class="description">Reminders</span>
          </a>
          <a class="nav-link" href="#" data-bs-toggle="tooltip" title="Setting">
            <i class="bi-gear-fill"></i>
            <span class="description">Settings</span>
          </a>
          <a class="nav-link logout" href="#" data-bs-toggle="tooltip" title="Logout">
            <i class="bi-door-open-fill"></i>
            <span class="description">Logout</span>
          </a>
        </nav>
      </div>
    `;
  }

  connectedCallback() {
    const linkElem = document.createElement("link");
    linkElem.setAttribute("rel", "stylesheet");
    linkElem.setAttribute("href", "styles/navbar.css");
    document.getElementsByTagName("head")[0].appendChild(linkElem);
    document.addEventListener("DOMContentLoaded", () => {
      this.setActiveTab();
      const tooltipList = this.getTooltip();
      this.querySelector("#toggle-btn").addEventListener("click", () => {
        const isClosed = this.querySelector(".sidebar").classList.toggle("min");
        tooltipList.forEach((element) => {
          if (isClosed) {
            element.enable();
          } else {
            element.disable();
          }
        });
      });
    });
  }

  getTooltip() {
    return [].slice
      .call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
      .map((element) => {
        const tooltip = new bootstrap.Tooltip(element, {
          placement: "right",
          delay: { show: 300, hide: 0 },
        });
        tooltip.disable();
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
