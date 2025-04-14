<?php

namespace App\Controllers;

use CodeIgniter\Controller;

use App\Models\M_sekretaris_unit;

class Sekretaris_kelola_unit extends BaseController
{
    protected $M_sekretaris_unit;

    public function __construct()
    {
        $this->M_sekretaris_unit = new M_sekretaris_unit();
    }

    public function index()
    {
        $data = [
            'title' => 'Daftar Unit Kerja',
            'title2' => 'Data Unit Kerja',
            'data_unit' => $this->M_sekretaris_unit->get_unit(),
            'isi' => 'sekretaris/data_unit/v_unit',
        ];
        return view('layout/v_wrapper', $data);
    }

    public function add()
    {
        $data = [
            'title' => 'Tambah Jadwal',
            'title2' => 'Data Jadwal',
            'data_unit' => $this->M_sekretaris_unit->get_unit(),
            'isi' => 'sekretaris/data_unit/v_add',
        ];
        return view('layout/v_wrapper', $data);
    }

    public function save()
    {
        if ($this->validate([
            'nama_unit' => [
                'label' => 'Nama Unit',
                'rules' => 'required',
                'errors' => ['required' => '{field} Wajib Diisi !!!']
            ],
        ])) {
            $data = [
                'nama_unit' => $this->request->getPost('nama_unit'),
            ];

            $this->M_sekretaris_unit->add($data);

            session()->setFlashdata('pesan', 'Data Unit Berhasil Ditambahkan!');
            return redirect()->to(base_url('sekretaris_kelola_unit'));
        } else {
            session()->setFlashdata('errors', \Config\Services::validation()->getErrors());
            return redirect()->to(base_url('sekretaris_kelola_unit/add'));
        }
    }
    public function edit($id_unit)
    {
        $data = [
            'title' => 'Edit Unit Kerja',
            'title2' => 'Data Unit Keja',
            'data_unit' => $this->M_sekretaris_unit->detailUnit($id_unit),
            'isi' => 'sekretaris/data_unit/v_edit',
        ];
        return view('layout/v_wrapper', $data);
    }

    public function update($id_unit)
    {
        $rules = [
            'nama_unit' => [
                'label' => 'Nama Unit',
                'rules' => 'required',
                'errors' => ['required' => '{field} Wajib Diisi!']
            ],
        
        ];

        if (!$this->validate($rules)) {
            session()->setFlashdata('errors', \Config\Services::validation()->getErrors());
            return redirect()->to(base_url('sekretaris_kelola_unit/edit/' . $id_unit));
        }

        // Ambil data lama
        $data_unit = $this->M_sekretaris_unit->detailUnit($id_unit);

        $data = [
            'id_unit' => $id_unit,
            'nama_unit' => $this->request->getPost('nama_unit'),
        ];

        // Update data di database
        $this->M_sekretaris_unit->edit($data);

        session()->setFlashdata('pesan', 'Data Unit Berhasil Diupdate!');
        return redirect()->to(base_url('sekretaris_kelola_unit'));
    }

    public function data_dihapus()
    {
        $data = [
            'title' => 'Daftar Unit Dihapus',
            'title2' => 'Data Unit Dihapus',
            'data_unit_dihapus' => $this->M_sekretaris_unit->get_unit_dihapus(), // Ambil data produk yang sudah dihapus
            'isi' => 'sekretaris/data_unit/v_data_dihapus',// Ganti dengan view yang sesuai
        ];
        return view('layout/v_wrapper', $data);
    }

    public function delete($id_unit)
    {
        // Soft delete produk, menandai produk sebagai terhapus
        $this->M_sekretaris_unit->update($id_unit, ['deleted_at' => 1]);
        return redirect()->to(base_url('sekretaris_kelola_unit'))->with('pesan', 'Data Unit Ini berhasil dihapus !');
    }

    public function restore($id_unit)
    {
        // Restore produk yang telah dihapus
        $this->M_sekretaris_unit->update($id_unit, ['deleted_at' => 0]);
        return redirect()->to(base_url('sekretaris_kelola_unit'))->with('pesan', 'Data Unit Ini berhasil direstore !');
    }

    public function backup_db()
    {
        // Data untuk view
        $data = [
            'title' => 'Data Backup Database',
            'title2' => 'Backup Database',
            'isi' => 'sekretaris/data_website/v_backup',  // View yang akan digunakan
        ];

        // Menampilkan view dengan data yang telah disiapkan
        return view('layout/v_wrapper', $data);
    }

