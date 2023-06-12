<?php

namespace App\Enums;

enum FailedMessageEnum: string
{
    case CreateError = 'Failed to create';
    case UpdateError = 'Failed to update';
    case DeleteError = 'Failed to delete';
    case KeyExpired = 'Key is no longer available';

    public function resultMessage(): array
    {
        $message = 'message';
        return match ($this) {
            FailedMessageEnum::CreateError => [$message => self::CreateError],
            FailedMessageEnum::UpdateError => [$message => self::UpdateError],
            FailedMessageEnum::DeleteError => [$message => self::DeleteError],
            FailedMessageEnum::KeyExpired => [$message => self::KeyExpired],
        };
    }
}
