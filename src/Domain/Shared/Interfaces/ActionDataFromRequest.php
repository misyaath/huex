<?php

namespace Domain\Shared\Interfaces;

use Illuminate\Http\Request;

interface ActionDataFromRequest
{
    public function fromRequest(Request $request);
}
