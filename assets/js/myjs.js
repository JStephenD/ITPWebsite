$(function () {
    $('#cmlist').DataTable();
    $('#blist').DataTable();
});

formData_to_jsonstringify = function(formdata) {
    let obj = {};
    formdata.forEach((value, key) => {
        obj[key] = value;
    });
    
    return JSON.stringify(obj);
};