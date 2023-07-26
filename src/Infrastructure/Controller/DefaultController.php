<?php declare(strict_types=1);

namespace App\Infrastructure\Controller;

use App\Domain\ApplicationUser;
use App\Domain\Party;
use App\Domain\RedisPartyStorage;
use Redis;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Routing\RouterInterface;

class DefaultController extends AbstractController
{
    /**
     * @Route("/", name="homepage" )
     */
    public function index(RouterInterface $router, RedisPartyStorage $redis, ApplicationUser $user): Response
    {
        $parties = $redis->listParties();

        return $this->render("index.html.twig", [
            'parties' => $parties,
        ]);
    }
}
