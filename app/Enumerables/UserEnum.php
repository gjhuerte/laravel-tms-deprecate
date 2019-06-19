<?php

namespace App\Enumerables;

use App\Enumerables\BaseEnum;

class UserEnum extends BaseEnum
{
    const HEAD_ADMINISTRATOR = 'head administrator';
    const ADMINISTRATOR = 'administrator';
    const DESIGNATOR = 'designator';
    const VERIFIER = 'verifier';
    const SUPPORT = 'support';
    const CLIENT_MANAGER = 'client manager';
    const CLIENT = 'client';
}
