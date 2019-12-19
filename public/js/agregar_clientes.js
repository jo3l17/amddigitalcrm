
$(function () {
    var table;
    const app = new Vue({
        el: '#app',
        data: {
            ubigeos: [],
            usuarios: [],
            select: null,
        },
        store: store,
        created: function () {
            this.ActivarSocket();
        },
        computed: {
            ...Vuex.mapState(['numeroclientes', 'ws']),
        },
        mounted: function () {
            this.LlamarUsuarios();
            this.LlamarUbigeo();
            this.LlamarContadorClientes();
        },
        methods: {
            ...Vuex.mapMutations(['LlamarContadorClientes', 'ActivarSocket']),
            AgregarCliente: function (event) {
                event.preventDefault();
                var id_formulario = document.getElementById("form_agregar_cliente");
                var input_empresa = document.getElementById("input_empresa");
                var input_correo = document.getElementById("input_correo");
                var input_telefono = document.getElementById("input_telefono");
                var formData = new FormData(id_formulario);
                var url = URLPRINCIPAL + 'ClientesGeneral/Agregar/1';
                this.$http.post(url, formData, {
                    before: function () {
                        alertify.notify('<img class="imgr_medida imgr" src="' + URLPRINCIPAL + 'public/img/spinner-of-dots.svg" alt=""> Agregando <b> cliente', 'custom-black', TIEMPO_NOTIFICACION, function () { });
                    },
                }).then(response => {
                    if (response.body[0].respuesta == 0) {
                        this.select = $('.select_ubigeos').selectpicker('destroy');
                        this.select = $('.select_usuarios').selectpicker('destroy');
                        id_formulario.reset();
                        input_empresa.focus();
                        this.LlamarUsuarios();
                        this.LlamarUbigeo();
                        alertify.dismissAll();
                        alertify.notify('<img class="imgr_medida" src="' + URLPRINCIPAL + 'public/img/check-mark.svg" alt=""> Agregado <b>correctamente</b>', 'custom-black', TIEMPO_NOTIFICACION, function () { });
                        this.LlamarContadorClientes();
                        this.ws.send('AgregarCliente');
                    }
                    if (response.body[0].respuesta == 1) {
                        alertify.dismissAll();
                        input_empresa.focus();
                        alertify.notify('Empresa ya se encuentra <b>registrada</b>', 'custom-warning', TIEMPO_NOTIFICACION, function () { });
                    }
                    if (response.body[0].respuesta == 2) {
                        alertify.dismissAll();
                        input_correo.focus();
                        alertify.notify('Correo ya se encuentra <b>registrado</b>', 'custom-warning', TIEMPO_NOTIFICACION, function () { });
                    }
                    if (response.body[0].respuesta == 3) {
                        alertify.dismissAll();
                        input_telefono.focus();
                        alertify.notify('Teléfono ya se encuentra <b>registado</b>', 'custom-warning', TIEMPO_NOTIFICACION, function () { });
                    }
                }, response => { });
            },
            LlamarUbigeo: function () {
                var url = URLPRINCIPAL + 'Ubigeo/MostrarUbigeos';
                this.$http.get(url).then(
                    response => {
                        this.ubigeos = response.body;
                        this.select = $('.select_ubigeos').selectpicker();
                    }, response => { });
            },
            LlamarUsuarios: function () {
                var url = URLPRINCIPAL + 'Usuario/MostrarUsuarios';
                this.$http.get(url, {
                    before: function () {
                    },
                }).then(
                    response => {
                        this.usuarios = response.body;
                        this.select = $('.select_usuarios').selectpicker();
                    }, response => { });
            },
        },
    });
});

