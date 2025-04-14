<?php

function truncatePost(string $text, int $limit = 100) : string {
    // Strip out the HTML tags temporarily
    $plainText = strip_tags($text);

    // Check if the length exceeds the limit
    if (strlen($plainText) <= $limit) {
        return $text; // Return the original text if within limit
    }

    // Truncate the plain text to the specified limit
    $truncatedText = mb_substr($plainText, 0, $limit);

    // Find the last space to avoid cutting words
    $lastSpace = strrpos($truncatedText, ' ');

    // Trim the truncated text to the last space
    $truncatedText = mb_substr($truncatedText, 0, $lastSpace);

    // Return the truncated text with an ellipsis and maintain HTML tags
    return $truncatedText . '...';
}

function isTrunctable(string $text, int $limit = 100) : bool
{
    // Strip out the HTML tags temporarily
    $plainText = strip_tags($text);

    // Check if the length exceeds the limit
    if (strlen($plainText) <= $limit)
        return false;

    return true;
}
function truncatePostAndRemoveImages(string $text, int $limit = 100) : string {
    $textWithoutFigures = preg_replace('/<figure class="image">.*?<\/figure>/is', '', $text);
    $textWithoutImages = preg_replace('/<img[^>]*>/i', '', $textWithoutFigures);

    return truncatePost($textWithoutImages, $limit);
}
function extractImagesSrc(string $content) : array
{
    $pattern = '/<img[^>]+src="([^">]+)"/i';

    preg_match_all($pattern, $content, $matches);
    $imageUrls = $matches[1];

    return $imageUrls;
}