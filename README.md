<div align="center">
  <h1>🚀 VochtTech — Sistema de Gestão</h1>
  <p>
    Uma aplicação moderna para gerenciar grupos econômicos, suas marcas, unidades e colaboradores.
  </p>
</div>

---

## ✨ O que é o VochtTech?

O VochtTech é um sistema de demonstração que centraliza a gestão de um grupo de empresas. Com ele, você pode facilmente:

- 🏢 **Cadastrar Grupos Econômicos:** A base da sua organização.
- 🏷️ **Gerenciar Bandeiras:** As diferentes marcas que compõem seus grupos.
- 📍 **Administrar Unidades:** As filiais ou locais de operação de cada bandeira.
- 👥 **Controlar Colaboradores:** Adicionar e organizar as pessoas que trabalham em cada unidade.

---

## 💻 Como Rodar o Projeto Localmente

Siga estes passos simples para ter o sistema funcionando na sua máquina.

### 1. Baixe o Projeto
Clone o repositório para o seu computador e entre na pasta criada.
```bash
git clone https://github.com/ErosJanka/vochtech.git
cd vochttech
```

### 2. Instale as Dependências
O projeto precisa de pacotes do PHP (via Composer) e do JavaScript (via NPM).
```bash
composer install
npm install
```

### 3. Configure o Ambiente
Copie o arquivo de exemplo `.env.example` para um novo arquivo chamado `.env`. É nele que ficam as configurações do sistema.
```bash
cp .env.example .env
php artisan key:generate
```
Agora, abra o arquivo `.env` e configure as informações de acesso ao seu banco de dados MySQL (`DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD`).

### 4. Prepare o Banco de Dados
Este comando irá criar as tabelas e preenchê-las com dados de exemplo, incluindo um usuário de teste.
```bash
php artisan migrate --seed
```

### 5. Inicie o Servidor
Compile os arquivos de front-end e inicie o servidor local do Laravel.
```bash
npm run build
php artisan serve
```

🎉 **Pronto!** Acesse <http://127.0.0.1:8000> no seu navegador.

---

## 🔑 Credenciais de Acesso
Use os dados abaixo para explorar o sistema como um usuário autenticado.

- **Email:** `test@example.com`
- **Senha:** `password`

---

Obrigado por avaliar este projeto!
