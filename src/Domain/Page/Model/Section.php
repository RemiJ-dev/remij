<?php

declare(strict_types=1);

namespace App\Domain\Page\Model;

use App\Domain\Page\Enums\SectionTypeEnum;

class Section
{
    public function __construct(
        public string $page,
        public string $slug,
        public ?string $content = '',
        // Plus bas = premier
        public ?int $order = 0,
        public SectionTypeEnum $type = SectionTypeEnum::Text,
    ) {
    }
}
