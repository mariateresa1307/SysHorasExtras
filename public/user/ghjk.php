<div id="miModal" class="modal fade">

<div class="modal-contenido">
  <div class="row" style="background-color: #0c4dc1;width: 100%;margin-left: 0px !important; margin-right: 0px !important;height:70px">
    <div class="col-xs-6" style="color: white;">
      <h2>Agregar Usuario</h2>
    </div>
    <div class="col-xs-6" style="text-align: end;top: 10px;margin-top: 17px;padding-right: 29px;">

      <a href="#" style="text-decoration: none;color: white;">X</a>
    </div>

  </div>


  <div id="formUser">
    <form action="#" method="POST">

      <input type="text" id="InputUser" placeholder="Nombres" required>

      <input type="text" id="InputUser" placeholder="Apellido" required>


      <input type="text" id="InputUser" placeholder="Cedula" required>

    
      <input type="text" id="InputUser" placeholder="Usuario" required>


      <input type="password" id="InputUser" placeholder="Contraseña" required>


      <input type="password" id="InputUser" placeholder="Confirmar Contraseña" required>


      <input type="text" id="InputUser" placeholder="Status" required>
      

      <input type="text" id="InputUser" placeholder="Rol" required>

      
      <input type="text" id="InputUser" placeholder="Tipo de Usuario" required>


      <div style="text-align: center; margin-top: 25px;"> <input type="submit" id="ai" class="btn btn-primary"value="Agregar"></a>

    </form>

  </div>

</div>
</div>

</div>
<!-- </div> -->





<div class="form-group">
                  <label class="control-label">Nombres</label>
                  <input class="form-control" type="text" placeholder="Ingresa tu nombre">
                </div>
                <div class="form-group">
                  <label class="control-label">Apellido</label>
                  <input class="form-control" type="text" placeholder="">
                </div>
                <div class="form-group">
                  <label class="control-label">Cedula</label>
                  <input class="form-control" type="text" placeholder="Solo Numeros">
                </div>
                <div class="form-group">
                  <label class="control-label">Apellido</label>
                  <input class="form-control" type="text" placeholder="Ingresa tu Aepllido">
                </div>
                <div class="form-group">
                  <label class="control-label">Contraseña</label>
                  <input class="form-control"  type="password" placeholder="Contraseña">
                </div>
                <div class="form-group">
                  <label class="control-label">Confirmar contraseña</label>
                  <input class="form-control"  type="password" placeholder="Contraseña">
                </div>  
                <div class="form-group">
                  <label class="control-label">Email</label>
                  <input class="form-control" type="email" placeholder="Enter email address">
                </div>
                <div class="form-group">
                  <label class="control-label">Address</label>
                  <textarea class="form-control" rows="4" placeholder="Enter your address"></textarea>
                </div>
                <div class="form-group">
                  <label class="control-label">Identity Proof</label>
                  <input class="form-control" type="file">
                </div>





                <div class="tile">
            <h3 class="tile-title">Vertical Form</h3>
            <div class="tile-body">
              <form>
                <div class="form-group">
                  <label class="control-label">Name</label>
                  <input class="form-control" type="text" placeholder="Enter full name">
                </div>
                <div class="form-group">
                  <label class="control-label">Email</label>
                  <input class="form-control" type="email" placeholder="Enter email address">
                </div>
                <div class="form-group">
                  <label class="control-label">Address</label>
                  <textarea class="form-control" rows="4" placeholder="Enter your address"></textarea>
                </div>
                <div class="form-group">
                  <label class="control-label">Gender</label>
                  <div class="form-check">
                    <label class="form-check-label">
                      <input class="form-check-input" type="radio" name="gender">Male
                    </label>
                  </div>
                  <div class="form-check">
                    <label class="form-check-label">
                      <input class="form-check-input" type="radio" name="gender">Female
                    </label>
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label">Identity Proof</label>
                  <input class="form-control" type="file">
                </div>
                <div class="form-group">
                  <div class="form-check">
                    <label class="form-check-label">
                      <input class="form-check-input" type="checkbox">I accept the terms and conditions
                    </label>
                  </div>
                </div>
              </form>
            </div>
            <div class="tile-footer">
              <button class="btn btn-primary" type="button"><i class="fa fa-fw fa-lg fa-check-circle"></i>Register</button>&nbsp;&nbsp;&nbsp;<a class="btn btn-secondary keychainify-checked" href="#"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancel</a>
            </div>
          </div>




          // <?php
                // $activos = 0;
                // $desactivado = 0;
                // foreach ($this->usuarios as $value) {
                //   if ($value['status'] == "t") {
                //     $activos = $activos + 1;
                //   }else{
                //     $desactivado = $desactivado + 1;
                //   }
                // }       
                //   echo $activos;
              ?>



            // foreach ($this->usuarios as $value) { 



            <td><?=$value['id_usuario']?></td>
            <td><?=$value['nombre_usuario']?></td>
            <td><?=$value['apellido_usuario']?></td>
            <td><?=$value['usuario']?></td>
            <td><?=($value['status'] == "t") ? 'Activo' : 'Desactivado';?></td>
            <td><?=$value['nombre_tipo_usuario']?></td>
            <td> 
















