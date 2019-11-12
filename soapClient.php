<?php
try {
        // Settings Soap
        // ======================================================================================================
        // options for ssl in php 5.6.5
        $opts = array(
            'ssl' => array(
                'encoding' => 'UTF-8', 
                'ciphers'=>'RC4-SHA',
                'verify_peer'=>false, 
                'verify_peer_name'=>false,
                'verifyhost' => false, 
                'soap_version' => SOAP_1_2, 
                'trace' => 1, 
                'exceptions' => 1, 
                "connection_timeout" => 180,
                'crypto_method' => STREAM_CRYPTO_METHOD_TLS_CLIENT, 
                'allow_self_signed' => true
            )
        );
        libxml_disable_entity_loader(false);
        // SOAP 1.2 client
        // ======================================================================================================
        // Settings Soap
       
        // Create the Auth instance
        $user        = "";
        $password    = "";
        $auth = array(
             'login' => $user,
             'password' => $password,
        );

        // Parâmetros de Entrada
        $identificador_proprio = "";
        $ano_calculo = 2019;
        $data_base_calculo = 26/08/2019;
        $codigo_sub_receita = 999;
        $cpfcnpj = "99999999999999";
        $codigo_bloco = 44;
        $codigo_item = 1;
        $sequencia_item = 1;
        $valor = 999.99;
        $ano_forma_pagamento = 0;
        $codigo_forma_pagamento = 4;
        $quantidade_parcelas = 1;
        $principal = true;
        $data_base_vencimento = 20/10/2019;

        // Params Array
        $paramsPay = array(
                        'identificador_proprio'=>$identificador_proprio, 
                        'ano_calculo'=>$ano_calculo, 
                        'data_base_calculo'=>$data_base_calculo,
                        'codigo_sub_receita'=>$codigo_sub_receita,
                        'cpfcnpj'=>$cpfcnpj, 
                        'codigo_bloco'=>$codigo_bloco, 
                        'codigo_item'=>$codigo_item,
                        'sequencia_item'=>$sequencia_item,
                        'valor'=>$valor, 
                        'ano_forma_pagamento'=>$ano_forma_pagamento, 
                        'codigo_forma_pagamento'=>$codigo_forma_pagamento,
                        'quantidade_parcelas'=>$quantidade_parcelas,
                        'principal'=>$principal,
                        'data_base_vencimento'=>$data_base_vencimento
                     );
        // Create the SoapClient instance
        $url    = "";        
        echo "Testando 1";
        $client = new SoapClient($url, $params);
        echo "Testando 2";
        // Call wsdl function
        $result = $client->__soapCall("Payment", array(
            "Payment" => array(
                "login"        => $user,
                "password"    => $password
               
            )
        ), NULL, $paramsPay); 

        // Echo the result
        echo "<pre>".print_r($result, true)."</pre>";
        if($result->Payment->Status == "Success")
            {
                echo "Boleto Gerado!";
            }
   
    } catch (Exception $e) {
        echo "<h2>Exception Error!</h2>";
        echo $e->getMessage();
    }
    
?>
