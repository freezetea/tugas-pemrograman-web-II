<?php

class AdminController extends Controller
{
    private ArticleModel $articles;
    private FeedbackModel $feedback;

    public function __construct()
    {
        $this->articles = new ArticleModel();
        $this->feedback = new FeedbackModel();
    }

    public function dashboard(): void
    {
        $articles = $this->articles->all();
        $feedback = $this->feedback->all();

        $this->view('admin/dashboard', [
            'title' => 'Dashboard',
            'articleCount' => count($articles),
            'feedbackCount' => count($feedback),
            'latestArticles' => array_slice($articles, 0, 5),
            'latestFeedback' => array_slice($feedback, 0, 5),
        ]);
    }

    public function articles(): void
    {
        $this->view('admin/articles/index', [
            'title' => 'Daftar Artikel',
            'articles' => $this->articles->all(),
        ]);
    }

    public function createArticle(): void
    {
        $errors = $_SESSION['errors'] ?? [];
        if (!$errors) {
            clear_old();
        }

        $this->view('admin/articles/form', [
            'title' => 'Tambah Artikel',
            'action' => base_url('admin/articles/store'),
            'article' => null,
            'errors' => $errors,
        ]);
        unset($_SESSION['errors']);
    }

    public function storeArticle(): void
    {
        $errors = $this->validateArticle($_POST);

        if ($errors) {
            $_SESSION['errors'] = $errors;
            keep_old($_POST);
            redirect('admin/articles/create');
        }

        $this->articles->create($_POST);
        clear_old();
        flash('success', 'Artikel berhasil ditambahkan.');
        redirect('admin/articles');
    }

    public function editArticle(int $id): void
    {
        $article = $this->articles->find($id);

        if (!$article) {
            flash('error', 'Artikel tidak ditemukan.');
            redirect('admin/articles');
        }

        $errors = $_SESSION['errors'] ?? [];
        if (!$errors) {
            clear_old();
        }

        $this->view('admin/articles/form', [
            'title' => 'Edit Artikel',
            'action' => base_url('admin/articles/update&id=' . $id),
            'article' => $article,
            'errors' => $errors,
        ]);
        unset($_SESSION['errors']);
    }

    public function updateArticle(int $id): void
    {
        if (!$this->articles->find($id)) {
            flash('error', 'Artikel tidak ditemukan.');
            redirect('admin/articles');
        }

        $errors = $this->validateArticle($_POST);

        if ($errors) {
            $_SESSION['errors'] = $errors;
            keep_old($_POST);
            redirect('admin/articles/edit&id=' . $id);
        }

        $this->articles->update($id, $_POST);
        clear_old();
        flash('success', 'Artikel berhasil diperbarui.');
        redirect('admin/articles');
    }

    public function deleteArticle(int $id): void
    {
        if (!$this->articles->find($id)) {
            flash('error', 'Artikel tidak ditemukan.');
            redirect('admin/articles');
        }

        $this->articles->delete($id);
        flash('success', 'Artikel berhasil dihapus.');
        redirect('admin/articles');
    }

    public function feedback(): void
    {
        $this->view('admin/feedback/index', [
            'title' => 'Feedback Pengguna',
            'feedback' => $this->feedback->all(),
        ]);
    }
}
