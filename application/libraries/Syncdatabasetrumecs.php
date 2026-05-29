<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

use Google\Client;
use Google\Service\Sheets;
use Google\Service\Sheets\ValueRange;

class Syncdatabasetrumecs
{
    private $client;
    private $service;
    private $spreadsheetId;

    public function __construct()
    {
        $this->loadEnvFile();
        $credentialsPath = FCPATH . getenv('GOOGLE_SHEET_PATH_SYNC');

        if (!file_exists($credentialsPath)) {
            throw new Exception('Credentials file not found: ' . $credentialsPath);
        }

        $this->client = new Client();

        $this->client->setAuthConfig($credentialsPath);
        $this->client->addScope(Sheets::SPREADSHEETS);

        $this->service = new Sheets($this->client);
        $this->spreadsheetId = getenv('GOOGLE_SHEET_ID_SYNC');
    }
    private function loadEnvFile()
    {
        $envFile = FCPATH . '.env';
        if (file_exists($envFile)) {
            $lines = file($envFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
            foreach ($lines as $line) {
                if (strpos(trim($line), '#') === 0) continue; // Skip comments

                list($key, $value) = explode('=', $line, 2);
                $key = trim($key);
                $value = trim($value);

                // Remove quotes if present
                $value = trim($value, '"\'');

                if (!putenv("$key=$value")) {
                    $_ENV[$key] = $value;
                    $_SERVER[$key] = $value;
                }
            }
        }
    }

    public function read($sheet, $range)
    {
        try {
            $range = $sheet . '!' . $range;
            $response = $this->service->spreadsheets_values->get($this->spreadsheetId, $range);
            $values = $response->getValues();

            return $values ?: [];
        } catch (Exception $e) {
            log_message('error', 'Spreadsheet Read Error: ' . $e->getMessage());
            return false;
        }
    }

    public function readAll($sheet)
    {
        try {
            // Ambil semua data dari row 2 sampai kolom K
            $range = $sheet . '!A2:K';
            $response = $this->service->spreadsheets_values->get($this->spreadsheetId, $range);
            $values = $response->getValues();

            return $values ?: [];
        } catch (Exception $e) {
            log_message('error', 'Spreadsheet Read Error: ' . $e->getMessage());
            return false;
        }
    }

    public function write($sheet, $range, $value = [])
    {
        try {
            $range = $sheet . '!' . $range;

            if (!is_array($value)) {
                $values = [[$value]];
            } else {
                $values = is_array($value[0]) ? $value : [$value];
            }

            $body = new ValueRange([
                'values' => $values
            ]);

            $params = [
                'valueInputOption' => 'RAW'
            ];

            $response = $this->service->spreadsheets_values->update(
                $this->spreadsheetId,
                $range,
                $body,
                $params
            );

            return $response->getUpdatedCells();
        } catch (Exception $e) {
            log_message('error', 'Spreadsheet Write Error: ' . $e->getMessage());
            return false;
        }
    }

    public function uploadAllDataAdminToSheet($databases)
    {
        try {
            $headers = [
                'id',
                'email',
                'name',
                'password',
                'privileges',
                'billy',
                'phone',
                'trumecs_email',
                'whatsapp',
                'point',
                'created_at',
                'updated_at',
            ];

            $data = [];
            $data[] = $headers;

            foreach ($databases as $database) {
                $data[] = [
                    $database->id ?? 0,
                    $database->email ?? 'No Email',
                    $database->name ?? 'N/A',
                    $database->password ?? 'N/A',
                    $database->privileges ?? 0,
                    $database->billy ?? 'N/A',
                    $database->phone ?? 'Unknown',
                    $database->trumecs_email ?? 'No Email',
                    $database->whatsapp ?? 'Unknown',
                    $database->point ?? 0,
                    date('Y-m-d H:i:s', $database->created_at) ?? date('Y-m-d H:i:s'),
                    $database->updated_at ?? date('Y-m-d H:i:s'),
                ];
            }

            $range = 'admin' . '!A1:L';
            $body = new ValueRange([
                'values' => $data
            ]);

            $params = [
                'valueInputOption' => 'RAW'
            ];

            $response = $this->service->spreadsheets_values->update(
                $this->spreadsheetId,
                $range,
                $body,
                $params
            );

            return [
                'success' => true,
                'uploaded_rows' => count($databases),
                'updated_cells' => $response->getUpdatedCells()
            ];
        } catch (Exception $e) {
            return [
                'success' => false,
                'error' => $e->getMessage()
            ];
        }
    }

    public function getAllAdminFromSheet()
    {
        try {
            $range = 'admin' . '!A2:L';

            $response = $this->service->spreadsheets_values->get(
                $this->spreadsheetId,
                $range
            );

            $values = $response->getValues();

            if (empty($values)) {
                return [
                    'success' => true,
                    'message' => 'No data found in sheet',
                    'admins' => []
                ];
            }

            $admins = [];
            foreach ($values as $row) {
                if (count($row) >= 11 && !empty($row[0])) {
                    $updatedAt = $row[11] ?? date('Y-m-d H:i:s');
                    if (is_string($updatedAt) && !strtotime($updatedAt)) {
                        $updatedAt = date('Y-m-d H:i:s');
                    }

                    $admins[] = [
                        'id' => intval($row[0]),
                        'email' => $row[1] ?? 'No Email',
                        'name' => $row[2] ?? 'N/A',
                        'password' => $row[3] ?? 'N/A',
                        'privileges' => $row[4] ?? 0,
                        'billy' => $row[5] ?? 'N/A',
                        'phone' => $row[6] ?? 'Unknown',
                        'trumecs_email' => $row[7] ?? 'No Email',
                        'whatsapp' => $row[8] ?? 'Unknown',
                        'point' => intval($row[9] ?? 0),
                        'created_at' => intval(strtotime($row[10]) ?? null),
                        'updated_at' => $updatedAt
                    ];
                }
            }

            return [
                'success' => true,
                'admins' => $admins,
                'total_rows' => count($admins)
            ];
        } catch (Exception $e) {
            log_message('error', 'Get Admin From Sheet Error: ' . $e->getMessage());
            return [
                'success' => false,
                'error' => $e->getMessage()
            ];
        }
    }

    public function syncAdminFromSheetToDB()
    {
        try {
            $sheetData = $this->getAllAdminFromSheet();

            if (!$sheetData['success']) {
                throw new Exception('Failed to get data from sheet: ' . $sheetData['error']);
            }

            $sheetadmins = $sheetData['admins'];

            $ci = &get_instance();
            $ci->load->database();
            $dbAdmin = $ci->db->get('admin')->result_array();

            // Convert ke format yang mudah diakses
            $dbAdminMap = [];
            foreach ($dbAdmin as $admin) {
                $dbAdminMap[$admin['id']] = $admin;
            }

            $sheetadminsMap = [];
            $sheetadminIds = [];

            foreach ($sheetadmins as $admin) {
                $sheetadminsMap[$admin['id']] = $admin;
                $sheetadminIds[] = $admin['id'];
            }

            $stats = [
                'created' => 0,
                'updated' => 0,
                'deleted' => 0,
                'skipped' => 0,
                'total_sheet' => count($sheetadmins),
                'total_db_before' => count($dbAdmin)
            ];

            foreach ($sheetadmins as $sheetadmin) {
                $adminId = $sheetadmin['id'];

                if (empty($adminId) || $adminId == 0) {
                    $stats['skipped']++;
                    continue;
                }

                if (isset($dbAdminMap[$adminId])) {
                    $dbadmin = $dbAdminMap[$adminId];
                    $sheetUpdated = strtotime($sheetadmin['updated_at']);
                    $dbUpdated = $dbadmin['updated_at'];
                    if ($sheetUpdated > $dbUpdated) {

                        $ci->db->where('id', $adminId);
                        $ci->db->update('admin', [
                            'email' => $sheetadmin['email'],
                            'name' => $sheetadmin['name'],
                            'password' => $sheetadmin['password'],
                            'privileges' => $sheetadmin['privileges'],
                            'billy' => $sheetadmin['billy'],
                            'phone' => $sheetadmin['phone'],
                            'trumecs_email' => $sheetadmin['trumecs_email'],
                            'whatsapp' => $sheetadmin['whatsapp'],
                            'point' => $sheetadmin['point'],
                            'updated_at' => $sheetUpdated
                        ]);

                        if ($ci->db->affected_rows() > 0) {
                            $stats['updated']++;
                        }
                    } else {
                        $stats['skipped']++;
                    }
                } else {
                    // CREATE: admin ada di sheet tapi tidak ada di database
                    $ci->db->insert('admin', [
                        'id' => $adminId, // Insert dengan ID dari sheet
                        'email' => $sheetadmin['email'],
                        'name' => $sheetadmin['name'],
                        'password' => $sheetadmin['password'],
                        'privileges' => $sheetadmin['privileges'],
                        'billy' => $sheetadmin['billy'],
                        'phone' => $sheetadmin['phone'],
                        'trumecs_email' => $sheetadmin['trumecs_email'],
                        'whatsapp' => $sheetadmin['whatsapp'],
                        'point' => $sheetadmin['point'],
                        'created_at' => strtotime($sheetadmin['created_at']),
                        'updated_at' => strtotime($sheetadmin['updated_at'])
                    ]);

                    if ($ci->db->insert_id()) {
                        $stats['created']++;
                    }
                }
            }
            $dbadminIds = array_keys($dbAdminMap);
            $adminsToDelete = array_diff($dbadminIds, $sheetadminIds);

            if (!empty($adminsToDelete)) {
                $ci->db->where_in('id', $adminsToDelete);
                $ci->db->delete('admin');
                $stats['deleted'] = $ci->db->affected_rows();
            }

            $stats['total_db_after'] = $stats['total_db_before'] + $stats['created'] - $stats['deleted'];

            return [
                'success' => true,
                'message' => 'Sync completed successfully',
                'stats' => $stats
            ];
        } catch (Exception $e) {
            return [
                'success' => false,
                'error' => $e->getMessage()
            ];
        }
    }

    public function uploadAllDataArtikelToSheet($databases)
    {
        try {
            $headers = [
                'id',
                'title',
                'date',
                'img',
                'value',
                'url',
                'seo_key',
                'discription_seo',
                'tag',
                'view',
                'created_by',
                'title_en',
                'value_en',
                'url_en',
                'seo_key_en',
                'discription_seo_en',
                'tag_en',
                'title_ch',
                'value_ch',
                'url_ch',
                'seo_key_ch',
                'discription_seo_ch',
                'tag_ch',
                'memberId',
                'created_at',
                'updated_at',
                'updated_by',
                'display',
            ];

            $data = [];
            $data[] = $headers;

            foreach ($databases as $database) {
                $value_artikel = $database->value;
                $count_value = strlen($value_artikel);
                if ($count_value < 50000) {
                    $end_value = $value_artikel;
                } else {
                    $end_value = '';
                };
                $data[] = [
                    $database->id ?? 0,
                    $database->title ?? 'No Title',
                    $database->date ?? date('d/m/Y'),
                    $database->img ?? 'N/A',
                    $end_value ?? 0,
                    $database->url ?? 'N/A',
                    $database->seo_key ?? 'Unknown',
                    $database->discription_seo ?? 'Unknown',
                    $database->tag ?? 'Unknown',
                    $database->view ?? 0,
                    $database->created_by ?? 1,
                    $database->title_en ?? 'Unknown',
                    $database->value_en ?? 'Unknown',
                    $database->url_en ?? 'Unknown',
                    $database->seo_key_en ?? 'Unknown',
                    $database->discription_seo_en ?? 'Unknown',
                    $database->tag_en ?? 'Unknown',
                    $database->title_ch ?? 'Unknown',
                    $database->value_ch ?? 'Unknown',
                    $database->url_ch ?? 'Unknown',
                    $database->seo_key_ch ?? 'Unknown',
                    $database->discription_seo_ch ?? 'Unknown',
                    $database->tag_ch ?? 'Unknown',
                    $database->memberId ?? 1,
                    $database->created_at ?? date('Y-m-d H:i:s'),
                    $database->updated_at ?? date('Y-m-d H:i:s'),
                    $database->updated_by ?? 1,
                    $database->display ?? 0,
                ];
            }

            $range = 'artikel' . '!A1:AB';
            $body = new ValueRange([
                'values' => $data
            ]);

            $params = [
                'valueInputOption' => 'RAW'
            ];

            $response = $this->service->spreadsheets_values->update(
                $this->spreadsheetId,
                $range,
                $body,
                $params
            );

            return [
                'success' => true,
                'uploaded_rows' => count($databases),
                'updated_cells' => $response->getUpdatedCells()
            ];
        } catch (Exception $e) {
            return [
                'success' => false,
                'error' => $e->getMessage()
            ];
        }
    }

    public function getAllArtikelFromSheet()
    {
        try {
            $range = 'artikel' . '!A2:L';

            $response = $this->service->spreadsheets_values->get(
                $this->spreadsheetId,
                $range
            );

            $values = $response->getValues();

            if (empty($values)) {
                return [
                    'success' => true,
                    'message' => 'No data found in sheet',
                    'artikels' => []
                ];
            }

            $artikels = [];
            foreach ($values as $row) {
                if (count($row) >= 11 && !empty($row[0])) {
                    $updatedAt = $row[11] ?? date('Y-m-d H:i:s');
                    if (is_string($updatedAt) && !strtotime($updatedAt)) {
                        $updatedAt = date('Y-m-d H:i:s');
                    }

                    $artikels[] = [
                        'id' => intval($row[0]),
                        'title' => $row[1] ?? 'No Title',
                        'date' => $row[2] ?? date('d/m/Y'),
                        'img' => $row[3] ?? 'N/A',
                        'value' => $row[4] ?? 0,
                        'url' => $row[5] ?? 'N/A',
                        'seo_key' => $row[6] ?? 'Unknown',
                        'discription_seo' => $row[7] ?? 'Unknown',
                        'tag' => $row[8] ?? 'Unknown',
                        'view' => intval($row[9] ?? 0),
                        'created_by' => intval($row[10] ?? 1),
                        'title_en' => intval($row[11] ?? 'Unknown'),
                        'value_en' => intval($row[12] ?? 'Unknown'),
                        'url_en' => intval($row[13] ?? 'Unknown'),
                        'seo_key_en' => intval($row[14] ?? 'Unknown'),
                        'discription_seo_en' => intval($row[15] ?? 'Unknown'),
                        'tag_en' => intval($row[16] ?? 'Unknown'),
                        'title_ch' => intval($row[17] ?? 'Unknown'),
                        'value_ch' => intval($row[18] ?? 'Unknown'),
                        'url_ch' => intval($row[19] ?? 'Unknown'),
                        'seo_key_ch' => intval($row[20] ?? 'Unknown'),
                        'discription_seo_ch' => intval($row[21] ?? 'Unknown'),
                        'tag_ch' => intval($row[22] ?? 'Unknown'),
                        'memberId' => intval($row[23] ?? 1),
                        'created_at' => intval($row[24] ?? date('Y-m-d H:i:s')),
                        'updated_at' => intval($row[25] ?? date('Y-m-d H:i:s')),
                        'updated_by' => intval($row[26] ?? 1),
                        'display' => intval($row[27] ?? 0)
                    ];
                }
            }

            return [
                'success' => true,
                'artikels' => $artikels,
                'total_rows' => count($artikels)
            ];
        } catch (Exception $e) {
            log_message('error', 'Get artikel From Sheet Error: ' . $e->getMessage());
            return [
                'success' => false,
                'error' => $e->getMessage()
            ];
        }
    }

    public function syncArtikelFromSheetToDB()
    {
        try {
            $sheetData = $this->getAllArtikelFromSheet();

            if (!$sheetData['success']) {
                throw new Exception('Failed to get data from sheet: ' . $sheetData['error']);
            }

            $sheetartikels = $sheetData['artikels'];

            $ci = &get_instance();
            $ci->load->database();
            $dArtikel = $ci->db->get('artikel')->result_array();

            // Convert ke format yang mudah diakses
            $dArtikelMap = [];
            foreach ($dArtikel as $artikel) {
                $dArtikelMap[$artikel['id']] = $artikel;
            }

            $sheetartikelsMap = [];
            $sheetartikelIds = [];

            foreach ($sheetartikels as $artikel) {
                $sheetartikelsMap[$artikel['id']] = $artikel;
                $sheetartikelIds[] = $artikel['id'];
            }

            $stats = [
                'created' => 0,
                'updated' => 0,
                'deleted' => 0,
                'skipped' => 0,
                'total_sheet' => count($sheetartikels),
                'total_db_before' => count($dArtikel)
            ];

            foreach ($sheetartikels as $sheetartikel) {
                $artikelId = $sheetartikel['id'];

                if (empty($artikelId) || $artikelId == 0) {
                    $stats['skipped']++;
                    continue;
                }

                if (isset($dArtikelMap[$artikelId])) {
                    $dArtikel = $dArtikelMap[$artikelId];
                    $sheetUpdated = strtotime($sheetartikel['updated_at']);
                    $dbUpdated = $dArtikel['updated_at'];
                    if ($sheetUpdated > $dbUpdated) {

                        $ci->db->where('id', $artikelId);
                        $ci->db->update('artikel', [
                            'email' => $sheetartikel['email'],
                            'name' => $sheetartikel['name'],
                            'password' => $sheetartikel['password'],
                            'privileges' => $sheetartikel['privileges'],
                            'billy' => $sheetartikel['billy'],
                            'phone' => $sheetartikel['phone'],
                            'trumecs_email' => $sheetartikel['trumecs_email'],
                            'whatsapp' => $sheetartikel['whatsapp'],
                            'point' => $sheetartikel['point'],
                            'updated_at' => $sheetUpdated
                        ]);

                        if ($ci->db->affected_rows() > 0) {
                            $stats['updated']++;
                        }
                    } else {
                        $stats['skipped']++;
                    }
                } else {
                    // CREATE: artikel ada di sheet tapi tidak ada di database
                    $ci->db->insert('artikel', [
                        'id' => $artikelId, // Insert dengan ID dari sheet
                        'email' => $sheetartikel['email'],
                        'name' => $sheetartikel['name'],
                        'password' => $sheetartikel['password'],
                        'privileges' => $sheetartikel['privileges'],
                        'billy' => $sheetartikel['billy'],
                        'phone' => $sheetartikel['phone'],
                        'trumecs_email' => $sheetartikel['trumecs_email'],
                        'whatsapp' => $sheetartikel['whatsapp'],
                        'point' => $sheetartikel['point'],
                        'created_at' => strtotime($sheetartikel['created_at']),
                        'updated_at' => strtotime($sheetartikel['updated_at'])
                    ]);

                    if ($ci->db->insert_id()) {
                        $stats['created']++;
                    }
                }
            }
            $dArtikelIds = array_keys($dArtikelMap);
            $artikelsToDelete = array_diff($dArtikelIds, $sheetartikelIds);

            if (!empty($artikelsToDelete)) {
                $ci->db->where_in('id', $artikelsToDelete);
                $ci->db->delete('artikel');
                $stats['deleted'] = $ci->db->affected_rows();
            }

            $stats['total_db_after'] = $stats['total_db_before'] + $stats['created'] - $stats['deleted'];

            return [
                'success' => true,
                'message' => 'Sync completed successfully',
                'stats' => $stats
            ];
        } catch (Exception $e) {
            return [
                'success' => false,
                'error' => $e->getMessage()
            ];
        }
    }
}
