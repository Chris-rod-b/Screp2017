<?php
	include("PHPMailer/class.phpmailer.php");
	include("PHPMailer/class.smtp.php");
	include "connect_s.php";
	$login = $_POST['login'];
	$email= $_POST['email'];
	// Inicia a classe PHPMailer
	$mail = new PHPMailer(true);
	// Define os dados do servidor e tipo de conexão
	// =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
	$mail->IsSMTP(); // Define que a mensagem será SMTP
	$mail->Host = "smtp.gmail.com"; // Endereço do servidor SMTP
	$mail->SMTPAuth = true;
	$mail->SMTPSecure = 'ssl'; 
	$mail->Port=465;// Usa autenticação SMTP? (opcional)
	$mail->Username = 'screpbottons10@gmail.com'; // Usuário do servidor SMTP
	$mail->Password = 'screp1234'; // Senha do servidor SMTP
	// Define o remetente
	// =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
	$mail->SetFrom("screpbottons10@gmail.com","Screp Bottons"); // Seu e-mail
	// Seu nome
	// Define os destinatário(s)
	// =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
	$mail->AddAddress($email, $login);
	$mail->AddAddress($email);
	//$mail->AddCC('ciclano@site.net', 'Ciclano'); // Copia
	//$mail->AddBCC('fulano@dominio.com.br', 'Fulano da Silva'); // Cópia Oculta
	// Define os dados técnicos da Mensagem
	// =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
	$mail->IsHTML(true); 
	
	//------------------------- SOLUÇÃO DO ERRO: --------------------------------
	//A FUNÇÃO ABAIXO NÃO FOI DEFINIDA CORRETAMENTE, SÒ COMENTE E ELA ENVIOU O EMAAIL
	//SE TA FUNCIONANDO, NÂO MEXE :v
	
	//$mail->IsMail();// Define que o e-mail será enviado como HTML
	$mail->CharSet = 'utf-8'; // Charset da mensagem (opcional)
	// Define a mensagem (Texto e Assunto)
	// =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
	for ($i = 0; $i < 1; $i++)
	{
		$Novasenha =uniqid();
	}
	
	$mail->Subject  = "Screp Bottons - Recuperação de senha."; // Assunto da mensagem
	$mail->Body = "Olá, ".$login."<br>Você nos solicitou uma recuperação de senha para o acesso de sua conta. Caso não seja o endereço de e-mail correto entre em contato conosco.<p>Nova senha:".$Novasenha;
	$mail->AltBody = "Email para recuperação de senha para ter acesso de Screp Bottons.";
	
	
	// Envia o e-mail
	
	$enviado = $mail->Send(); //PROBLEMA 
	// Limpa os destinatários e os anexos
	// Define os anexos (opcional)
	// =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
	//$mail->AddAttachment("c:/temp/documento.pdf", "novo_nome.pdf");  // Insere um anexo
	
	
	$mail->ClearAllRecipients();
	$mail->ClearAttachments();
	// Exibe uma mensagem de resultado
	
	if ($enviado==true) {
		
		$Novasenha= md5($senha);
		
		$sql = "update usuario set senha= '$Novasenha' where email = '$email'";
		echo $Novasenha."<br>";
		$resultado = pg_query($connection_s, $sql);
		$qtd = pg_affected_rows($resultado);
		if($qtd >0)
		{
			echo "Senha alterada!";
		}
		else{
			echo "Senha não alterada !";
		}
		echo "E-mail enviado com sucesso!";
	}
	else 
	{
		echo "Não foi possível enviar o e-mail.";
		echo "<b>Informações do erro:</b> " . $mail->ErrorInfo;
	}
?>