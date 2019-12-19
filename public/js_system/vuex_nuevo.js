
const vue = new Vue({});
const store = new Vuex.Store({
    state: {
        numeroclientes: 0,
        clientes: [],
        cuerpo_notificacion: "",
        interval: null,
        numeros: 0,
    },
    mutations: {
        LlamarIntervalo: function (state) {
            state.interval = setInterval(function () {
                state.numeros++;
            }, 1000);
        },
        LlamarContadorClientes: function (state) {
            var url = URLPRINCIPAL + 'ClientesGeneral/ContadorMostrar';
            vue.$http.post(url).then(
                response => {
                    state.numeroclientes = response.body[0].numero_clientes;
                }, response => { });
        },
        LlamarClientes: function (state) {
            var url = URLPRINCIPAL + 'ClientesGeneral/Mostrar';
            vue.$http.get(url).then(
                response => {
                    state.clientes = response.body;

                }, response => { });
        },
        ActivarSocket: function (state) {
            var self = state;
            try {
                self.ws = new WebSocket('ws://192.168.1.3:8080/chat');
            } catch (error) {
            }
            self.ws.onopen = function (e) { };
            self.ws.onmessage = function (e) {
                if (e.data == "AgregarCliente") {
                    store.commit('LlamarContadorClientes');
                    store.commit('LlamarClientes');
                    state.cuerpo_notificacion = "Se agrego un nuevo <b>PROSPECTO</b>";
                    store.commit('Notificaciones', "marco");
                }
            };
            self.ws.onerror = function (e) { };
            self.ws.onclose = function (e) { };
        },
        Notificaciones: function (state, titulo) {
            Push.create(titulo, {
                body: state.cuerpo_notificacion,
                icon: '../img/logo.svg',
                link: '/#',
                timeout: 4000,
                onClick: function () {
                    window.focus();
                    this.close();
                },
                vibrate: [200, 100, 200, 100, 200, 100, 200]
            })
        }
    },
    actions: {},
});
