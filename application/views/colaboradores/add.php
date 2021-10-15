

    <?php $this->load->view('layout/sidebar.php'); ?>

    

      <!-- Main Content -->
      <div id="content">

        <?php $this->load->view('layout/navbar.php'); ?>

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="<?php echo base_url('/'); ?>">Home</a></li>
              <li class="breadcrumb-item"><a href="<?php echo base_url('/'.$pagina); ?>"><?php echo $lista; ?></a></li>
              <li class="breadcrumb-item active" aria-current="page"><?php echo $titulo; ?></li>
            </ol>
          </nav>
          
          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-secondary">
                <i class="<?php echo $icon; ?>"></i> <?php echo $titulo; ?> <br/>
              </h6>
            </div>
            <div class="card-body">
              <form class="user" method="POST" name="form_add">
 
              <fieldset class="mt-2 border p-3">
                  <legend style="font-size: 16px"><i class="<?php echo $icon; ?>"></i> Dados Pessoais</legend>

                    <div class="form-group row">
                      <div class="col-md-3">
                        <label>Nome</label>
                        <input type="text" class="form-control" name="colaborador_nome" value="<?php echo set_value('colaborador_nome'); ?>">
                        <?php echo form_error('colaborador_nome', '<small class="form-text text-danger">','</small>'); ?>
                      </div>
                      <div class="col-md-5">
                        <label>Sobrenome</label>
                        <input type="text" class="form-control" name="colaborador_sobrenome" value="<?php echo set_value('colaborador_sobrenome'); ?>">
                        <?php echo form_error('colaborador_sobrenome', '<small class="form-text text-danger">','</small>'); ?>
                      </div>
                      <div class="col-md-2">
                        <label>Data Nascimento</label>
                        <input type="date" id="idade" onfocusout="getIdade()" class="form-control" name="colaborador_data_nascimento" value="<?php echo set_value('colaborador_data_nascimento'); ?>">
                        <?php echo form_error('colaborador_data_nascimento', '<small class="form-text text-danger">','</small>'); ?>
                      </div>
                      <div class="col-md-2">
                        <label >Idade</label>
                        <input type="text" class="form-control" document.write(getIdade(age)) readonly>
                        <script language=javascript type="text/javascript">document.write(getIdade(age))</script>
                      </div>  
                    </div>

                    <div class="form-group row mb-3">
                      <div class="col-md-2">
                        <label>Telefone</label>
                        <input type="text" class="form-control phone_with_ddd" name="colaborador_telefone" value="<?php echo set_value('colaborador_telefone'); ?>">
                        <?php echo form_error('colaborador_telefone', '<small class="form-text text-danger">','</small>'); ?>
                      </div> 
                      <div class="col-md-2">
                        <label>Celular</label>
                        <input type="text" class="form-control sp_celphones" name="colaborador_celular" value="<?php echo set_value('colaborador_celular'); ?>">
                        <?php echo form_error('colaborador_celular', '<small class="form-text text-danger">','</small>'); ?>
                      </div>
                      <div class="col-md-6">
                        <label>E-mail</label>
                        <input type="email" class="form-control" name="colaborador_email" value="<?php echo set_value('colaborador_email'); ?>">
                        <?php echo form_error('colaborador_email', '<small class="form-text text-danger">','</small>'); ?>
                      </div>
                      <div class="col-md-2">
                        <label>Status</label>                 
                        <select class="form-control" name="colaborador_status">                   
                          <option value="1">Ativo</option>
                          <option value="0">Inativo</option>
                        </select>
                      </div>     
                    </div>

                </fieldset>

                <hr>
                <div>
                  <button type="submit" class="btn btn-sm btn-primary">Salvar</button>
                  <a href="<?php echo base_url('/'.$pagina) ?>" class="btn btn-sm btn-light btn-sm">Voltar</a>
                </div>
              </form>

            </div>
          </div>

        </div>
        <!-- /.container-fluid -->

        

      </div>
      <!-- End of Main Content -->

      <script>
        function getIdade() {
          var dateString = document.getElementById('idade').value;        
          var today = new Date();
          var birthDate = new Date(dateString);
          var age = today.getFullYear() - birthDate.getFullYear();
          var m = today.getMonth() - birthDate.getMonth();
          if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) {
              age--;
          }
          console.log("Idade: " + age);
          return age;
        }
    </script>

      
