<?php


namespace App\Services;


interface ParserServiceInterface
{
    public function setUrl(string $url): self;
    public function parsing(): array;
}
