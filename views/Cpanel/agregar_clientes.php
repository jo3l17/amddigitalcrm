<?php
require URLINC . 'nav_dash.php';
require URLINC . 'check_session.php';
?>
<div class="row">
    <div class="col-12 col-lg-4">
        <form id="form_agregar_cliente" action="#" @submit="AgregarCliente" method="post">
            <div class="form-group">
                <label>Nombre empresa : </label>
                <input id="input_empresa" name="empresa" class="form-control form-control-sm" type="text" placeholder="Ingrese el nombre de la empresa" required autocomplete="off">
            </div>
            <div class="form-group">
                <label>Correo : </label>
                <input id="input_correo" name="correo_principal" class="form-control form-control-sm" type="email" placeholder="Ingrese un correo valido" required autocomplete="off">
            </div>
            <div class="form-group">
                <label>Celular : </label>
                <input id="input_telefono" name="telefono" class="form-control form-control-sm" type="number" placeholder="Ingrese su número de celular" required autocomplete="off">
            </div>
            <div class="form-group">
                <label>Ubigeo : </label>
                <select name="id_ubigeo" class="select_ubigeos form-control form-control-sm" data-live-search="true" data-size="5" required>
                    <option value="" disabled selected>Seleccione ubigeo</option>
                    <option v-for="ubigeo in ubigeos" :value="ubigeo.id">{{ubigeo.departamento}} - {{ubigeo.provincia}} - {{ubigeo.distrito}}</option>
                </select>
            </div>
            <div class="form-group">
                <label>Usuarios : </label>
                <select name="id_usuario_asignado" class="select_usuarios form-control form-control-sm" data-live-search="true" data-size="5" required>
                    <option value="" disabled selected>Seleccione usuario</option>
                    <option value="">CRM - Sistema</option>
                    <option v-for="usuario in usuarios" :value="usuario.id">{{usuario.usuario}}</option>
                </select>
            </div>
            <div class="form group">
                <label for="">Observación : </label>
                <textarea class="form-control form-control-sm" name="observacion"  cols="30" rows="6"></textarea>
            </div>
            <div class="form group">
                <button type="submit" class="btn btn-amdigital-a btn-sm">Agregar</button>
            </div>
        </form>
    </div>
</div>
