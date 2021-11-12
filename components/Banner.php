<?php

class Banner {
    public $title;
    public $subtitle;
    public $text;
    public $image;
    public $sectionClass;
    public $divClass;
    public $alt;

    function __construct($title,$subtitle,$text,$image,$sectionClass,$divClass,$alt) {
        $this->title = $title;
        $this->subtitle = $subtitle;
        $this->text = $text;
        $this->image = $image;
        $this->sectionClass = $sectionClass;
        $this->divClass = $divClass;
        $this->alt = $alt;
    }

    function showElement() {
        echo "
        <section class='$this->sectionClass'>
        <div class='$this->divClass'>
            <h1>$this->title</h1>
            <h3>$this->subtitle</h3>
            <p>$this->text</p>
        </div>
        <img src='$this->image' alt='$this->alt'/>
    </section>
    ";
    }
}