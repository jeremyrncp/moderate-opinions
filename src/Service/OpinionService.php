<?php


namespace App\Service;


use App\Entity\Opinion;
use Doctrine\ORM\EntityManagerInterface;

class OpinionService
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * OpinionService constructor.
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @param Opinion $opinion
     */
    public function save(Opinion $opinion)
    {
        /** @var Opinion $opinionActual */
        $opinionActual = $this->entityManager->getRepository(Opinion::class)->findOneBy(['email' => $opinion->getEmail()]);

        if ($opinionActual instanceof Opinion) {
            $opinionActual->setName($opinion->getName());
            $opinionActual->setMessage($opinion->getMessage());
            $opinionActual->setNote($opinion->getNote());
            $opinionActual->setDate(new \DateTime());

            $this->entityManager->persist($opinionActual);
        } else {
            $opinion->setDate(new \DateTime());
            $this->entityManager->persist($opinion);
        }
    }
}
