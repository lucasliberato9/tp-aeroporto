<?php
function validar_cpf($cpf) {
    // remove caracteres não numéricos do CPF
    $cpf = preg_replace('/[^0-9]/', '', $cpf);

    // verifica se o CPF tem 11 dígitos
    if (strlen($cpf) != 11) {
        return false;
    }

    // calcula o primeiro dígito verificador (primeiro digito após "-")
    $soma = 0;
    for ($i = 0; $i < 9; $i++) {
        $soma += (int) $cpf[$i] * (10 - $i);
    }
    
    $resto = ($soma*10)% 11;
    
    $div1 = ($resto == 10) ? 0 : $resto;

    // calcula o segundo dígito verificador
    $soma = 0;
    for ($i = 0; $i < 10; $i++) {
        $soma += (int) $cpf[$i] * (11 - $i);
    }
    $resto = ($soma*10)% 11;
    
    $div2 = ($resto == 10) ? 0 : $resto;

    // verifica se os dígitos verificadores estão corretos
    if ($cpf[9] == $div1 && $cpf[10] == $div2) {
        return true;
    } else {
        return false;
    }
}

function validarEmail($email) {
  // Remove espaços em branco antes e depois do endereço de e-mail
  $email = trim($email);
  
  // Verifica se o endereço de e-mail é válido com regex
  if (preg_match('/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/', $email)) {
    return true;
} else {
    return false;
}
}

// Valida 4 formatos de data
function validarDataNascimento($data) {
    $formatos = array('d/m/Y', 'Y-m-d', 'd.m.Y', 'dmY');

    foreach ($formatos as $formato) {
        $dataObj = DateTime::createFromFormat($formato, $data);
        if ($dataObj !== false && !array_sum($dataObj::getLastErrors())) {
            return true;
        }
    }

    return false;
}






?>
