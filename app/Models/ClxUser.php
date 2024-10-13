<?php

namespace Models;

use DateTime;

class ClxUser
{
    public int $id;
    public string $name;
    public string $surname;
    public bool $active;
    public DateTime $last_login;
    public string $picture;
    public float $rating;
    public function __construct(int $id, string $name, string $surname, bool $active, DateTime $last_login, string $picture, float $rating)
    {
        $this->id = $id;
        $this->name = $name;
        $this->surname = $surname;
        $this->active = $active;
        $this->last_login = $last_login;
        $this->picture = $picture;
        $this->rating = $rating;
    }
}
