<?php
/**
 * Created by PhpStorm.
 * User: benjaminsureau
 * Date: 29/03/2019
 * Time: 19:02
 */

namespace App\Manager;


use Doctrine\ORM\EntityManagerInterface;

abstract class AbstractManager
{

    /**
     * @var EntityManagerInterface
     */
    protected $em;

    /**
     * @param $entity
     */
    public function save($entity) : void
    {
        $this->em->persist($entity);
        $this->em->flush();
    }

}
