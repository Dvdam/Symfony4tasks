<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * User
 *
 * @ORM\Table(name="users")
 * @ORM\Entity
 */
class User implements UserInterface
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string|null
     *
     * @ORM\Column(name="role", type="string", length=50, nullable=true, options={"default"="NULL"})
     */
    // private $role = 'NULL';
    private $role;


    /**
     * @var string|null
     *
     * @ORM\Column(name="name", type="string", length=100, nullable=true, options={"default"="NULL"})
     * @Assert\NotBlank
     * @Assert\Regex("/[a-zA-Z ]+/")
     */
    // private $name = 'NULL';
    private $name;


    /**
     * @var string|null
     *
     * @ORM\Column(name="surname", type="string", length=200, nullable=true, options={"default"="NULL"})
     * @Assert\NotBlank
     * @Assert\Regex("/[a-zA-Z ]+/")
     */
    // private $surname = 'NULL';
    private $surname;


    /**
     * @var string|null
     *
     * @ORM\Column(name="email", type="string", length=255, nullable=true, options={"default"="NULL"})
     * @Assert\NotBlank
     * @Assert\Email(
     *          message = "El email '{{ value }}' no es valido",
     *          checkMX = true
     * )
     */
    // private $email = 'NULL';
    private $email;

    /**
     * @var string|null
     *
     * @ORM\Column(name="password", type="string", length=255, nullable=true, options={"default"="NULL"})
     * @Assert\NotBlank
     */
    // private $password = 'NULL';
    private $password;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="created_at", type="datetime", nullable=true, options={"default"="NULL"})
     */
    // private $createdAt = 'NULL';
    private $createdAt;

   


    // Propiedad creada para guardar todas las tareas
    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Task", mappedBy="user")
     */
    private $tasks;

    // Creamos el constructor para obtener las coleccion de tareas
    public function __construct()
    {
        $this->tasks = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRole(): ?string
    {
        return $this->role;
    }

    public function setRole(?string $role): self
    {
        $this->role = $role;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getSurname(): ?string
    {
        return $this->surname;
    }

    public function setSurname(?string $surname): self
    {
        $this->surname = $surname;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(?string $password): self
    {
        $this->password = $password;

        return $this;
    }

    // public function getCreatedAt(): ?\DateTimeInterface
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    // public function setCreatedAt(?\DateTimeInterface $createdAt): self
    public function setCreatedAt($createdAt): self

    {
        $this->createdAt = $createdAt;

        return $this;
    }

    // MEtodo que va a devolver todas las tareas
    /**
     * @return Collection|Task[]
     */
    public function getTasks()
    {
        return $this->tasks;
    }

    // Metodos para hacer uso de la interface
    public function getUsername()
    {
        return $this->email;
    }

    public function getSalt()
    {
        return null;
    }
    public function getRoles()
    {
        return array('ROLE_USER');
    }

    public function eraseCredentials()
    {
        
    }


}
