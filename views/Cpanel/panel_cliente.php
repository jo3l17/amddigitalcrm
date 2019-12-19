<?php 
require URLINC.'nav_dash.php';
require URLINC.'check_session.php';
?>

<div id="app_cliente" class="container-fluid">
	<div class="row row_principal" >

		<div class="col-12 col-lg-4" style="overflow: visible;">
			<div class="row">
				<div class="col-12 ">	
					<hr class="mb-1">		
					<h5 class="mb-1"><i class="fa fa-bars" aria-hidden="true"></i> Correos</h5>
					<small><i class="far fa-edit"></i> Aquí podrá ver toda la información de todos sus clientes asignados</small>
					<hr class="mt-1">
				</div>
				<div class="col-12 ">
					<div class="form-group row">
						<div class="col-12 ">
								
							<textarea id="txt_mensaje"class="form-control" rows="2" placeholder="Escriba un mensaje aqui" v-on:keyup.enter="MandarMensaje" ></textarea>
							<p id="p">{{estado}}</p>
						</div>						
					</div>

				</div>
				<div class="col-12 ">
					<div v-for="item in correos">						
						<div class="mensaje mt-1" :class="{mensaje_b:item.tipo == 'C'}">
							<div>
								<img class="img-fluid avatar" src="<?php echo URL.URLIMG?>avatar.jpg" alt="">
							</div>
							<div class="mensaje_flecha" :class="{mensaje_flecha_l:item.tipo == 'S'||item.tipo == 'V',mensaje_flecha_r:item.tipo == 'C'}">
								<small>{{item.fecha}} - {{item.hora}}</small><br>
								<small v-if="item.tipo == 'S'">Enviado por : <b>CRM</b></small>
								<small v-if="item.tipo == 'C'">Enviado por : <b>CLIENTE</b></small>
								<small v-if="item.tipo == 'V'">Enviado por : <b>VENDEDOR</b></small>
								<small v-if="item.revisado == 0">NUEVO</small>
								<p class="mb-1">{{item.mensaje}}</p>
							</div>				
						</div>	
					</div>
					<br>
				</div>	
			</div>
		</div>
		<div class="col-12 col-lg-4">

		</div>
		<div class="col-12 col-lg-4">

			<div class="toast">
				<div class="toast-header">
					Toast Header
				</div>
				<div class="toast-body">
					Some text inside the toast body
				</div>
			</div>
		</div>	
	</div>
</div>

