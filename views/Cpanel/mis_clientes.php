<?php
require URLINC . 'nav_dash.php';
require URLINC . 'check_session.php';
?>
<div class="col-12">
    

</div>
<div class="row">

    <div class="col-12">
         <table id="datatable" class="datatable table table-sm dt-responsive" width="100%" nowrap>
            <thead>
                <tr>
                    <th class="text-center">Imagen</th>
                    <th class="text-center">Empresa</th>
                    <th class="text-center">Primera Observación</th>
                    <th class="text-center">Origen</th>
                    <th class="text-center">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="cliente in clientes">
                    <td class="align-middle" width="10%">
                        <div class="img_center">
                            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcR_8Nx67s9JJVDMNZ9FS_Q9QrkixTatiOBhvf6Zbk36NlqFh-mW8g" alt="">
                        </div>
                    </td>
                    <td class="align-middle text-center" width="25%">
                        <b>{{cliente.empresa.toUpperCase()}}</b><br>
                        <div class="star-rating" @mouseover="QuitarEstrella" @mouseleave="PonerEstrella">
                            <a :class="{ estrella_marcada : cliente.calificacion >= 1}" href="#" @click="CambiarCalificacion(cliente.id,1)">★</a>
                            <a :class="{ estrella_marcada : cliente.calificacion >= 2}" href="#" @click="CambiarCalificacion(cliente.id,2)">★</a>
                            <a :class="{ estrella_marcada : cliente.calificacion >= 3}" href="#" @click="CambiarCalificacion(cliente.id,3)">★</a>
                            <a :class="{ estrella_marcada : cliente.calificacion >= 4}" href="#" @click="CambiarCalificacion(cliente.id,4)">★</a>
                            <a :class="{ estrella_marcada : cliente.calificacion >= 5}" href="#" @click="CambiarCalificacion(cliente.id,5)">★</a>
                        </div><br>
                        <small>{{cliente.fecha}} | {{cliente.hora}}</small><br>
                        <p class="p_datos_line"><small><b>Departamento : </b>{{cliente.departamento}}</small><br>
                            <small><b>Provincia : </b>{{cliente.provincia}}</small><br>
                            <small><b>Distrito : </b>{{cliente.distrito}}</small><br></p>
                    </td>
                    <td class="align-middle text-center">
                        <p class="p_datos_justi p_datos_line">
                            <small><b>Primera observación : </b></small>
                            <small>{{cliente.observacion}}</small>
                        </p>
                        <p class="p_datos_justi p_datos_line">
                            <small><b>Primer mensaje : </b></small>
                            <small>{{cliente.mensaje}}</small>
                        </p>
                    </td>
                    <td class="align-middle text-center">{{cliente.id_origen.toUpperCase()}}</td>
                    <td class="align-middle text-center ">
                        <div class="row m-0 p-0">
                            <div class="col-6 p-0 m-0">
                                <img @click="AbrirModal" class="img_datatable_c" src="<?php echo URL . URLIMG ?>envelope.svg" alt="">
                            </div>
                            <div class="col-6 p-0 m-0">
                                <img class="img_datatable_c" src="<?php echo URL . URLIMG ?>sms.svg" alt="">
                            </div>
                            <div class="col-6 p-0 m-0">
                                <img class="img_datatable_c" src="<?php echo URL . URLIMG ?>notes.svg" alt="">
                            </div>
                            <div class="col-6 p-0 m-0">
                                <img class="img_datatable_c" src="<?php echo URL . URLIMG ?>notes.svg" alt="">
                            </div>
                            <div class="col-6 p-0 m-0">
                                <img class="img_datatable_c" src="<?php echo URL . URLIMG ?>notes.svg" alt="">
                            </div>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table> 
       
    </div>

</div>
<div id="correos_cliente" class="ocultar">
    <div class="row">
        <div class="col-12">
            <form action="" @submit="MandarMensaje" action="#" method="post">
                <div class="form group mb-2 ">
                    <input type="text" class="form-control form-control-sm" name="asunto" placeholder="Nombre del asunto">
                </div>
                <div class="form group mb-2 row ">
                    <div class="col-9 pr-0">
                        <textarea id="summernote" class="form-control form-control-sm" name="observacion"></textarea>
                        <button type="submit" class="btn btn-amdigital-a btn-sm">Enviar</button>

                    </div>
                    <div class="col-3">
                        <div id="fileuploader">Upload</div>
                    </div>
                </div>

            </form>
        </div>
        <div class="col-12">
            <hr>
        </div>
        <div class="col-4">
            Lorem ipsum, dolor sit amet consectetur adipisicing elit. Tempora error eligendi repellat dolores explicabo alias, doloribus tenetur amet iste consequatur voluptatum numquam eum laudantium. Debitis eos reprehenderit provident mollitia veniam.
        </div>
        <div class="col-8">
            <table class="datatable_mensajes  table-sm dt-responsive" width="100%" nowrap>
                <thead>
                    <tr>
                        <th class="text-center ocultar"></th>
                        <th class="text-center ocultar"></th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="item in correos_lista">
                        <td class="text-center ocultar">{{item.contador}}</td>
                        <td>
                            <div class="mensaje mt-1 row" :class="{mensaje_b:item.tipo == 'C'}">
                                <div class="col-12 col-lg-3 text-center ">
                                    <div class="avatar" :class="{avatar_s:item.tipo == 'S',avatar_v:item.tipo == 'V',avatar_c:item.tipo == 'C'}">{{item.tipo}}</div>
                                </div>
                                <div class="col-12 col-lg-9 mensaje_flecha  " :class="{mensaje_flecha_l:item.tipo == 'S'||item.tipo == 'V',mensaje_flecha_r:item.tipo == 'C'}">
                                    <p class="datos m-0 pl-3 pr-3 pt-1 pb-1 p_datos_justi">
                                        <small>{{item.fecha}} {{item.hora}}</small><br></small>
                                        <small><span v-if="item.tipo == 'S'"><b>Enviado por : </b>CRM</span></small>
                                        <small><span v-if="item.tipo == 'C'"><b>Enviado por : </b>CLIENTE</span></small>
                                        <small><span v-if="item.tipo == 'V'"><b>Enviado por : </b>VENDEDOR</span></small>
                                        <small><span v-if="item.revisado == 0">NUEVO</span><br></small>
                                        <small><b>Mensaje : </b><span v-html="item.mensaje"></small>
                                    </p>
                                </div>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>