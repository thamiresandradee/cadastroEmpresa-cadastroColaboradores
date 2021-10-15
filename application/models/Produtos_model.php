<?php

defined('BASEPATH') or exit('Ação não permitida');

class Produtos_model extends CI_Model{

	public function get_all(){

		/*
			[produto_id] => 1
            [produto_codigo] => 72495380
            [produto_data_cadastro] => 
            [produto_categoria_id] => 1
            [produto_marca_id] => 1
            [produto_fornecedor_id] => 1
            [produto_descricao] => Notebook gamer
            [produto_unidade] => UN
            [produto_codigo_barras] => 4545
            [produto_ncm] => 5656
            [produto_preco_custo] => 1.800,00
            [produto_preco_venda] => 15.031,00
            [produto_estoque_minimo] => 2
            [produto_qtde_estoque] => 3
            [produto_ativo] => 1
            [produto_obs] => 
            [produto_data_alteracao] => 2020-02-28 22:01:44
		*/

		$this->db->select([
			'produtos.*',
			'categorias.categoria_id',
			'categorias.categoria_nome as produto_categoria',
			'marcas.marca_id',
			'marcas.marca_nome as produto_marca',
			'fornecedores.fornecedor_id',
			'fornecedores.fornecedor_nome_fantasia as produto_fornecedor',

		]);

		$this->db->join('categorias', 'categoria_id = produto_categoria_id', 'LEFT');
		$this->db->join('marcas', 'marca_id = produto_marca_id', 'LEFT');
		$this->db->join('fornecedores', 'fornecedor_id = produto_fornecedor_id', 'LEFT');

		return $this->db->get('produtos')->result();

	}

}