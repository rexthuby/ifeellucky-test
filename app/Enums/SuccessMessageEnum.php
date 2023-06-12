<?php

namespace App\Enums;

enum SuccessMessageEnum: string
{
    case Create = 'Created successfully';
    case Update = 'Updated successfully';
    case Delete = 'Deleted successfully';

    public function resultMessage(): array {
        $message = 'message';
        return match($this) {
            SuccessMessageEnum::Create=>[$message=>self::Create],
            SuccessMessageEnum::Update=>[$message=>self::Update],
            SuccessMessageEnum::Delete=>[$message=>self::Delete]
        };
    }
}
