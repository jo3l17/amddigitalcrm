<?php 
require URLINC.'check_session_login.php';
?>
<div class="content-form centrar text-center">
    <img id="logo" src="<?php echo URL.URLIMG.NOMBRE_LOGO?>" alt="">

    <p>Ingresa a tu cuenta<br>
        Sigue ganando tiempo y tranquilidad</p>
    <form id="formulario_logueo" action="<?php echo URL?>Login/Login" method="post" @submit="loguearse">

        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text">@</span>
            </div>
            <input type="text" class="form-control " placeholder="Ingrese su usuario" name="usuario" autocomplete="off"
                v-model="usuario">

        </div>
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text">@</span>
            </div>
            <input type="password" class="form-control" placeholder="Ingrese su contraseña" name="password"
                autocomplete="off">
        </div>
        <div class="input-group mb-3" v-if="token">
            <div class="input-group-prepend">
                <span class="input-group-text">@</span>
            </div>
            <input type="password" class="form-control" placeholder="Ingrese su token" name="token" autocomplete="off">
        </div>
        <div class="form-group">
            <button class="btn btn-amdigital">Ingresar</button>
        </div>

        <div class="form-group">
            <div class="alert" v-bind:class="{'alert-info':(info == 1), 'alert-danger':(info == 0)}" role="alert"
                v-if="mensaje != ''" v-html="mensaje">
            </div>

            <a href="">¿Olvidaste tu contraseña?</a><br>
            <span>¿Aún no tienes una cuenta? </span><a href="">CREAR CUENTA</a>
        </div>
        <div class="form-group">
            <p>Cada semana tenemos nuevas características<br>
                <small>Síguenos en nuestras redes sociales</small></p>
            <p>&copy;Amdigital
                <br>soporte@amdigital.pe</p>
        </div>
    </form>
</div>


<div id="wrapper"> </div>