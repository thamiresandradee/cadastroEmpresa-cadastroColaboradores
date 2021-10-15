<?php

defined('BASEPATH') or exit('Ação não permitida');

class Colaboradores extends CI_Controller{

	public function __construct(){

		parent::__construct();

		$this->load->model("colaboradores_model");

	}

	public function index(){

		$data = array(
			//'colaboradores' => $this->core_model->get_all('colaboradores'),
			'colaboradores' => $this->colaboradores_model->get_all_colaboradores(),
			//$this->secretaria_model->get_all_unidades(),
			'titulo'   		=> 'Colaboradores Cadastrados',
			'pagina'		=> 'colaboradores',

			
			'styles' => array(
				'vendor/datatables/dataTables.bootstrap4.min.css',
			),

			'scripts' => array(
				'vendor/datatables/jquery.dataTables.min.js',
				'vendor/datatables/dataTables.bootstrap4.min.js',
				'vendor/datatables/app.js',
			),

		);

		//PARA DEBUG
		//echo '<pre>';
		//print_r($data['colaboradores']);
		//exit();

		$this->load->view('layout/header', $data);
		$this->load->view('colaboradores/index');
		$this->load->view('layout/footer');

	}

	public function list($empresa_id = null){

		if(!$empresa_id || !$this->core_model->get_by_id('empresas', array('empresa_id' => $empresa_id))){

			$this->session->set_flashdata('error', 'Empresa não encontrado');
			redirect($this->router->fetch_class());

		}else{

		$data = array(
			//'colaboradores' => $this->core_model->get_all('colaboradores'),
			//'colaboradores' => $this->colaboradores_model->get_all_colaboradores(),
			'colaboradores'	=> $this->colaboradores_model->get_ll_colaboradores_by_empresa($empresa_id),
			'lista'			=> 'Empresas',
			'list'			=> 'empresas',
			'titulo'   		=> 'Colaboradores Cadastrados',
			'pagina'		=> 'colaboradores',
			'empresa'		=> $empresa_id,

			
			'styles' => array(
				'vendor/datatables/dataTables.bootstrap4.min.css',
			),

			'scripts' => array(
				'vendor/datatables/jquery.dataTables.min.js',
				'vendor/datatables/dataTables.bootstrap4.min.js',
				'vendor/datatables/app.js',
			),

		);
		}



		//PARA DEBUG
		//echo '<pre>';
		//print_r($data['colaboradores']);
		//exit();

		$this->load->view('layout/header', $data);
		$this->load->view('colaboradores/list');
		$this->load->view('layout/footer');

	}

	public function exportCSV($empresa_id = null){
        // get data
        $myData = $this->colaboradores_model->get_ll_colaboradores_by_empresa($empresa_id);

        // file name
        $filename = 'colaboradores_'.date('Ymd').'.csv';
        header("Content-Description: File Transfer");
        header("Content-Disposition: attachment; filename=$filename");
        header("Content-Type: application/csv; ");
 
        // file creation
        $file = fopen('php://output', 'w');
 
        $header = array("empresa","nome","sobrenome","telefone","celular","email","dtnascimento","status");
        fputcsv($file, $header);
 
        foreach ($myData as $colaborador){
            fputcsv($file,array(
				$colaborador->colaborador_empresa,
				$colaborador->colaborador_nome,
				$colaborador->colaborador_sobrenome,
				$colaborador->colaborador_telefone,
				$colaborador->colaborador_celular,
				$colaborador->colaborador_email,
				$colaborador->colaborador_data_nascimento,
				$colaborador->colaborador_status,
			));
        }
 
        fclose($file);
        exit;
    }

