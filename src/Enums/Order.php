<?php

declare(strict_types=1);

namespace Vampyrian\PostIt\Enums;

enum Order: string
{
    case ASC = 'asc';
    case DESC = 'desc';
}
