<?php

namespace AviaturBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * AvCiudad
 *
 * @ORM\Table(name="av_ciudad", indexes={@ORM\Index(name="FK_av_ciudad_av_departamento", columns={"id_departamento"})})
 * @ORM\Entity
 */
class AvCiudad
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
     * @var string
     *
     * @ORM\Column(name="descripcion", type="string", length=255, nullable=false)
     */
    private $descripcion;

    /**
     * @var \AvDepartamento
     *
     * @ORM\ManyToOne(targetEntity="AvDepartamento")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_departamento", referencedColumnName="id")
     * })
     */
    private $idDepartamento;



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
     * @return AvCiudad
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
     * Set descripcion
     *
     * @param string $descripcion
     *
     * @return AvCiudad
     */
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    /**
     * Get descripcion
     *
     * @return string
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * Set idDepartamento
     *
     * @param \AviaturBundle\Entity\AvDepartamento $idDepartamento
     *
     * @return AvCiudad
     */
    public function setIdDepartamento(\AviaturBundle\Entity\AvDepartamento $idDepartamento = null)
    {
        $this->idDepartamento = $idDepartamento;

        return $this;
    }

    /**
     * Get idDepartamento
     *
     * @return \AviaturBundle\Entity\AvDepartamento
     */
    public function getIdDepartamento()
    {
        return $this->idDepartamento;
    }
}
