<?php
declare(strict_types=1);
namespace App\JsonRpc;

use Hyperf\RpcServer\Annotation\RpcService;

/**
 * @RpcService(name="CalculatorOneService", protocol="jsonrpc-http", server="jsonrpc-http",publishTo="nacos")
 */
class CalculatorOneService implements CalculatorServiceInterface
{

    public function add(int $a, int $b): int
    {
        return $a + $b+5;
    }
}