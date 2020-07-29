
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">

      <h1>
        administrar usuarios
        <small>usuarios</small>
      </h1>

      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> home</a></li>
        <li class="active">administrador de usuarios</li>
      </ol>
      
    </section>

    <!-- Main content -->
    <section class="content">

      
      <div class="box">
        <div class="box-header with-border">
          <!-- agregando un boton para agregar usuarios -->
          <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarUsuario"> 
            agregar usuario
          </button>           
        </div>
        <div class="box-body">
          <table class="table table-bordered table-striped datatable">
            <thead>
              <tr>
                <th>#</th>
                <th>Nombre</th>
                <th>usuario</th>
                <th>Foto</th>
                <th>Perfil</th>
                <th>Estado</th>
                <th>Ultimo-login</th>
                <th>Acciones</th>
              </tr>
            </thead>
              <body>
                <tr>
                  <td>1</td>
                  <td>Ususario Administrador</td>
                  <td>Admin</td>
                  <td><img src="view/img/anonymous.png" class="img-thumbnail" width="40px"></td>
                  <td>Administrador</td>
                  <td><button class="btn btn-success btn-xs">Activado</button></td>
                  <td>2020-02-02 12:05:37</td>
                  <td>
                    <div class="btn-group">
                      <button class="btn btn-warning"><i class="fa fa-pencil"></i></button>
                      <button class="btn btn-danger"><i class="fa fa-times"></i></button>
                    </div>
                  </td>
                </tr>
              </body>
          </table>
        </div>
      </div>
    </section>
  </div>

  <!-- modal para registrar un usuario nuevo -->

  <div id="modalAgregarUsuario" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- contenido del modal y del titulo-->
    <div class="modal-content"> 

<!-- form para poder trabajar el formulario de registro -->
<!-- use multipart/form-datacuando su formulario incluya cualquier <input type="file">elemento -->
  <form action="" role="form" method="post" enctype="multipart/form-data">

      <div class="modal-header" style="background:#3c8dbc; color:white; ">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Agregar Usuario</h4>
      </div>

     <!-- Cuerpo del modal-->
      <div class="modal-body">
        <div class="box-body">

          <!-- Campo del Nombre-->
          <div class="form-group">
            <div class="input-group">
              <span class="input-group-addon"><i class="fa fa-user"></i></span>
              <input type="text" class="form-control input-lg" name="Nuevonombre" placeholder="ingresar nombre" required>
            </div>
          </div>

          <!-- Campo del Nombre de usuario-->
          <div class="form-group">
            <div class="input-group">
              <span class="input-group-addon"><i class="fa fa-key"></i></span>
              <input type="text" class="form-control input-lg" name="Nuevousuario" placeholder="ingresar usuario" required>
            </div>
          </div>

           <!-- Campo de contraseña-->
           <div class="form-group">
            <div class="input-group">
              <span class="input-group-addon"><i class="fa fa-lock"></i></span>
              <input type="password" class="form-control input-lg" name="Nuevopassword" placeholder="ingresar contraseña" required>
            </div>
          </div>

          <!-- Campo de perfil !se coloco en un select¡-->
          <div class="form-group">
            <div class="input-group">
              <span class="input-group-addon"><i class="fa fa-users"></i></span>
              <select name="Nuevoperfil" class="form-control input-lg">
                <option value="">seleccionar perfil</option>
                <option value="Administrador">Administrador</option>
                <option value="Especial">Especial</option>
                <option value="Vendedor">Vendedor</option>
              </select>
            </div>
          </div>

          <!-- Campo para Subir la foto-->
          <div class="form-group"> 
            <div class="panel">SUBIR FOTO</div>
            <input type="file" class="Nuevafoto" name="Nuevafoto">
            <p class="help-block">peso maximo de la foto 2 MB</p>
            <img src="view/img/anonymous.png" class="img-thumbnail previsualizar" width="100px">
          </div>

        </div>  
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">guardar cambios</button>
      </div>
      <?php

      $crearUsuario = new ControllerUsers();
      $crearUsuario -> ctrCrearUsuario();


      ?>
  </form>
    </div>

  </div>
</div>