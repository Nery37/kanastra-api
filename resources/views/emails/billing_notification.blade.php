<!DOCTYPE html>
<html>
<head>
    <title>Seu boleto de cobrança</title>
</head>
<body>
    <h1>Olá {{ $billet['name'] }},</h1>
    <p>Segue abaixo o boleto para pagamento:</p>
    <p><strong>Valor:</strong> R$ {{ number_format($billet['debtAmount'], 2, ',', '.') }}</p>
    <p><strong>Data de Vencimento:</strong> {{ \Carbon\Carbon::parse($billet['debtDueDate'])->format('d/m/Y') }}</p>
    <p>Obrigado por utilizar nossos serviços!</p>
</body>
</html>
