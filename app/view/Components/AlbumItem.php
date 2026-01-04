<?php

namespace App\View\Components;

use Illuminate\View\Component;

class AlbumItem extends Component
{
    public $name;
    public $artists;
    public $genre;

    public $year;

    public function __construct($name, $artists, $genre, $year)
    {
        $this->name = $name;
        $this->artists = $artists;
        $this->genre = $genre;
        $this->year = $year;
    }

    public function render()
    {
        return view('components.album-item');
    }
}



?>
