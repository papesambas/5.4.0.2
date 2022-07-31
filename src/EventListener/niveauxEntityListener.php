<?php

namespace App\EventListener;

use App\Entity\niveaux;
use App\Entity\Classes;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Symfony\Component\Security\Core\Security;
use function PHPUnit\Framework\throwException;

use Symfony\Component\String\Slugger\SluggerInterface;

class niveauxEntityListener
{

    public function __construct(Security $security, SluggerInterface $Slugger)
    {
        $this->Securty = $security;
        $this->Slugger = $Slugger;
    }

    public function prePersist(niveaux $niveaux, LifecycleEventArgs $arg): void
    {
        $user = $this->Securty->getUser();
        /*if ($user === null) {
            throw new \LogicException('User cannot be null here ...');
        }*/

        $niveaux
            //->setCreatedAt(new \DateTimeImmutable('now'))
            ->setSlug($this->getniveauxSlug($niveaux));
    }

    private function getniveauxSlug(niveaux $niveaux): string
    {
        $slug = mb_strtolower($niveaux->getDesignation(), 'UTF-8');
        return $this->Slugger->slug($slug);
    }
}
