
function openDeleteModal(ruta, item) {
  $('#modal-item').html(item);
  $('#modal-delete-link').attr('href', ruta);

  const modal = new bootstrap.Modal($('#modal-delete'));
  modal.show();
}

function openCloneModal(id) {
  //tanquem possibles modals perque no s'acumulin
  const existingModal = bootstrap.Modal.getInstance($('#modal-clone'));
  if (existingModal) {
    existingModal.dispose();
  }

  $('#modal-article-id').val(id);
  const formData = new FormData(document.getElementById('codeForm'));
  $.ajax({
    url: 'qr?article=true',
    type: 'POST',
    data: Object.fromEntries(formData),
    success: function (response) {
      $("#modal-qr").html(response);
    },
  });

  const modal = new bootstrap.Modal($('#modal-clone'));

  modal.show();
}