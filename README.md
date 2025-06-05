# 📌 Sistema de Registro de Ponto

Este é um sistema simples e funcional de registro de ponto feito com Laravel 12, usando TailwindCSS no frontend e SQL e SleekDB (no padrao de projeto adapter) para persistência de dados. Ideal para uso interno por pequenas equipes. Este projeto foi desenvolvido por mim, para um trabalho da faculdade, um MVP (Produto Mínimo Viável) 100% funcional.

![Home](https://i.imgur.com/nU094HX.png)

---

## ✅ Funcionalidades atuais

- Cadastro de funcionários (nome, sobrenome, CPF e senha).
- Autenticação de usuários.
- Registro de ponto até 4 vezes por dia.
- Visualização dos pontos registrados por data.
- Painel administrativo com:
  - Cadastro de novos funcionários.
  - Listagem de usuários.
  - Exclusão de usuários (Mantendo os registros de ponto).
  - Geração de relatório.

![Painel Admin](https://i.imgur.com/Lic3TZ9.png)
---

## 🧱 Tecnologias utilizadas

- Laravel 12
- TailwindCSS
- SQLite (padrão Laravel, possibilitando mudar para MySQL de forma simples) e [SleekDB - NoSQL file](https://sleekdb.github.io/) (em modo [Adapter](https://refactoring.guru/pt-br/design-patterns/adapter), possibilitando mudar para MongoDB de forma simples)
- Blade templates
- Autenticação nativa do Laravel (`Auth`)

---

## 🛠️ Como funciona?

- Cada funcionário registra até **4 pontos por dia**, sendo armazenados por data.
- A persistência de dados usa o padrão Adapter, permitindo alternar entre SleekDB (NoSQL) e MongoDB no futuro, sem alterar o restante da aplicação.
- Os pontos são armazenados de forma organizada por CPF e por dia, como no exemplo:

```json
{
  "cpf": "12345678901",
  "points": {
    "2025-06-04": [
      "08:05:26",
      "12:30:29",
      "13:23:31",
      "17:00:34"
    ]
  }
}
```

- A autenticação é feita via Laravel Auth.
- O administrador tem acesso a um painel onde pode:
  - Cadastrar novos funcionários.
  - Listar todos os usuários.
  - Excluir usuários (os registros de ponto são mantidos).
  - Gerar relatórios dos registros.

## 🚀 Instalando (Com Docker)

1. **Clone o repositório**

2. **Copie o arquivo .env e edite com sua credencial**

```bash
cp .env.example .env
```

3. **Suba o container**

```bash
docker-compose up --build
```

4. **Aguarde a criacao container**

### 🌐 Acesse no navegador!

Abra: [http://localhost](http://localhost)

## 📄 Licença

Este projeto é livre. Sinta-se à vontade para adaptar conforme sua necessidade.
