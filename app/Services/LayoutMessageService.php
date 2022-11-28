<?php


namespace App\Services;


class LayoutMessageService
{
    public function flashSuccessMessage()
    {
        session()->flash('layout.success-message', 'Operação realizada com sucesso.');
    }

    public function flashErrorMessage(string $message = 'Ocorreu um erro inesperado.')
    {
        session()->flash('layout.error-message', $message);
    }
}
