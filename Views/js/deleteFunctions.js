var deletionUrl = "";
var deletionId = "";

function deleteItem(id)
{
    deletionId = id;
    var modal = new bootstrap.Modal(document.getElementById('modal-delete'));
    modal.show();
}

function deleteConfirm()
{
    window.location.href = deletionUrl+"&id="+deletionId;
}