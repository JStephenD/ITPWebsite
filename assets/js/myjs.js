formData_to_jsonstringify = function (formdata) {
  let obj = {};
  formdata.forEach((value, key) => {
    obj[key] = value;
  });

  return JSON.stringify(obj);
};

window.onload = function () {
  let sidebar_logout = document.querySelector('#sidebar-logout');

  sidebar_logout.addEventListener('click', (ev) => {
    ev.preventDefault();

    Swal.fire({
      title: 'Confirm Logout',
      icon: 'warning',
      showCancelButton: true,
      showLoaderOnConfirm: true,
      preConfirm: async () => {
        return fetch('/user/logout', {
          method: 'POST',
        })
          .then((res) => {
            if (!res.ok) {
              throw new Error(res.statusText);
            }
          })
          .catch((error) => {
            Swal.showValidationMessage(`Response failed: ${error}`);
          });
      },
      allowOutsideClick: () => !Swal.isLoading(),
    }).then((res) => {
      if (res.isConfirmed) {
        window.location.href = "/user/login";
      }
    });
  });
};

async function asyncForEach(array, callback) {
  for (let index = 0; index < array.length; index++) {
    await callback(array[index], index, array);
  }
}
async function getCMLocs() {
  return fetch('/ajaj/getCMLocs.php', {
    method: 'GET',
    headers: {
      Accept: 'application/json',
    },
  })
    .then((res) => {
      if (res.ok) {
        return res.json();
      }
    })
    .then((json) => {
      return json;
    });
}

async function getBLocs() {
  return fetch('/ajaj/getBLocs.php', {
    method: 'GET',
    headers: {
      Accepts: 'application/json',
    },
  })
    .then((res) => {
      if (res.ok) {
        return res.json();
      }
    })
    .then((json) => {
      return json;
    });
}

function addMarkersToMap(markers, map) {
  for (let marker of markers) {
    marker.addTo(map);
  }
}

function removeMarkersFromMap(markers, map) {
  for (let marker of markers) {
    map.removeLayer(marker);
  }
}

// let urlParams = new URLSearchParams(window.location.search);
// if (urlParams.has('redirect_url')) {
//   window.location.href = urlParams.get('redirect_url');
// }

// let main_content2 = document.querySelector('#main-content');
// let main_content_text = main_content2.innerHTML;
// let redirect_url_start = main_content_text.search('redirect_url')
// if (redirect_url_start > -1) {
//   redirect_url = main_content_text.substring(redirect_url_start + 13, main_content_text.indexOf('<', redirect_url_start));
//   console.log(redirect_url)
//   window.location.href = redirect_url;
// }
