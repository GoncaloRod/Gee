<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Clientes extends CI_Model
{
  public function Login($email, $senha)
	{
		// Escolher a tabela
		$this->db->from('clientes');

		// Defenir as condicoes
		$this->db->where('CLI_Email', $email);
		$this->db->where('CLI_Senha', $senha);

		// Receber os dados da base de dados
		$admins = $this->db->get();

		// Se existir pelo menos um utilizador que obdeca aos requisitos defenidos e porque o login é valido
		if ($admins->num_rows())
		{
			$admins = $admins->result_array();

			return $admins[0];
		}
		else
    {
			return false;
		}
	}

  public function Registar($dados)
	{
		// Escolher a tabela
		$this->db->from('clientes');

		// Defenir as condições
		$this->db->where('CLI_Email', $dados['CLI_Email']);

		// Receber os dados da base de dados
		$utilizadores = $this->db->get();

		// Se não existir nenhum utilizador com o mesmo email o registro pode continuar
		if (!$utilizadores->num_rows())
		{
			$this->db->insert('clientes', $dados);

			return true;
		}
		else
		{
			return false;
		}
	}
}

?>
