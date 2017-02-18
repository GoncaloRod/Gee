<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Conta extends CI_Controller
{
	public function Entrar()
	{
		$alerta = null;

		if ($this->input->post('entrar') == 'entrar')
		{
			// Se a captcha for preenchida o 'utilizador'(Robô) é rederecionado para a página inicial
			if ($this->input->post('captcha')) redirect(base_url());

			// Defenir regars de validação de formulários
			$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
			$this->form_validation->set_rules('password', 'Senha', 'trim|required|min_length[6]|max_length[50]');

			// Executar a validação e verificar se cumpre os requisitos
			if ($this->form_validation->run())
			{
				// Carregar o model para o login
				$this->load->model('Clientes');

				// Defenir as variaveis que vao ser enviadas para o model
				$email 	  = $this->input->post('email');
				$password = $this->input->post('password');

				// Executar a funcao do model e guardar os dados retornados
				$login_valido = $this->Clientes->Login($email, $password);

				// Verificar se o login foi bem sucedido
				if ($login_valido)
				{
					// Guardar as informacoes retrnadas pelo model
					$utilizador = $login_valido;

					// Defenir as variaveis da sessao
					$session = array(
						'id_cliente' => $utilizador['CLI_ID'],
						'nome'			 => $utilizador['CLI_Nome'],
						'apelido'		 => $utilizador['CLI_Apelido'],
						'logged_in'  => true
					);

					// Iniciar a sessao
					$this->session->set_userdata($session);

					// Rederecionar para a pagina inicial
					redirect(base_url());
				}
				else
				{
					$alerta = array(
						'class'    => 'danger',
						'mensagem' => 'Atenção! Email ou Password Incoretos!'
					);
				}
			}
			else
			{
				$alerta = array(
					'class'    => 'danger',
					'mensagem' => 'Atenção! Falha na Validação do Formulário:<br>'. validation_errors()
				);
			}
		}

		$dados = array(
			'alerta' => $alerta
		);
		// Header
		$this->load->view('includes/header');	

		// Pagina
		$this->load->view('Login', $dados);
	}

	public function Sair()
	{
		// Destruir a sessao
		$this->session->sess_destroy();

		// Rederecionar para a págine inicial
		redirect(base_url());
	}

	public function Registar()
	{
		$alerta = null;

		if ($this->input->post('registar') == 'registar')
		{
			// Se a captcha for preenchida o 'utilizador'(Robô) é rederecionado para a página inicial
			if ($this->input->post('captcha')) redirect(base_url('Registar'));

			// Defenir regars de validação de formulários
			$this->form_validation->set_rules('nome', 'Nome', 'required|max_length[15]');
			$this->form_validation->set_rules('apelido', 'Apelido', 'required|max_length[15]');
			$this->form_validation->set_rules('password', 'Password', 'required|min_length[6]|max_length[50]');
			$this->form_validation->set_rules('confrimarPassword', 'Confirmar Password', 'required|min_length[6]|max_length[50]|matches[password]');

			// Executar a validação e verificar se cumpre os requisitos
			if ($this->form_validation->run())
			{
				// Carregar o Model para o registro
				$this->load->model('Clientes');

				// Cria o array com os dados que vai ser enviado para o Model
				$utilizador = array(
					'CLI_Nome' 	  => $this->input->post('nome'),
					'CLI_Apelido' => $this->input->post('apelido'),
					'CLI_Email' 	=> $this->input->post('email'),
					'CLI_Senha' 	=> $this->input->post('password')
				);

				// Vereficar se o registo foi bem sucedido
				if ($this->Clientes->Registar($utilizador))
				{
					// Defenir as variaveis da sessão
					$session = array(
						'nome'			=> $utilizador['CLI_Nome'],
						'apelido'		=> $utilizador['CLI_Apelido'],
						'logged_in' => true
					);

					// Iniciar a sessão
					$this->session->set_userdata($session);

					// Rederionar para a página inicial
					redirect(base_url());
				}
				else
				{
					$alerta = array(
						'class'    => 'danger',
						'mensagem' => 'O Email já está em uso!'
					);
				}
			}
			else
			{
				$alerta = array(
					'class'    => 'danger',
					'mensagem' => validation_errors()
				);
			}
		}

		$dados = array(
			'alerta' => $alerta
		);

		// Header
		$this->load->view('includes/header');

		// Pagina
		$this->load->view('Registar', $dados);

		// Footer
		$this->load->view('includes/footer');

		$alerta = null;
	}
}

?>
