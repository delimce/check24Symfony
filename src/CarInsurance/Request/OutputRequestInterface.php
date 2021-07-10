<?php
declare( strict_types = 1 );

namespace App\CarInsurance\Request;

interface OutputRequestInterface
{
    public function render(array $data): string;
}
