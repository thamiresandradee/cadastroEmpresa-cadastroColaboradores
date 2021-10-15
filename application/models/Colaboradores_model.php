<?php

defined('BASEPATH') or exit('Ação não permitida');

class Colaboradores_model extends CI_Model{

	public function get_all_colaboradores(){

		$this->db->select([
			'colaboradores.*',
			'empresas.empresa_id',
			'empresas.empresa_razao_social as colaborador_empresa',
		]);

		$this->db->join('empresas', 'colaborador_id_empresa = empresa_id', 'LEFT');

		return $this->db->get('colaboradores')->result();

	}

    public function get_by_id_colaborador($id){

		$this->db->select([
			'colaboradores.*',
			'empresas.empresa_id',
			'empresas.empresa_razao_social as colaborador_empresa',
		]);

		$this->db->join('empresas', 'colaborador_id_empresa = empresa_id', 'LEFT');
        $this->db->where('colaborador_id', $id);
        
        return $this->db->get('colaboradores')->row();

	}

	public function get_ll_colaboradores_by_empresa($id){

		$this->db->select([
			'colaboradores.*',
			'empresas.empresa_id',
			'empresas.empresa_razao_social as colaborador_empresa',
		]);

		$this->db->join('empresas', 'colaborador_id_empresa = empresa_id', 'LEFT');
        $this->db->where('empresa_id', $id);
        
        return $this->db->get('colaboradores')->result();

	}

}