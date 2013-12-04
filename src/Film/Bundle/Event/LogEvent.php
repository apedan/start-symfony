<?php

namespace Film\Bundle\Event;

use Symfony\Component\EventDispatcher\Event;
use Film\Bundle\Entity\Log;

class LogEvent extends Event
{
    protected $entity;

    protected $type;

    protected $message;

    protected $em;

    public function __construct($em, $entity, $type, $message)
    {
        $this->em = $em;
        $this->entity = $entity;
        $this->type = $type;
        $this->mesage = $message;
    }

    public function persistLog(Log $log)
    {
        var_dump($log);
        $this->em->persist($log);
    }

    public function getEntity()
    {
        return $this->entity;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @return mixed
     */
    public function getMessage()
    {
        return $this->message;
    }
}
