## Twitter Clone - Neex Brasil

Este projeto é um clone do Twitter desenvolvido como desafio da empresa Neex Brasil. A aplicação conta com funcionalidades básicas de uma rede social, incluindo autenticação de usuários, publicação de tweets, comentários e sistema de seguidores.

## Tecnologias Utilizadas
**Backend:**
- Laravel: Framework PHP utilizado para desenvolver a API RESTful
- Laravel Cloud: Plataforma utilizada para deploy da aplicação

**Frontend:**
- HTML: Estruturação das páginas
- CSS: Estilização responsiva da interface
- JavaScript: Interatividade e comunicação com a API

## Funcionalidades Principais

**Autenticação:**
- Cadastro de novos usuários
- Login com email e senha
- Sistema de tokens para autenticação
- Logout seguro

**Feed de Publicações**
- Visualização de tweets de todos os usuários
- Publicação de novos tweets
- Sistema de comentários em tweets
- Visualização dos comentários

**Perfil de Usuário**
- Visualização das estatísticas do usuário logado (seguidores e seguindo)
- Visualização de perfis de outros usuários
- Sistema para seguir/deixar de seguir outros usuários

## Estrutura do projeto

**Páginas Principais**

- **index.html**: Página inicial com formulários de login e cadastro
- **publicacoes.html**: Feed de publicações e interações com outros usuários

**Organização de Arquivos**

- **/css**: Contém os arquivos de estilo da aplicação
- **/images**: Armazena imagens e ícones utilizados na interface
- **Arquivos HTML**: Páginas principais da aplicação

## Responsividade
A aplicação foi desenvolvida com foco em responsividade, adaptando-se a diferentes tamanhos de tela:

- Computadores (telas grandes)
- Tablets (telas médias)
- Smartphones (telas pequenas)
- Dispositivos muito pequenos

## API Endpoints
**Autenticação**

- ```POST /api/register```: Cadastro de novos usuários
- ```POST /api/login```: Autenticação de usuários
- ```POST /api/logout```: Encerramento de sessão

**Tweets**

- ```GET /api/tweets```: Obtenção do feed de tweets
- ```POST /api/tweets```: Criação de um novo tweet
- ```GET /api/tweets/{id}/comments```: Obtenção dos comentários de um tweet
- ```POST /api/tweets/{id}/comments```: Criação de comentário em um tweet

**Usuários**

- ```GET /api/users/{id}```: Obtenção de informações de um usuário específico
- ```GET /api/users/{id}/followers```: Obtenção da lista de seguidores de um usuário
- ```GET /api/users/{id}/following```: Obtenção da lista de usuários que um perfil segue
- ```POST /api/users/{id}/follow```: Seguir um usuário
- ```POST /api/users/{id}/unfollow```: Deixar de seguir um usuário

## Links do Projeto

- **Deploy**: https://back-twitter-main-gwz7pb.laravel.cloud/
- **Repositório**: https://github.com/IsisG13/back-twitter

## Como Executar Localmente

-  Clone o repositório: ```git clone https://github.com/IsisG13/back-twitter.git```
-  Navegue até a pasta do projeto
-  Abra o arquivo index.html em um navegador para acessar a tela de login
-  Crie uma conta ou faça login com credenciais existentes

## Considerações Finais
Este projeto demonstra a integração entre um frontend desenvolvido com tecnologias web básicas (HTML, CSS e JavaScript) e um backend robusto construído com Laravel, resultando em uma aplicação completa que simula as principais funcionalidades do Twitter.