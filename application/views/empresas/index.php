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
              <li class="breadcrumb-item active" aria-current="page"><?php echo $titulo; ?></li>
            </ol>
          </nav>

          <?php if($message = $this->session->flashdata('error')) : ?>

            <div class="row">
              <div class="col-md-12">
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                  <strong><i class="fas fa-ban"></i> <?php echo $message; ?></strong>
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
              </div>
            </div>

          <?php endif; ?>

          <?php if($message = $this->session->flashdata('sucesso')) : ?>

            <div class="row">
              <div class="col-md-12">
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                  <strong><i class="fas fa-check"></i> <?php echo $message; ?></strong>
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
              </div>
            </div>

          <?php endif; ?>

          <?php if($message = $this->session->flashdata('info')) : ?>

            <div class="row">
              <div class="col-md-12">
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                  <strong><i class="fas fa-exclamation-triangle"></i> <?php echo $message; ?></strong>
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
              </div>
            </div>

          <?php endif; ?>
          
          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <a href="<?php echo base_url($pagina.'/add');?>" class="btn btn-info btn-sm float-right" data-toggle="tooltip" data-placement="bottom" title="Cadastrar novo Usuário" ><i class="fas fa-plus"></i> Novo</a>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Razão Social</th>
                      <th>CNPJ</th>
                      <th>Telefone / Celular</th>
                      <th>E-mail</th>
                      <th class="text-center">Status</th>
                      <th class="text-right no-sort">Ações</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($empresas as $empresa) :?>
                    <tr>
                      <td><?php echo $empresa->empresa_id ;?></td>
                      <td><?php echo $empresa->empresa_razao_social ;?></td>
                      <td><?php echo $empresa->empresa_cnpj ;?></td>
                      <td><?php echo $empresa->empresa_telefone ;?> / <?php echo $empresa->empresa_celular ;?></td>
                      <td><?php echo $empresa->empresa_email ;?></td>
                      <td class="text-center pr-4"><?php echo ($empresa->empresa_status) == 1 ? '<span class="badge badge-success"><i class="fas fa-lock-open"></i> Ativa</span>' : '<span class="badge badge-dark"><i class="fas fa-lock"></i> Inativa</span>' ?></td>
                      <td class="text-right">
                        
                        <a href="<?php echo base_url('colaboradores/list/'.$empresa->empresa_id);?>" class="btn btn-warning btn-circle btn-sm" data-toggle="tooltip" data-placement="bottom" title="Listar Colaboradores">
                          <i class="fa fa-list"></i>
                        </a>

                        <a href="<?php echo base_url($pagina.'/edit/'.$empresa->empresa_id);?>" class="btn btn-primary btn-circle btn-sm" data-toggle="tooltip" data-placement="bottom" title="Editar">
                          <i class="fa fa-edit"></i>
                        </a>
                        <button type="button" data-toggle="modal" data-target="#empresa-<?php echo $empresa->empresa_id; ?>" data-placement="bottom" title="Excluir <?php echo $this->router->fetch_class(); ?>" class="btn btn-danger btn-circle btn-sm"><i class="far fa-trash-alt"></i></button>
                      </td>
                    </tr>

                    <div class="modal fade" id="empresa-<?php echo $empresa->empresa_id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                             <h5 class="modal-title" id="empresa-<?php echo $empresa->empresa_id; ?>Label">
                              <i class="fas fa-exclamation-triangle text-danger"></i>&nbsp;Tem certeza da exclusão do registro?
                            </h5>
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                          </div>
                          <div class="modal-body">
                            <p>Se deseja excluir o registro, clique em <strong>Sim, excluir!</strong></p>
                          </div>
                          <div class="modal-footer">
                          <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal" data-toggle="tooltip" title="Cancelar Exclusão">Não, voltar!</button>
                            <a href="<?php echo base_url($this->router->fetch_class().'/del/'.$empresa->empresa_id);?>" data-toggle="tooltip" data-placement="bottom" class="btn btn-sm btn-danger" title="Excluir <?php echo $this->router->fetch_class(); ?>">Sim, desejo excluir!</a>
                          </div>
                        </div>
                      </div>
                    </div>

                  <?php endforeach; ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

      
