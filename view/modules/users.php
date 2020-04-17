
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
          <table class="table table-bordered table-striped">
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
      <!-- /.box -->
    </section>
    <!-- /.content -->
  </div>
  <!-- modal para registrar un usuario nuevo -->
  <div id="modalAgregarUsuario" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Modal Header</h4>
      </div>
      <div class="modal-body">
        <p>Some text in the modal.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>