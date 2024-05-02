<?php

declare(strict_types=1);

namespace App\Data;

use phpDocumentor\Reflection\Types\This;
use Spatie\LaravelData\Attributes\Validation\Email;
use Spatie\LaravelData\Attributes\Validation\Password;
use Spatie\LaravelData\Attributes\Validation\Required;
use Spatie\LaravelData\Attributes\Validation\Same;
use Spatie\LaravelData\Attributes\Validation\StringType;
use Spatie\LaravelData\Attributes\Validation\Unique;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Support\Validation\References\RouteParameterReference;

class UserUpsertData extends Data
{
    public function __construct(
        public readonly ?int $id,
        public readonly string $name,
        #[Email, Required] #[Unique(table: 'users', column: 'email', ignore: new RouteParameterReference(routeParameter: 'user',nullable: true))]
        public readonly string $email,
        #[StringType, Required, Password(min: 8)]
        public readonly string $password,
        #[StringType, Required, Same('password')]
        public readonly string $password_confirmation,

    ) {
    }
}
