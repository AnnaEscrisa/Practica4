<div class="modal" id="modal-clone" tabindex="-1" aria-labelledby="exampleModalLabel" >
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Clonar article</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body hstack">
                <form action="" id="codeForm">
                    <input type="text" name="id" id="modal-article-id" hidden>
                    <div class="form-check">
                      <label class="form-check-label">
                        <input type="checkbox" class="form-check-input" name="titol" id="" value="checkedValue" checked>
                        Títol
                      </label>
                    </div>
                    <div class="form-check">
                      <label class="form-check-label">
                        <input type="checkbox" class="form-check-input" name="descripcio" id="" value="checkedValue" checked>
                        Descripcio
                      </label>
                    </div>
                    <div class="form-check">
                      <label class="form-check-label">
                        <input type="checkbox" class="form-check-input" name="ingredients" id="" value="checkedValue" checked>
                        Ingredients
                      </label>
                    </div>
                    <div class="form-check">
                      <label class="form-check-label">
                        <input type="checkbox" class="form-check-input" name="imatge" id="" value="checkedValue" checked>
                        Imatge
                      </label>
                    </div>

                </form>
                <div id="modal-qr">
                </div>
            </div>

        </div>
    </div>
</div>