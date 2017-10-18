<?php

namespace BH3Bundle\Twig;

class BBCodeExtension extends \Twig_Extension
{
    public function getFilters()
    {
        return array(new \Twig_SimpleFilter('bbcode', array($this, 'bbcode')));
    }

    public function getName()
    {
        return 'bbcode';
    }

    public function bbcode($text)
    {
        // Title
        $text = preg_replace('#\[title\](.*)\[/title\]#isU', '<h5 class="subtitle">$1</h5>', $text);

        // Bold
        $text = preg_replace('#\[b\](.*)\[/b\]#isU', '<strong>$1</strong>', $text);

        // Italic
        $text = preg_replace('#\[i\](.*)\[/i\]#isU', '<em>$1</em>', $text);

        // Link
        $text = preg_replace('#\[link=(.*)\](.*)\[/link\]#isU', '<a href="$1">$2</a>', $text);

        // Image
        $text = preg_replace('#\[img\](.*)\[/img\]#isU', '<img src="$1" alt="Image de présentation" class="responsive-img"/>', $text);

        // Video
        $text = preg_replace('#\[video\].+v=(\d{11}|\w{11}).*\[/video\]#isU', '<div class="video-container"><iframe src="https://www.youtube.com/embed/$1?autoplay=0" frameborder="0" allowfullscreen></iframe></div>', $text);

        return $text;
    }
}
