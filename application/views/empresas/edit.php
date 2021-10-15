

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
                <small>Última Alteração - <?php echo formata_data_banco_com_hora($empresa->dt_modificacao); ?></small>
              </h6>
            </div>
            <div class="card-body">
              <form class="user" method="POST" name="form_edit">
                
                <fieldset class="mt-2 border p-3">
                  <legend style="font-size: 16px"><i class="<?php echo $icon; ?>"></i> Dados Empresariais</legend>

                    <div class="form-group row">
                      <div class="col-md-6">
                        <label>Razão Social</label>
                        <input type="text" class="form-control" name="empresa_razao_social" value="<?php echo $empresa->empresa_razao_social; ?>">
                        <?php echo form_error('empresa_razao_social', '<small class="form-text text-danger">','</small>'); ?>
                      </div>
                      <div class="col-md-6">
                        <label>E-mail</label>
                        <input type="email" class="form-control" name="empresa_email" value="<?php echo $empresa->empresa_email; ?>">
                        <?php echo form_error('empresa_email', '<small class="form-text text-danger">','</small>'); ?>
                      </div>  
                    </div>

                    <div class="form-group row">
                      <div class="col-md-3">
                        <label>CNPJ</label>
                        <input type="text" class="form-control cnpj" name="empresa_cnpj" value="<?php echo $empresa->empresa_cnpj; ?>">
                        <?php echo form_error('empresa_cnpj', '<small class="form-text text-danger">','</small>'); ?>
                      </div>
                      <div class="col-md-3">
                        <label>Telefone</label>
                        <input type="text" class="form-control phone_with_ddd" name="empresa_telefone" value="<?php echo $empresa->empresa_telefone; ?>">
                        <?php echo form_error('empresa_telefone', '<small class="form-text text-danger">','</small>'); ?>
                      </div> 
                      <div class="col-md-3">
                        <label>Celular <a href="https://api.whatsapp.com/send?l=pt_BR&phone=55<?php echo $empresa->empresa_celular; ?>" target="_blank" aria-label="link to https://api.whatsapp.com/send?l=pt_BR&phone=55<?php echo $empresa->empresa_celular; ?>" rel="noopener"><i class="fab fa-whatsapp" aria-hidden="true"></i></a></label>
                        <input type="text" class="form-control sp_celphones" name="empresa_celular" value="<?php echo $empresa->empresa_celular; ?>">
                        <?php echo form_error('empresa_celular', '<small class="form-text text-danger">','</small>'); ?>
                      </div>
                      <div class="col-md-3">
                        <label>Status</label>                 
                        <select class="form-control" name="empresa_status">                   
                          <option value="0" <?php echo ($empresa->empresa_status == 0) ? 'selected' : '' ?>>Inativa</option>
                          <option value="1" <?php echo ($empresa->empresa_status == 1) ? 'selected' : '' ?>>Ativa</option>
                        </select>
                      </div>  
                    </div>
                </fieldset>

                <fieldset class="mt-4 border p-3">
                  <legend style="font-size: 16px"><i class="fas fa-map-marker-alt"></i> Dados de Endereço</legend>
                  <div class="form-group row">
                    <div class="col-md-2">
                      <label>CEP</label>
                      <input type="text" class="form-control cep" id="cep" name="empresa_cep" value="<?php echo $empresa->empresa_cep; ?>">
                      <?php echo form_error('empresa_cep', '<small class="form-text text-danger">','</small>'); ?>
                    </div>
                    <div class="col-md-4">
                      <label>Endereço</label>
                      <input type="text" class="form-control" id="endereco" name="empresa_endereco" value="<?php echo $empresa->empresa_endereco; ?>">
                      <?php echo form_error('empresa_endereco', '<small class="form-text text-danger">','</small>'); ?>
                    </div>
                    <div class="col-md-2">
                      <label>Nº</label>
                      <input type="text" class="form-control" name="empresa_numero_endereco" value="<?php echo $empresa->empresa_numero_endereco; ?>">
                      <?php echo form_error('empresa_numero_endereco', '<small class="form-text text-danger">','</small>'); ?>
                    </div>
                    <div class="col-md-4">
                      <label>Complemento</label>
                      <input type="text" class="form-control" name="empresa_complemento" value="<?php echo $empresa->empresa_complemento; ?>">
                      <?php echo form_error('empresa_complemento', '<small class="form-text text-danger">','</small>'); ?>
                    </div>
                  </div>
                
                  <div class="form-group row">
                    <div class="col-md-5">
                      <label>Bairro</label>
                      <input type="text" class="form-control" id="bairro" name="empresa_bairro" value="<?php echo $empresa->empresa_bairro; ?>">
                      <?php echo form_error('empresa_bairro', '<small class="form-text text-danger">','</small>'); ?>
                    </div>
                    <div class="col-md-5">
                      <label>Cidade</label>
                      <input type="text" class="form-control" id="cidade" name="empresa_cidade" value="<?php echo $empresa->empresa_cidade; ?>">
                      <?php echo form_error('empresa_cidade', '<small class="form-text text-danger">','</small>'); ?>
                    </div>
                    <div class="col-md-2">
                      <label>UF</label>
                      <input type="text" class="form-control" id="estado" name="empresa_uf" value="<?php echo $empresa->empresa_uf; ?>">
                      <?php echo form_error('empresa_uf', '<small class="form-text text-danger">','</small>'); ?>
                    </div>
                  </div>
                </fieldset>

                <input type="hidden" name="empresa_id" value="<?php echo $empresa->empresa_id; ?>">
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

      
