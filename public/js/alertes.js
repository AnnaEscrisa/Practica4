function openDeleteModal(ruta, item) {
  document.getElementById('modal-item').textContent = item;
  document.getElementById('modal-delete-link').href = ruta;
  
  const modal = new bootstrap.Modal(document.getElementById('modal-delete'));
  modal.show();
}

