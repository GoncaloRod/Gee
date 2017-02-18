<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class LojaDB extends CI_Model
{
  public function GetDestaques()
  {
    // Escolher a tabela
    $this->db->from('produtos_destaque');

    // Receber os dados da base de dados
    $produtos = $this->db->get();

    // Devolver os dados
    return $produtos->result_array();
  }

  public function GetPromocoes()
  {
    // Escolher a tabela
    $this->db->from('produtos_desconto');

    // Receber os dados da base de dados
    $produtos = $this->db->get();

    // Devolver os dados
    return $produtos->result_array();
  }

  public function GetCategorias()
  {
    // Escolher a tabela
    $this->db->from('categorias');

    // Receber os dados da base de dados
    $categorias = $this->db->get();

    // Devolver os dados
    return $categorias->result_array();
  }

  public function GetSubcategorias()
  {
    // Escolher a tabela
    $this->db->from('sub_categorias');

    // Receber os dados da base de dados
    $subCategorias = $this->db->get();

    // Devolver os dados
    return $subCategorias->result_array();
  }

  public function GetPdrInfo($id)
  {
    // Escolher a tabela
    $this->db->from('produtos');

    // Defenir as condicoes
    if (is_numeric($id))
    {
      $this->db->where('PDR_ID', $id);
    }
    else
    {
      $this->db->where('PDR_ID', $id['PDR_ID']);
    }


    // Receber os dados
    $info = $this->db->get();

    if ($info->num_rows())
    {
      return $info->row_array();
    }
    else
    {
      return false;
    }
  }

  public function GetInfoCliente($id)
  {
    // Escolher a tabela
    $this->db->from('clientes');

    // Defenir as condicoes
    $this->db->where('CLI_ID', $id);

    // Receber os dados
    $cliente = $this->db->get();

    if ($cliente->num_rows())
    {
      return $cliente->row_array();
    }
    else
    {
      return false;
    }
  }

  public function InserirEncomenda($dados, $dadosDetalhes)
  {
    $this->db->insert('encomendas', $dados);

    $idEnc = $this->db->get('encomendas');
    $idEnc = $idEnc->num_rows() - 1;

    $dados = array(
      'ENC_ID' => $idEnc,
      'PDR_ID' => $dadosDetalhes['PDR_ID'],
      'Quantidade' => $dadosDetalhes['Quantidade']
    );

    $this->db->insert('detalhes_enc', $dados);
  }
}

?>
