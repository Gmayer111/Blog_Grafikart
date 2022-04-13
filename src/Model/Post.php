<?php

namespace App\Model;
use App\Helpers\text;
use DateTime;

class Post {

    private $id;

    private $slug;

    private  $name;

    private $content;

    private $created_at;

    private $categories = [];

    public function getName(): ?string
    {
        return $this->name;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function getExcerpt(): ?string
    {
        if ($this->content === null) {
            return null;
        }
        return Text::excerpt($this->content, 60);
    }


    public function getCreatedAt(): DateTime
    {
        return new DateTime($this->created_at);
    }

    public function getID(): ?int
    {
        return $this->id;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }



    
}