    // Method untuk memproses backup database
    public function proses_db()
    {
        // Tentukan lokasi penyimpanan file backup
        $backupPath = WRITEPATH . 'backup/';
        if (!is_dir($backupPath)) {
            mkdir($backupPath, 0777, true); // Membuat folder backup jika belum ada
        }

        $backupFile = $backupPath . 'backup_' . date('Y-m-d_H-i-s') . '.sql'; // Nama file backup dengan timestamp

        try {
            // Mengambil koneksi database dari konfigurasi CodeIgniter
            $db = \Config\Database::connect();

            // Query untuk mengambil semua tabel
            $tablesResult = $db->query('SHOW TABLES');

            if (!$tablesResult) {
                // Jika gagal mengambil tabel, tampilkan pesan error
                session()->setFlashdata('error', 'Gagal mengambil tabel dari database.');
                return redirect()->to(base_url('sekretaris_kelola_unit/backup_db'));
            }

            // Mulai menulis file backup
            $backupData = "-- phpMyAdmin SQL Dump\n";
            $backupData .= "-- version 5.2.0\n";
            $backupData .= "-- https://www.phpmyadmin.net/\n\n";
            $backupData .= "-- Host: " . $_SERVER['SERVER_ADDR'] . "\n";
            $backupData .= "-- Generation Time: " . date('Y-m-d H:i:s') . "\n";
            $backupData .= "-- PHP Version: " . phpversion() . "\n\n";
            $backupData .= "SET SQL_MODE = \"NO_AUTO_VALUE_ON_ZERO\";\n";
            $backupData .= "START TRANSACTION;\n";
            $backupData .= "SET time_zone = \"+00:00\";\n\n";
            $backupData .= "/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;\n";
            $backupData .= "/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;\n";
            $backupData .= "/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;\n";
            $backupData .= "/*!40101 SET NAMES utf8mb4 */;\n\n";

            // Menentukan nama database
            $backupData .= "-- Database: " . $db->getDatabase() . "\n\n";

            // Loop untuk mengambil data dari setiap tabel
            foreach ($tablesResult->getResultArray() as $row) {
                // Ambil nama tabel dari hasil query
                $tableName = $row['Tables_in_' . $db->getDatabase()];

                // Menambahkan query untuk menghapus tabel jika sudah ada
                $backupData .= "DROP TABLE IF EXISTS `$tableName`;\n";

                // Menyertakan definisi tabel
                $createTableResult = $db->query("SHOW CREATE TABLE `$tableName`");
                if ($createTableResult) {
                    $createTableRow = $createTableResult->getRowArray();
                    $backupData .= $createTableRow['Create Table'] . ";\n\n";
                }

                // Menambahkan data tabel
                $dataResult = $db->query("SELECT * FROM `$tableName`");
                if ($dataResult->getNumRows() > 0) {
                    $columns = array_keys($dataResult->getRowArray()); // Ambil kolom tabel
                    $backupData .= "INSERT INTO `$tableName` (`" . implode('`, `', $columns) . "`) VALUES\n";
                    $rowCount = 0;
                    foreach ($dataResult->getResultArray() as $dataRow) {
                        $values = array_map(function ($value) use ($db) {
                            return $db->escape($value);  // Menggunakan escape untuk nilai
                        }, array_values($dataRow));
                        $backupData .= "    (" . implode(", ", $values) . ")";
                        $rowCount++;
                        if ($rowCount < $dataResult->getNumRows()) {
                            $backupData .= ",\n";
                        } else {
                            $backupData .= ";\n\n";
                        }
                    }
                }
            }

            // Akhirkan transaksi dan pengaturan SQL
            $backupData .= "COMMIT;\n";

            // Simpan data ke dalam file backup
            file_put_contents($backupFile, $backupData);

            // Simpan pesan sukses
            session()->setFlashdata('success', 'Backup database berhasil disimpan di folder backup.');
            return redirect()->to(base_url('sekretaris_kelola_unit/backup_db'));
        } catch (\Exception $e) {
            // Jika terjadi kesalahan, tampilkan pesan error
            session()->setFlashdata('error', 'Terjadi kesalahan: ' . $e->getMessage());
            return redirect()->to(base_url('sekretaris_kelola_unit/backup_db'));
        }
    }

}
