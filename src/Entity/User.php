<?php

declare(strict_types = 1);

namespace MyApp\Entity;

class User {
    private ?int $id = null;
    private string $email;
    private string $lastname;
    private string $firstname;
    private string $password;
    private array $roles; 

    public function __construct(?int $id, string $email, string $lastname, string $firstname, string $password, array $roles){
        $this-> id = $id;
        $this-> email = $email;
        $this-> lastname = $lastname;
        $this-> firstname = $firstname;
        $this-> password = $password;
        $this->roles = $roles;
    }

    public function getId():?int{
        return $this->id;
    }
    public function getEmail():string{
        return $this->email;
    }
    public function getLastname():string{
        return $this->lastname;
    }
    public function getFirstname():string{
        return $this->firstname;
    }
    public function getPassword():string{
        return $this-> password;
    }
    public function setId(?int $id):void{
        $this-> id = $id;
    }
    public function setEmail(string $email): void
    {
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    throw new InvalidArgumentException("Email invalide.");
    }
    $this->email = $email;
    }   
    public function setLastname(string $lastname):void{
        $this-> lastname = $lastname;
    }
    public function setFirstname(string $firstname):void{
        $this-> firstname = $firstname;
    }
    public function setPassword(string $password):void{
        $this-> password = $password;
    }
    public function verifyPassword(string $password): bool
    {
    return password_verify($password , $this->password);
    }
    public function getRoles(): array
    {
    // Désérialise les rôles en tableau PHP
    return $this->roles;
    }
    public function setRoles(array $roles): void
    {
    $this->roles = $roles;
    }
}