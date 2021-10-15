<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Export_csv extends CI_Controller {
 
    public function __construct(){
        
        parent::__construct();
        $this->load->model('export_csv_model');
    }
    
    public function index($empresa_id){

        $empresa_id = $this->input->get($empresa_id);

        echo "TIPO: ".$empresa_id;

        $data["colaboradores_data'"] = $this->export_csv_model->fetch_data();
        $this->load->view('export_csv', $data);



    
    }

    public function export(){

        $pagina = $this->input->post('pagina');
        $pagina_data = $pagina.'_data';

        //RECEBE O TIPO DE PESQUISA PARA EXPORTAR NO .CSV DE ACORDO COM A ORDENAÇÃO SELECIONADA
        $tipo = $this->input->post('tipopesq');

        $nome_arquivo = $pagina.'_'.date("Ymd").'.csv';

        $file_name = $nome_arquivo; 
        header("Content-Description: File Transfer"); 
        header("Content-Disposition: attachment; filename=$file_name"); 
        header("Content-Type: application/csv;");
        
        //if($this->input->post('tipopesq') == 'SIGLA'){

            //CHAMA A FUNÇÃO EXPORTAR DE ACORDO COM A O TIPO DE ORDENAÇÃO SELECIONADO 
            $pagina_data = $this->export_csv_model->fetch_data($tipo);

        //}else{
//
        //    // get data 
        //    $pagina_data = $this->export_csv_model->fetch_data_nome();
//
        //}      

        // CRIA O ARQUIVO 
        $file = fopen('php://output', 'w');
        
        $header = array("sigla","nome");
        fputcsv($file, $header);
        
        foreach ($pagina_data->result_array() as $key => $value){ 
          
            fputcsv($file, $value); 
        
        }
        
        fclose($file); 
        
        exit; 
    
    }

}