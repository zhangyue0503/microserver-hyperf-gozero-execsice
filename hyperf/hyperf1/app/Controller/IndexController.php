<?php

declare(strict_types=1);
/**
 * This file is part of Hyperf.
 *
 * @link     https://www.hyperf.io
 * @document https://hyperf.wiki
 * @contact  group@hyperf.io
 * @license  https://github.com/hyperf/hyperf/blob/master/LICENSE
 */
namespace App\Controller;

use App\JsonRpc\HyperfHelloAInterface;
use Hyperf\Utils\ApplicationContext;

class IndexController extends AbstractController
{
    public function index()
    {
        $user = $this->request->input('user', 'Hyperf');
        $method = $this->request->getMethod();

        return [
            'method' => $method,
            'message' => "Hello {$user}.",
        ];
    }

    /**
     * @var \App\JsonRpc\HyperfHelloAInterface
     */
    protected $service;

    public function rpc(){
        $client = ApplicationContext::getContainer()->get(HyperfHelloAInterface::class);

        $result = $client->getList(123, "ttt", 20);
        return $result;
    }
}
