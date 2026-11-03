Biblioteca Cidadão — Projeto 2


Sobre o projeto
O Projeto 2 da Biblioteca Cidadão representa a evolução da aplicação web desenvolvida para a disciplina de Web Servidor na UTFPR. O sistema expande as funcionalidades de gestão de uma biblioteca universitária, implementando operações completas de CRUD (com edição e exclusão controladas), migração completa para Banco de Dados Relacional, arquitetura orientada a objetos (POO) estruturada no padrão MVC e DAO, além de camadas rigorosas de segurança web no lado do servidor.

Integrantes

Rayane Alves
Gleice Emilly

Contribuições e Atividades dos Integrantes
Rayane Alves
Desenvolvimento e Gestão de Empréstimos: Implementação completa da lógica de controle, cadastro, baixa de empréstimos de livros para os clientes da biblioteca.

Refatoração para POO: Implementação orientada a objetos (classes, models, DAOs e controllers) aplicada à gestão de empréstimos.

Segurança e Confiabilidade: Atuação direta na integração de validações no lado do servidor, proteção de rotas e suporte na aplicação de segurança contra vulnerabilidades web.


Gleice Emilly
Gerenciamento Completo de Usuários (CRUD Avançado): Desenvolvimento das rotinas de edição, atualização e exclusão de usuários cadastrados no sistema.

Implementação em POO: Estruturação das regras de negócio de usuários utilizando Programação Orientada a Objetos, mapeando entidades e persistência via camada DAO.

Testes e Validações: Aplicação de validações de dados e refinamento da interface de edição de usuários (views/usuarios/editar.php).

Principais Evoluções Técnicas (Comparado ao Projeto 1)
Migração para Banco de Dados Relacional: Substituição do armazenamento estático por um banco relacional estruturado com tabelas normalizadas (usuarios, livros, autores, categorias, emprestimos).

Programação Orientada a Objetos (POO) & DAO: O código passou a ser orientado a objetos, utilizando o padrão DAO (Data Access Object) para isolar o acesso aos dados.

Segurança Avançada:
Prepared Statements (PDO): Eliminação total de riscos de SQL Injection.

Proteção contra CSRF: Tokens de segurança validados em todas as requisições POST (cadastros, exclusões e alteração de sessão).

Sessões e Logout Seguro: Conversão da rota de encerramento de sessão obrigatoriamente para método POST.

Estrutura do Projeto
A aplicação segue o padrão arquitetural MVC aliado ao padrão DAO:

Plaintext
Biblioteca_Cidadao/
├── controllers/
├── models/
├── views/
├── helpers/
├── config/
└── README.md

Instalação, Execução e Configuração do Banco de Dados
1. Requisitos e Configuração do Banco de Dados (.env ou arquivo de configuração)
O sistema opera com as seguintes configurações padrão para conexão via PDO:

Host: localhost
Porta: 3306
Nome do Banco: biblioteca_cidadao
Usuário: root
Senha: (vazia / sem senha)

2. Como acessar e gerenciar o Banco de Dados pelo XAMPP
Para verificar ou importar a estrutura das tabelas no MySQL utilizando o XAMPP:

Abra o Painel do XAMPP (XAMPP Control Panel).

Inicie os Serviços: Clique em Start nos módulos Apache e MySQL (ambos devem ficar com o fundo verde).

Abra o phpMyAdmin: No seu navegador, acesse:

http://localhost/phpmyadmin
Localize o Banco de Dados: Na coluna lateral esquerda, selecione o banco biblioteca_cidadao (caso ainda não exista, clique em "Novo", digite o nome biblioteca_cidadao e clique em Criar). A partir daí, você poderá inspecionar e gerenciar as tabelas de usuários, livros e empréstimos diretamente.

3. Colocar o projeto no servidor
Copie a pasta do projeto para o diretório htdocs do XAMPP:

C:\xampp\htdocs\Biblioteca_Cidadao
Abra o navegador e acesse a aplicação a partir da rota principal configurada no seu sistema.

## Tecnologias utilizadas

- *PHP 8+* (com Programação Orientada a Objetos)
- *MySQL / PDO* (Banco de dados relacional com Prepared Statements)
- *HTML5 & CSS3* (Interface responsiva e padronizada)
- *JavaScript* (Interações e comportamentos no front-end)
- *XAMPP* (Ambiente de desenvolvimento local - Apache e MySQL)
- *Git & GitHub* (Controle de versão e colaboração)

### Acesso Inicial:
- *E-mail:* atendimento@bibliotecacidadao.gov.br 
- *Senha:* biblioteca2026