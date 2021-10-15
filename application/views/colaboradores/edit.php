

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
                <small>Última Alteração - <?php echo formata_data_banco_com_hora($colaborador->dt_modificacao); ?></small>
              </h6>
            </div>
            <div class="card-body">
              <form class="user" method="POST" name="form_edit">
                
                <fieldset class="mt-2 border p-3">
                  <legend style="font-size: 16px"><i class="<?php echo $icon; ?>"></i> Dados Pessoais</legend>

                  <div class="form-group row">
                      <div class="col-md-12">
                        <label>Empresa</label>
                        <input type="text" class="form-control" value="<?php echo $colaborador->colaborador_empresa; ?>" readonly>
                      </div>
                    </div>  

                    <div class="form-group row">
                      <div class="col-md-3">
                        <label>Nome</label>
                        <input type="text" class="form-control" name="colaborador_nome" value="<?php echo $colaborador->colaborador_nome; ?>">
                        <?php echo form_error('colaborador_nome', '<small class="form-text text-danger">','</small>'); ?>
                      </div>
                      <div class="col-md-7">
                        <label>Sobrenome</label>
                        <input type="text" class="form-control" name="colaborador_sobrenome" value="<?php echo $colaborador->colaborador_sobrenome; ?>">
                        <?php echo form_error('colaborador_sobrenome', '<small class="form-text text-danger">','</small>'); ?>
                      </div>
                      <div class="col-md-2">
                        <label>Data Nascimento</label>
                        <input type="date" class="form-control" name="colaborador_data_nascimento" value="<?php echo $colaborador->colaborador_data_nascimento; ?>">
                        <?php echo form_error('colaborador_data_nascimento', '<small class="form-text text-danger">','</small>'); ?>
                      </div>   
                    </div>

                    <div class="form-group row mb-3">
                      <div class="col-md-2">
                        <label>Telefone</label>
                        <input type="text" class="form-control phone_with_ddd" name="colaborador_telefone" value="<?php echo $colaborador->colaborador_telefone; ?>">
                        <?php echo form_error('colaborador_telefone', '<small class="form-text text-danger">','</small>'); ?>
                      </div> 
                      <div class="col-md-2">
                        <label>Celular <a href="https://api.whatsapp.com/send?l=pt_BR&phone=55<?php echo $colaborador->colaborador_celular; ?>" target="_blank" aria-label="link to https://api.whatsapp.com/send?l=pt_BR&phone=55<?php echo $colaborador->colaborador_celular; ?>" rel="noopener"><i class="fab fa-whatsapp" aria-hidden="true"></i></a></label>
                        <input type="text" class="form-control sp_celphones" name="colaborador_celular" value="<?php echo $colaborador->colaborador_celular; ?>">
                        <?php echo form_error('colaborador_celular', '<small class="form-text text-danger">','</small>'); ?>
                      </div>
                      <div class="col-md-6">
                        <label>E-mail</label>
                        <input type="email" class="form-control" name="colaborador_email" value="<?php echo $colaborador->colaborador_email; ?>">
                        <?php echo form_error('colaborador_email', '<small class="form-text text-danger">','</small>'); ?>
                      </div>
                      <div class="col-md-2">
                        <label>Status</label>                 
                        <select class="form-control" name="colaborador_status">                   
                          <option value="0" <?php echo ($colaborador->colaborador_status == 0) ? 'selected' : '' ?>>Inativo</option>
                          <option value="1" <?php echo ($colaborador->colaborador_status == 1) ? 'selected' : '' ?>>Ativo</option>
                        </select>
                      </div>     
                    </div>

                </fieldset>
                <input type="hidden" name="colaborador_id" value="<?php echo $colaborador->colaborador_id; ?>">
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

      
