<?php

namespace App\Entity;

interface BankNoteInterface
{
    public function __construct(int $nominal);
}
