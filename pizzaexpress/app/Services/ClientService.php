<?php
/**
 * Created by PhpStorm.
 * User: ClaudioSouza
 * Date: 18/01/2016
 * Time: 08:15
 */

namespace pizzaexpress\Services;


use pizzaexpress\Repositories\ClientRepository;
use pizzaexpress\Repositories\UserRepository;

class ClientService {

    private $clientRepository;
    private $userRepository;

    public function  __construct(ClientRepository $clientRepository, UserRepository $userRepository )
    {
        $this->clientRepository = $clientRepository;
        $this->userRepository = $userRepository;

    }

    public function  update(array $data, $id)
    {
        $userId = $this->clientRepository->find($id, ['user_id'])->user_id;
        $this->clientRepository->update($data, $id);
        $this->userRepository->update($data['user'], $userId );

    }

    public function create(array $data)
    {
        $data['user']['password'] = bcrypt(123456);
        $user = $this->userRepository->create($data['user']);

        $data['user_id'] = $user->id;

        $this->clientRepository->create($data);
    }

}