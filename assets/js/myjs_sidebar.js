let main_content = document.querySelector("#main-content");

let sidebar_drawers = document.querySelectorAll('.drawer-menu-item');

let sidebar_dp_img = document.querySelector('#dp-img');
let sidebar_dp_txt = document.querySelector('#dp-text');
let sidebar_user_txt = document.querySelector('#sidebar-user-text');

let sidebar_account = document.querySelector("#sidebar-account");
let sidebar_logout = document.querySelector("#sidebar-logout");
let sidebar_signup = document.querySelector("#sidebar-signup");
let sidebar_login = document.querySelector("#sidebar-login");

let sidebar_citymun_listing = document.querySelector(
  "#sidebar-citymun-listing"
);
let sidebar_citymun_add = document.querySelector("#sidebar-citymun-add");

let sidebar_barangay_listing = document.querySelector(
  "#sidebar-barangay-listing"
);
let sidebar_barangay_add = document.querySelector("#sidebar-barangay-add");

let sidebar_mapping = document.querySelector("#sidebar-mapping");

function addExtJs(src) {
  let script = document.createElement("script");
  script.type = "text/javascript";
  script.defer = "defer";
  script.src = src;
  main_content.appendChild(script);
}

function changeDrawerActive(target) {
  sidebar_drawers.forEach(drawer => {
    drawer.classList.remove('drawer-active');
  })
  drawer_menu = target.parentElement.parentElement.parentElement.parentElement;
  drawer_menu.classList.add('drawer-active');
}


// USER
sidebar_signup.addEventListener("click", async (ev) => {
  ev.preventDefault();
  let formdata = new FormData();
  formdata.append("ajax", "ajax");

  fetch("/user/signup", {
    method: "POST",
    body: formdata,
  })
    .then((res) => {
      return res.text();
    })
    .then((text) => {
      main_content.innerHTML = text;
      addExtJs("/assets/js/user/signup.js");
      changeDrawerActive(ev.target);
      history.pushState("", "", "/user/signup");
    });
});
sidebar_login.addEventListener("click", async (ev) => {
  ev.preventDefault();
  let formdata = new FormData();
  formdata.append("ajax", "ajax");

  fetch("/user/login", {
    method: "POST",
    body: formdata,
  })
    .then((res) => {
      return res.text();
    })
    .then((text) => {
      main_content.innerHTML = text;
      addExtJs("/assets/js/user/login.js");
      changeDrawerActive(ev.target);
      history.pushState("", "", "/user/login");
    });
});
sidebar_account.addEventListener("click", async (ev) => {
  ev.preventDefault();
  let formdata = new FormData();
  formdata.append("ajax", "ajax");

  fetch("/user/account", {
    method: "POST",
    body: formdata
  })
    .then((res) => {
      return res.text();
    })
    .then((text) => {
      main_content.innerHTML = text;
      addExtJs("/assets/js/user/account.js");
      changeDrawerActive(ev.target);
      history.pushState("", "", "/user/account");
    });
});

// CITYMUN
sidebar_citymun_listing.addEventListener("click", async (ev) => {
  ev.preventDefault();
  let formdata = new FormData();
  formdata.append("ajax", "ajax");

  fetch("/citymunicipality/listing", {
    method: "POST",
    body: formdata,
  })
    .then((res) => {
      return res.text();
    })
    .then((text) => {
      main_content.innerHTML = text;
      addExtJs("/assets/js/citymun/citymun_listing.js");
      changeDrawerActive(ev.target);
      history.pushState("", "", "/citymunicipality/listing");
    });
});
sidebar_citymun_add.addEventListener("click", async (ev) => {
  ev.preventDefault();
  let formdata = new FormData();
  formdata.append("ajax", "ajax");

  fetch("/citymunicipality/add", {
    method: "POST",
    body: formdata,
  })
    .then((res) => {
      return res.text();
    })
    .then((text) => {
      main_content.innerHTML = text;
      addExtJs("/assets/js/citymun/citymun_add.js");
      changeDrawerActive(ev.target);
      history.pushState("", "", "/citymunicipality/add");
    });
});

// BARANGAY
sidebar_barangay_listing.addEventListener("click", async (ev) => {
  ev.preventDefault();
  let formdata = new FormData();
  formdata.append("ajax", "ajax");

  fetch("/barangay/listing", {
    method: "POST",
    body: formdata,
  })
    .then((res) => {
      return res.text();
    })
    .then((text) => {
      main_content.innerHTML = text;
      addExtJs("/assets/js/barangay/brgy_listing.js");
      changeDrawerActive(ev.target);
      history.pushState("", "", "/barangay/listing");
    });
});
sidebar_barangay_add.addEventListener("click", async (ev) => {
  ev.preventDefault();
  let formdata = new FormData();
  formdata.append("ajax", "ajax");

  fetch("/barangay/add", {
    method: "POST",
    body: formdata,
  })
    .then((res) => {
      return res.text();
    })
    .then((text) => {
      main_content.innerHTML = text;
      addExtJs("/assets/js/barangay/brgy_add.js");
      changeDrawerActive(ev.target);
      history.pushState("", "", "/barangay/add");
    });
});

// MAPPING
sidebar_mapping.addEventListener("click", async (ev) => {
  ev.preventDefault();
  let formdata = new FormData();
  formdata.append("ajax", "ajax");

  fetch("/mapping", {
    method: "POST",
    body: formdata,
  })
    .then((res) => {
      return res.text();
    })
    .then((text) => {
      main_content.innerHTML = text;
      addExtJs("/assets/js/mapping/mapping.js");
      changeDrawerActive(ev.target);
      history.pushState("", "", "/mapping");
    });
});
