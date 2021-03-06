<?php

namespace App\Entity;

use Ramsey\Uuid\Uuid;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(
 *     name="companion_retainers",
 *     indexes={
 *          @ORM\Index(name="name", columns={"name"}),
 *          @ORM\Index(name="server", columns={"server"}),
 *          @ORM\Index(name="added", columns={"added"}),
 *          @ORM\Index(name="updated", columns={"updated"})
 *     }
 * )
 * @ORM\Entity(repositoryClass="App\Repository\CompanionRetainerRepository")
 */
class CompanionRetainer
{
    /**
     * @var string
     * @ORM\Id
     * @ORM\Column(type="string", length=64)
     */
    public $id;
    /**
     * @var string
     * @ORM\Column(type="string", length=64)
     */
    public $name;
    /**
     * @var int
     * @ORM\Column(type="integer", length=64)
     */
    public $server;
    /**
     * @var int
     * @ORM\Column(type="integer", length=16)
     */
    public $updated = 0;
    /**
     * @var int
     * @ORM\Column(type="integer", length=16)
     */
    public $added = 0;
    
    public function __construct(string $name, int $server)
    {
        $this->id       = Uuid::uuid4();
        $this->added    = time();
        $this->updated  = time();
        $this->name     = $name;
        $this->server   = $server;
    }
    
    public function getId(): string
    {
        return $this->id;
    }
    
    public function setId(string $id)
    {
        $this->id = $id;
        
        return $this;
    }
    
    public function getName(): string
    {
        return $this->name;
    }
    
    public function setName(string $name)
    {
        $this->name = $name;
        
        return $this;
    }

    public function getServer(): int
    {
        return $this->server;
    }

    public function setServer(int $server)
    {
        $this->server = $server;

        return $this;
    }

    public function getUpdated(): int
    {
        return $this->updated;
    }
    
    public function setUpdated(int $updated)
    {
        $this->updated = $updated;
        
        return $this;
    }
    
    public function getAdded(): int
    {
        return $this->added;
    }
    
    public function setAdded(int $added)
    {
        $this->added = $added;
        
        return $this;
    }
}