	public function add($empresa_id = null){

		$this->form_validation->set_rules('colaborador_nome', '', 'trim|required|min_length[3]|max_length[45]');
		$this->form_validation->set_rules('colaborador_sobrenome', '', 'trim|required|min_length[3]|max_length[145]');
		$this->form_validation->set_rules('colaborador_data_nascimento', '', 'trim|exact_length[10]');
		$this->form_validation->set_rules('colaborador_email', '', 'trim|required|valid_email|max_length[100]|is_unique[colaboradores.colaborador_email]');
		$this->form_validation->set_rules('colaborador_telefone', '', 'trim|required|exact_length[14]|is_unique[colaboradores.colaborador_telefone]');
		$this->form_validation->set_rules('colaborador_celular', '', 'trim|required|min_length[14]|max_length[15]|is_unique[colaboradores.colaborador_celular]');

		if($this->form_validation->run()){

			$data = elements(
    			array(
					'colaborador_nome',
    				'colaborador_sobrenome',
    				//'colaborador_data_nascimento',
    				'colaborador_email',
    				'colaborador_telefone',
    				'colaborador_celular',
    				'colaborador_status',
				), $this->input->post()
    		);

			if($data['colaborador_data_nascimento'] == ''){
				$data['colaborador_data_nascimento'] == NULL;
			}else{
				$data['colaborador_data_nascimento'] = date('Y-m-d',strtotime($this->input->post('colaborador_data_nascimento')));
			}

			$data['colaborador_id_empresa'] = $empresa_id;

    		$data = html_escape($data);

			//PARA DEBUG
			//echo '<pre>';
			//print_r($data);
			//exit();

    		$this->core_model->insert('colaboradores', $data);
    		//redirect($this->router->fetch_class('/list/'.$empresa_id));
			redirect($this->router->fetch_class().'/list/'.$empresa_id);

		}else{

			//ERRO DE VALIDAÇÃO
			$data = array(
				'titulo' => 'Cadastrar Dados do Colaborador',
				'lista'		=> 'Listar Colaboradores',
				'pagina'	=> 'colaboradores',
				'icon'		=> 'fas fa-users',
				'scripts' => array(
					'js/mask/jquery.mask.min.js',
					'js/mask/app.js',
					'js/colaboradores.js',
				),
			);

			//PARA DEBUG
			//echo '<pre>';
			//print_r($data['colaboradores']);
			//exit();

			$this->load->view('layout/header', $data);
			$this->load->view('colaboradores/add');
			$this->load->view('layout/footer');

		}

	}

	public function edit($colaborador_id = NULL){

		if(!$colaborador_id || !$this->core_model->get_by_id('colaboradores', array('colaborador_id' => $colaborador_id))){

			$this->session->set_flashdata('error', 'Colaborador não encontrado');
			redirect($this->router->fetch_class());

		}else{

			$this->form_validation->set_rules('colaborador_nome', '', 'trim|required|min_length[3]|max_length[45]');
			$this->form_validation->set_rules('colaborador_sobrenome', '', 'trim|required|min_length[3]|max_length[145]');
			$this->form_validation->set_rules('colaborador_data_nascimento', '', 'trim|exact_length[10]');
			$this->form_validation->set_rules('colaborador_email', '', 'trim|required|valid_email|max_length[100]|callback_check_colaborador_email');
			$this->form_validation->set_rules('colaborador_telefone', '', 'trim|required|exact_length[14]|callback_check_colaborador_telefone');
			$this->form_validation->set_rules('colaborador_celular', '', 'trim|required|min_length[14]|max_length[15]|callback_check_colaborador_celular');

			if($this->form_validation->run()){

					$data = elements(
    					array(
							'colaborador_nome',
							'colaborador_sobrenome',
							//'colaborador_data_nascimento',
							'colaborador_email',
							'colaborador_telefone',
							'colaborador_celular',
							'colaborador_status',
					), $this->input->post()
    			);

				if($data['colaborador_data_nascimento'] == ''){
					$data['colaborador_data_nascimento'] == NULL;
				}else{
					$data['colaborador_data_nascimento'] = date('Y-m-d',strtotime($this->input->post('colaborador_data_nascimento')));
				}

    			$data = html_escape($data);

    			$this->core_model->update('colaboradores', $data, array('colaborador_id' => $colaborador_id));
    			redirect($this->router->fetch_class());

			}else{

				//ERRO DE VALIDAÇÃO
				$data = array(
					'titulo' => 'Editar Dados do Cliete',
					'lista'		=> 'Listar Colaboradores',
					'pagina'	=> 'colaboradores',
					'icon'		=> 'fas fa-users',
					//'colaborador'	=> $this->core_model->get_by_id('colaboradores', array('colaborador_id' => $colaborador_id)),
					//'colaboradores' => $this->colaboradores_model->get_all_colaboradores(),
					'colaborador'	=> $this->colaboradores_model->get_by_id_colaborador($colaborador_id),

					'scripts' => array(
						'js/mask/jquery.mask.min.js',
						'js/mask/app.js'
					),

				);

				//PARA DEBUG
				//echo '<pre>';
				//print_r($data['colaborador']);
				//exit();

				$this->load->view('layout/header', $data);
				$this->load->view('colaboradores/edit');
				$this->load->view('layout/footer');

			}
		}

	}

