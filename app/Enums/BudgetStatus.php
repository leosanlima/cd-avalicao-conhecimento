<?php

namespace App\Enums;

class BudgetStatus
{
    const PENDING = 1;
    const PENDING_TEXT = 'Pendente';

    const IN_PROGRESS = 2;
    const IN_PROGRESS_TEXT = 'Em Andamento';

    const AUTHORIZE = 3;
    const AUTHORIZE_TEXT = 'Autorizado';

    const CONCLUDED = 4;
    const CONCLUDED_TEXT = 'Concluído';

    const DELIVERED = 4;
    const DELIVERED_TEXT = 'Entregue';

    public static function title($status)
    {
        return match ($status) {
            self::PENDING => self::PENDING_TEXT,
            self::IN_PROGRESS => self::IN_PROGRESS_TEXT,
            self::AUTHORIZE => self::AUTHORIZE_TEXT,
            self::CONCLUDED => self::CONCLUDED_TEXT,
            default => self::PENDING_TEXT,
        };
    }

    public static function pluck()
    {
        return [
            self::PENDING => self::PENDING_TEXT,
            self::IN_PROGRESS => self::IN_PROGRESS_TEXT,
            self::AUTHORIZE => self::AUTHORIZE_TEXT,
            self::CONCLUDED => self::CONCLUDED_TEXT,
        ];
    }

    public static function enums(): array
    {
        return [
            self::PENDING,
            self::IN_PROGRESS,
            self::AUTHORIZE,
            self::CONCLUDED,
        ];
    }
}
