<?php

namespace App\Models;

use DateTime;

class ClxUser
{
    public int $id;
    public string $name;
    public string $surname;
    public bool $active;
    public DateTime $last_login;
    public string $picture;
    public string $resizedPicture;
    public float $rating;

    public function __construct(int $id, string $name, string $surname, bool $active, string $last_login, string $picture, float $rating)
    {
        $this->id = $id;
        $this->name = $name;
        $this->surname = $surname;
        $this->active = $active;
        $this->last_login = DateTime::createFromFormat('Y-m-d H:i:s', $last_login);

        $image = imagecreatefromjpeg($picture);
        $imgResized = imagescale($image, 100);
        $newPath = 'data/resizedImages/' . $id . '.jpg';
        imagejpeg($imgResized, $newPath);

        $this->picture = $picture;
        $this->resizedPicture = $newPath;
        $this->rating = $rating;
    }
}
