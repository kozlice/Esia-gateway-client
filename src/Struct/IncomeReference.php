<?php

declare(strict_types=1);

namespace Vanta\Integration\EsiaGateway\Struct;

use Symfony\Component\Uid\Uuid;

final class IncomeReference extends Document
{
    public function __construct(
        public readonly Uuid $id,
        public readonly int $year,
        public readonly int $version,
        /** @var IncomeReferenceDataItem[] $data */
        public array $data,
    ) {
        parent::__construct(DocumentType::INCOME_REFERENCE->value);
    }
}
