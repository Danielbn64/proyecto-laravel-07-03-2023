<head>
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/thinline.css">
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}" defer="defer"></script>
    <script type="text/javascript" src="{{ asset('js/change-tag-input-listener.js')}}" defer="defer"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<div class="modal fade" id="changeTagsView" tabindex="-1" aria-hidden="true" role="dialog" aria-labelledby="modalTitle">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitle">Cambiar etiquetas</h5>
                <button type="button" class="btn btn-close" data-bs-dismiss="modal" aria-labelledby="close"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="30" fill="#6c757d" class="bi bi-x" viewBox="5 0 5 16">
                        <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z" />
                    </svg></button>
            </div>
            <div class="modal-body">
                <form method="PUT" action="{{ route('ImageTags.update_images_tags') }}" onsubmit="return false;" class="form-group">
                    @csrf
                    <input id="imageId" type="hidden" name="imageId" value="{{$image->id}}" />
                    <div class="col">
                        <p class="remaining-tags-count"><span id="tagsCount">_</span> Etiquetas restantes</p>
                        <ul id="AddedTags">
                            <input id="addTags" placeholder="Escribe palabras que describan tu imagen" autocomplete="off" type="text">
                        </ul>
                        <div class="recomended-tag-list">
                            <p>Etiquetas recomendadas : </p>
                            <span id="tagListResponse" class="d-flex flex-wrap"></span>
                        </div>
                    </div>
            </div>
            </form>
            <div class="modal-footer">
                <button id="removeTags" type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button id="saveTags" type="submit" class="btn btn-success" disabled="disabled" data-bs-dismiss="modal">guardar</button>
            </div>
        </div>
    </div>
</div>