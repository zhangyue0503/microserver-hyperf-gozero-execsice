<?php

namespace App\JsonRpc;

use Hyperf\RpcServer\Annotation\RpcService;

/**
 * @RpcService(name="HyperfHelloAService", protocol="jsonrpc", server="jsonrpc",publishTo="nacos")
 */
class HyperfHelloAService implements HyperfHelloAInterface
{

    public function getList(int $id, $type, int $count = 10): array
    {
        return ['id'=>$id, 'type'=>$type, 'count'=>$count];
    }
}