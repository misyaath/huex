<?php

namespace Domain\Admin\Users\DTO\Abstractions;

use App\Models\User;
use Illuminate\Http\Request;

abstract class EnableDisableUserAbstraction
{
    public readonly User $user;

    public function toArray(): array
    {
        return [];
    }

    public function fromRequest(Request $request): void
    {
        $this->user = User::where('id', $request->input('user_id'))->first();
    }
}
