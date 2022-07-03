<footer>
      
   <!-- Contenedor footer -->
<div class="me-0">
    <!-- Footer -->
    <footer
            class="text-center text-lg-start text-white" style="background-color: rgb(111,132,55)">
  
      <section class="">
        <div class="container text-center text-md-start mt-5">
 
          <div class="row mt-3">
    
            <!-- Columna Mi cuenta  -->
            <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mb-4" style="margin-top: 2%;">
              <h6 class="text-uppercase fw-bold">Mi Cuenta</h6>
              <hr class="mb-4 mt-0 d-inline-block mx-auto"style="width: 60px;  height: 2px"/>
              <p>
                <a href="mi-cuenta.php" class="text-white"> Mi Cuenta </a>
              </p>
            </div>

            <!-- Columna Contactanos -->
            <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mb-4" style="margin-top: 2%;">
              <h6 class="text-uppercase fw-bold">Contactanos</h6>
              <hr class="mb-4 mt-0 d-inline-block mx-auto"style="width: 60px;  height: 2px" />
              <p>
                <a href="solicitud-locatario.php" class="text-white"> Quiero ser locatario </a>
              </p>
              <p>
                <a href="dudasconsultas.php" class="text-white">Contacto</a>
              </p>
            </div>
  
            <!-- Columna Acerca de Nosotros -->
            <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4" style="margin-top: 2%;">
              <h6 class="text-uppercase fw-bold">Acerca de Nosotros</h6>
              <hr class="mb-4 mt-0 d-inline-block mx-auto"style="width: 60px; height: 2px" />
              <p><a href="nosotros.php" class="text-white"><i class="fas fa-home mr-3"></i>  Nosotros </a></p>
              <p><a href="terminos-condiciones.php" class="text-white"><i class="fas fa-envelope mr-3"></i> Terminos y Condiciones</a></p>
            </div>

            <!-- Columna  Pago -->
            <div class="col-md-4 col-lg-3 col-xl-4 mx-auto mb-md-0 mb-4" style="margin-top: 2%;">

                <h6 class="text-uppercase fw-bold">Paga con</h6>
                <hr class="mb-4 mt-0 d-inline-block mx-auto"style="width: 60px; height: 2px" />

                <p><i> <img src="resources/images/tarjeta.png" id="tarjeta" alt="tarjeta"  width="35" height="25" > Web Pay </i></p>

              </div>
          </div>
        </div>
      </section>

      <!-- Copyright -->
      <div class="text-center p-3"style="background-color: rgba(0, 0, 0, 0.2)" >
        © 2022 Copyright: <a> Todos los derechos reservados</a >
      </div>
    </footer>
  </div>
</footer>

   <!-- Optional JavaScript -->
    <!-- Para Hacer que el boton ver mas funcione :) -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
        integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
        crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
        integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6"
        crossorigin="anonymous"></script>

<!-- Funciones SweetAlert2 -->
<script>

function eliminarPuesto(id) {
  Swal.fire({
		  title: '¿Eliminar Puesto?',
		  text: "¿Desea Eliminar el puesto Seleccionado?",
		  type: "warning",
		  showCancelButton: true,
      cancelButtonText: 'Cancelar',
		  confirmButtonColor: '#3085d6',
		  confirmButtonText: 'Si'
		}).then((result) => {
		  if (result.value) {
			  document.getElementById("eliminar_puesto"+id).submit();
		  }
		});
}

function eliminarProducto(id) {
  Swal.fire({
		  title: '¿Eliminar Producto?',
		  text: "¿Desea Eliminar el producto Seleccionado?",
		  type: "warning",
		  showCancelButton: true,
      cancelButtonText: 'Cancelar',
		  confirmButtonColor: '#3085d6',
		  confirmButtonText: 'Si'
		}).then((result) => {
		  if (result.value) {
			  document.getElementById("eliminar_producto"+id).submit();
		  }
		});
}

function eliminarUsuario(id) {
  Swal.fire({
		  title: '¿Eliminar Usuario?',
		  text: "¿Desea Eliminar el usuario Seleccionado?",
		  type: "warning",
		  showCancelButton: true,
      cancelButtonText: 'Cancelar',
		  confirmButtonColor: '#3085d6',
		  confirmButtonText: 'Si'
		}).then((result) => {
		  if (result.value) {
			  document.getElementById("eliminar_usuario"+id).submit();
		  }
		});
}

function guardarCambios() {
  Swal.fire({
		  title: '¿Guardar Cambios?',
		  text: "¿Desea guardar los cambios?",
		  type: "success",
		  showCancelButton: true,
      cancelButtonText: 'Cancelar',
		  confirmButtonColor: '#3085d6',
		  confirmButtonText: 'Si'
		}).then((result) => {
		  if (result.value) {
			  document.getElementById("modificar_usuario").submit();
		  }
		});
}

</script>