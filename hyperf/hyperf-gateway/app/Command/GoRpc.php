<?php

declare(strict_types=1);

namespace App\Command;

use Hyperf\Command\Command as HyperfCommand;
use Hyperf\Command\Annotation\Command;
use Hyperf\GrpcClient\BaseClient;
use Psr\Container\ContainerInterface;
use User\IdReq;
use User\UserInfoReply;

/**
 * @Command
 */
#[Command]
class GoRpc extends HyperfCommand
{
    /**
     * @var ContainerInterface
     */
    protected $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;

        parent::__construct('rpc:go-book');
    }

    public function configure()
    {
        parent::configure();
        $this->setDescription('Hyperf Demo Command');
    }

    public function handle()
    {


        $client = new UserClient('127.0.0.1:8080', [
            'credentials' => null,
        ]);
        $u = new IdReq();
        $u->setId(1);
        [$reply, $status] = $client->getUser($u);

        var_dump($reply,$status);
        echo $reply->getName();

        $this->line('Hello Hyperf!', 'info');
    }

}

class UserClient extends BaseClient
{
    public function getUser(IdReq $argument)
    {
        return $this->_simpleRequest(
            '/user.user/getUser',
            $argument,
            [UserInfoReply::class, 'decode']
        );
    }
}
