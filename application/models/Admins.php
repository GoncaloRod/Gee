<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admins extends CI_Model
{
	public function Login($admin_id, $senha)
	{
		// Escolher a tabela
		$this->db->from('admins');

		// Defenir as condicoes
		$this->db->where('ADM_ID', $admin_id);
		$this->db->where('ADM_Senha', $senha);

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
		$this->db->insert('admins', $dados);
	}

	public function NEncPendentes()
	{
		// Escolher a tabela
		$this->db->from('encomendas');

		// Defenir as condicoes
		$this->db->where('ENC_Estado', 'Pendente');

		// Receber os dados da base de dados
		$encomendas = $this->db->get();

		// Devolver o numero de encomendas que estao pendentes
		return $encomendas->num_rows();
	}

	public function NPdrBaixa()
	{
		// Escolher a tabela
		$this->db->from('produtos');

		// Defenir as condicoes
		$this->db->where('PDR_Quantidade <=', '5');

		// Receber os dados da base de dados
		$produtos = $this->db->get();

		// Devolver o numero de produtos que estado em baixa
		return $produtos->num_rows();
	}

	public function NEncEnvio()
	{
		// Escolher a tabela
		$this->db->from('encomendas');

		// Defenir as condicoes
		$this->db->where('ENC_Estado', 'Envio');

		// Receber os dados da base de dados
		$encomendas = $this->db->get();

		// Devolver o numero de encomendas que estao para envio
		return $encomendas->num_rows();
	}

	public function GetPdr()
	{
		// Escolher a tabela
		$this->db->from('produtos');

		// Receber os dados da base de dados
		$produtos = $this->db->get();

		// Devolver os dados na forma de array
		return $produtos->result_array();
	}

	public function GetMarcas()
	{
		// Escolher a tabela
		$this->db->from('produtos');

		// Escolher a coluna
		$this->db->select('PDR_Marca');

		// Receber os dados da base de dados
		$marcas = $this->db->get();

		// Devolver os dados na forma de array
		return $marcas->result_array();
	}

	public function GetSubCat()
	{
		// Escolher a tabela
		$this->db->from('sub_categorias');

		// Escolher a coluna
		$this->db->select('SCT_Nome');

		// Receber os dados da base de dados
		$subCats = $this->db->get();

		// Devolver os dados
		return $subCats->result_array();
	}

	public function GetCat()
	{
		// Escolher a tabela
		$this->db->from('categorias');

		// Escolher a coluna
		$this->db->select('CAT_Nome');

		// Receber os dados da base de dados
		$cat = $this->db->get();

		// Devolver os dados na forma de array
		return $cat->result_array();
	}

	public function GetSubCatID($nome)
	{
		// Escolher a tabela
		$this->db->from('sub_categorias');

		// Escolher a coluna
		$this->db->select('SCT_ID');

		// Defenir as condicoes
		$this->db->where('SCT_Nome', $nome);

		// Receber os dados da base de dados
		$subCatID = $this->db->get();

		// Verificar se existe pelo menos 1 registro
		if ($subCatID->num_rows())
		{
			// Retirar apenas o id
			$subCatID = $subCatID->result_array();
			$subCatID = $subCatID[0];

			// Returnar os dados
			return $subCatID['SCT_ID'];
		}
		else
		{
			return false;
		}
	}

	public function CheckMarca($nome)
	{
		// Escolher a tabela
		$this->db->from('produtos');

		// Defenir as condicoes
		$this->db->where('PDR_Marca', $nome);

		// Receber os dados da base de dados
		$produtos = $this->db->get();

		// Se a marca nao existir e enviado um alerta
		if (!$produtos->num_rows())
		{
			return true;
		}
		else
		{
			return false;
		}
	}

	public function AddSubCat($variaveis)
	{
		// Escolher a tabela
		$this->db->from('categorias');

		// Escolher as colunas
		$this->db->select('CAT_ID');

		// Defenir as condicoes
		$this->db->where('CAT_Nome', $variaveis['CatNome']);

		// Receber os dados da base de dados
		$catID = $this->db->get();

		$catID = $catID->result_array();

		// Retirar o ID da Categoria
		$catID = $catID[0];

		// Dados
		$dados = array(
			'SCT_Nome' => $variaveis['SubCatNome'],
			'CAT_ID' 	 => $catID['CAT_ID']
		);

		// Escolher a tabela
		$this->db->from('sub_categorias');

		// Defenir as condicoes
		$this->db->where('SCT_Nome', $dados['SCT_Nome']);

		// Receber os dados da base de dados
		$subCats = $this->db->get();

		if (!$subCats->num_rows())
		{
			$this->db->insert('sub_categorias', $dados);

			return true;
		}
		else
		{
			return false;
		}
	}

	public function AddCat($variaveis)
	{
		// Dados
		$dados = array(
			'CAT_Nome' => $variaveis['CatNome']
		);

		// Escolher a tabela
		$this->db->from('categorias');

		// Defenir as condicoes
		$this->db->where('CAT_Nome', $dados['CAT_Nome']);

		// Receber os dados da base de dados
		$categorias = $this->db->get();

		// Se nao existir nenhuma categoria com o mesmo nome o registro pode continuar
		if (!$categorias->num_rows())
		{
			$this->db->insert('categorias', $dados);

			return true;
		}
		else
		{
			return false;
		}
	}

	public function AddPdr($dados)
	{
		// Escolher a tabela
		$this->db->from('produtos');

		// Defenir as condicoes
		$this->db->where('PDR_Nome', $dados['PDR_Nome']);

		// Receber os dados da base de dados
		$produtos = $this->db->get();

		// Se nao existir nenhum produto com o mesmo nome pode ser adicionado
		if (!$produtos->num_rows())
		{
			$this->db->insert('produtos', $dados);

			return true;
		}
		else
		{
			return false;
		}
	}

	public function RegistarAlteracao($dados)
	{
		// Adicionar alteracao
		$this->db->insert('alteracoes_prod', $dados);
	}

	public function GetSctNome($id)
	{
		// Escoler a tabela
		$this->db->from('sub_categorias');

		// Defenir as condicoes
		$this->db->where('SCT_ID', $id);

		// Receber os dados da base de dados
		$subCats = $this->db->get();

		// Verificar se existe pelo menos 1 registro
		if ($subCats->num_rows())
		{
			$subCats = $subCats->result_array();
			$subCats = $subCats[0];

			return $subCats['SCT_Nome'];
		}
		else
		{
			return false;
		}
	}

	public function GetPdrInfo($id)
	{
		// Escolher a tabela
		$this->db->from('produtos');

		// Defenir as condicoes
		$this->db->where('PDR_ID', $id);

		// Receber os dados da base de dados
		$produto = $this->db->get();

		// Verifivar se existe pelo menos um registro
		if ($produto->num_rows())
		{
			return $produto->row_array();
		}
		else
		{
			return false;
		}
	}

	public function AtualizarPdr($id, $dados)
	{
		// Defenir as condicoes
		$this->db->where('PDR_ID', $id);

		// Atualizar a tabela
		$this->db->update('produtos', $dados);

		// Verificar se algum registo foi afetado pelo update
		if ($this->db->affected_rows())
		{
			return true;
		}
		else
		{
			return false;
		}
	}

	public function RemoverPdr($id)
	{
		// Escolher a tabela
		$this->db->from('produtos');

		// Defenir as condicoes
		$this->db->where('PDR_ID', $id);

		// Guardar os dados do produto provisoriamente
		$produto = $this->db->get();
  	$produto = $produto->row_array();

		// Defenir as condicoes
		$this->db->where('PDR_ID', $id);

		// Remover o produtos
		$this->db->delete('produtos');

		// Vereficar se a subcategoria do produto removido contem mais algum produto
		// Escolher a tabela
		$this->db->from('produtos');

		// Defenir as condicoes
		$this->db->where('SCT_ID', $produto['SCT_ID']);

		// Receber os dados da base de dados
		$produtos = $this->db->get();

		// Se nao existir nenhum produto a subcategoria e apagada
		if (!$produtos->num_rows())
		{
			// Guardar os dados da subcategoria provisoriamente
			// Escolher a tabela
			$this->db->from('sub_categorias');

			// Defenir as condicoes
			$this->db->where('SCT_ID', $produto['SCT_ID']);

			// Receber os dados da base de dados
			$subCat = $this->db->get();
			$subCat = $subCat->row_array();

			// Defenir as condicoes
			$this->db->where('SCT_ID', $produto['SCT_ID']);

			// Remover a subcategoria
			$this->db->delete('sub_categorias');

			// Verificar se a categora da subcategoria removida contem mais alguma subcategoria
			// Escolher a tabela
			$this->db->from('sub_categorias');

			// Defenir as condicoes
			$this->db->where('CAT_ID', $subCat['CAT_ID']);

			// Receber os dados da base de dados
			$cat = $this->db->get();

			// Se nao exixtir nenhuma subcategoria a categoria e apagada
			if (!$cat->num_rows())
			{
				// Defenir as condicoes
				$this->db->where('CAT_ID', $subCat['CAT_ID']);

				// Remover a categoria
				$this->db->delete('categorias');
			}
		}

		if ($this->db->affected_rows())
		{
			return true;
		}
		else
		{
			return false;
		}
	}

	public function Homepage($dados)
	{
		// Variaveis recebidas
		$destaques = $dados['destaques'];
		$promocoes = $dados['promocoes'];

		// Verificar se existem informacoes nas tabelas
		// Escolher a tabela
		$this->db->from('produtos_destaque');

		// Receber os dados da base de dados
		$destaquesDB = $this->db->get();

		// Escolher a tabela
		$this->db->from('produtos_desconto');

		// Receber os dados da base de dados
		$promocoesDB = $this->db->get();

		// Inserir dados dos Destques
		if (!$destaquesDB->num_rows())
		{
			for ($i=0; $i < 4; $i++)
			{
				$dadosDB = array(
					'PDR_ID' => $destaques[$i]
				);

				$this->db->insert('produtos_destaque', $dadosDB);
			}
		}
		// Atualizar dados dos Destques
		else
		{
			// Apagar todos os registros da tabela
			$this->db->where('PDR_ID !=', 'NULL');
			$this->db->delete('produtos_destaque');

			for ($i=0; $i < 4; $i++)
			{
				$dadosDB = array(
					'PDR_ID' => $destaques[$i]
				);

				$this->db->insert('produtos_destaque', $dadosDB);
			}
		}

		// Inserir dados das Promocoes
		if (!$destaquesDB->num_rows())
		{
			for ($i=0; $i < 4; $i++)
			{
				$dadosDB = array(
					'PDR_ID' => $promocoes[$i]
				);

				$this->db->insert('produtos_desconto', $dadosDB);
			}
		}
		// Atualizar dados das Promocoes
		else
		{
			// Apagar todos os registros da tabela
			$this->db->where('PDR_ID !=', 'NULL');
			$this->db->delete('produtos_desconto');

			for ($i=0; $i < 4; $i++)
			{
				$dadosDB = array(
					'PDR_ID' => $promocoes[$i]
				);

				$this->db->insert('produtos_desconto', $dadosDB);
			}
		}

		if ($this->db->affected_rows())
		{
			return true;
		}
		else
		{
			return false;
		}
	}

	public function GetAlt()
	{
		// Escoler a tabela
		$this->db->from('alteracoes_prod');

		// Rebeber os dados da base de dados
		$alteracoes = $this->db->get();

		// Devolver os dados
		return $alteracoes->result_array();
	}

	public function GetEncPendentes()
	{
		// Escolher a tabela
		$this->db->from('encomendas');

		// Defenir as condicoes
		$this->db->where('ENC_Estado', 'Pendente');

		// Receber os dados da base de dados
		$encomendas = $this->db->get();

		// Verificar se a base de dados devolveu pelo menos um RegistarAlteracao
		if ($encomendas->num_rows())
		{
			return $encomendas->result_array();
		}
		else
		{
			return false;
		}
	}
}

?>
