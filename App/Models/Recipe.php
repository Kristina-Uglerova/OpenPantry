<?php

use App\Core\Model;

class Recipe extends Model
{
    protected int $id;
    protected string $name;
    protected string $description;
    protected string $image_path;
    protected int $user_id;
}