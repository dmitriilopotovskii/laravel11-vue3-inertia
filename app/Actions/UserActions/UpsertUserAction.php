<?php

declare(strict_types=1);

namespace App\Actions\UserActions;

use App\Data\UserUpsertData;
use App\Models\User;

class UpsertUserAction
{
    public static function execute(UserUpsertData $data): User
    {
        return User::updateOrCreate(
            [
                'id' => $data->id,
            ],
            [
                ...$data->all(),
            ]

        );
    }
}
