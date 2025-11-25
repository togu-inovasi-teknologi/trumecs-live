<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

use Google\Client;
use Google\Service\Sheets;
use Google\Service\Sheets\ValueRange;

class Spreadsheetapi
{
    private $client;
    private $service;
    private $spreadsheetId;

    public function __construct()
    {
        $this->loadEnvFile();
        $credentialsPath = FCPATH . getenv('GOOGLE_SHEET_PATH');

        if (!file_exists($credentialsPath)) {
            throw new Exception('Credentials file not found: ' . $credentialsPath);
        }

        $this->client = new Client();

        $this->client->setAuthConfig($credentialsPath);
        $this->client->addScope(Sheets::SPREADSHEETS);

        $this->service = new Sheets($this->client);
        $this->spreadsheetId = getenv('GOOGLE_SHEET_ID');
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

            // Handle single value or array
            if (!is_array($value)) {
                $values = [[$value]];
            } else {
                // Ensure it's 2D array
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

    // Method untuk testing
    public function testConnection()
    {
        try {
            $response = $this->service->spreadsheets->get($this->spreadsheetId);
            return [
                'success' => true,
                'title' => $response->getProperties()->getTitle()
            ];
        } catch (Exception $e) {
            return [
                'success' => false,
                'error' => $e->getMessage()
            ];
        }
    }

    public function uploadAllProductsToSheet($sheet, $products)
    {
        try {
            $headers = [
                'ID',
                'Title',
                'Part Number',
                'SKU Number',
                'Stock',
                'Unit',
                'Description',
                'Price',
                'Status',
                'Store ID',
                'Updated At'
            ];

            $data = [];
            $data[] = $headers;

            foreach ($products as $product) {
                $data[] = [
                    $product->id ?? 0,
                    $product->tittle ?? 'No Title',
                    $product->partnumber ?? 'N/A',
                    $product->sku_number ?? 'N/A',
                    $product->stock ?? 0,
                    $product->unit ?? 'pcs',
                    $product->description ?? 'No Description',
                    $product->price ?? 0,
                    $product->status ?? 'Unknown',
                    $product->store_id ?? 0,
                    $product->updated_at ?? date('Y-m-d H:i:s')
                ];
            }

            $range = $sheet . '!A1:K';
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
                'uploaded_rows' => count($products),
                'updated_cells' => $response->getUpdatedCells()
            ];
        } catch (Exception $e) {
            log_message('error', 'Upload Products Error: ' . $e->getMessage());
            return [
                'success' => false,
                'error' => $e->getMessage()
            ];
        }
    }

    public function getAllProductsFromSheet($sheet)
    {
        try {
            $range = $sheet . '!A2:K'; // Mulai dari row 2 untuk menghindari header

            $response = $this->service->spreadsheets_values->get(
                $this->spreadsheetId,
                $range
            );

            $values = $response->getValues();

            if (empty($values)) {
                return [
                    'success' => true,
                    'message' => 'No data found in sheet',
                    'products' => []
                ];
            }

            $products = [];
            foreach ($values as $row) {
                // Pastikan row memiliki minimal data yang diperlukan
                if (count($row) >= 11 && !empty($row[0])) { // Skip row dengan ID kosong
                    // Format updated_at ke timestamp yang konsisten
                    $updatedAt = $row[10] ?? date('Y-m-d H:i:s');
                    if (is_string($updatedAt) && !strtotime($updatedAt)) {
                        $updatedAt = date('Y-m-d H:i:s');
                    }

                    $products[] = [
                        'id' => intval($row[0]),
                        'tittle' => $row[1] ?? 'No Title',
                        'partnumber' => $row[2] ?? 'N/A',
                        'sku_number' => $row[3] ?? 'N/A',
                        'stock' => intval($row[4] ?? 0),
                        'unit' => $row[5] ?? 'pcs',
                        'description' => $row[6] ?? 'No Description',
                        'price' => $row[7] ?? 0,
                        'status' => $row[8] ?? 'Unknown',
                        'store_id' => intval($row[9] ?? 0),
                        'updated_at' => $updatedAt
                    ];
                }
            }

            return [
                'success' => true,
                'products' => $products,
                'total_rows' => count($products)
            ];
        } catch (Exception $e) {
            log_message('error', 'Get Products From Sheet Error: ' . $e->getMessage());
            return [
                'success' => false,
                'error' => $e->getMessage()
            ];
        }
    }

    public function syncProductsFromSheetToDB($sheet)
    {
        try {
            // 1. Ambil data dari Google Sheet
            $sheetData = $this->getAllProductsFromSheet($sheet);

            if (!$sheetData['success']) {
                throw new Exception('Failed to get data from sheet: ' . $sheetData['error']);
            }

            $sheetProducts = $sheetData['products'];

            // 2. Ambil semua data dari database
            $ci = &get_instance();
            $ci->load->database();
            $dbProducts = $ci->db->get('product')->result_array();

            // Convert ke format yang mudah diakses
            $dbProductsMap = [];
            foreach ($dbProducts as $product) {
                $dbProductsMap[$product['id']] = $product;
            }

            $sheetProductsMap = [];
            $sheetProductIds = [];

            foreach ($sheetProducts as $product) {
                $sheetProductsMap[$product['id']] = $product;
                $sheetProductIds[] = $product['id'];
            }

            $stats = [
                'created' => 0,
                'updated' => 0,
                'deleted' => 0,
                'skipped' => 0,
                'total_sheet' => count($sheetProducts),
                'total_db_before' => count($dbProducts)
            ];

            // 3. PROCESS UPDATE & CREATE
            foreach ($sheetProducts as $sheetProduct) {
                $productId = $sheetProduct['id'];

                // Skip jika ID = 0 atau kosong (baris baru tanpa ID)
                if (empty($productId) || $productId == 0) {
                    $stats['skipped']++;
                    continue;
                }

                if (isset($dbProductsMap[$productId])) {
                    // UPDATE: Cek jika updated_at di sheet lebih baru
                    $dbProduct = $dbProductsMap[$productId];
                    $sheetUpdated = strtotime($sheetProduct['updated_at']);
                    $dbUpdated = strtotime($dbProduct['updated_at']);

                    if ($sheetUpdated > $dbUpdated) {
                        // Update database dengan data dari sheet
                        $ci->db->where('id', $productId);
                        $ci->db->update('product', [
                            'tittle' => $sheetProduct['tittle'],
                            'partnumber' => $sheetProduct['partnumber'],
                            'sku_number' => $sheetProduct['sku_number'],
                            'stock' => $sheetProduct['stock'],
                            'unit' => $sheetProduct['unit'],
                            'description' => $sheetProduct['description'],
                            'price' => $sheetProduct['price'],
                            'status' => $sheetProduct['status'],
                            'store_id' => $sheetProduct['store_id'],
                            'updated_at' => $sheetProduct['updated_at']
                        ]);

                        if ($ci->db->affected_rows() > 0) {
                            $stats['updated']++;
                        }
                    } else {
                        $stats['skipped']++;
                    }
                } else {
                    // CREATE: Product ada di sheet tapi tidak ada di database
                    $ci->db->insert('product', [
                        'id' => $productId, // Insert dengan ID dari sheet
                        'tittle' => $sheetProduct['tittle'],
                        'partnumber' => $sheetProduct['partnumber'],
                        'sku_number' => $sheetProduct['sku_number'],
                        'stock' => $sheetProduct['stock'],
                        'unit' => $sheetProduct['unit'],
                        'description' => $sheetProduct['description'],
                        'price' => $sheetProduct['price'],
                        'status' => $sheetProduct['status'],
                        'store_id' => $sheetProduct['store_id'],
                        'created_at' => $sheetProduct['updated_at'],
                        'updated_at' => $sheetProduct['updated_at']
                    ]);

                    if ($ci->db->insert_id()) {
                        $stats['created']++;
                    }
                }
            }

            // 4. PROCESS DELETE: Cek product yang ada di database tapi tidak ada di sheet
            $dbProductIds = array_keys($dbProductsMap);
            $productsToDelete = array_diff($dbProductIds, $sheetProductIds);

            if (!empty($productsToDelete)) {
                $ci->db->where_in('id', $productsToDelete);
                $ci->db->delete('product');
                $stats['deleted'] = $ci->db->affected_rows();
            }

            // 5. Hitung total setelah sync
            $stats['total_db_after'] = $stats['total_db_before'] + $stats['created'] - $stats['deleted'];

            return [
                'success' => true,
                'message' => 'Sync completed successfully',
                'stats' => $stats
            ];
        } catch (Exception $e) {
            log_message('error', 'Sync Products Error: ' . $e->getMessage());
            return [
                'success' => false,
                'error' => $e->getMessage()
            ];
        }
    }
}
