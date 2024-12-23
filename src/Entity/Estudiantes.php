<?php

namespace App\Entity;

use App\Repository\EstudiantesRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: EstudiantesRepository::class)]
class Estudiantes
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    #[Assert\NotBlank(message: 'El nombre no puede estar vacío.')]
    #[Assert\Length(
        max: 255,
        maxMessage: 'El nombre no puede tener más de {{ limit }} caracteres.'
    )]
    private ?string $nombre = null;

    #[ORM\Column(type: 'string', length: 100)]
    #[Assert\NotBlank(message: 'El salón no puede estar vacío.')]
    #[Assert\Length(
        max: 100,
        maxMessage: 'El salón no puede tener más de {{ limit }} caracteres.'
    )]
    private ?string $salon = null;

    #[ORM\Column(type: 'string', length: 255)]
    #[Assert\NotBlank(message: 'El acudiente no puede estar vacío.')]
    private ?string $acudiente = null;

    #[ORM\Column(type: 'integer')]
    #[Assert\NotBlank(message: 'La edad es obligatoria.')]
    #[Assert\Range(
        min: 1,
        max: 16,
        notInRangeMessage: 'La edad debe estar entre {{ min }} y {{ max }} años.'
    )]
    private ?int $edad = null;

    #[ORM\Column(type: 'string', length: 10)]
    #[Assert\NotBlank(message: 'El género es obligatorio.')]
    #[Assert\Choice(
        choices: ['Masculino', 'Femenino', 'Otro'],
        message: 'Seleccione un género válido.'
    )]
    private ?string $genero = null;

    // Getters y Setters

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre): self
    {
        $this->nombre = $nombre;
        return $this;
    }

    public function getSalon(): ?string
    {
        return $this->salon;
    }

    public function setSalon(string $salon): self
    {
        $this->salon = $salon;
        return $this;
    }

    public function getAcudiente(): ?string
    {
        return $this->acudiente;
    }

    public function setAcudiente(string $acudiente): self
    {
        $this->acudiente = $acudiente;
        return $this;
    }

    public function getEdad(): ?int
    {
        return $this->edad;
    }

    public function setEdad(int $edad): self
    {
        $this->edad = $edad;
        return $this;
    }

    public function getGenero(): ?string
    {
        return $this->genero;
    }

    public function setGenero(string $genero): self
    {
        $this->genero = $genero;
        return $this;
    }

}
