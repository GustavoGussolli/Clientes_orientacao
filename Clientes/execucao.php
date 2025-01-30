<?php

require_once("modelo/Cliente.php");
require_once("modelo/ClientePf.php");
require_once("modelo/ClientePj.php");
require_once("DAO/ClienteDAO.php");
//Teste da conexão
/*require_once("util/Conexao.php");
$con = Conexao::getCon();
print_r($con);*/

do {

    echo "\n----CADASTRO DE CLIENTES----\n";
    echo "1- Cadastrar Cliente PF\n";
    echo "2- Cadastrar Cliente PJ\n";
    echo "3- Listar Cliente\n";
    echo "4- Buscar Cliente\n";
    echo "5- excluir Cliente\n";
    echo "0- Sair\n";

    $opcao = readline("informe a opcao: ");
    switch ($opcao) {

        case '1':
            $cliente = new ClientePf();
            $cliente->setNome(readline("Informe o nome: "));
            $cliente->setNomeSocial(readline("Informe o nome Social: "));
            $cliente->setCpf(readline("Informe o CPF: "));
            $cliente->setEmail(readline("Informe o email: "));

            //Criar o objeto a ser persistido
            $clienteDAO = new ClienteDAO();
            $clienteDAO->inserirCliente($cliente);

            echo "Cliente PF cadastrado com sucesso! \n\n";
            break;

        case '2':
            //Criar o objeto a ser persistido
            $cliente = new ClientePj();

            $cliente->setRazaoSocial(readline("Informe a razão social: "));
            $cliente->setNomeSocial(readline("Informe o nome Social: "));
            $cliente->setCnpj(readline("Informe o CNPJ: "));
            $cliente->setEmail(readline("Informe o email: "));

            //Criar o objeto a ser persistido
            $clienteDAO = new ClienteDAO();
            $clienteDAO->inserirCliente($cliente);

            echo "Cliente PJ cadastrado com sucesso! \n\n";
            break;

        case '3':
            //Buscar os objetos no BC
            $clienteDAO = new ClienteDAO();
            $clientes = $clienteDAO->listarClientes();

            //Exibir os dados dos objetos
            foreach ($clientes as $c) {
                printf(
                    "%d | %s | %s | %s | %s | \n",
                    $c->getId(),
                    $c->getTipo(),
                    $c->getNomeSocial(),
                    $c->getIdentificacao(),
                    $c->getEmail()
                );
            }
            break;

        case '4':

            $id = readline("Informe o ID do cliente que deseja buscar: ");
            $clienteDAO = new ClienteDAO();
            $cliente = $clienteDAO->buscarCliente($id);

            if ($cliente) {
                printf(
                    "Cliente encontrado: %d | %s | %s | %s | %s | \n",
                    $cliente->getId(),
                    $cliente->getTipo(),
                    $cliente->getNomeSocial(),
                    $cliente->getIdentificacao(),
                    $cliente->getEmail()
                );
            } else {
                echo "Cliente não encontrado!\n";
            }
            break;

        case '5':

            //EXCLUSÃO PELO ID DO CLIENTE

            //1- listar clientes

            $clienteDAO = new ClienteDAO();
            $clientes = $clienteDAO->listarClientes();

            foreach ($clientes as $c) {
                printf(
                    "%d | %s | %s | %s | %s | \n",
                    $c->getId(),
                    $c->getTipo(),
                    $c->getNomeSocial(),
                    $c->getIdentificacao(),
                    $c->getEmail()
                );
            }

            //2- solicitar ao usuario para informar o ID

            $id = readline("Informe o ID do cliente que deseja excluir: ");

            //3- Chamar o clienteDAO para remover da base de dados

            $cliente = $clienteDAO->excluirCliente($id);

            //4- informar que o cliente foi excluído
            echo "Cliente excluido! \n";

            break;

        case '0':
            echo "Programa encerrado!\n";
            break;

        default:
            echo "Opcão Invalida!\n";
    }
} while ($opcao != 0);
