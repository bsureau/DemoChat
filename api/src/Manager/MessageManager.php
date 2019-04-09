<?php
/**
 * Created by PhpStorm.
 * User: benjaminsureau
 * Date: 29/03/2019
 * Time: 19:04
 */

namespace App\Manager;


use App\Entity\Message;
use Doctrine\Common\Persistence\ObjectRepository;
use Doctrine\ORM\EntityManagerInterface;

class MessageManager extends AbstractManager
{

    /**
     * @var ObjectRepository
     */
    private $repository;

    /**
     * MessageManager constructor.
     * @param EntityManagerInterface $em
     */
    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
        $this->repository = $em->getRepository(Message::class);
    }

    /**
     * @return array
     */
    public function getAll() : array
    {
        return $this->repository->findAll();
    }
}
