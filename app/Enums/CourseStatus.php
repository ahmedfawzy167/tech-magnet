<?php

namespace App\Enums;

enum CourseStatus: int
{
    case ACTIVE = 1;
    case INACTIVE = 0;

    public function icon()
    {
        return match ($this) {
            self::ACTIVE => '<i class="fa-solid fa-check-circle text-success" title="ACTIVE"></i>',
            self::INACTIVE => '<i class="fa-solid fa-times-circle text-danger" title="INACTIVE"></i>',
        };
    }
}
