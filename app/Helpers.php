<?php

if (!function_exists('nl2p')) {
    function nl2p($text)
    {
        // Split text into paragraphs based on newline characters
        // $paragraphs = preg_split('/\n+/', $text);

        $paragraphs = preg_split('/\n{2,}/', $text);

        // Filter out empty paragraphs
        $paragraphs = array_filter($paragraphs, 'trim');

        // Wrap each paragraph in <p> tags
        $paragraphs = array_map(function ($paragraph) {
            return '<p>' . $paragraph . '</p>';
        }, $paragraphs);

        // Combine paragraphs into a single string
        return implode('\n\n', $paragraphs);
    }
}
