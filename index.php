<?php

require __DIR__.'/vendor/autoload.php';

use \App\Pix\Payload;
use Mpdf\QrCode\QrCode;
use Mpdf\QrCode\Output;

//instância principal do Payload Pix
$obPayload = (new Payload)->setPixKey('chave-pix-aqui')
                          ->setDescription('descrição-do-pagamento')
													->setMerchantName('nome-do-recebedor')
													->setMerchantCity('cidade-do-recebedor')
													->setAmount('valor-da-cobrança')
													->setTxid('id-da-transação');


//código de pagamento do Pix
$payloadQrcode = $obPayload->getPayload();

//instância do QrCode
$obQrCode = new QrCode($payloadQrcode);

//gerando a imagem
$image = (new Output\Png)->output($obQrCode, 400);

//header('Content-Type: image/png');
//echo $image;

?>


<h1>QR Code Pix</h1>
<br>
<img src="data:image/png;base64, <?=base64_encode($image)?>">
<br><br>
Código Pix:<br>
<strong><?=$payloadQrcode?></strong>

