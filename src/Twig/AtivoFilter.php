<?php

namespace App\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

class AtivoFilter extends AbstractExtension
{
    public function getFilters()
    {
        return [
            new TwigFilter('ativo', [$this, 'ativoFilter'], ['is_safe' => ['html']])
        ];
    }


    public function ativoFilter($ativo)
    {
        switch ($ativo) {
            case true:
                return '<i class="fas fa-check-circle fa-2x" style="color:green"></i>';
                $ativo = true;
                break;
            case false:
                return '<i class="fas fa-times-circle fa-2x" style="color:red"></i>';
                $ativo = false;
                break;
            default:
                return "Indefinido";
        }
    }
}
