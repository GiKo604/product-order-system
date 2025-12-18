<?php

class Status
{
    private PDO $db;

    public function __construct()
    {
        $this->db = Database::getConnection();
    }

    // Approval statuses
    public function getApprovalStatuses(): array
    {
        $stmt = $this->db->query("SELECT id, name FROM approval_statuses ORDER BY id");
        return $stmt->fetchAll();
    }

    public function getApprovalStatusById(int $id): ?array
    {
        $stmt = $this->db->prepare("SELECT id, name FROM approval_statuses WHERE id = ?");
        $stmt->execute([$id]);
        $row = $stmt->fetch();
        return $row ?: null;
    }

    // Order statuses
    public function getOrderStatuses(): array
    {
        $stmt = $this->db->query("SELECT id, name FROM order_statuses ORDER BY id");
        return $stmt->fetchAll();
    }

    public function getOrderStatusById(int $id): ?array
    {
        $stmt = $this->db->prepare("SELECT id, name FROM order_statuses WHERE id = ?");
        $stmt->execute([$id]);
        $row = $stmt->fetch();
        return $row ?: null;
    }
}
