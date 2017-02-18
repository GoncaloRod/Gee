<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller
{
	public function index()
	{
    // Esta variavel ira guardar uma futura mensagem de erro
    $alerta = null;

		// Verificar se a sessao de Administrador nao existe
		if (!$this->session->userdata('admin_session'))
		{
			// Se a captcha for preenchida o 'utilizador'(Robô) é rederecionado para a página inicial
			if ($this->input->post('captcha')) redirect(base_url());

			// Verificar se o utlilizador ja tentou fazer login
			if ($this->input->post('entrar') == 'entrar')
			{
				// Defenir regars de validação de formulários
				$this->form_validation->set_rules('id_admin', 'ID Admin', 'trim|required|numeric');
				$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[6]|max_length[50]');

				// Executar a validação e verificar se cumpre os requisitos
				if ($this->form_validation->run())
				{
					// Carregar o model para o login
					$this->load->model('Admins');

					// Defenir as variaveis que vao ser enviadas para o model
					$admin_id = $this->input->post('id_admin');
					$password = $this->input->post('password');

					// Executar a funcao do model e guardar os dados returnados
					$login_valido = $this->Admins->Login($admin_id, $password);

					// Verificar se o login foi bem sucedido
					if ($login_valido)
					{
						// Guargar as informacoes retornadas pelo model
						$admin = $login_valido;

						// Defenir as variaveis da sessao
						$session = array(
							'admin_id' 			=> $admin['ADM_ID'],
							'admin_nome' 		=> $admin['ADM_Nome'],
							'admin_apelido' => $admin['ADM_Apelido'],
							'admin_master'	=> $admin['ADM_Master'],
							'admin_session' => true
						);

						// Iniciar a sessao
						$this->session->set_userdata($session);

						// Rederecionar para a Dashboard
						redirect('Admin/Dashboard');
					}
					else
					{
						$alerta = array(
							'class'    => 'danger',
							'mensagem' => 'Atenção! ID ou Password Incoretos!'
						);
					}
				}
				else
				{
					$alerta = array(
						'class'    => 'danger',
						'mensagem' =>'Atenção! Falha na Validação do Formulário:<br>'. validation_errors()
					);
				}
			}

			$dados = array(
				'alerta' => $alerta
			);

			// Mostrar a pagina de login
			$this->load->view('Admin/Login', $dados);
		}
		// Se exixtir o utilizador e redirecionado para a Dashboard
		else
		{
			redirect('Admin/Dashboard');
		}
	}

	public function Registar()
	{
		$alerta = null;
		if ($this->input->post('registar') == 'registar')
		{
			if ($this->input->post('captcha')) redirect(base_url());

			// Defenir as regras de validacoa de formularios
			$this->form_validation->set_rules('nome', 'Nome', 'required|max_length[15]');
			$this->form_validation->set_rules('apelido', 'Apelido', 'required|max_length[15]');
			$this->form_validation->set_rules('password', 'Password', 'required|max_length[6]|max_length[50]');
			$this->form_validation->set_rules('confirmarPassword', 'Confirmar Password', 'required|max_length[6]|max_length[50]|matches[password]');

			// Verificar se o formulario foi preenchido corretamente
			if ($this->form_validation->run())
			{
				// Carregar o model
				$this->load->model('Admins');

				// Variaveis que serao enviadas para o model
				$nome = $this->input->post('nome');
				$apelido = $this->input->post('apelido');
				$password = $this->input->post('password');

				if ($this->input->post('adminMaster'))
				{
					$adminMaster = true;
				}
				else
				{
					$adminMaster = false;
				}


				$dados = array(
					'ADM_Nome' 		 => $nome,
					'ADM_Apelido'  => $apelido,
					'ADM_Senha' => $password,
					'ADM_Master' 	 => $adminMaster
				);

				if ($this->Admins->Registar($dados))
				{
					$alerta = array(
						'class' 	 => 'success',
						'mensagem' => 'Administrador adicionado com sucesso!'
					);
				}
				else
				{
					$alerta = array(
						'class' 	 => 'danger',
						'mensagem' => 'Administrador adicionado sem com sucesso!'
					);
				}
			}
			else
			{
				$alerta = array(
					'class'    => 'danger',
					'mensagem' =>'Atenção! Falha na Validação do Formulário:<br>'. validation_errors()
				);
			}
		}

		// Dados que vao ser enviados para a view
		$dados = array(
			'alerta' => $alerta
		);

		// Header
		$this->load->view('Admin/includes/header');

		// Pagina
		$this->load->view('Admin/Registar', $dados);
	}

	public function Dashboard()
	{
		// Verificar se a sessao de Administrador ja existe
		if ($this->session->userdata('admin_session'))
		{
			// Carregar o model de Administrador
			$this->load->model('Admins');

			// Variaveis para as Tarefas
			$tarefas = array(
				'EncPendentes' => $this->Admins->NEncPendentes(),
				'PdrBaixa' 		 => $this->Admins->NPdrBaixa(),
				'EncEnvio' 		 => $this->Admins->NEncEnvio()
			);


			$dados = array(
					'tarefas' => $tarefas
			);

			// Header
			$this->load->view('Admin/includes/header');

			// Pagina
			$this->load->view('Admin/MainPage', $dados);
		}
		// Se nao existir o utilizador e redirecionado para a pagina de login
		else
		{
			redirect('Admin');
		}
	}

	public function Sair()
	{
		// Destruir a sessao
		$this->session->sess_destroy();

		// Rederecionar para a pagina de login
		redirect(base_url('Admin'));
	}

	public function EncomendasPendentes($pag)
	{
		// Verificar se a sessao de Administrador ja existe
		if ($this->session->userdata('admin_session'))
		{
			// Dados
			$enc = null;

			// Carregar o model de administrador
			$this->load->model('admins');

			// Receber as encomendas do model
			$encomendas = $this->admins->GetEncPendentes();

			if ($encomendas)
			{
				$enc = array();

				for ($i = ($pag * 10) - 10 ; $i < $pag * 10; $i++)
				{
					array_push($enc, $encomendas[$i]);
				}
			}

			// Array com os dados para serem enviados para a view
			$dados = array(
				'pagina' 		 => $pag,
				'encomendas' => $enc
			);

			// Header
			$this->load->view('Admin/includes/header');

			// Pagina
			$this->load->view('Admin/EncPendentes', $dados);
		}
		// Se nao existir o utilizador e redirecionado para a pagina de login
		else
		{
			redirect('Admin');
		}
	}

	public function ProdutosBaixa()
	{
		// Verificar se a sessao de Administrador ja existe
		if ($this->session->userdata('admin_session'))
		{
			// Header
			$this->load->view('Admin/includes/header');

			// Pagina

		}
		// Se nao existir o utilizador e redirecionado para a pagina de login
		else
		{
			redirect('Admin');
		}
	}

	public function EncomendasEnvio()
	{
		// Verificar se a sessao de Administrador ja existe
		if ($this->session->userdata('admin_session'))
		{
			// Header
			$this->load->view('Admin/includes/header');

			// Pagina

		}
		// Se nao existir o utilizador e redirecionado para a pagina de login
		else
		{
			redirect('Admin');
		}
	}

	public function GerirPdr()
	{
		// Verificar se a sessao de Administrador ja existe
		if ($this->session->userdata('admin_session'))
		{
			// Carregar o model de Administrador
			$this->load->model('Admins');

			// Descarregar a lista de produtos da base de dados
			$produtos = $this->Admins->GetPdr();

			if ($this->input->post('confirmar') == 'confirmar')
			{
				$marca = $this->input->post('selectMarca');
				$subCat = $this->input->post('selectSubCat');

				// Verificar pela marcas
				if ($marca != 'Todas')
				{
					$arrayAuxiliar = array();

					for ($i=0; $i < count($produtos); $i++)
					{
						$produto = $produtos[$i];

						if ($produto['PDR_Marca'] == $marca)
						{
							array_push($arrayAuxiliar, $produtos[$i]);
						}
					}

					$produtos = $arrayAuxiliar;
				}

				// Verificar pela subcategoria
				if ($subCat != 'Todas')
				{
					$subCatID = $this->Admins->GetSubCatID($subCat);

					$arrayAuxiliar = array();

					for ($i=0; $i < count($produtos); $i++)
					{
						$produto = $produtos[$i];

						if ($produto['SCT_ID'] == $subCatID)
						{
							array_push($arrayAuxiliar, $produtos[$i]);
						}
					}

					$produtos = $arrayAuxiliar;
				}
			}

			// Descarregar a lista de marcas da base de dados
			$marcasDB = $this->Admins->GetMarcas();

			// Array onde serao armazenadas as marcas
			$marcas = array();

			// Remover as marcas repetidas do array
			for ($i=0; $i < count($marcasDB); $i++)
			{
				if(!in_array($marcasDB[$i], $marcas))
				{
					array_push($marcas, $marcasDB[$i]);
				}
			}

			// Descarregar a lista de Sub-Categorias da base de dados
			$subCategorias = $this->Admins->GetSubCat();

			// Criar o array que vai ser enviado para a view
			$dados = array(
				'produtos' 			=> $produtos,
				'marcas' 				=> $marcas,
				'subCategorias' => $subCategorias
			);

			// Header
			$this->load->view('Admin/includes/header');

			// Pagina
			$this->load->view('Admin/GerirProdutos', $dados);
		}
		// Se nao existir o utilizador e redirecionado para a pagina de login
		else
		{
			redirect('Admin');
		}
	}

	public function AddPdr()
	{
		// Variavel para armazenar um alerta caso seja necessario
		$alerta = null;

		// Verificar se a sessao de Administrador ja existe
		if ($this->session->userdata('admin_session'))
		{
			// Carregar o model de Administrador
			$this->load->model('Admins');

			// Descarregar a lista de marcas da base de dados
			$marcasDB = $this->Admins->GetMarcas();

			// Array onde serao armazenadas as marcas
			$marcas = array();

			// Remover as marcas repetidas do array
			for ($i=0; $i < count($marcasDB); $i++)
			{
				if(!in_array($marcasDB[$i], $marcas))
				{
					array_push($marcas, $marcasDB[$i]);
				}
			}

			// Descarregar a lista de Sub-Categorias da base de dados
			$subCategorias = $this->Admins->GetSubCat();

			// Descarregar a lista de Categorias da base de dados
			$categorias = $this->Admins->GetCat();

			// Se a captcha for preenchida o 'utilizador'(Robô) é rederecionado para a página inicial
			if ($this->input->post('captcha')) redirect(base_url());

			if ($this->input->post('confirmar') == 'confirmar')
			{
				// Verificar se o radio da marca foi selecionado
				if ($this->input->post('RadioMarca') != null)
				{
					// Verificar se o radio da subcategoria foi selecionado
					if($this->input->post('RadioSubCat') != null)
					{
						// Verificar se o radio da categoria foi selecionado
						if (($this->input->post('RadioSubCat') == 'subCatExistente') ||(($this->input->post('RadioSubCat') == 'subCatNova') && ($this->input->post('RadioCat') != null)))
						{
							$this->form_validation->set_rules('nome', 'Nome', 'required|max_length[60]');
							$this->form_validation->set_rules('preco', 'Preco', 'required|numeric');
							$this->form_validation->set_rules('percentagemIVA', 'Percentagem IVA', 'required|numeric');
							$this->form_validation->set_rules('quantidade', 'Quantidade', 'required|numeric');

							// Se o utilizador escolher adicionar uma marca defenir as regras de validacao de formularios
							if ($this->input->post('RadioMarca') == 'marcaNova')
							{
								$this->form_validation->set_rules('marcaNova', 'Marca Nova', 'required|max_length[30]');
							}

							// Se o utilizador escolher adicionar uma subcategoria defenir as regras de validacao de formularios
							if ($this->input->post('RadioSubCat') == 'subCatNova')
							{
								$this->form_validation->set_rules('subCategoriaNova', 'Subcategoria Nova', 'required|max_length[25]');
							}

							// Se o utilizador escolher adicionar uma categoria defenir as regras de validacao de formularios
							if ($this->input->post('RadioCat') == 'catNova')
							{
								$this->form_validation->set_rules('categoriaNova', 'Categoria Nova', 'required|max_length[25]');
							}

							if ($this->form_validation->run())
							{
								// Variaveis verificadoras
								$marcaEnixistente  = true;
								$subCatEnixistente = true;
								$catEnixistente		 = true;

								// Variaveis que serao enviadas para os models
								$nome 			= $this->input->post('nome');
								$preco 			= $this->input->post('preco');
								$iva 				= $this->input->post('percentagemIVA');
								$quantidade = $this->input->post('quantidade');
								$desconto 	= 0;

								// Marca
								if ($this->input->post('RadioMarca') == 'marcaNova')
								{
									$marca = $this->input->post('marcaNova');

									// Se a marca ja existir define a variavel verificadora com false
									if(!$this->Admins->CheckMarca($marca))
									{
										$marcaEnixistente = false;
									}
								}
								else
								{
									$marca = $this->input->post('selectMarca');
								}

								// Categoria
								if ($this->input->post('RadioCat') == 'catNova')
								{
									$cat = $this->input->post('categoriaNova');

									// Variaveis que vao ser enviadas para o model
									$dados = array(
										'CatNome' => $cat
									);

									if (!$this->Admins->AddCat($dados))
									{
										$catEnixistente = false;
									}
								}
								else
								{
									$cat = $this->input->post('selectCat');
								}

								// Subcategoria
								if ($catEnixistente)
								{
									if($this->input->post('RadioSubCat') == 'subCatNova')
									{
										$subCat = $this->input->post('subCategoriaNova');

										$dados = array(
											'SubCatNome' => $subCat,
											'CatNome' 	 => $cat
										);

										if (!$this->Admins->AddSubCat($dados))
										{
											$subCatEnixistente = false;
										}
									}
									else
									{
										$subCat = $this->input->post('selectSubCat');
									}
								}

								// Receber o ID da subcategoria da base de dodos
								$subCatID = $this->Admins->GetSubCatID($subCat);

								if ($marcaEnixistente && $subCatEnixistente && $catEnixistente)
								{
									// Enviar a imagem para o servidor
									// Configurar o upload
									$config['upload_path']	 = './assets/img/Produtos';
									$config['allowed_types'] = 'png';
              		$config['max_width']     = 400;
              		$config['max_height']    = 400;
									$config['min_width']     = 400;
              		$config['min_height']    = 400;
									$config['file_name']		 = $nome;
									$config['overwrite']		 = true;

									$this->load->library('upload', $config);

									if ($this->upload->do_upload('imagem'))
									{
										$dados = array(
											'PDR_Nome' 			 => $nome,
											'PDR_Marca' 		 => $marca,
											'PDR_Preco' 		 => $preco,
											'PDR_IVA' 			 => $iva,
											'PDR_Imagem'     => $this->upload->data('file_name'),
											'PDR_Quantidade' => $quantidade,
											'PDR_Desconto' 	 => $desconto,
											'SCT_ID' 				 => $subCatID
										);

										if ($this->Admins->AddPdr($dados))
										{
											$dados = array(
												'ADM_ID' 	 => $this->session->userdata('admin_id'),
												'PDR_ID' 	 => count($this->Admins->GetPdr()) - 1,
												'ALT_Tipo' => 'Adição'
											);

											$this->Admins->RegistarAlteracao($dados);

											redirect('Admin/GerirPdr');
										}
										else
										{
											$alerta = array(
												'class'    => 'danger',
												'mensagem' => 'Produto já existe!'
											);
										}
									}
									else
									{
										$alerta = array(
											'class'    => 'danger',
											'mensagem' => $this->upload->display_errors()
										);
									}
								}
								else
								{
									// Variavel onde sera armazenada a mensagem para o alerta
									$textAlerta = "";

									// Se a marca ja existir
									if(!$marcaEnixistente)
									{
										$textAlerta = $textAlerta ."A marca já existe!<br>";
									}

									// Se a categoria ja existir
									if(!$catEnixistente)
									{
										$textAlerta = $textAlerta ."A categoria já existe!<br>";
									}

									// Se a subcategoria ja existir
									if(!$subCatEnixistente)
									{
										$textAlerta = $textAlerta ."A subcategoria já existe!<br>";
									}

									$alerta = array(
										'class' 	 => 'danger',
										'mensagem' => $textAlerta
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
						else
						{
							$alerta = array(
								'class' 	 => 'danger',
								'mensagem' => 'Deve escolher se quer usar uma Categoria existente ou se pertende criar uma nova!'
							);
						}
					}
					else
					{
						$alerta = array(
							'class' 	 => 'danger',
							'mensagem' => 'Deve escolher se quer usar uma Subcategoria existente ou se pertende criar uma nova!'
						);
					}
				}
				else
				{
					$alerta = array(
						'class' 	 => 'danger',
						'mensagem' => 'Deve escolher se quer usar uma Marca existe ou se pertende criar uma nova!'
					);
				}
			}

			// Criar o array que vai ser enviado para a view
			$dados = array(
				'marcas' 				=> $marcas,
				'subCategorias' => $subCategorias,
				'categorias' 		=> $categorias,
				'alerta' 				=> $alerta
			);

			// Header
			$this->load->view('Admin/includes/header');

			// Pagina
			$this->load->view('Admin/AddProduto', $dados);
		}
		// Se nao existir o utilizador e redirecionado para a pagina de login
		else
		{
			redirect('Admin');
		}
	}

	public function EditarPdr($pdrID)
	{
		if ($this->session->userdata('admin_session'))
		{
			$alerta = null;
			$produto = null;

			$pdrID = (int) $pdrID;

			if($pdrID)
			{
				// Carregar o model
				$this->load->model('Admins');

				// Chamar o model
				$existe = $this->Admins->GetPdrInfo($pdrID);

				if ($existe)
				{
					$produto = $existe;

					if ($this->input->post('guardar') == 'guardar')
					{
						if ($this->input->post('captcha')) redirect(base_url());

						if ($pdrID != $this->input->post('id_produto')) redirect('Admin/GerirPdr');

						// Defenir regras de validacoa
						$this->form_validation->set_rules('nome', 'Nome', 'required|max_length[60]');
						$this->form_validation->set_rules('preco', 'Preco', 'required|numeric');
						$this->form_validation->set_rules('percentagemIVA', 'Percentagem IVA', 'required|numeric');
						$this->form_validation->set_rules('quantidade', 'Quantidade', 'required|numeric');
						$this->form_validation->set_rules('desconto', 'Desconto', 'required|numeric');

						// Se o formulario for corretamente validado pode prosseguir a atualizacoa
						if ($this->form_validation->run())
						{
							// Guardar os dados do produto atualizados num array
							$produto_atualizado = array(
								'PDR_Nome' 			 => $this->input->post('nome'),
								'PDR_Preco' 		 => $this->input->post('preco'),
								'PDR_IVA' 			 => $this->input->post('percentagemIVA'),
								'PDR_Quantidade' => $this->input->post('quantidade'),
								'PDR_Desconto' 	 => $this->input->post('desconto')
							);

							// Executar o model
							if ($this->Admins->AtualizarPdr($pdrID, $produto_atualizado))
							{
								// Registar alteracao na bese de dados
								// Variaveis que saroa enviadas para o medel
								$dados = array(
									'ADM_ID' 	 => $this->session->userdata('admin_id'),
									'PDR_ID' 	 => $pdrID,
									'ALT_Tipo' => 'Edição'
								);

								$this->Admins->RegistarAlteracao($dados);

								// Defenir mensagem de alerta
								$alerta = array(
									'class'    => 'success',
									'mensagem' => 'Produto atualizado com sucesso!'
								);
							}
							else
							{
								$alerta = array(
									'class'    => 'danger',
									'mensagem' => 'O produto não atualizado com sucesso!'
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
				}
				else
				{
					$produto = false;

					$alerta = array(
						'class' 	 => 'danger',
						'mensagem' => 'O produto não existe!'
					);
				}
			}
			else {
				$alerta = array(
					'class' 	 => 'danger',
					'mensagem' => 'Produto não existe!'
				);
			}

			$dados = array(
				'alerta'  => $alerta,
				'produto' => $produto
			);

			// Header
			$this->load->view('Admin/includes/header');

			// Pagina
			$this->load->view('Admin/EditarProduto', $dados);
		}
		else
		{
			redirect('Admin');
		}
	}

	public function RemoverPdr($pdrID)
	{
		if ($this->session->userdata('admin_session'))
		{
			$alerta = null;

			$pdrID = (int) $pdrID;

			if ($pdrID)
			{
				// Carregar o model
				$this->load->model('Admins');

				// Chamar o model
				$existe = $this->Admins->GetPdrInfo($pdrID);

				if ($existe)
				{
					if ($this->Admins->RemoverPdr($pdrID))
					{
						// Registar alteracao na bese de dados
						// Variaveis que saroa enviadas para o medel
						$dados = array(
							'ADM_ID' 	 => $this->session->userdata('admin_id'),
							'PDR_ID' 	 => $pdrID,
							'ALT_Tipo' => 'Remoção'
						);

						$this->Admins->RegistarAlteracao($dados);

						// Defenir mensagem de alerta
						$alerta = array(
							'class'    => 'success',
							'mensagem' => 'Produto removido com sucesso!'
						);
					}
					else
					{
						$alerta = array(
							'class' 	 => 'danger',
							'mensagem' => 'Produto removido sem sucesso!'
						);
					}
				}
				else
				{
					$alerta = array(
						'class' 	 => 'danger',
						'mensagem' => 'Produto não existe!'
					);
				}
			}
			else
			{
				$alerta = array(
					'class' 	 => 'danger',
					'mensagem' => 'Produto não existe!'
				);
			}

			$dados = array(
				'alerta' => $alerta
			);

			// Header
			$this->load->view('Admin/includes/header');

			// Pagina
			$this->load->view('Admin/RemoverProduto', $dados);
		}
		else
		{
			redirect('Admin');
		}
	}

	public function GerirHomepage()
	{
		if ($this->session->userdata('admin_session'))
		{
			$alerta = null;

			// Carreger o model
			$this->load->model('Admins');

			// Verificar se o formulario ja foi preenchido
			if ($this->input->post('guardar') == 'guardar')
			{
				if ($this->input->post('captcha')) redirect(base_url());

				// Defenir regras de validacoa de formularios
				// Produtos em Destaque
				$this->form_validation->set_rules('selectPdr1', 'Destaque Posição 1', 'required|differs[selectPdr2]|differs[selectPdr3]|differs[selectPdr4]');
				$this->form_validation->set_rules('selectPdr2', 'Destaque Posição 2', 'required|differs[selectPdr1]|differs[selectPdr3]|differs[selectPdr4]');
				$this->form_validation->set_rules('selectPdr3', 'Destaque Posição 3', 'required|differs[selectPdr1]|differs[selectPdr2]|differs[selectPdr4]');
				$this->form_validation->set_rules('selectPdr4', 'Destaque Posição 4', 'required|differs[selectPdr1]|differs[selectPdr2]|differs[selectPdr3]');
				//Podutos em Promocao
				$this->form_validation->set_rules('selectPdrDesconto1', 'Promoção Posição 1', 'required|differs[selectPdrDesconto2]|differs[selectDescontoPdr3]|differs[selectDescontoPdr4]');
				$this->form_validation->set_rules('selectPdrDesconto2', 'Promoção Posição 2', 'required|differs[selectPdrDesconto1]|differs[selectDescontoPdr3]|differs[selectDescontoPdr4]');
				$this->form_validation->set_rules('selectPdrDesconto3', 'Promoção Posição 3', 'required|differs[selectPdrDesconto1]|differs[selectDescontoPdr2]|differs[selectDescontoPdr4]');
				$this->form_validation->set_rules('selectPdrDesconto4', 'Promoção Posição 4', 'required|differs[selectPdrDesconto1]|differs[selectDescontoPdr2]|differs[selectDescontoPdr3]');

				if ($this->form_validation->run())
				{
					// Defenir array com os produtos em destaque
					$destaques = array(
						$this->input->post('selectPdr1'),
						$this->input->post('selectPdr2'),
						$this->input->post('selectPdr3'),
						$this->input->post('selectPdr4')
					);

					// Defenir array com os produtos em promocao
					$promocoes = array(
						$this->input->post('selectPdrDesconto1'),
						$this->input->post('selectPdrDesconto2'),
						$this->input->post('selectPdrDesconto3'),
						$this->input->post('selectPdrDesconto4')
					);

					// Defenir array com as informacoes para o model
					$dados = array(
						'destaques' => $destaques,
						'promocoes' => $promocoes
					);

					if ($this->Admins->Homepage($dados))
					{
						$alerta = array(
							'class'    => 'success',
							'mensagem' =>'Homepage atualizada com sucesso!'
						);
					}
					else
					{
						$alerta = array(
							'class'    => 'danger',
							'mensagem' =>'Homepage atualizada sem sucesso!'
						);
					}
				}
				else
				{
					$alerta = array(
						'class'    => 'danger',
						'mensagem' =>'Atenção! Falha na Validação do Formulário:<br>'. validation_errors()
					);
				}
			}

			// Descarregar a lista de produtos da base de dados
			$produtos = $this->Admins->GetPdr();

			// Retirar os produtos em desconto do array produtos
			$produtosDesconto = array();
			for ($i=0; $i < count($produtos); $i++)
			{
				$produto = $produtos[$i];

				if ($produto['PDR_Desconto'] > 0)
				{
					array_push($produtosDesconto, $produto);
				}
			}

			// Array que sera enviado para a view
			$dados = array(
				'produtos' 				 => $produtos,
				'produtosDesconto' => $produtosDesconto,
				'alerta' 	 				 => $alerta
			);

			// Header
			$this->load->view('Admin/includes/header');

			// Pagina
			$this->load->view('Admin/GerirHomepage', $dados);
		}
		else
		{
			redirect('Admin');
		}
	}

	public function ConsultarAlteracoes()
	{
		if ($this->session->userdata('admin_session'))
		{
			// Carregar o model
			$this->load->model('Admins');

			// Receber as alteracoes do model
			$alteracoes = $this->Admins->GetAlt();

			$dados = array(
				'alteracoes' => $alteracoes
			);

			// Header
			$this->load->view('Admin/includes/header');

			// Pagina
			$this->load->view('Admin/consultarAlteracoes', $dados);
		}
		else
		{
			redirect('Admin');
		}
	}
}
