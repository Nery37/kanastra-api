<!DOCTYPE html>
<html>
<head>
    <title>Seu boleto de cobrança</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 100%;
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .header {
            background-color: #4CAF50;
            color: #ffffff;
            padding: 10px 0;
            text-align: center;
        }
        .content {
            padding: 20px;
        }
        .content h1 {
            color: #333333;
        }
        .content p {
            font-size: 16px;
            line-height: 1.5;
            color: #666666;
        }
        .content strong {
            color: #333333;
        }
        .footer {
            text-align: center;
            padding: 10px;
            background-color: #f4f4f4;
            color: #666666;
            font-size: 14px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Seu boleto de cobrança</h1>
        </div>
        <div class="content">
            <h1>Olá {{ $billet['name'] }},</h1>
            <p>Segue abaixo o boleto para pagamento:</p>
            <p><strong>Valor:</strong> R$ {{ number_format($billet['debtAmount'], 2, ',', '.') }}</p>
            <p><strong>Data de Vencimento:</strong> {{ \Carbon\Carbon::parse($billet['debtDueDate'])->format('d/m/Y') }}</p>
            <p>Obrigado por utilizar nossos serviços!</p>
        </div>
        <div class="footer">
            <p>&copy; {{ date('Y') }} Sua Empresa. Todos os direitos reservados.</p>
        </div>
    </div>
</body>
</html>
