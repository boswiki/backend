<?php

namespace App\Domain\Feedbacks\Enums;

enum Feedback: string
{
    case BUG = 'bug';
    case IDEA = 'idea';
    case PRAISE = 'praise';
    case OTHER = 'other';

    public function color(): string
    {
        return match ($this) {
            self::BUG => 'red',
            self::IDEA => 'yellow',
            self::PRAISE => 'green',
            self::OTHER => 'pink'
        };
    }
}
