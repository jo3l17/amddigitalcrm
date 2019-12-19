var table;
const app_clientes_general = new Vue({
    el: '#app',
    data: {
        dataTable: null,
    },
    store: store,
    computed: {
        ...Vuex.mapState(['numeroclientes', 'ws', 'clientes']),
    },
    created() {
        this.LlamarClientes();
        this.ActivarSocket();
        this.LlamarContadorClientes();
    },
    beforeUpdat() {
        if (this.dataTable) {
            this.dataTable.destroy();
            this.LlamarContadorClientes();
        }
    },
    updated: function() {
        this.dataTable = $('.datatable').DataTable()
    },
    methods: {
        ...Vuex.mapMutations(['LlamarContadorClientes', 'ActivarSocket', 'LlamarClientes']),
        AdministrarCliente: function(id) {
            var url = URLPRINCIPAL + 'ClientesGeneral/AceptarCliente/' + id;
            this.$http.get(url).then(response => {
                alertify.notify('<b>Se asigno cliente correctamente</b>', 'custom-black', TIEMPO_NOTIFICACION, function() {});
                this.LlamarClientes();
            }, response => {});
        },
    },


});