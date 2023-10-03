<?php

declare(strict_types=1);

namespace Vanta\Integration\EsiaGateway\Struct;

use Symfony\Component\Uid\Uuid;

final class PassportHistory extends Document
{
    public function __construct(
        public Uuid $id,
        public int $version,
        /** @var list<PreviousDocument> $history */
        public array $history,
    ) {
        parent::__construct(DocumentType::PASSPORT_HISTORY->value);
    }
}
