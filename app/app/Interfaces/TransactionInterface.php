<?php

namespace App\Interfaces;

interface TransactionInterface
{
    public function getType(): string;
    public function setType(string $type): void;
}