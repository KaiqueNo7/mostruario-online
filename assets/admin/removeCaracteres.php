<?php 
    function removeCaracteresEspeciais($texto) {
        // Define as substituições para os caracteres especiais
        $substituicoes = array(
            '/[áàãâä]/u' => 'a',
            '/[éèêë]/u' => 'e',
            '/[íìîï]/u' => 'i',
            '/[óòõôö]/u' => 'o',
            '/[úùûü]/u' => 'u',
            '/ç/u' => 'c',
            '/[ñ]/u' => 'n',
            '/[ÁÀÃÂÄ]/u' => 'A',
            '/[ÉÈÊË]/u' => 'E',
            '/[ÍÌÎÏ]/u' => 'I',
            '/[ÓÒÕÔÖ]/u' => 'O',
            '/[ÚÙÛÜ]/u' => 'U',
            '/Ç/u' => 'C',
            '/[Ñ]/u' => 'N',
            '/[^\w\s]/u' => '', // Remove outros caracteres especiais não acentuados
        );

        // Aplica as substituições na string
        $texto = preg_replace(array_keys($substituicoes), array_values($substituicoes), $texto);

        // Transforma o texto em minúsculas
        $texto = strtolower($texto);

        // Substitui múltiplos espaços por um único hífen
        $texto = preg_replace('/\s+/', '-', $texto);

        return $texto;
    }
?>