<?php

namespace App\Data;

use Spatie\LaravelData\Attributes\Validation\Email;
use Spatie\LaravelData\Attributes\Validation\Required;
use Spatie\LaravelData\Attributes\WithTransformer;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Transformers\DateTimeInterfaceTransformer;

class UserData extends Data
{
    public function __construct(
        public readonly ?int $id,
        public readonly string $name,
        #[Email, Required]
        public readonly string $email,
        #[WithTransformer(DateTimeInterfaceTransformer::class, format: 'Y-m-d H:i')]
        public readonly ?\DateTime $created_at


    ) {
    }
}
