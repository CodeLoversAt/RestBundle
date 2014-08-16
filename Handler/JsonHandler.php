<?php
/**
 * @package symfony-seed-mongo
 *
 * @author Daniel Holzmann <d@velopment.at>
 * @date 16.08.14
 * @time 17:35
 */

namespace CodeLovers\RestBundle\Handler;

use FOS\RestBundle\View\View;
use FOS\RestBundle\View\ViewHandler;
use JMS\Serializer\SerializerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class JsonHandler
{
    /**
     * @var SerializerInterface
     */
    private $serializer;

    /**
     * @param SerializerInterface $serializer
     */
    public function __construct(SerializerInterface $serializer)
    {
        $this->serializer = $serializer;
    }

    public function createResponse(ViewHandler $handler, View $view, Request $request)
    {
        $context = $handler->getSerializationContext($view);
        $json = $this->serializer->serialize($view->getData(), 'json', $context);

        return new Response($json, $view->getStatusCode(), $view->getHeaders());
    }
}