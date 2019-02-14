<?php

namespace Truehero;

interface ClientInterface
{
    public function domains(): array;
    public function inbox(string $email): object;
    public function mailbox(string $email): object;
    public function downloadFile(string $messageId, string $fileId, string $path);
}
