<?php
// Definir os dados do formulário
$fname = isset($_POST['fname']) ? trim($_POST['fname']) : null;
$email = isset($_POST['email']) ? trim($_POST['email']) : null;
$phone = isset($_POST['phone']) ? trim($_POST['phone']) : null;
$date = isset($_POST['date']) ? trim($_POST['date']) : "Não informado";
$subject = isset($_POST['subject']) ? trim($_POST['subject']) : "Sem mensagem";

// Verificar se os campos obrigatórios estão preenchidos
if (!empty($fname) && !empty($email)) {
    $to_email = "vitgermim@gmail.com";
    $email_subject = "Nova solicitação de consulta - Clínica de Oftalmologia";

    // Criar o corpo da mensagem
    $vpb_message_body = nl2br("
        <strong>Prezado(a) Administrador(a),</strong><br><br>
        Um novo paciente enviou uma solicitação de agendamento de consulta através do site.<br><br>
        <strong>Detalhes do Paciente:</strong><br>
        Nome: $fname<br>
        E-mail: $email<br>
        Telefone: $phone<br>
        Data desejada: $date<br>
        Mensagem: $subject<br><br>
        <strong>Por favor, entre em contato para confirmar o agendamento.</strong><br><br>
        Atenciosamente,<br>
        Clínica de Oftalmologia ABC
    ");

    // Configurar os cabeçalhos do e-mail
    $headers = "From: $fname <$email>\r\n";
    $headers .= "Reply-To: $email\r\n";
    $headers .= "Content-Type: text/html; charset=UTF-8\r\n";

    // Enviar o e-mail
    if (@mail($to_email, $email_subject, $vpb_message_body, $headers)) {
        $status = 'success';
        $output = "Obrigado, $fname! Sua solicitação de consulta foi enviada com sucesso. Nossa equipe entrará em contato para confirmação.";
    } else {
        $status = 'error';
        $output = "Desculpe, houve um erro ao enviar sua solicitação. Por favor, tente novamente mais tarde.";
    }
} else {
    $status = 'error';
    $output = "Por favor, preencha os campos obrigatórios (Nome e E-mail).";
}

// Retornar a resposta em JSON
echo json_encode(array('status' => $status, 'msg' => $output));
?>
