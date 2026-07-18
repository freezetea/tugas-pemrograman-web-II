<?php

class ArticleModel extends BaseModel
{
    public function countAll(): int
    {
        return count($this->readStorage()['articles']);
    }

    public function all(): array
    {
        return $this->sortNewest($this->readStorage()['articles']);
    }

    public function find(int $id): ?array
    {
        foreach ($this->readStorage()['articles'] as $article) {
            if ((int) $article['id'] === $id) {
                return $article;
            }
        }

        return null;
    }

    public function create(array $data): void
    {
        $storage = $this->readStorage();
        $now = date('Y-m-d H:i:s');
        $id = (int) $storage['next_article_id'];

        $storage['articles'][] = [
            'id' => $id,
            'title' => trim($data['title']),
            'content' => trim($data['content'] ?? ''),
            'status' => trim($data['status']),
            'created_at' => $now,
            'updated_at' => $now,
        ];
        $storage['next_article_id'] = $id + 1;

        $this->writeStorage($storage);
    }

    public function update(int $id, array $data): void
    {
        $storage = $this->readStorage();

        foreach ($storage['articles'] as &$article) {
            if ((int) $article['id'] === $id) {
                $article['title'] = trim($data['title']);
                $article['content'] = trim($data['content'] ?? '');
                $article['status'] = trim($data['status']);
                $article['updated_at'] = date('Y-m-d H:i:s');
                break;
            }
        }
        unset($article);

        $this->writeStorage($storage);
    }

    public function delete(int $id): void
    {
        $storage = $this->readStorage();
        $storage['articles'] = array_values(array_filter(
            $storage['articles'],
            fn ($article) => (int) $article['id'] !== $id
        ));

        $this->writeStorage($storage);
    }
}
