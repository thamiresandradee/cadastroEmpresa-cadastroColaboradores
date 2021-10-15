<?php

defined('BASEPATH') or exit('Ação não permitida');

class Empresas extends CI_Controller{

	public function __construct(){

		parent::__construct();

		$this->load->model("colaboradores_model");

	}

	public function index(){

		$data = array(
			'empresas' 	=> $this->core_model->get_all('empresas'),
			//'colaboradores' => $this->colaboradores_model->get_ll_colaboradores_by_empresa(),
			'titulo'   	=> 'Empresas Cadastradas',
			'pagina'	=> 'empresas',

			'styles' => array(
				'vendor/datatables/dataTables.bootstrap4.min.css',
			),

			'scripts' => array(
				'vendor/datatables/jquery.dataTables.min.js',
				'vendor/datatables/dataTables.bootstrap4.min.js',
				'vendor/datatables/app.js',
			),

		);

		$this->load->view('layout/header', $data);
		$this->load->view('empresas/index');
		$this->load->view('layout/footer');

	}

	public function list(){

		$data = array(
			'empresas' 	=> $this->core_model->get_all('empresas'),
			//'colaboradores' => $this->colaboradores_model->get_ll_colaboradores_by_empresa(),
			'titulo'   	=> 'Empresas Cadastradas',
			'pagina'	=> 'empresas',

			'styles' => array(
				'vendor/datatables/dataTables.bootstrap4.min.css',
			),

			'scripts' => array(
				'vendor/datatables/jquery.dataTables.min.js',
				'vendor/datatables/dataTables.bootstrap4.min.js',
				'vendor/datatables/app.js',
			),

		);
		

		$this->load->view('layout/header', $data);
		$this->load->view('empresas/index');
		$this->load->view('layout/footer');

	}

	public function add(){

		$this->form_validation->set_rules('empresa_razao_social', '', 'trim|required|min_length[3]|max_length[200]|is_unique[empresas.empresa_razao_social]');
		$this->form_validation->set_rules('empresa_cnpj', '', 'trim|required|exact_length[18]|is_unique[empresas.empresa_cnpj]|callback_valida_cnpj');
		$this->form_validation->set_rules('empresa_email', '', 'trim|valid_email|max_length[100]|is_unique[empresas.empresa_email]');
		$this->form_validation->set_rules('empresa_telefone', '', 'trim|required|exact_length[14]|is_unique[empresas.empresa_telefone]');
		$this->form_validation->set_rules('empresa_celular', '', 'trim|required|min_length[14]|max_length[15]|is_unique[empresas.empresa_celular]');					
		$this->form_validation->set_rules('empresa_cep', '', 'trim|exact_length[9]');
		$this->form_validation->set_rules('empresa_endereco','','trim|min_length[10]|max_length[145]');
		$this->form_validation->set_rules('empresa_numero_endereco','','trim|max_length[25]');
		$this->form_validation->set_rules('empresa_complemento','','trim|max_length[145]');
		$this->form_validation->set_rules('empresa_bairro','','trim|max_length[45]');
		$this->form_validation->set_rules('empresa_cidade','','trim|max_length[50]');
		$this->form_validation->set_rules('empresa_uf','','trim|exact_length[2]');

		if($this->form_validation->run()){
			$data = elements(
    		array(
				'empresa_razao_social',
    			'empresa_cnpj',
				'empresa_email',
    			'empresa_telefone',
    			'empresa_celular',
    			'empresa_cep',
    			'empresa_endereco',
    			'empresa_numero_endereco',
    			'empresa_complemento',
				'empresa_bairro',
    			'empresa_cidade',
    			'empresa_uf',
    			'empresa_status',
			), $this->input->post()
    	);

		//PARA DEBUG
		//echo '<pre>';
		//print_r($this->input->post());
		//exit();

	    $data = html_escape($data);
	
	    $this->core_model->insert('empresas', $data);
    	redirect($this->router->fetch_class());

		}else{

			//ERRO DE VALIDAÇÃO
			$data = array(
				'titulo' 	=> 'Cadastrar Dados da Empresa',
				'lista'		=> 'Listar Empresas',
				'pagina'	=> 'empresas',
				'icon'		=> 'fas fa-user-tag',
				'colaboradores' => $this->core_model->get_all('colaboradores'),
				'scripts' 	=> array(
					'js/mask/jquery.mask.min.js',
					'js/mask/app.js',
					'js/buscacep/buscacep.js',
				),
			);

			$this->load->view('layout/header', $data);
			$this->load->view('empresas/add');
			$this->load->view('layout/footer');
		}

	}

