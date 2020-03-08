
<style>



ul.nav.navbar-nav.navbar-right{
	background: initial;
	position: relative;
	bottom: 115px;

}
.btn-success {
color: #fff;
background-color: rgba(244, 25, 5, 0.9);
border-color: rgba(244, 25, 5, 0.9);
}
.btn-success:hover {
color: #fff;
background-color: rgba(244, 220, 5, 0.92);
border-color: rgba(244, 220, 5, 0.92);
}
.btn-successs {
color: #fff;
background-color:  rgba(237, 215, 20, 0.84);
border-color: rgba(237, 215, 20, 0.84);
}
.btn-successs:hover {
color: #fff;
background-color:  rgba(244, 25, 5, 0.9);
border-color:  rgba(244, 25, 5, 0.9);
}

html {
	font-size: 8px;
}

.social-bar {
	position: fixed;
	right: 0%;
	top: 9%;
	font-size: 1.5rem;
	display: flex;
	flex-direction: column;
	align-items: flex-end;
	z-index: 100;
}

.icon {
	color: white;
	text-decoration: none;
	padding: .7rem;
	display: flex;
	transition: all .5s;
}

.icon-facebook {
	background: #dfd21e;
}

.icon-twitter {
	background: #339DC5;
}

.icon-youtube {
	background: #E83028;
}

.icon-instagram {
	background: #E83028;
}

.icon:first-child {
	border-radius: 1rem 0 0 0;
}

.icon:last-child {
	border-radius: 0 0 0 1rem;
}

.icon:hover {
	padding-right: 3rem;
	border-radius: 1rem 0 0 1rem;
	box-shadow: 0 0 .5rem rgba(0, 0, 0, 0.42);
}
ul.nav.navbar-nav.navbar-right {
    background: initial;
    position: relative;
    bottom: -40px;}
