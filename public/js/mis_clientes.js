var table;
const app_clientes_general = new Vue({
    el: '#app',
    data: {
        dataTable: null,
        dataTable_mensajes: null,
        texteditor: null,
        clientes: [],
        estrella: 3,
        hoverestrella: false,
        correos_lista: [],
    },
    store: store,
    computed: {
        ...Vuex.mapState(['numeroclientes', 'ws']),
    },
    beforeUpdate() {
        if (this.dataTable) {
            this.dataTable.destroy();
            this.LlamarContadorClientes();
        }
        if (this.dataTable_mensajes) {
            this.dataTable_mensajes.destroy();
        }
    },
    updated: function () {
        this.dataTable = $('.datatable').DataTable({
        });
        this.dataTable_mensajes = $('.datatable_mensajes').DataTable({
            dom: '<"row"<"col-12 col-sm-12 col-md-6"l><"col-12 col-sm-12 col-md-6"f>>rtp',
        });
    },
    mounted: function () {
        abrir_modal('modalagregar', 'Módulo correo electrónico');
    },
    created: function () {
        this.LlamarClientes();
        this.ActivarSocket();
        this.LlamarContadorClientes();

    },
    methods: {
        ...Vuex.mapMutations(['LlamarContadorClientes', 'ActivarSocket']),
        LlamarClientes: function () {
            var url = URLPRINCIPAL + 'MisClientes/Mostrar';
            this.$http.get(url).then(
                response => {
                    this.clientes = response.body;
                }, response => { });
        },
        QuitarEstrella: function (e) {
            var elemento_padre = e.target.children;
            for (var i = 0; i < elemento_padre.length; i++) {
                if (elemento_padre[i].className == "estrella_marcada") {
                    elemento_padre[i].classList.add("estrella_desmarcada");
                    elemento_padre[i].classList.remove("estrella_marcada");
                }
            }
        },
        PonerEstrella: function (e) {
            var elemento_padre = e.target.children;
            for (var i = 0; i < elemento_padre.length; i++) {
                if (elemento_padre[i].className == "estrella_desmarcada") {
                    elemento_padre[i].classList.add("estrella_marcada");
                    elemento_padre[i].classList.remove("estrella_desmarcada");
                }
            }
        },
        CambiarCalificacion: function (id, calificacion) {
            var url = URLPRINCIPAL + 'MisClientes/CambiarCalificacion/';
            const formData = {
                id: id,
                calificacion: calificacion,
            };
            this.$http.post(url, formData, { emulateJSON: true })
                .then(response => {
                    this.LlamarClientes();
                }, response => { });
        },
        AbrirModal: function () {
            document.getElementById("correos_cliente").classList.remove('ocultar');
            alertify.modalagregar(document.getElementById("correos_cliente"));
            this.LlamarCorreos();
            $('#summernote').summernote('reset');
            $('#summernote').summernote('destroy');
            this.texteditor = $('#summernote').summernote({
                lang: 'es-ES',
                height: 250,
                toolbar: [
                    // [groupName, [list of button]]
                    ['style', ['bold', 'italic', 'underline', 'clear']],
                    ['font', ['strikethrough', 'superscript', 'subscript']],
                    ['fontsize', ['fontsize']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['height', ['height']],
                    ['table'],
                ],
                placeholder: 'Escriba el mensaje del correo aquí',
                callbacks: {
                    onPaste: function (e) {
                        var bufferText = ((e.originalEvent || e).clipboardData || window.clipboardData).getData('Text');
                        e.preventDefault();
                        setTimeout(function () {
                            document.execCommand('insertText', false, bufferText);
                        }, 10);
                    }
                },
            });
            $('#summernote').summernote('focus');
            $("#fileuploader").uploadFile({
                url: URLPRINCIPAL + 'Upload/upload_imagen/',
                multiple: true,
                dragDrop: true,
                maxFileCount: 5,
                acceptFiles: "image/*,.pdf",
                maxFileSize: 26214400,
                autoSubmit: true,
                previewHeight: "100px",
                previewWidth: "100px",
                showPreview: true,
                fileName: "imagen",
                onSelect: function (files) {
                    console.log(files);
                },
                onSuccess: function (files, data, xhr, pd) {
                    console.log(data);
                }
            });
        },
        LlamarCorreos: function () {
            var url = URLPRINCIPAL + 'PanelCliente/LlamarCorreos/1/1';
            this.$http.get(url).then(response => {
                this.correos_lista = response.body;
            }, response => { });
        },
        MandarMensaje: function (e, cliente_id, usario_id) {
            e.preventDefault();
            this.LlamarCorreos();
            var url = URLPRINCIPAL + 'MisClientes/MandarMensaje/';
            const formData = {
                'cliente_id': 1,
                'asunto': document.querySelectorAll('input[name=asunto]')[0].value,
                'cuerpo': document.getElementById('summernote').value,
                'usario_id': 1,
            };
            this.$http.post(url, formData, { emulateJSON: true })
                .then(response => {
                    this.LlamarCorreos();
                    console.log(response.body);
                    $('#summernote').summernote('reset');
                    $('#summernote').summernote('focus');
                }, response => { });
        },
       
    },
})
