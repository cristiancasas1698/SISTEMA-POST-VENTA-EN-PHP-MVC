
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

              <?php
                 $item = null;
                 $valor = null;

                 $usuarios = ControllerUsers::ctrMostrarUsuario($item,$valor);

          

                 foreach ($usuarios as $key => $value) {

                  echo'<tr>
                  <td>'.$value["id"].'</td>
                  <td>'.$value["nombre"].'</td>
                  <td>'.$value["usuario"].'</td>';
                  if ($value["foto"] != "") {
                    echo '<td><img src="'.$value["foto"].'" class="img-thumbnail" width="40px"></td>';
                  }else{
                    echo'<td><img src="view/img/anonymous.png" class="img-thumbnail" width="40px"></td>';
                  }
                
                  echo '<td>'.$value["perfil"].'</td>
                  <td><button class="btn btn-success btn-xs">Activado</button></td>
                  <td>'.$value["ultimo_login"].'</td>
                  <td>
                    <div class="btn-group">
                      <button class="btn btn-warning btnEditarUsuario" idUsuario="'.$value["id"].'" data-toggle="modal" data-target="#ModalEditarUsuario"><i class="fa fa-pencil"></i></button>
                      <button class="btn btn-danger"><i class="fa fa-times"></i></button>
                    </div>
                  </td>
                </tr>';
                   
                 }



              ?>
                
              </body>
          </table>
        </div>
      </div>
    </section>
  </div>

<!--===========================================
MODAL PARA CREAR USUARIOS
============================================-->

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


<!--===========================================
MODAL PARA EDITAR USUARIO
============================================-->

<div id="ModalEditarUsuario" class="modal fade" role="dialog">
      <div class="modal-dialog">

        <!-- contenido del modal y del titulo-->
        <div class="modal-content"> 

    <!-- form para poder trabajar el formulario de registro -->
    <!-- use multipart/form-datacuando su formulario incluya cualquier <input type="file">elemento -->
      <form action="" role="form" method="post" enctype="multipart/form-data">

        <div class="modal-header" style="background:#3c8dbc; color:white; ">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Editar Usuarios</h4>
        </div>

      <!-- Cuerpo del modal-->
        <div class="modal-body">
          <div class="box-body">

            <!-- Campo del Nombre-->
            <div class="form-group">
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-user"></i></span>
              <input type="text" class="form-control input-lg" name="Editarnombre" id="Editarnombre" value="" required>
            </div>
          </div>

          <!-- Campo del Nombre de usuario-->
          <div class="form-group">
            <div class="input-group">
              <span class="input-group-addon"><i class="fa fa-key"></i></span>
              <input type="text" class="form-control input-lg" name="Editarusuario" id="Editarusuario" value="" readonly>
            </div>
          </div>

           <!-- Campo de contraseña-->
           <div class="form-group">
            <div class="input-group">
              <span class="input-group-addon"><i class="fa fa-lock"></i></span>
              <input type="password" class="form-control input-lg" name="Editarpassword" placeholder="escriba la nueva contraseña" required>
              <input type="hidden" id="passwordActual" name="passwordActual">
            </div>
          </div>

          <!-- Campo de perfil !se coloco en un select¡-->
          <div class="form-group">
            <div class="input-group">
              <span class="input-group-addon"><i class="fa fa-users"></i></span>
              <select name="Editarperfil" class="form-control input-lg">
                <option value="" id="Editarperfil"> </option>
                <option value="Administrador">Administrador</option>
                <option value="Especial">Especial</option>
                <option value="Vendedor">Vendedor</option>
              </select>
            </div>
          </div>

          <!-- Campo para Subir la foto-->
          <div class="form-group"> 
            <div class="panel">SUBIR FOTO</div>
            <input type="file" class="Nuevafoto" name="Editarfoto">
            <p class="help-block">peso maximo de la foto 2 MB</p>
            <img src="view/img/anonymous.png" class="img-thumbnail previsualizar" width="100px">
            <input type="hidden" name="fotoActual"  id="fotoActual">
          </div>

        </div>  
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Actualizar usuario</button>
      </div>
      <?php


      //los metodos que nos permiten hacer UPDATE al usuario desde user.controller
      $editarUsuario = new ControllerUsers();
      $editarUsuario -> ctrEditarUsuario();


       ?>
    </form>
   </div>

  </div>
</div>