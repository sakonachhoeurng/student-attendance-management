<?php

namespace AttedanceManagement\UserBundle\Traits;

use Doctrine\Common\Persistence\ObjectManager;

trait HasControllerUtils
{
    /**
     * @return ObjectManager
     */
    protected function getEntityManager()
    {
        return $this->getDoctrine()->getManager();
    }

    /**
     * Persists and flush an entity.
     *
     * @param mixed $entity
     */
    protected function persistAndFlush($entity)
    {
        $this->getEntityManager()
             ->persist($entity);
        $this->getEntityManager()
             ->flush();
    }

    /**
     * @param mixed $entity
     */
    protected function removeAndFlush($entity)
    {
        $this->getEntityManager()
             ->remove($entity);
        $this->getEntityManager()
             ->flush();
    }
}
