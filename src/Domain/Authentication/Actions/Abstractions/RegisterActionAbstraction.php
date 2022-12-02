<?php

namespace Domain\Authentication\Actions\Abstractions;

use App\Models\User;
use Domain\Shared\Interfaces\ActionData;
use Illuminate\Support\Facades\Hash;

abstract class RegisterActionAbstraction
{
    protected ActionData $data;
    protected User $user;

    protected function registerUser(): void
    {
        $this->user = User::make()->fill($this->data->toArray());
        $this->user->fill(['password' => Hash::make($this->data->password)]);
        $this->user->save();
    }

}
