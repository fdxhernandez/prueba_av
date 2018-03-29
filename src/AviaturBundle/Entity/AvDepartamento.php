<?php

namespace AviaturBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * AvDepartamento
 *
 * @ORM\Table(name="av_departamento", indexes={@ORM\Index(name="FK2", columns={"id_pais"})})
 * @ORM\Entity
 */
class AvDepartamento
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=255, nullable=false)
     */
    private $nombre;

    /**
     * @var \AvPais
     *
     * @ORM\ManyToOne(targetEntity="AvPais")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_pais", referencedColumnName="id")
     * })
     */
    private $idPais;



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
     * Set nombre
     *
     * @param string $nombre
     *
     * @return AvDepartamento
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get nombre
     *
     * @return string
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set idPais
     *
     * @param \AviaturBundle\Entity\AvPais $idPais
     *
     * @return AvDepartamento
     */
    public function setIdPais(\AviaturBundle\Entity\AvPais $idPais = null)
    {
        $this->idPais = $idPais;

        return $this;
    }

    /**
     * Get idPais
     *
     * @return \AviaturBundle\Entity\AvPais
     */
    public function getIdPais()
    {
        return $this->idPais;
    }
}
