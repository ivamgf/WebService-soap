<?php
// ===========================================================================================
// Web Service Integration with Server Api Soap 1.0.0
// Author: Ivam Galvão Filho
// Date: 22/11/2019
// Contacts:
// E:mail: 
// ===========================================================================================

// try Block
try {

    // Settings Soap
    // =====================================================================================================================
    $sEndWsdl = 'URL';
    $oCliente = new SoapClient($sEndWsdl, Array(
         'cache_wsdl' => WSDL_CACHE_NONE
        ,'encoding'   => 'ISO-8859-1'
        ,'login'      => ''
        ,'password'   => ''
        ,'exceptions' => true
        ,'trace'      => true
    ));
    // =====================================================================================================================
    // Settings Soap

    // Input Parameters
    // ===========================================================================================
    $identificador_proprio = "";
    $ano_calculo = 2019;
    $data_base_calculo = '26/08/2019';
    $codigo_sub_receita = 999;
    $cpfcnpj = "";
    $codigo_bloco = 44;
    $codigo_item = 1;
    $sequencia_item = 1;
    $valor = 150.25;
    $ano_forma_pagamento = 0;
    $codigo_forma_pagamento = 4;
    $quantidade_parcelas = 1;
    $principal = true;
    $data_base_vencimento = '20/10/2019';

    // Params Array
    $paramsPay = array(
                    'identificador_proprio'=>$identificador_proprio, 
                    'ano_calculo'=>$ano_calculo, 
                    'data_base_calculo'=>$data_base_calculo,
                    'codigo_sub_receita'=>$codigo_sub_receita,
                    'cpfcnpj'=>$cpfcnpj,                                
                    'formas_pagamento'=>Array(Array('ano_forma_pagamento'=>$ano_forma_pagamento, 
                                              'codigo_forma_pagamento'=>$codigo_forma_pagamento,
                                              'quantidade_parcelas'=>$quantidade_parcelas,
                                              'principal'=>$principal,
                                              'data_base_vencimento'=>$data_base_vencimento)),
                    'parametros_calculo' =>Array(Array('codigo_bloco'=>$codigo_bloco, 
                                                'codigo_item'=>$codigo_item,
                                                'sequencia_item'=>$sequencia_item,
                                                'valor'=>$valor))
                 );
    // Params Array
    // ===========================================================================================
    // Input Parameters

    // Call wsdl function
    // ===========================================================================================        
    $xRetorno = $oCliente->realizaCalculoTributarioIndividual($paramsPay);
    // ===========================================================================================
    // Call wsdl function

    // Result
    // ===========================================================================================
    $codigo;
    foreach ($xRetorno as $key => $value){
        if($key == "numero_lancamento") {
            $codigo = $value;
        }
    }
    // billet printable script
    foreach ($xRetorno as $key => $value){
        if($key == "carne") {
            $decoded = base64_decode($value);
            $file = "boleto".$codigo;
            file_put_contents($file, $decoded);

            if (file_exists($file)) {
            header("Content-Description: File Transfer");
            header("Content-Type: application/octet-stream");
            header("Content-Disposition: attachment; filename=$file.pdf");
            header("Expires: 0");
            header("Cache-Control: must-revalidate");
            header("Pragma: public");
            header("Content-Length: " . filesize($file));
            readfile($file);
            exit;
            }
            
        }
    }
    // billet printable script
    // ===========================================================================================
    // Result

} catch (Exception $e) {
    echo "<h2>Exception Error!</h2>";
    echo $e->getMessage();
}
// try Block
?>
