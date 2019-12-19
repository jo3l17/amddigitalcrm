$(document).ready(function() {
    $('.toast').toast('show');
});
$(function() {
    const app = new Vue({
        el: '#app_cliente',
        data: {
            correos: [],
            estado: "",
            ws: null,
        },
        created: function() {
            this.LlamarCorreos();
            this.ActivarSocket();
        },
        computed: {},
        methods: {
            MandarMensaje: function() {
                var url = URLPRINCIPAL + 'MisClientes/MandarMensaje';
                this.$http.get(url, {
                    params: {
                        'cliente_id': 1,
                        'cuerpo': document.getElementById("txt_mensaje").value,
                        'usario_id': 1,
                    },
                    before: function() {
                        document.getElementById("txt_mensaje").readOnly = true;
                    },
                    uploadProgress: function(e) {},
                    downloadProgress: function(e) {},
                }).then(response => {
                    document.getElementById("txt_mensaje").readOnly = false;
                    document.getElementById("txt_mensaje").value = "";
                    document.getElementById("txt_mensaje").focus();
                    this.LlamarCorreos();
                }, response => {});
            },
            LlamarCorreos: function() {
                var url = URLPRINCIPAL + 'PanelCliente/LlamarCorreos/1/1';
                this.$http.get(url).then(response => {
                    this.correos = response.body;
                }, response => {});
            },           
        },
    });
});