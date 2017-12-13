<?php
/**
 * Created by PhpStorm.
 * User: yuriy
 * Date: 27.11.17
 * Time: 0.35
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="categories")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\CategoryRepository")
 */
class Category
{
    /**
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(name="name", type="string", length=255, unique=true)
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity="Item", mappedBy="category")
     */
    private $item;
    /**
     * @ORM\OneToMany(targetEntity="Category", mappedBy="parent")
     */
    private $children;

    /**
     * @ORM\ManyToOne(targetEntity="Category", inversedBy="children")
     * @ORM\JoinColumn(name="parent_id", referencedColumnName="id")
     */
    private $parent;

    public function __construct(string $name, ?Category $parent)
    {
        $this->children = new \Doctrine\Common\Collections\ArrayCollection();
        $this->article = new \Doctrine\Common\Collections\ArrayCollection();
        $this->name = $name;
        $this->parent = $parent;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setName(string $name)
    {
        $this->name = $name;
    }

    public function getName(): string
    {
        return $this->name;
    }


    public function setItem(array $item)
    {
        $this->article = new \Doctrine\Common\Collections\ArrayCollection($item);
    }

    public function getItem(): \Doctrine\Common\Collections\ArrayCollection
    {
        return $this->item;
    }

    public function setChildren(array $children)
    {
        $this->children = new \Doctrine\Common\Collections\ArrayCollection($children);
    }

    public function getChildren(): \Doctrine\Common\Collections\ArrayCollection
    {
        return $this->children;
    }

    public function setParent(Category $parent)
    {
        $this->parent = $parent;
    }

    public function getParent():? Category
    {
        return $this->parent;
    }

}