<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Loja extends CI_Controller
{
	public function index()
	{
		$pdrDestaques = null;
		$pdrPromocoes = null;

		// Carregar o model
		$this->load->model('LojaDB');

		// Receber os produtos em destaque
		$destaques = $this->LojaDB->GetDestaques();

		// Receber os produtos em desconto
		$promocoes = $this->LojaDB->GetPromocoes();

		// Receber as categorias
		$categorias = $this->LojaDB->GetCategorias();

		// Receber as subCategorias
		$subCategorias = $this->LojaDB->GetSubcategorias();

		// Se existirem produtos em destaque guardar as informacoes de todos eles num array
		if ($destaques)
		{
			$pdrDestaques = array(
				$this->LojaDB->GetPdrInfo($destaques[0]),
				$this->LojaDB->GetPdrInfo($destaques[1]),
				$this->LojaDB->GetPdrInfo($destaques[2]),
				$this->LojaDB->GetPdrInfo($destaques[3])
			);
		}

		// Se existirem produtos com desconto guardar as informacoes de todos eles num array
		if ($promocoes)
		{
			$pdrPromocoes = array(
				$this->LojaDB->GetPdrInfo($promocoes[0]),
				$this->LojaDB->GetPdrInfo($promocoes[1]),
				$this->LojaDB->GetPdrInfo($promocoes[2]),
				$this->LojaDB->GetPdrInfo($promocoes[3])
			);
		}

		$dados = array(
			'destaques' 		=> $pdrDestaques,
			'promocoes' 	 	=> $pdrPromocoes,
			'categorias'	  => $categorias,
			'subCategorias' => $subCategorias
		);

		// Header
		$this->load->view('includes/header');

		// Pagina
		$this->load->view('Homepage', $dados);

		// Footer
		$this->load->view('includes/footer');
	}

	public function ProcessarCompra($id)
	{
		// Carregar o model
		$this->load->model('LojaDB');

		// Descarregar as informacoes do produto da base de dados
		$produto = $this->LojaDB->GetPdrInfo($id);

		$dados = array(
			'produto' => $produto
		);

		// Header
		$this->load->view('includes/header');

		// Pagina
		$this->load->view('ProcessarCompra', $dados);
	}

	public function ConcluirCompra($id)
	{
		// Carregar o model
		$this->load->model('LojaDB');

		// Receber os dados do cliente
		$cliente = $this->LojaDB->GetInfoCliente($this->session->userdata('id_cliente'));

		// Receber os dados do produto
		$produto = $this->LojaDB->GetPdrInfo($id);

		// Dados que serao enviados para o model
		$dados = array(
			'CLI_ID' 			 => $cliente['CLI_ID'],
			'ENC_Total' 	 => $produto['PDR_Preco'],
			'ENC_Paga' 		 => false,
			'ENC_ValorIVA' => $produto['PDR_Preco'] * ($produto['PDR_IVA'] / 100),
			'ENC_Estado' 	 => 'Pendente'
		);

		$dadosDetalhes = array(
			'PDR_ID' 		 => $produto['PDR_ID'],
			'Quantidade' => 1
		);

		// Executar o model
		$this->LojaDB->InserirEncomenda($dados, $dadosDetalhes);

		$alerta = array(
			'class'  	 => 'success',
			'mensagem' => 'Compra Concluida!'
		);

		$dados = array(
			'alerta' => $alerta
		);

		$this->load->view('includes/header');

		$this->load->view('CompraConcluida', $dados);

		$this->load->view('includes/footer');
	}
}
