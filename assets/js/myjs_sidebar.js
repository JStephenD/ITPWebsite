let main_content = document.querySelector("#main-content");

let sidebar_drawers = document.querySelectorAll('.drawer-menu-item');

let sidebar_dp_img = document.querySelector('#dp-img');
let sidebar_dp_txt = document.querySelector('#dp-text');
let sidebar_user_txt = document.querySelector('#sidebar-user-text');

let sidebar_admin_accounts = document.querySelector("#sidebar-admin-accounts");

let sidebar_account = document.querySelector("#sidebar-account");
let sidebar_logout = document.querySelector("#sidebar-logout");
let sidebar_signup = document.querySelector("#sidebar-signup");
let sidebar_login = document.querySelector("#sidebar-login");

let sidebar_citymun_listing = document.querySelector("#sidebar-citymun-listing");
let sidebar_citymun_add = document.querySelector("#sidebar-citymun-add");

let sidebar_barangay_listing = document.querySelector("#sidebar-barangay-listing");
let sidebar_barangay_add = document.querySelector("#sidebar-barangay-add");

let sidebar_mapping = document.querySelector("#sidebar-mapping");
let sidebar_mapping_citymun = document.querySelector("#sidebar-mapping-citymun");
let sidebar_mapping_barangay = document.querySelector("#sidebar-mapping-barangay");

let sidebar_tracing_logs_view = document.querySelector('#sidebar-tracing-logs-view');
let sidebar_tracing_employee = document.querySelector('#sidebar-tracing-employee');
let sidebar_tracing_customer = document.querySelector('#sidebar-tracing-customer');

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

function switchPageContent(ev, page_url, js_url, new_link_url) {
  ev.preventDefault();
  let formdata = new FormData();
  formdata.append("ajax", "ajax");

  fetch(page_url, {
    method: "POST",
    body: formdata,
  })
    .then((res) => {
      if (res.ok) {
        return res.text();
      }
    })
    .then(text => {
      try {
        json = JSON.parse(text);
        status = json['status'];
        statusText = json['statusText'];
        response = json['response'];

        if (status == 550 || statusText == 'Permission denied') {
          window.location.href = response['redirect_url'];
        }
      } catch (error) {
        main_content.innerHTML = text;
        addExtJs(js_url);
        changeDrawerActive(ev.target);
        history.pushState("", "", new_link_url);
      }
    });
}

// ADMIN
try {
  sidebar_admin_accounts.addEventListener("click", async (ev) => {
    switchPageContent(
      ev,
      "/admin/accounts",
      "/assets/js/admin/admin_accounts.js",
      "/admin/accounts"
    );
  });
} catch (error) { }

// USER
sidebar_signup.addEventListener("click", async (ev) => {
  switchPageContent(ev, "/user/signup", "/assets/js/user/signup.js", "/user/signup");
});
sidebar_login.addEventListener("click", async (ev) => {
  switchPageContent(ev, "/user/login", "/assets/js/user/login.js", "/user/login");
});
sidebar_account.addEventListener("click", async (ev) => {
  switchPageContent(ev, "/user/account", "/assets/js/user/account.js", "/user/account");
});

// CITYMUN
sidebar_citymun_listing.addEventListener("click", async (ev) => {
  switchPageContent(
    ev,
    "/citymunicipality/listing",
    "/assets/js/citymun/citymun_listing.js",
    "/citymunicipality/listing"
  );
});
sidebar_citymun_add.addEventListener("click", async (ev) => {
  switchPageContent(
    ev,
    "/citymunicipality/add",
    "/assets/js/citymun/citymun_add.js",
    "/citymunicipality/add"
  );
});

// BARANGAY
sidebar_barangay_listing.addEventListener("click", async (ev) => {
  switchPageContent(
    ev,
    "/barangay/listing",
    "/assets/js/barangay/brgy_listing.js",
    "/barangay/listing"
  );
});
sidebar_barangay_add.addEventListener("click", async (ev) => {
  switchPageContent(
    ev,
    "/barangay/add",
    "/assets/js/barangay/brgy_add.js",
    "/barangay/add"
  );
});

// MAPPING
sidebar_mapping.addEventListener("click", async (ev) => {
  switchPageContent(ev, "/mapping", "/assets/js/mapping/mapping.js", "/mapping");
});
sidebar_mapping_citymun.addEventListener("click", async (ev) => {
  switchPageContent(
    ev,
    "/mapping/citymunicipality",
    "/assets/js/mapping/mapping_citymun.js",
    "/mapping/citymunicipality"
  );
});
sidebar_mapping_barangay.addEventListener("click", async (ev) => {
  switchPageContent(
    ev,
    "/mapping/barangay",
    "/assets/js/mapping/mapping_brgy.js",
    "/mapping/barangay"
  );
});

// TRACING
sidebar_tracing_logs_view.addEventListener('click', (ev) => {
  switchPageContent(
    ev,
    '/tracing/logs/view',
    '/assets/js/tracing/logs_view.js',
    '/tracing/logs/view'
  );
});
sidebar_tracing_employee.addEventListener('click', (ev) => {
  switchPageContent(
    ev,
    '/tracing/employee',
    '/assets/js/tracing/employee_log.js',
    '/tracing/employee'
  );
});
sidebar_tracing_customer.addEventListener('click', (ev) => {
  switchPageContent(
    ev,
    '/tracing/customer',
    '/assets/js/tracing/customer_log.js',
    '/tracing/customer'
  );
});