</style>

  <!-- Top Bar -->
    <section class="top_sec">
        <div class="container">
          <div class="social-bar">
                        <a href="" class="icon icon-facebook" target="_blank" data-toggle="modal" data-target="#modalForm" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;¡VENDE!&nbsp;&nbsp;</a>
                      <!--  <a href="https://www.youtube.com/c/devcodela" class="icon icon-youtube" target="_blank"></a> -->
                        <a href="" class="icon icon-instagram" target="_blank" data-toggle="modal" data-target="#modalForm">¡ARRIENDA!</a>
                      </div>
            <div class="row">
                <div class="col-xs-12 col-md-6 top_lft">
                    <div class="inf_txt">
                      <a href="tel:+56996736137">
                      <button class="btn btn-success btn-lg" style="font-size: 12px;" >
                        ¡Llamenos!
                    </button>
                    </a>
                    <button class="btn btn-successs btn-lg" style="font-size:12px;"  data-toggle="modal" data-target="#modalForm">
                        ¡Contáctenos ahora!
                    </button>
                    </div>
                </div>
                <!-- /.top-left -->
                <div class="col-xs-12 col-md-6 top_rgt">
                    <div class="soc_ico">
                        <ul>
                            <!--
                            <li class="inf_txt uf-dato">
								<p>$26.624,85</p>
							</li>
                            -->
                            <!-- Button to trigger modal -->
                            <!-- <button class="btn btn-success btn-lg" style="font-size:9px;"  data-toggle="modal" data-target="#modalForm">
                                ¡Contáctenos ahora!
                            </button> -->

							<li class="fb">
                                <a href="https://www.facebook.com/MateoSanchezPropiedades/" target="_blank">
                                    <img src="images/social-buttons/fb2.png" style="width: 33px;">
                                </a>
                            </li>

							<li class="insta">
                                <a href="https://www.instagram.com/mateosanchezcomerciales/" target="_blank">
                                    <img src="images/social-buttons/insta1.png" style="width: 33px;">
                                </a>
                            </li>
                            <li class="ytube">
                                <a href="https://www.youtube.com/channel/UCgX7kNlaOafuFvQoxpQbviQ" target="_blank">
                                      <img src="images/social-buttons/you2.png" style="width: 33px;">
                                </a>
                            </li>

                            <li class="rss">
                                <a href="https://api.whatsapp.com/send?phone=56996736137" target="_blank">
                                    <img src="images/social-buttons/wts1.png" style="width: 33px;">
                                </a>
                            </li>

                        </ul>
                    </div>
					<!--
                    <div class="submit_prop">
                        <h3 class="subm_btn"><a href="#prop_box" data-toggle="modal">
							<i class="fa fa-bars"></i>
							<span> Seleccionar propiedad </span></a>
						</h3>
                    </div>
					-->
                </div>
                <!-- /.top-right -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container -->
    </section>

    <!-- Modal -->
    <div class="modal fade" id="modalForm" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Modal Cabecera -->
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">
                        <span aria-hidden="true">&times;</span>
                        <span class="sr-only">Cerrar</span>
                    </button>
                    <h4 class="modal-title" id="myModalLabel">Formulario de Contacto</h4>
                </div>

                <!-- Modal Cuerpo contenido -->
                <div class="modal-body">
                    <p class="statusMsg"></p>
                    <form role="form">
                        <div class="form-group">
                            <label for="inputName">Nombre</label>
                            <input type="text" class="form-control" id="inputName" placeholder="Ingrese su nombre"/>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail">Email</label>
                            <input type="email" class="form-control" id="inputEmail" placeholder="Ingrese su email"/>
                        </div>
                        <div class="form-group">
                            <label for="inputPhone">Numero</label>
                            <textarea class="form-control" id="inputPhone" placeholder="Ingrese su Numero"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="inputMessage">Mensaje</label>
                            <textarea class="form-control" id="inputMessage" placeholder="Ingrese su mensaje"></textarea>
                        </div>
                    </form>
                </div>

                <!-- Modal Pie de Página -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary submitBtn" onclick="EnviarFormulario()">Enviar Ahora</button>
                </div>
            </div>
        </div>
    </div>

		<div class="modal fade" id="modalFormv" role="dialog">
			<div class="modal-dialog">
					<div class="modal-content">
							<!-- Modal Cabecera -->
							<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal">
											<span aria-hidden="true">&times;</span>
											<span class="sr-only">Cerrar</span>
									</button>
									<h4 class="modal-title" id="myModalLabel">Formulario de Contacto Para Venta Propiedades</h4>
							</div>

							<!-- Modal Cuerpo contenido -->
							<div class="modal-body">
									<p class="statusMsg"></p>
									<form role="form">
											<div class="form-group">
													<label for="inputName">Nombre</label>
													<input type="text" class="form-control" id="inputName" placeholder="Ingrese su nombre"/>
											</div>
											<div class="form-group">
													<label for="inputEmail">Email</label>
													<input type="email" class="form-control" id="inputEmail" placeholder="Ingrese su email"/>
											</div>
											<div class="form-group">
													<label for="inputPhone">Numero</label>
													<textarea class="form-control" id="inputPhone" placeholder="Ingrese su Numero"></textarea>
											</div>
											<div class="form-group">
													<label for="inputMessage">Mensaje</label>
													<textarea class="form-control" id="inputMessage" placeholder="Ingrese su mensaje"></textarea>
											</div>
									</form>
							</div>

							<!-- Modal Pie de Página -->
							<div class="modal-footer">
									<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
									<button type="button" class="btn btn-primary submitBtn" onclick="EnviarFormulario()">Enviar Ahora</button>
							</div>
					</div>
			</div>
	</div>


	<!-- Modal -->
	<div class="modal fade" id="modalForma" role="dialog">
			<div class="modal-dialog">
					<div class="modal-content">
							<!-- Modal Cabecera -->
							<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal">
											<span aria-hidden="true">&times;</span>
											<span class="sr-only">Cerrar</span>
									</button>
									<h4 class="modal-title" id="myModalLabel">Formulario de Contacto Arriendo Propiedades</h4>
							</div>

							<!-- Modal Cuerpo contenido -->
							<div class="modal-body">
									<p class="statusMsg"></p>
									<form role="form">
											<div class="form-group">
													<label for="inputName">Nombre</label>
													<input type="text" class="form-control" id="inputName" placeholder="Ingrese su nombre"/>
											</div>
											<div class="form-group">
													<label for="inputEmail">Email</label>
													<input type="email" class="form-control" id="inputEmail" placeholder="Ingrese su email"/>
											</div>
											<div class="form-group">
													<label for="inputPhone">Numero</label>
													<textarea class="form-control" id="inputPhone" placeholder="Ingrese su Numero"></textarea>
											</div>
											<div class="form-group">
													<label for="inputMessage">Mensaje</label>
													<textarea class="form-control" id="inputMessage" placeholder="Ingrese su mensaje"></textarea>
											</div>
									</form>
							</div>

							<!-- Modal Pie de Página -->
							<div class="modal-footer">
									<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
									<button type="button" class="btn btn-primary submitBtn" onclick="EnviarFormulario()">Enviar Ahora</button>
							</div>
					</div>
			</div>
	</div>


    <!-- Navigation -->
    <nav class="navbar" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <!-- Logo -->
                <a class="navbar-brand" href="../index.php"><img src="images/logo-web.png" alt="logo">
                </a>

            </div>

            <!-- Navigation -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1" >
							<?php require_once('sidebar2.php'); ?>
                <ul class="nav navbar-nav navbar-right"   >

                    <li>
                        <a href="index.php">Home</a>
                    </li>
                    <li>
                        <a href="resultado-buscador.php?id_tipo_valor=1">Buscador</a>
                    </li>
                    <li>
                      <a href="resultado-buscador-comercial.php?id_tipo_valor=1">Comercial</a>
                    </li>
                <li>
                    <a href="resultado-buscador-habitacional.php?id_tipo_valor=1">Habitacional</a>
                        </li>
                      <li>
                    <a href="servicios.php">Administraciones<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Servicios</a>
                    </li>
					<li>
                        <a href="quienes-somos.php">Quienes somos</a>
                    </li>
					<!--
                    <li>
                        <a href="#">Trabaja con nosotros</a>
                    </li>
					-->

                    <li>
                        <a href="contacto.php">Contacto</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>

    <script>
    function EnviarFormulario(){
        var reg = /^[A-Z0-9._%+-]+@([A-Z0-9-]+\.)+[A-Z]{2,4}$/i;
        var name = $('#inputName').val();
        var email = $('#inputEmail').val();
        var phone = $('#inputPhone').val();
        var message = $('#inputMessage').val();
        if(name.trim() == '' ){
    		alert('Por Favor ingrese su nombre.');
            $('#inputName').focus();
    		return false;
    	}else if(email.trim() == '' ){
    		alert('Por favor ingrese su email.');
            $('#inputEmail').focus();
    		return false;
    	}else if(email.trim() != '' && !reg.test(email)){
    		alert('Por favor ingrese un email valido.');
            $('#inputEmail').focus();
    		return false;
      }else if(phone.trim() == '' ){
        alert('Por favor ingrese su numero.');
            $('#inputPhone').focus();
        return false;
    	}else if(message.trim() == '' ){
    		alert('Por favor ingrese su mensaje.');
            $('#inputMessage').focus();
    		return false;
    	}else{
            $.ajax({
                type:'POST',
                url:'EnviarForm.php',
                data:'ContactoEnviar=1&name='+name+'&email='+email+'&phone='+phone+'&message='+message,
                beforeSend: function () {
                    $('.submitBtn').attr("disabled","disabled");
                    $('.modal-body').css('opacity', '.5');
                },
                success:function(msg){
                    if(msg == 'bien'){
                        $('#inputName').val('');
                        $('#inputEmail').val('');
                        $('#inputPhone').val('');
                        $('#inputMessage').val('');
                        $('.statusMsg').html('<span style="color:green;">Gracias por contactarnos, nos pondremos en contacto con usted pronto.</p>');
                    }else{
                        $('.statusMsg').html('<span style="color:red;">Ha ocurrido algún problema, por favor intente de nuevo.</span>');
                    }
                    $('.submitBtn').removeAttr("disabled");
                    $('.modal-body').css('opacity', '');
                }
            });
        }
    }
    </script>
    <script>
  function EnviarFormulario(){
      var reg = /^[A-Z0-9._%+-]+@([A-Z0-9-]+\.)+[A-Z]{2,4}$/i;
      var name = $('#inputName').val();
      var email = $('#inputEmail').val();
      var phone = $('#inputPhone').val();
      var message = $('#inputMessage').val();
      if(name.trim() == '' ){
      alert('Por Favor ingrese su nombre.');
          $('#inputName').focus();
      return false;
    }else if(email.trim() == '' ){
      alert('Por favor ingrese su email.');
          $('#inputEmail').focus();
      return false;
    }else if(email.trim() != '' && !reg.test(email)){
      alert('Por favor ingrese un email valido.');
          $('#inputEmail').focus();
      return false;
    }else if(phone.trim() == '' ){
      alert('Por favor ingrese su numero.');
          $('#inputPhone').focus();
      return false;
    }else if(message.trim() == '' ){
      alert('Por favor ingrese su mensaje.');
          $('#inputMessage').focus();
      return false;
    }else{
          $.ajax({
              type:'POST',
              url:'EnviarFormA.php',
              data:'ContactoEnviar=1&name='+name+'&email='+email+'&phone='+phone+'&message='+message,
              beforeSend: function () {
                  $('.submitBtn').attr("disabled","disabled");
                  $('.modal-body').css('opacity', '.5');
              },
              success:function(msg){
                  if(msg == 'bien'){
                      $('#inputName').val('');
                      $('#inputEmail').val('');
                      $('#inputPhone').val('');
                      $('#inputMessage').val('');
                      $('.statusMsg').html('<span style="color:green;">Gracias por contactarnos, nos pondremos en contacto con usted pronto.</p>');
                  }else{
                      $('.statusMsg').html('<span style="color:red;">Ha ocurrido algún problema, por favor intente de nuevo.</span>');
                  }
                  $('.submitBtn').removeAttr("disabled");
                  $('.modal-body').css('opacity', '');
              }
          });
      }
  }
  </script>
  <script>
  function EnviarFormulario(){
      var reg = /^[A-Z0-9._%+-]+@([A-Z0-9-]+\.)+[A-Z]{2,4}$/i;
      var name = $('#inputName').val();
      var email = $('#inputEmail').val();
      var phone = $('#inputPhone').val();
      var message = $('#inputMessage').val();
      if(name.trim() == '' ){
      alert('Por Favor ingrese su nombre.');
          $('#inputName').focus();
      return false;
    }else if(email.trim() == '' ){
      alert('Por favor ingrese su email.');
          $('#inputEmail').focus();
      return false;
    }else if(email.trim() != '' && !reg.test(email)){
      alert('Por favor ingrese un email valido.');
          $('#inputEmail').focus();
      return false;
    }else if(phone.trim() == '' ){
      alert('Por favor ingrese su numero.');
          $('#inputPhone').focus();
      return false;
    }else if(message.trim() == '' ){
      alert('Por favor ingrese su mensaje.');
          $('#inputMessage').focus();
      return false;
    }else{
          $.ajax({
              type:'POST',
              url:'EnviarFormV.php',
              data:'ContactoEnviar=1&name='+name+'&email='+email+'&phone='+phone+'&message='+message,
              beforeSend: function () {
                  $('.submitBtn').attr("disabled","disabled");
                  $('.modal-body').css('opacity', '.5');
              },
              success:function(msg){
                  if(msg == 'bien'){
                      $('#inputName').val('');
                      $('#inputEmail').val('');
                      $('#inputPhone').val('');
                      $('#inputMessage').val('');
                      $('.statusMsg').html('<span style="color:green;">Gracias por contactarnos, nos pondremos en contacto con usted pronto.</p>');
                  }else{
                      $('.statusMsg').html('<span style="color:red;">Ha ocurrido algún problema, por favor intente de nuevo.</span>');
                  }
                  $('.submitBtn').removeAttr("disabled");
                  $('.modal-body').css('opacity', '');
              }
          });
      }
  }
  </script>
