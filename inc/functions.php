<?php
function renderError(string $message, int $statusCode): void
{
    echo json_encode($message);
    http_response_code($statusCode);
}
