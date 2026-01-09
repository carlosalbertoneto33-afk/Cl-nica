<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

$msg = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $nome = $_POST['nome'];
  $email = $_POST['email'];
  $mensagem = $_POST['mensagem'];

  $mail = new PHPMailer(true);

  try {
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'carlosalbertoneto33@gmail.com';
    $mail->Password = 'SENHA_DE_APP_AQUI'; // COLOQUE SUA SENHA DE APP DO GMAIL
    $mail->SMTPSecure = 'tls';
    $mail->Port = 587;

    $mail->setFrom('carlosalbertoneto33@gmail.com', 'Postural Pilates');
    $mail->addAddress('carlosalbertoneto33@gmail.com');
    $mail->addReplyTo($email, $nome);

    $mail->isHTML(true);
    $mail->Subject = 'Nova Aula Experimental - ' . $nome;
    $mail->Body = "<strong>Nome:</strong> $nome<br><strong>Email:</strong> $email<br><br><strong>Mensagem:</strong><br>$mensagem";

    $mail->send();
    $msg = "Mensagem enviada com sucesso!";
  } catch (Exception $e) {
    $msg = "Erro ao enviar: {$mail->ErrorInfo}";
  }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Postural Pilates</title>
  <style>
    body { margin: 0; font-family: 'Segoe UI', sans-serif; background: #f0f0f0; color: #333; }
    header { background-color: #88c0d0; color: rgb(93, 75, 255); padding: 20px; text-align: center; }
    nav { background-color: #4c566a; display: flex; justify-content: center; }
    nav a { color: white; text-decoration: none; padding: 15px 20px; display: inline-block; transition: background 0.3s; }
    nav a:hover { background-color: #5e81ac; }
    section { padding: 40px; max-width: 900px; margin: auto; background: rgb(63, 92, 255); margin-top: 20px; border-radius: 8px; box-shadow: 0 0 10px rgba(0,0,0,0.1); }
    h2 { color: #2e3440; }
    ul { padding-left: 20px; }
    form { display: flex; flex-direction: column; }
    input, textarea { padding: 10px; margin: 8px 0; border-radius: 4px; border: 1px solid #ccc; }
    button { background-color: #88c0d0; color: rgb(97, 80, 255); padding: 12px; border: none; border-radius: 4px; cursor: pointer; margin-top: 10px; font-size: 16px; }
    button:hover { background-color: #5e81ac; }
    footer { background-color: #4c566a; color: rgb(134, 83, 253); text-align: center; padding: 15px; margin-top: 40px; }
    html { scroll-behavior: smooth; }
    .msg { color: white; font-weight: bold; margin-bottom: 10px; }
  </style>
</head>
<body>

<header>
  <h1>Postural Pilates</h1>
  <p>Conecte corpo e mente com equilíbrio e saúde</p>
</header>

<nav>
  <a href="#sobre">Sobre</a>
  <a href="#beneficios">Benefícios</a>
  <a href="#agenda">Agende uma Aula</a>
  <a href="#contato">Contato</a>
</nav>

<section id="sobre">
  <h2>Sobre o Estúdio</h2>
  <p>O Postural Pilates é um estúdio dedicado ao bem-estar, à postura e ao fortalecimento do corpo. Oferecemos aulas com acompanhamento personalizado em um ambiente acolhedor.</p>
  <p>Nosso foco é proporcionar saúde e qualidade de vida através do método Pilates, respeitando os limites e objetivos de cada aluno.</p>
</section>

<section id="beneficios">
  <h2>Benefícios do Pilates</h2>
  <ul>
    <li>Melhora da postura e equilíbrio</li>
    <li>Fortalecimento muscular</li>
    <li>Redução de dores nas costas</li>
    <li>Maior consciência corporal</li>
    <li>Melhora da respiração e concentração</li>
  </ul>
</section>

<section id="agenda">
  <h2>Agende uma Aula Experimental</h2>

  <?php if($msg != ""): ?>
    <p class="msg"><?php echo $msg; ?></p>
  <?php endif; ?>

  <form method="POST">
    <label>Nome:</label>
    <input type="text" name="nome" required>

    <label>Email:</label>
    <input type="email" name="email" required>

    <label>Mensagem:</label>
    <textarea name="mensagem" rows="4" required></textarea>

    <button type="submit">Enviar</button>
  </form>
</section>

<section id="contato">
  <h2>Contato</h2>
  <p>📍 Av. Senador Ruy Carneiro</p>
  <p>📞 (83) 98823-6443</p>
  <p>📧 contato@posturalpilates.com.br</p>
</section>

<footer>
  <p>&copy; 2025 Postural Pilates – Todos os direitos reservados</p>
</footer>

</body>
</html>
