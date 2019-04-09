<?php

namespace App\Controller;

use App\Entity\Message;
use App\Manager\MessageManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\Mercure\Update;


/**
 * Class ChatController
 * @package App\Controller
 */
class ChatController extends AbstractController
{

    /**
     * @var MessageManager
     */
    private $msgManager;

    /**
     * ChatController constructor.
     * @param MessageManager $msgManager
     */
    public function __construct(MessageManager $msgManager)
    {
        $this->msgManager = $msgManager;
    }

    /**
     * @Route("/", methods={"GET"}, defaults={"_format" = "json"})
     * @param SerializerInterface $serializer
     * @return JsonResponse
     */
    public function getAction(SerializerInterface $serializer) :JsonResponse
    {
        $messages = $this->msgManager->getAll();
        $datas = $serializer->serialize($messages, 'json');
        return new JsonResponse($datas, Response::HTTP_OK);
    }

    /**
     * @Route("/", methods={"POST"}, defaults={"_format" = "json"})
     * @param Request $request
     * @param SerializerInterface $serializer
     * @param ValidatorInterface $validator
     * @param MessageBusInterface $bus
     * @return Response
     */
    public function postAction(Request $request, SerializerInterface $serializer, ValidatorInterface $validator, MessageBusInterface $bus) :Response
    {

        $data = $request->getContent();
        $message = $serializer->deserialize($data, Message::class, 'json');
        $errors = $validator->validate($message);
        if(count($errors) === 0){
            $this->msgManager->save($message);
            $update = new Update(
                'http://demochat.local:80/',
                $serializer->serialize($message, 'json')
            );
            $bus->dispatch($update);
            return new Response(Response::HTTP_OK);
        }
        return new Response(Response::HTTP_BAD_REQUEST);
    }

    /**
     * @Route("/ping", methods={"POST"}, defaults={"_format" = "json"})
     * @param MessageBusInterface $bus
     * @return Response
     */
    public function pingAction(MessageBusInterface $bus) :Response
    {
        $update = new Update(
            'http://demochat.local:80/ping',
            json_encode(['data' => 'ping'])
        );
        $bus->dispatch($update);
        return new Response(Response::HTTP_OK);
    }
}
