$(function () {
  const app = new Vue({
    el: "#formulario_logueo",
    data: {
      usuario: "",
      mensaje: "",
      info: 0,
      token: false
    },
    methods: {
      loguearse(e) {
        e.preventDefault();
        var url = ".." + URLPRINCIPAL + "Login/Login";
        var form = document.getElementById("formulario_logueo");
        var datos = new FormData(form);
        this.$http
          .post(url, datos, { emulateJSON: true })
          .then(function (response) {
            if (response.body == 0) {
              this.info = 0;
              this.mensaje =
                "No existe usuario " +
                "<small>" +
                this.usuario.toUpperCase().bold() +
                "</small>";
            }
            if (response.body == 1) {
              //this.token = true;
              location.reload();
            }
            if (response.body == 2) {
              this.info = 0;
              this.mensaje =
                "No coincide contraseña con usuario " +
                "<small>" +
                this.usuario.toUpperCase().bold() +
                "</small>";
            }
            if (response.body == 0.1) {
              this.info = 1;
              this.mensaje = "Usuario en blanco <b>¡verificar!</b>";
            }
            if (response.body == 0.2) {
              this.info = 1;
              this.mensaje = "Contraseña en blanco <b>¡verificar!</b>";
            }
          })
          .catch(err => {
          });
      }
    }
  });
});
