<?php

namespace Film\Bundle\Form\DataTransformer;

use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;
use Doctrine\Common\Persistence\ObjectManager;
use Film\Bundle\Entity\Actor;

class ActorsToArrayCollection implements DataTransformerInterface
{
    /**
     * @var ObjectManager
     */
    private $om;

    /**
     * @param ObjectManager $om
     */
    public function __construct(ObjectManager $om)
    {
        $this->om = $om;
    }

    /**
     * Transforms an object (actor) to a string (id).
     *
     * @param  Actor|null $actor
     * @return string
     */
    public function transform($actor)
    {
        if (null === $actor) {
            return "";
        }

        return $actor;
    }

    /**
     * Transforms a array (data) to an object (actor).
     *
     * @param  string $data
     * @return Actor|null
     * @throws TransformationFailedException if object (actor) is not found.
     */
    public function reverseTransform($data)
    {
        if (!$data) {
            return null;
        }

        var_dump($data);
        die();
        $issue = $this->om
            ->getRepository('AcmeTaskBundle:Issue')
            ->findOneBy(array('number' => $number))
        ;

        if (null === $issue) {
            throw new TransformationFailedException(sprintf(
                'An issue with number "%s" does not exist!',
                $number
            ));
        }

        return $issue;
    }
}
