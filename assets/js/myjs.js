$(function () {
    $('#cmlist').DataTable();
    $('#blist').DataTable();
});

let table_delete = document.querySelectorAll('.table-delete');
if (table_delete) {
    table_delete.forEach((el) => {
        el.addEventListener('click', (ev) => {
            let target = ev.target;
            let href = target.dataset.href;
            let name = target.dataset.name;
    
            document.querySelector('#confirm-delete').style.opacity = '1';
            document.querySelector('#confirm-delete').style.visibility = 'visible';
    
            let message = document.querySelector('.confirm-delete .message');
            message.innerHTML = `Are you sure you want to <span class='action'>Delete</span> <span class="target">${name}</span>?`;
    
            document.querySelector('.confirm-delete .confirm a').setAttribute('href', href);
        });    
    });
}

let cancel_delete = document.querySelector('#cancel-delete');
if (cancel_delete) {
    cancel_delete.addEventListener('click', (ev) => {
        document.querySelector('#confirm-delete').style.opacity = '0';
        document.querySelector('#confirm-delete').style.visibility = 'hidden';
    });
}