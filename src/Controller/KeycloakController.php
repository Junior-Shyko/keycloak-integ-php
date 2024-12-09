<?php
declare(strict_types=1);

namespace JuniorShyko\KeycloakIntegPhp\Controller;

use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class KeycloakController extends AbstractController
{
    public function __construct(
        private Security $security,
        protected TokenStorageInterface $tokenStorage,
    ) {
    }

    public function connect(Request $request)
    {
        dump($request);
        die('KeyCloakController');
    }
}