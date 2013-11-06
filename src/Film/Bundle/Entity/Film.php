<?php

namespace Film\Bundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Film
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Film\Bundle\Entity\FilmRepository")
 */
class Film
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text")
     */
    private $description;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created", type="datetime")
     */
    private $created;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updated", type="datetime")
     */
    private $updated;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="releaseAt", type="datetime")
     */
    private $releaseAt;

    /**
     * @ORM\ManyToMany(targetEntity="Genre")
     * @ORM\JoinTable(name="films_genres",
     *      joinColumns={@ORM\JoinColumn(name="film_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="genre_id", referencedColumnName="id")}
     *      )
     */
    private $genres;

    /**
     * @ORM\ManyToMany(targetEntity="Actor")
     * @ORM\JoinTable(name="films_actors",
     *      joinColumns={@ORM\JoinColumn(name="film_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="actor_id", referencedColumnName="id")}
     *      )
     */
    private $actors;

    /**
     * @ORM\ManyToOne(targetEntity="Category", inversedBy="films")
     * @ORM\JoinColumn(name="category_id", referencedColumnName="id")
     */
    private $category;


    public function __construct() {
        $this->created = new \DateTime();
        $this->updated = new \DateTime();
        $this->genres = new \Doctrine\Common\Collections\ArrayCollection();
        $this->actors = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function populate($data = array())
    {
        foreach ($data as $field => $value)
        {
            if(property_exists($this, $field))
                $this->$field = $value;
        }
    }

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set title
     *
     * @param string $title
     * @return Film
     */
    public function setTitle($title)
    {
        $this->title = $title;
    
        return $this;
    }

    /**
     * Get title
     *
     * @return string 
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Film
     */
    public function setDescription($description)
    {
        $this->description = $description;
    
        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set created
     *
     * @param \DateTime $created
     * @return Film
     */
    public function setCreated($created)
    {
        $this->created = $created;
    
        return $this;
    }

    /**
     * Get created
     *
     * @return \DateTime 
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * Set updated
     *
     * @param \DateTime $updated
     * @return Film
     */
    public function setUpdated($updated)
    {
        $this->updated = $updated;
    
        return $this;
    }

    /**
     * Get updated
     *
     * @return \DateTime 
     */
    public function getUpdated()
    {
        return $this->updated;
    }

    /**
     * Set releaseAt
     *
     * @param \DateTime $releaseAt
     * @return Film
     */
    public function setReleaseAt($releaseAt)
    {
        $this->releaseAt = $releaseAt;
    
        return $this;
    }

    /**
     * Get releaseAt
     *
     * @return \DateTime 
     */
    public function getReleaseAt()
    {
        return $this->releaseAt;
    }

    /**
     * @param Category $category
     */
    public function setCategory(Category $category)
    {
        $this->category = $category;
    }

    /**
     * @return Category
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * @return \Doctrine\Common\Collections\ArrayCollection
     */
    public function getGenres()
    {
        return $this->genres;
    }

    /**
     * @return \Doctrine\Common\Collections\ArrayCollection
     */
    public function getActors()
    {
        return $this->actors;
    }

}