	public function edit($empresa_id = NULL){

		if(!$empresa_id || !$this->core_model->get_by_id('empresas', array('empresa_id' => $empresa_id))){

			$this->session->set_flashdata('error', 'Empresa não encontrada');
			redirect($this->router->fetch_class());

		}else{

			$this->form_validation->set_rules('empresa_razao_social', '', 'trim|required|min_length[3]|max_length[200]|callback_check_empresa_razao_social');
			$this->form_validation->set_rules('empresa_cnpj', '', 'trim|required|exact_length[18]|callback_valida_cnpj');
			$this->form_validation->set_rules('empresa_email', '', 'trim|valid_email|max_length[100]|callback_check_empresa_email');
			$this->form_validation->set_rules('empresa_telefone', '', 'trim|required|exact_length[14]|callback_check_empresa_telefone');
			$this->form_validation->set_rules('empresa_celular', '', 'trim|required|min_length[14]|max_length[15]|callback_check_empresa_celular');					
			$this->form_validation->set_rules('empresa_cep', '', 'trim|exact_length[9]');
			$this->form_validation->set_rules('empresa_endereco','','trim|min_length[10]|max_length[145]');
			$this->form_validation->set_rules('empresa_numero_endereco','','trim|max_length[25]');
			$this->form_validation->set_rules('empresa_complemento','','trim|max_length[145]');
			$this->form_validation->set_rules('empresa_bairro','','trim|max_length[45]');
			$this->form_validation->set_rules('empresa_cidade','','trim|max_length[50]');
			$this->form_validation->set_rules('empresa_uf','','trim|exact_length[2]');
			
			

			if($this->form_validation->run()){

				$data = elements(
    			array(
					'empresa_razao_social',
    				'empresa_cnpj',
    				'empresa_email',
    				'empresa_telefone',
    				'empresa_celular',
    				'empresa_cep',
    				'empresa_endereco',
    				'empresa_numero_endereco',
    				'empresa_complemento',
    				'empresa_bairro',
    				'empresa_cidade',
    				'empresa_uf',
    				'empresa_status',
				), $this->input->post()
    		);

			//PARA DEBUG
			//echo '<pre>';
			//print_r($this->input->post());
			//exit();

	    		$data = html_escape($data);
	
	    		$this->core_model->update('empresas', $data, array('empresa_id' => $empresa_id));
    			redirect($this->router->fetch_class());

			}else{

				//ERRO DE VALIDAÇÃO
				$data = array(
					'titulo' => 'Editar Dados do Empresa',
					'lista'		=> 'Listar Empresas',
					'pagina'	=> 'empresas',
					'icon'		=> 'fas fa-user-tag',
					'empresa'	=> $this->core_model->get_by_id('empresas', array('empresa_id' => $empresa_id)),
					'scripts' => array(
						'js/mask/jquery.mask.min.js',
						'js/mask/app.js',
						'js/buscacep/buscacep.js',
					),
				);

				$this->load->view('layout/header', $data);
				$this->load->view('empresas/edit');
				$this->load->view('layout/footer');

			}

		}

	}

	public function del($empresa_id = NULL){

		if(!$empresa_id || !$this->core_model->get_by_id('empresas', array('empresa_id' => $empresa_id))){
			$this->session->set_flashdata('error', 'Empresa não encontrada');
			redirect($this->router->fetch_class());
		}else{
			$this->core_model->delete('empresas', array('empresa_id' => $empresa_id));
			redirect($this->router->fetch_class());
		}

	}

	public function check_empresa_razao_social($empresa_razao_social){

		$empresa_id = $this->input->post('empresa_id');

		if($this->core_model->get_by_id('empresas', array('empresa_razao_social' => $empresa_razao_social, 'empresa_id !=' => $empresa_id))){

			$this->form_validation->set_message('check_empresa_razao_social', 'Essa Razão Social já existe!');

			return FALSE;

		}else{

			return TRUE;

		}

	}

