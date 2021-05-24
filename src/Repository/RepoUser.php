<?php


namespace Api\Repository;


class RepoUser
{

    private ?int $id;
    private string $login;
    private string $pass;
    private string $email;
    private string $name;
    private string $address;
    private string $phone;

    public function __construct()
    {
    }
}
