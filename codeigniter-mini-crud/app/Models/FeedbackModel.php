<?php

class FeedbackModel extends BaseModel
{
    public function countAll(): int
    {
        return count($this->readStorage()['feedback']);
    }

    public function all(): array
    {
        return $this->sortNewest($this->readStorage()['feedback']);
    }

    public function create(array $data): void
    {
        $storage = $this->readStorage();
        $id = (int) $storage['next_feedback_id'];

        $storage['feedback'][] = [
            'id' => $id,
            'name' => trim($data['name']),
            'email' => trim($data['email']),
            'message' => trim($data['message']),
            'created_at' => date('Y-m-d H:i:s'),
        ];
        $storage['next_feedback_id'] = $id + 1;

        $this->writeStorage($storage);
    }
}
