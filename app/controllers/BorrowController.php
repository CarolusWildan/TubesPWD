<?php


class BorrowController
{
    private mysqli $conn;
    private Borrow $borrowModel;

    public function __construct(mysqli $conn)
    {
        $this->conn = $conn;
        $this->borrowModel = new Borrow($this->conn);

        // Supaya response selalu JSON
        header('Content-Type: application/json; charset=utf-8');
    }

    // ==================================
    // GET: semua data peminjaman
    // route: ?controller=borrow&action=index
    // ==================================
    public function index(): void
    {
        $data = $this->borrowModel->getAll();

        echo json_encode([
            'status' => 'success',
            'data'   => $data,
        ]);
    }

    // ==================================
    // GET: detail peminjaman by id
    // route: ?controller=borrow&action=show&id=1
    // ==================================
    public function show(int $borrow_id): void
    {
        $borrow = $this->borrowModel->getById($borrow_id);

        if (!$borrow) {
            http_response_code(404);
            echo json_encode([
                'status'  => 'error',
                'message' => 'Borrow record not found',
            ]);
            return;
        }

        echo json_encode([
            'status' => 'success',
            'data'   => $borrow,
        ]);
    }

    // ==================================
    // POST: create peminjaman
    // route: ?controller=borrow&action=create
    // body: user_id, book_id, librarian_id, borrow_date, due_date
    // ==================================
    public function create(): void
    {
        
        $user_id      = $input['user_id']      ?? null;
        $book_id      = $input['book_id']      ?? null;
        $librarian_id = $input['librarian_id'] ?? null;
        $borrow_date  = $input['borrow_date']  ?? null;
        $due_date     = $input['due_date']     ?? null;

        // validasi simpel
        if (!$user_id || !$book_id || !$librarian_id || !$borrow_date || !$due_date) {
            http_response_code(400);
            echo json_encode([
                'status'  => 'error',
                'message' => 'All fields (user_id, book_id, librarian_id, borrow_date, due_date) are required',
            ]);
            return;
        }

        $success = $this->borrowModel->create(
            (int) $user_id,
            (int) $book_id,
            (int) $librarian_id,
            $borrow_date,
            $due_date
        );

        if (!$success) {
            http_response_code(400);
            echo json_encode([
                'status'  => 'error',
                'message' => 'Failed to create borrow (book may be already borrowed or not found)',
            ]);
            return;
        }

        echo json_encode([
            'status'  => 'success',
            'message' => 'Borrow created and book status updated to DIPINJAM',
        ]);
    }

    // ==================================
    // DELETE: hapus peminjaman
    // route: ?controller=borrow&action=delete&id=1
    // (optional) kamu bisa tambahkan update status buku di model kalau mau
    // ==================================
    public function delete(int $borrow_id): void
    {
        $success = $this->borrowModel->delete($borrow_id);

        if (!$success) {
            http_response_code(400);
            echo json_encode([
                'status'  => 'error',
                'message' => 'Failed to delete borrow record',
            ]);
            return;
        }

        echo json_encode([
            'status'  => 'success',
            'message' => 'Borrow record deleted',
        ]);
    }

    // ==================================
    // GET: semua peminjaman milik 1 user
    // route: ?controller=borrow&action=byUser&user_id=3
    // ==================================
    public function getByUser(int $user_id): void
    {
        $data = $this->borrowModel->getByUser($user_id);

        if(!$data){
            http_response_code(404);
            echo json_encode([
                'status'  => 'error',
                'message' => 'Borrow record not found',
            ]);
            return;
        }
        echo json_encode([
            'status' => 'success',
            'data'   => $data,
        ]);
    }

    public function getById(int $borrow_id): void
    {
        $data = $this->borrowModel->getById($borrow_id);

        if (!$data) {
            http_response_code(404);
            echo json_encode([
                'status'  => 'error',
                'message' => 'Borrow record not found',
            ]);
            return;
        }

        echo json_encode([
            'status' => 'success',
            'data'   => $data,
        ]);
    }
}
