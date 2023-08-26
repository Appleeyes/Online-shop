<?php

// function to highlight keywords
function highlightKeywords($text, $keyword)
{
    return str_ireplace($keyword, '<span class="highlight">' . $keyword . '</span>', $text);
}
?>