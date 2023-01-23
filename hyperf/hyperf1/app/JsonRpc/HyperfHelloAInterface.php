<?php

namespace App\JsonRpc;

interface HyperfHelloAInterface
{
    public function getList(int $id, $type, int $count = 10): array;
}