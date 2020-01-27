<?php

namespace App\Entity;
use App\Entity\Depot;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\AdvancedUserInterface;
/**
 * @ApiResource
 * @ORM\Entity(repositoryClass="App\Repository\UsersRepository")
 */
class Users implements  AdvancedUserInterface
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

  


    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nom;

   
  

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Role", inversedBy="users")
     */
    private $role;

    /**
     * @ORM\Column(type="boolean")
     */
    private $active;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $username;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $ninea;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $registre;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Depot", mappedBy="users")
     */
    private $users_depot;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Compte", mappedBy="users")
     */
    private $users_compte;

    public function __construct()
    {
        $this->users_depot = new ArrayCollection();
        $this->users_compte = new ArrayCollection();
    }
    public function getId(): ?int
    {
        return $this->id;
    }



    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return (string) $this->username;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        return [$this->role->getLibelle()];
       
    }

    
    /**
     * @see UserInterface
     */
    public function getPassword(): string
    {
        return (string) $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password ;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getSalt()
    {
        // not needed when using the "bcrypt" algorithm in security.yaml
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }



    public function getRole(): ?Role
    {
        return $this->role;
    }

    public function setRole(?Role $role): self
    {
        $this->role = $role;

        return $this;
    }

    public function getActive(): ?bool
    {
        return $this->active;
    }

    public function setActive(bool $active): self
    {
        $this->active = $active;

        return $this;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }
    public function isAccountNonExpired(){
        return true;
    }
    public function isAccountNonLocked(){
        return true;
    }
    public function isCredentialsNonExpired(){
        return true;
    }
    public function isEnabled(){
        return $this->active;
    }

    public function getNinea(): ?int
    {
        return $this->ninea;
    }

    public function setNinea(?int $ninea): self
    {
        $this->ninea = $ninea;

        return $this;
    }

    public function getRegistre(): ?string
    {
        return $this->registre;
    }

    public function setRegistre(?string $registre): self
    {
        $this->registre = $registre;

        return $this;
    }

    /**
     * @return Collection|Depot[]
     */
    public function getUsersDepot(): Collection
    {
        return $this->users_depot;
    }

    public function addUsersDepot(Depot $usersDepot): self
    {
        if (!$this->users_depot->contains($usersDepot)) {
            $this->users_depot[] = $usersDepot;
            $usersDepot->setUsers($this);
        }

        return $this;
    }

    public function removeUsersDepot(Depot $usersDepot): self
    {
        if ($this->users_depot->contains($usersDepot)) {
            $this->users_depot->removeElement($usersDepot);
            // set the owning side to null (unless already changed)
            if ($usersDepot->getUsers() === $this) {
                $usersDepot->setUsers(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Compte[]
     */
    public function getUsersCompte(): Collection
    {
        return $this->users_compte;
    }

    public function addUsersCompte(Compte $usersCompte): self
    {
        if (!$this->users_compte->contains($usersCompte)) {
            $this->users_compte[] = $usersCompte;
            $usersCompte->setUsers($this);
        }

        return $this;
    }

    public function removeUsersCompte(Compte $usersCompte): self
    {
        if ($this->users_compte->contains($usersCompte)) {
            $this->users_compte->removeElement($usersCompte);
            // set the owning side to null (unless already changed)
            if ($usersCompte->getUsers() === $this) {
                $usersCompte->setUsers(null);
            }
        }

        return $this;
    }
}
