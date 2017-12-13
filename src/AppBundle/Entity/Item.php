<?php



namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;


/**
 * @author brand
 * @version 1.0
 * @created 25-���-2017 10:36:04
 */
/**
 * @ORM\Table(name="items")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ItemRepository")
 */

class Item
{
    /**
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
	private $id;
    /**
     * @ORM\Column(name="IsAvailiable", type="boolean")
     */
	private $IsAvailiable;
    /**
     * @ORM\Column(name="IsNew", type="boolean")
     */
	private $IsNew;

    /**
     * @ORM\Column(name="ItemCount", type="integer")
     */
	private $ItemCount;
    /**
     * @ORM\Column(name="itemDescription", type="string", length=255)
     */
	private $itemDescription;
    /**
     * @ORM\Column(name="ItemImage", type="string", length=255)
     */
	private $ItemImage;
    /**
     * @ORM\Column(name="ItemName", type="string", length=255)
     */
	private $ItemName;
	/**
     * @ORM\Column(name="ItemPrice", type="integer")
     */
	private $ItemPrice;
    /**
     * @ORM\Column(name="manufacturer", type="string", length=255)
     */
	private $manufacturer;

    /**
     * @ORM\ManyToOne(targetEntity="Category", inversedBy="item")
     * @ORM\JoinColumn(name="category_id", referencedColumnName="id")
     */
    private $category;


	function __construct(Category $category,
                         string $name,
                         string $image,
                         string $itemDescription,
                         string $manufacturer,
                         int $price,
                         bool $isAvailable,
                         bool $isNew,
                         int $itemCount)
	{
	    $this->manufacturer=$manufacturer;
        $this->ItemPrice=$price;
        $this->IsNew=$isNew;
        $this->IsAvailiable=$isAvailable;
        $this->category=$category;
        $this->ItemName=$name;
        $this->ItemImage=$image;
        $this->ItemCount=$itemCount;
        $this->itemDescription=$itemDescription;

	}

	function __destruct()
	{
	}


    public function getId(): int
    {
        return $this->id;
    }

    public function setName(string $name)
    {
        $this->ItemName = $name;
    }

    public function getName(): string
    {
        return $this->ItemName;
    }

    public function setDescription(string $description)
    {
        $this->itemDescription = $description;
    }

    public function getDescription(): string
    {
        return $this->itemDescription;
    }

    public function setImage(string $image)
    {
        $this->itemImage = $image;
    }

    public function getImage(): string
    {
        return $this->ItemImage;
    }

    public function setCount(int $count)
    {
        $this->ItemCount = $count;
    }

    public function getCount(): int
    {
        return $this->ItemCount;
    }

    public function setAvailable(bool $isAvailable)
    {
        $this->IsAvailiable = $isAvailable;
    }

    public function getAvailable(): bool
    {
        return $this->IsAvailiable;
    }

    public function setIsNew(bool $isNew)
    {
        $this->IsNew = $isNew;
    }

    public function getIsNew(): bool
    {
        return $this->IsNew;
    }

    public function setPrice(int $price)
    {
        $this->ItemPrice = $price;
    }

    public function getPrice(): int
    {
        return $this->ItemPrice;
    }

    public function setCategory(Category $category){
	    $this->category=$category;
    }

    public function getCategory(): Category{
	    return $this->category;
    }

    public function setManufacturer(string $manufacturer)
    {
        $this->manufacturer = $manufacturer;
    }

    public function getManufacturer(): string
    {
        return $this->manufacturer;
    }



}
