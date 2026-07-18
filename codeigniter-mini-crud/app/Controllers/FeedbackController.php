<?php

class FeedbackController extends Controller
{
    private FeedbackModel $feedback;

    public function __construct()
    {
        $this->feedback = new FeedbackModel();
    }

    public function form(): void
    {
        $errors = $_SESSION['errors'] ?? [];
        if (!$errors) {
            clear_old();
        }

        $this->view('public/feedback', [
            'title' => 'Kirim Feedback',
            'errors' => $errors,
        ]);
        unset($_SESSION['errors']);
    }

    public function store(): void
    {
        $errors = $this->validateFeedback($_POST);

        if ($errors) {
            $_SESSION['errors'] = $errors;
            keep_old($_POST);
            redirect('feedback');
        }

        $this->feedback->create($_POST);
        clear_old();
        flash('success', 'Feedback berhasil dikirim. Terima kasih!');
        redirect('feedback');
    }
}
