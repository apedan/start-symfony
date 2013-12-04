<?php
namespace Film\Bundle;

use Film\Bundle\Entity\Log;
use Film\Bundle\Event\LogEvent;

class LogWriter
{
    public function write(LogEvent $event)
    {
        $log = new Log($event->getType(), $event->getMessage());

        $entity = $event->getEntity();
        $log->setEntityName(get_class($entity));
        $log->setEntityId($entity->getId());

        $event->persistLog($log);
    }
}
