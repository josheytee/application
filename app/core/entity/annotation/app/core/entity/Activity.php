<?php

namespace app\core\entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Activity
 *
 * @ORM\Entity(repositoryClass="app\core\entity\repository\ActvityRepository")
 * @ORM\Table(name="Activity", indexes={@ORM\Index(name="activity_url_idx", columns={"id", "url"})})
 */
class Activity {

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string")
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="url", type="string", length=32, nullable=true)
     */
    private $url;

    /**
     * @var string
     *
     * @ORM\Column(name="icon", type="string", nullable=true)
     */
    private $icon;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", length=320)
     */
    private $description;

}
