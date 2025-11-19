<?php
namespace App\Controllers\Admin;

use App\Models\Ad;

class AdsAdminController
{
    public function index()
    {
        \requireRole(['admin']);
        $model = new Ad();
        $ads = $model->all();
        $stats = $model->getStats();
        \render('admin/ads-index', compact('ads', 'stats'));
    }

    public function create()
    {
        \requireRole(['admin']);
        \render('admin/ads-form', ['ad' => null]);
    }

    public function store()
    {
        \requireRole(['admin']);
        \csrf_check();

        $title = trim($_POST['title'] ?? '');
        $description = trim($_POST['description'] ?? '');
        $url = trim($_POST['url'] ?? '');
        $position = trim($_POST['position'] ?? 'sidebar');
        $status = trim($_POST['status'] ?? 'active');
        $start_date = trim($_POST['start_date'] ?? '');
        $end_date = trim($_POST['end_date'] ?? '');

        // Validation
        if (!$title || !$url) {
            $_SESSION['flash'] = ['type' => 'error', 'msg' => 'Titel und URL sind erforderlich.'];
            return redirect('/admin/ads/create');
        }

        // Upload image if provided
        $imagePath = null;
        if (!empty($_FILES['image']['name'])) {
            $imagePath = $this->uploadImage($_FILES['image']);
            if (!$imagePath) {
                $_SESSION['flash'] = ['type' => 'error', 'msg' => 'Fehler beim Hochladen des Bildes.'];
                return redirect('/admin/ads/create');
            }
        }

        $model = new Ad();
        $model->create([
            'title' => $title,
            'description' => $description ?: null,
            'url' => $url,
            'image_path' => $imagePath,
            'position' => $position,
            'status' => $status,
            'start_date' => $start_date ?: null,
            'end_date' => $end_date ?: null,
        ]);

        $_SESSION['flash'] = ['type' => 'success', 'msg' => 'Anzeige erfolgreich erstellt.'];
        return redirect('/admin/ads');
    }

    public function edit(int $id)
    {
        \requireRole(['admin']);
        $model = new Ad();
        $ad = $model->find($id);
        if (!$ad) {
            $_SESSION['flash'] = ['type' => 'error', 'msg' => 'Anzeige nicht gefunden.'];
            return redirect('/admin/ads');
        }
        \render('admin/ads-form', compact('ad'));
    }

    public function update(int $id)
    {
        \requireRole(['admin']);
        \csrf_check();

        $model = new Ad();
        $ad = $model->find($id);
        if (!$ad) {
            $_SESSION['flash'] = ['type' => 'error', 'msg' => 'Anzeige nicht gefunden.'];
            return redirect('/admin/ads');
        }

        $title = trim($_POST['title'] ?? '');
        $description = trim($_POST['description'] ?? '');
        $url = trim($_POST['url'] ?? '');
        $position = trim($_POST['position'] ?? 'sidebar');
        $status = trim($_POST['status'] ?? 'active');
        $start_date = trim($_POST['start_date'] ?? '');
        $end_date = trim($_POST['end_date'] ?? '');

        // Validation
        if (!$title || !$url) {
            $_SESSION['flash'] = ['type' => 'error', 'msg' => 'Titel und URL sind erforderlich.'];
            return redirect('/admin/ads/' . $id . '/edit');
        }

        // Keep existing image or upload new one
        $imagePath = $_POST['existing_image'] ?? null;
        if (!empty($_FILES['image']['name'])) {
            $newImage = $this->uploadImage($_FILES['image']);
            if ($newImage) {
                // Delete old image if exists
                if ($imagePath && file_exists(__DIR__ . '/../../../public/uploads/' . $imagePath)) {
                    unlink(__DIR__ . '/../../../public/uploads/' . $imagePath);
                }
                $imagePath = $newImage;
            }
        }

        $model->update($id, [
            'title' => $title,
            'description' => $description ?: null,
            'url' => $url,
            'image_path' => $imagePath,
            'position' => $position,
            'status' => $status,
            'start_date' => $start_date ?: null,
            'end_date' => $end_date ?: null,
        ]);

        $_SESSION['flash'] = ['type' => 'success', 'msg' => 'Anzeige aktualisiert.'];
        return redirect('/admin/ads');
    }

    public function destroy(int $id)
    {
        \requireRole(['admin']);
        \csrf_check();

        $model = new Ad();
        $ad = $model->find($id);
        if (!$ad) {
            $_SESSION['flash'] = ['type' => 'error', 'msg' => 'Anzeige nicht gefunden.'];
            return redirect('/admin/ads');
        }

        // Delete image if exists
        if ($ad['image_path'] && file_exists(__DIR__ . '/../../../public/uploads/' . $ad['image_path'])) {
            unlink(__DIR__ . '/../../../public/uploads/' . $ad['image_path']);
        }

        $model->delete($id);
        $_SESSION['flash'] = ['type' => 'success', 'msg' => 'Anzeige gelöscht.'];
        return redirect('/admin/ads');
    }

    /**
     * Upload image helper
     */
    private function uploadImage(array $file): ?string
    {
        $allowed = ['image/jpeg', 'image/png', 'image/webp', 'image/gif'];
        if (!in_array($file['type'], $allowed, true)) {
            return null;
        }

        if ($file['size'] > 5 * 1024 * 1024) { // 5MB max
            return null;
        }

        $ext = match ($file['type']) {
            'image/jpeg' => '.jpg',
            'image/png' => '.png',
            'image/webp' => '.webp',
            'image/gif' => '.gif',
            default => '.jpg'
        };

        $filename = 'ad_' . uniqid() . $ext;
        $uploadDir = __DIR__ . '/../../../public/uploads/';
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }

        if (move_uploaded_file($file['tmp_name'], $uploadDir . $filename)) {
            return $filename;
        }

        return null;
    }
}
