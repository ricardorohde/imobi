<?
 

# Configura��es
$quemsomos = db_dados("SELECT * FROM tbdepartamentos WHERE id_departamentos=150 LIMIT 1");
?>
	
<?php
 
/* Medida preventiva para evitar que outros dom�nios sejam remetente da sua mensagem. */
if (eregi('tempsite.ws$|locaweb.com.br$|hospedagemdesites.ws$|websiteseguro.com$', $_SERVER[HTTP_HOST])) {
        $emailsender = $quemsomos['email']; // Substitua essa linha pelo seu e-mail@seudominio
} else {
        $emailsender = $quemsomos['email'];
        //    Na linha acima estamos for�ando que o remetente seja 'webmaster@seudominio',
        // Voc� pode alterar para que o remetente seja, por exemplo, 'contato@seudominio'.
}
 
/* Verifica qual �o sistema operacional do servidor para ajustar o cabe�alho de forma correta.  */
if(PATH_SEPARATOR == ";") $quebra_linha = "\r\n"; //Se for Windows
else $quebra_linha = "\n"; //Se "não for Windows"
 
// Passando os dados obtidos pelo formul�rio para as vari�veis abaixo
$nomeremetente     = $_POST['nome'];
$emailremetente    = $_POST['email'];
$emaildestinatario = $emailsender;
$comcopia          = $_POST['comcopia'];
$comcopiaoculta    = $_POST['comcopiaoculta'];
$telefone           = $_POST['telefone'];
$verba           = $_POST['verba'];
$mensagem          = $_POST['mensagem'];
 
 
 if (($nomeremetente == "") || ($emailremetente == "") || ($telefone == ""))

  {

    echo "<script>alert('Nenhum campo pode ficar em branco.');</script>";

	echo "<script>history.go(-1);</script>";
	exit;
  }





// Validando o campo com E-mail



if (substr_count($emailremetente,"@") == 0 || substr_count($emailremetente,".") == 0)

  {

   echo "<script>alert('Por favor, utilize um e-mail v�lido');</script>";

   echo "<script>history.go(-1);</script>";
	exit;
   }
   
   
 
/* Montando a mensagem a ser enviada no corpo do e-mail. */
$mensagemHTML = '<P><i>Mensagem enviada por '.$nomeremetente.' - '.$emailremetente.'</i></P>
<p><b><i>Telefone: '.$telefone.'</i></b></p>
<p><b><i>Mensagem: '.$mensagem.'</i></b></p>
<hr>';
 
 
/* Montando o cabeçalho da mensagem */
$headers = "MIME-Version: 1.1" .$quebra_linha;
$headers .= "Content-type: text/html; charset=UTF-8" .$quebra_linha;
// Perceba que a linha acima cont�m "text/html", sem essa linha, a mensagem n�o chegar� formatada.
$headers .= "From: " . $emailsender.$quebra_linha;
$headers .= "Cc: " . $comcopia . $quebra_linha;
$headers .= "Bcc: " . $comcopiaoculta . $quebra_linha;
$headers .= "Reply-To: " . $emailremetente . $quebra_linha;
// Note que o e-mail do remetente ser� usado no campo Reply-To (Responder Para)

// assunto
$eleenvioou = $nomeremetente.' - '.$telefone;
/* Enviando a mensagem */

//� obrigat�rio o uso do par�metro -r (concatena��o do "From na linha de envio"), aqui na Locaweb:

if(!mail($emaildestinatario, $eleenvioou, $mensagemHTML, $headers ,"-r".$emailsender)){ // Se for Postfix
    $headers .= "Return-Path: " . $emailsender . $quebra_linha; // Se "n�o for Postfix"
    mail($emaildestinatario, $telefone, $mensagemHTML, $headers );
}
 
/* mostrando mensagem ao usu�rio e redirecionando */
   echo '<script>alert("Mensagem enviada com sucesso beleza!");</script>';

   echo "<script>history.go(-1);</script>";


?>