	public function del($colaborador_id = NULL){

		if(!$colaborador_id || !$this->core_model->get_by_id('colaboradores', array('colaborador_id' => $colaborador_id))){
			$this->session->set_flashdata('error', 'colaborador não encontrado');
			redirect($this->router->fetch_class());
		}else{
			$this->core_model->delete('colaboradores', array('colaborador_id' => $colaborador_id));
			redirect($this->router->fetch_class());
		}

	}

	public function valida_cpf($cpf) {

        if ($this->input->post('colaborador_id')) {

            $colaborador_id = $this->input->post('colaborador_id');

            if ($this->core_model->get_by_id('colaboradores', array('colaborador_id !=' => $colaborador_id, 'colaborador_cpf_cnpj' => $cpf))) {
                $this->form_validation->set_message('valida_cpf', 'Este CPF já existe');
                return FALSE;
            }
        }

        $cpf = str_pad(preg_replace('/[^0-9]/', '', $cpf), 11, '0', STR_PAD_LEFT);
        // Verifica se nenhuma das sequências abaixo foi digitada, caso seja, retorna falso
        if (strlen($cpf) != 11 || $cpf == '00000000000' || $cpf == '11111111111' || $cpf == '22222222222' || $cpf == '33333333333' || $cpf == '44444444444' || $cpf == '55555555555' || $cpf == '66666666666' || $cpf == '77777777777' || $cpf == '88888888888' || $cpf == '99999999999') {

            $this->form_validation->set_message('valida_cpf', 'Por favor digite um CPF válido');
            return FALSE;
        } else {
            // Calcula os números para verificar se o CPF é verdadeiro
            for ($t = 9; $t < 11; $t++) {
                for ($d = 0, $c = 0; $c < $t; $c++) {
                    //$d += $cpf{$c} * (($t + 1) - $c); // Para PHP com versão < 7.4
                    $d += $cpf[$c] * (($t + 1) - $c); //Para PHP com versão < 7.4
                }
                $d = ((10 * $d) % 11) % 10;
                if ($cpf[$c] != $d) {
                    $this->form_validation->set_message('valida_cpf', 'Por favor digite um CPF válido');
                    return FALSE;
                }
            }
            return TRUE;
        }
    
    }

    public function valida_cnpj($cnpj) {

        // Verifica se um número foi informado
        if (empty($cnpj)) {
            $this->form_validation->set_message('valida_cnpj', 'Por favor digite um CNPJ válido');
            return false;
        }

        if ($this->input->post('colaborador_id')) {

            $colaborador_id = $this->input->post('colaborador_id');

            if ($this->core_model->get_by_id('colaboradores', array('colaborador_id !=' => $colaborador_id, 'colaborador_cpf_cnpj' => $cnpj))) {
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


    public function check_colaborador_rg_ie($colaborador_rg_ie){

		$colaborador_id = $this->input->post('colaborador_id');

		if($this->core_model->get_by_id('colaboradores', array('colaborador_rg_ie' => $colaborador_rg_ie, 'colaborador_id !=' => $colaborador_id))){

			$this->form_validation->set_message('check_colaborador_rg_ie', 'Esse Documento já existe!');

			return FALSE;

		}else{

			return TRUE;

		}

	}

	public function check_colaborador_email($colaborador_email){

		$colaborador_id = $this->input->post('colaborador_id');

		if($this->core_model->get_by_id('colaboradores', array('colaborador_email' => $colaborador_email, 'colaborador_id !=' => $colaborador_id))){

			$this->form_validation->set_message('check_colaborador_email', 'Esse E-mail já existe!');

			return FALSE;

		}else{

			return TRUE;

		}

	}

	public function check_colaborador_telefone($colaborador_telefone){

		$colaborador_id = $this->input->post('colaborador_id');

		if($this->core_model->get_by_id('colaboradores', array('colaborador_telefone' => $colaborador_telefone, 'colaborador_id !=' => $colaborador_id))){

			$this->form_validation->set_message('check_colaborador_telefone', 'Esse Telefone já existe!');

			return FALSE;

		}else{

			return TRUE;

		}

	}

	public function check_colaborador_celular($colaborador_celular){

		$colaborador_id = $this->input->post('colaborador_id');

		if($this->core_model->get_by_id('colaboradores', array('colaborador_celular' => $colaborador_celular, 'colaborador_id !=' => $colaborador_id))){

			$this->form_validation->set_message('check_colaborador_celular', 'Esse Celular já existe!');

			return FALSE;

		}else{

			return TRUE;

		}

	}


}