	public function valida_cnpj($cnpj) {

        // Verifica se um número foi informado
        if (empty($cnpj)) {
            $this->form_validation->set_message('valida_cnpj', 'Por favor digite um CNPJ válido');
            return false;
        }

        if ($this->input->post('empresa_id')) {

            $empresa_id = $this->input->post('empresa_id');

            if ($this->core_model->get_by_id('empresas', array('empresa_id !=' => $empresa_id, 'empresa_cnpj' => $cnpj))) {
                $this->form_validation->set_message('valida_cnpj', 'Esse CNPJ já existe');
                return FALSE;
            }
        }

        // Elimina possivel mascara
        $cnpj = preg_replace("/[^0-9]/", "", $cnpj);
        $cnpj = str_pad($cnpj, 14, '0', STR_PAD_LEFT);


        // Verifica se o numero de digitos informados é igual a 11 
        if (strlen($cnpj) != 14) {
            $this->form_validation->set_message('valida_cnpj', 'Por favor digite um CNPJ válido');
            return false;
        }

        // Verifica se nenhuma das sequências invalidas abaixo 
        // foi digitada. Caso afirmativo, retorna falso
        else if ($cnpj == '00000000000000' ||
                $cnpj == '11111111111111' ||
                $cnpj == '22222222222222' ||
                $cnpj == '33333333333333' ||
                $cnpj == '44444444444444' ||
                $cnpj == '55555555555555' ||
                $cnpj == '66666666666666' ||
                $cnpj == '77777777777777' ||
                $cnpj == '88888888888888' ||
                $cnpj == '99999999999999') {
            $this->form_validation->set_message('valida_cnpj', 'Por favor digite um CNPJ válido');
            return false;

            // Calcula os digitos verificadores para verificar se o
            // CPF é válido
        } else {

            $j = 5;
            $k = 6;
            $soma1 = "";
            $soma2 = "";

            for ($i = 0; $i < 13; $i++) {

                $j = $j == 1 ? 9 : $j;
                $k = $k == 1 ? 9 : $k;

                //$soma2 += ($cnpj{$i} * $k);

                $soma2 = intval($soma2) + ($cnpj{$i} * $k);

                if ($i < 12) {
                    $soma1 = intval($soma1) + ($cnpj{$i} * $j);
                }

                $k--;
                $j--;
            }

            $digito1 = $soma1 % 11 < 2 ? 0 : 11 - $soma1 % 11;
            $digito2 = $soma2 % 11 < 2 ? 0 : 11 - $soma2 % 11;

            if (!($cnpj{12} == $digito1) and ( $cnpj{13} == $digito2)) {
                $this->form_validation->set_message('valida_cnpj', 'Por favor digite um CNPJ válido');
                return false;
            } else {
                return true;
            }
        }
    
    }

	public function check_empresa_email($empresa_email){

		$empresa_id = $this->input->post('empresa_id');

		if($this->core_model->get_by_id('empresas', array('empresa_email' => $empresa_email, 'empresa_id !=' => $empresa_id))){

			$this->form_validation->set_message('check_empresa_email', 'Esse E-mail já existe!');

			return FALSE;

		}else{

			return TRUE;

		}

	}
	
	public function check_empresa_telefone($empresa_telefone){

		$empresa_id = $this->input->post('empresa_id');

		if($this->core_model->get_by_id('empresas', array('empresa_telefone' => $empresa_telefone, 'empresa_id !=' => $empresa_id))){

			$this->form_validation->set_message('check_empresa_telefone', 'Esse Telefone já existe!');

			return FALSE;

		}else{

			return TRUE;

		}

	}

	public function check_empresa_celular($empresa_celular){

		$empresa_id = $this->input->post('empresa_id');

		if($this->core_model->get_by_id('empresas', array('empresa_celular' => $empresa_celular, 'empresa_id !=' => $empresa_id))){

			$this->form_validation->set_message('check_empresa_celular', 'Esse Celular já existe!');

			return FALSE;

		}else{

			return TRUE;

		}

	}

}