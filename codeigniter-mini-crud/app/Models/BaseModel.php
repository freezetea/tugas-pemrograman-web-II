<?php

abstract class BaseModel
{
    protected function readStorage(): array
    {
        $path = storage_path();

        if (!is_file($path) || filesize($path) === 0) {
            $data = default_storage();
            $this->writeStorage($data);
            return $data;
        }

        $json = file_get_contents($path);
        $data = json_decode((string) $json, true);

        if (!is_array($data)) {
            $data = default_storage();
            $this->writeStorage($data);
        }

        $data += [
            'next_article_id' => 1,
            'next_feedback_id' => 1,
            'articles' => [],
            'feedback' => [],
        ];

        return $data;
    }

    protected function writeStorage(array $data): void
    {
        file_put_contents(storage_path(), json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES), LOCK_EX);
    }

    protected function sortNewest(array $rows): array
    {
        usort($rows, fn ($a, $b) => ($b['id'] ?? 0) <=> ($a['id'] ?? 0));

        return $rows;
    }
}
