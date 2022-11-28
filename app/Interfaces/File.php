<?php

namespace App\Interfaces;

use Symfony\Component\HttpFoundation\StreamedResponse;

interface File
{
    /**
     * @return StreamedResponse
     */
    public function download(): StreamedResponse;
}
