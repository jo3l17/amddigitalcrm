<?php
require URLINC . 'nav_dash.php';
require URLINC . 'check_session.php';
?>
<div class="row">
    <div class="col-12">
        <table class="datatable table table-sm table-bordered dt-responsive" width="100%" nowrap>
            <thead>
                <tr>
                    <th></th>
                    <th>Empresa</th>
                    <th>Primer Contacto</th>
                    <th>Ubigeo</th>
                    <th>Mensaje</th>
                    <th>Primera Observación</th>
                    <th>Origen</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="cliente in clientes">
                    <td class="align-middle text-center"><img class="img_datatable_c" src="<?php echo URL . URLIMG ?>accept.svg" alt="" v-on:click="AdministrarCliente(cliente.id)"></td>
                    <td class="align-middle text-center" width="20%">{{cliente.empresa.toUpperCase()}}</td>
                    <td class="align-middle text-center">
                        <small><b>Fecha : </b>{{cliente.fecha}}</small><br>
                        <small><b>Hora : </b>{{cliente.hora}}</small><br>
                    </td>
                    <td class="align-middle text-center">
                        <small><b>Departamento : </b>{{cliente.departamento}}</small><br>
                        <small><b>Provincia : </b>{{cliente.provincia}}</small><br>
                        <small><b>Distrito : </b>{{cliente.distrito}}</small><br>
                    </td>
                    <td class="align-middle text-center" width="20%"><small>{{cliente.mensaje.toUpperCase()}}</small></td>
                    <td class="align-middle text-center" width="20%"><small>{{cliente.observacion.toUpperCase()}}</small></td>

                    <td class="align-middle text-center">{{cliente.id_origen.toUpperCase()}}</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>