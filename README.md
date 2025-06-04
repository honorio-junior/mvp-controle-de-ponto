# 📌 Sistema de Registro de Ponto (MVP)

Este é um sistema simples e funcional de registro de ponto feito com Laravel 12, usando TailwindCSS no frontend e SQL e SleekDB (no padrao de projeto adapter) para persistência de dados. Ideal para uso interno por pequenas equipes. Este trabalho foi desenvolvido por mim, para um trabalho da faculdade.

![Home](https://i.imgur.com/nU094HX.png)

---

## ✅ Funcionalidades (MVP)

- Cadastro de funcionários (nome, sobrenome, CPF e senha).
- Autenticação de usuários.
- Registro de ponto até 4 vezes por dia.
- Visualização dos pontos registrados por data.
- Painel administrativo com:
  - Cadastro de novos funcionários.
  - Listagem de usuários.
  - Exclusão de usuários (Mantendo os registros de ponto).
  - Geração de relatório.

![Painel Admin](https://i.imgur.com/dIL3li1.png)
![Confirmacao](https://i.imgur.com/rQsvJY1.png)
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
  "cpf": "95363572087",
  "points": {
    "2025-06-04": [
      "05:36:26",
      "05:36:29",
      "05:36:31",
      "05:36:34"
    ]
  },
  "_id": 3
}
```

- A autenticação é feita via Laravel Auth.
- O administrador tem acesso a um painel onde pode:
  - Cadastrar novos funcionários.
  - Listar todos os usuários.
  - Excluir usuários (os registros de ponto são mantidos).
  - Gerar relatórios simples dos registros.

## 📄 Licença

Este projeto é livre. Sinta-se à vontade para adaptar conforme sua necessidade.
