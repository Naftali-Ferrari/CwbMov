# 🧾 Plataforma de Denúncias Urbanas

## 📌 Descrição do Projeto  
Este projeto é uma **plataforma colaborativa** onde cidadãos podem registrar problemas urbanos (como lixo acumulado, iluminação pública, acessibilidade, calçadas e áreas verdes).  
Cada denúncia é mostrada **automaticamente em um mapa interativo**, ajudando a prefeitura a visualizar e resolver os problemas da cidade.

---

## ⚙️ Estrutura do Projeto

```
📂 projeto-extensão/
 ├── index.html          # Página principal com formulário e mapa
 ├── php/
 │    ├── conn.php       # Conexão com o banco de dados
 │    ├── enviar.php     # Recebe e salva as denúncias no banco
 │    └── buscar.php     # Retorna as denúncias em formato JSON
 ├── uploads/            # Pasta onde ficam as fotos enviadas
 ├── README.md           # Documento de instruções (este arquivo)
```

---

## 🗄️ Banco de Dados MySQL

### Nome do banco:
```
denuncias_db
```

### Tabela:
```sql
CREATE TABLE denuncias (
  id INT AUTO_INCREMENT PRIMARY KEY,
  usuario_nome VARCHAR(100) NOT NULL,
  bairro VARCHAR(100) NOT NULL,
  categoria VARCHAR(50) NOT NULL,
  descricao TEXT NOT NULL,
  foto VARCHAR(255) DEFAULT NULL,
  latitude DECIMAL(10,6) NOT NULL,
  longitude DECIMAL(10,6) NOT NULL,
  data_envio TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
```

---

## 🔌 Arquivo `conn.php`

O arquivo `conn.php` é responsável por **fazer a conexão com o banco de dados**.  
Ele é incluído nos outros arquivos PHP (`enviar.php` e `buscar.php`) usando `require_once 'conn.php';`.

### Exemplo de `conn.php`:
```php
<?php
$servername = "localhost";   // Endereço do servidor MySQL
$username = "root";          // Usuário do banco (padrão no XAMPP)
$password = "";              // Senha do banco (deixe vazio se usar XAMPP)
$dbname = "denuncias_db";    // Nome do banco criado

// Cria a conexão
$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica se houve erro
if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}
?>
```

## 🚀 Como Executar o Projeto

1. **Inicie o servidor local** (XAMPP, WAMP ou Laragon).  
2. Crie o banco de dados:
   ```sql
   CREATE DATABASE denuncias_db;
   USE denuncias_db;
   ```
3. Execute o script SQL da tabela (mostrado acima).  
4. Coloque o projeto dentro da pasta `htdocs` (XAMPP) ou equivalente.  
   Exemplo:
   ```
   C:\xampp\htdocs\projeto-denuncias\
   ```
5. Acesse no navegador:
   ```
   http://localhost/projeto-denuncias/
   ```
6. Clique no mapa para marcar a localização e preencha o formulário.  
   A denúncia será salva e exibida automaticamente no mapa.
