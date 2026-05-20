<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

use Google\Client;
use Google\Service\Sheets;
use Google\Service\Sheets\ValueRange;

class Dataproductlmp
{
    private $client;
    private $service;
    private $spreadsheetId;

    public function __construct()
    {
        $this->loadEnvFile();
        $credentialsPath = FCPATH . getenv('GOOGLE_SHEET_PATH_LMP');

        if (!file_exists($credentialsPath)) {
            throw new Exception('Credentials file not found: ' . $credentialsPath);
        }

        $this->client = new Client();

        $this->client->setAuthConfig($credentialsPath);
        $this->client->addScope(Sheets::SPREADSHEETS);

        $this->service = new Sheets($this->client);
        $this->spreadsheetId = getenv('GOOGLE_SHEET_ID_LMP');
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
            $range = $sheet . '!A2:K';

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
            $sheetData = $this->getAllProductsFromSheet($sheet);

            if (!$sheetData['success']) {
                throw new Exception('Failed to get data from sheet: ' . $sheetData['error']);
            }

            $sheetProducts = $sheetData['products'];

            $ci = &get_instance();
            $ci->load->database();
            $dbProducts = $ci->db->get('product')->result_array();

            // Convert ke map berdasarkan ID
            $dbProductsMap = [];
            foreach ($dbProducts as $product) {
                $dbProductsMap[$product['id']] = $product;
            }

            $sheetProductsMap = [];
            foreach ($sheetProducts as $product) {
                $sheetProductsMap[$product['id']] = $product;
            }

            $sheetProductIds = array_keys($sheetProductsMap);
            $dbProductIds = array_keys($dbProductsMap);

            $stats = [
                'updated_db_from_sheet' => 0,
                'updated_sheet_from_db' => 0,
                'created_in_sheet' => 0,
                'deleted_from_sheet' => 0,
                'skipped' => 0,
                'total_sheet' => count($sheetProducts),
                'total_db_before' => count($dbProducts)
            ];

            $commonIds = array_intersect($sheetProductIds, $dbProductIds);

            foreach ($commonIds as $id) {
                $sheetProduct = $sheetProductsMap[$id];
                $dbProduct = $dbProductsMap[$id];

                $sheetUpdated = strtotime($sheetProduct['updated_at']);
                $dbUpdated = strtotime($dbProduct['updated_at']);

                if ($sheetUpdated > $dbUpdated) {
                    // Sheet lebih baru -> UPDATE DATABASE
                    $ci->db->where('id', $id);
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
                    $stats['updated_db_from_sheet']++;
                } elseif ($dbUpdated > $sheetUpdated) {
                    // Database lebih baru -> UPDATE SHEET
                    $this->updateProductToSheet($id, $dbProduct);
                    $stats['updated_sheet_from_db']++;
                } else {
                    $stats['skipped']++;
                }
            }

            $onlyInDb = array_diff($dbProductIds, $sheetProductIds);

            foreach ($onlyInDb as $id) {
                $dbProduct = $dbProductsMap[$id];
                $this->insertProductToSheet($dbProduct);
                $stats['created_in_sheet']++;
            }

            $onlyInSheet = array_diff($sheetProductIds, $dbProductIds);

            foreach ($onlyInSheet as $id) {
                $this->deleteProductFromSheet($id);
                $stats['deleted_from_sheet']++;
            }

            $stats['total_db_after'] = $ci->db->count_all('product');

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

    // Fungsi untuk insert produk baru ke sheet
    private function insertProductToSheet($product)
    {
        try {
            $range = 'data-product!A:A';
            $response = $this->service->spreadsheets_values->get(
                $this->spreadsheetId,
                $range
            );

            $values = $response->getValues();
            $newRowIndex = count($values) + 1;
            $insertRange = 'data-product!A' . $newRowIndex . ':K' . $newRowIndex;
            $body = new ValueRange([
                'values' => [[
                    $product['id'],
                    $product['tittle'],
                    $product['partnumber'],
                    $product['sku_number'],
                    $product['stock'],
                    $product['unit'],
                    $product['description'],
                    $product['price'],
                    $product['status'],
                    $product['store_id'],
                    date('Y-m-d H:i:s') // updated_at sekarang
                ]]
            ]);

            $this->service->spreadsheets_values->update(
                $this->spreadsheetId,
                $insertRange,
                $body,
                ['valueInputOption' => 'RAW']
            );

            return true;
        } catch (Exception $e) {
            log_message('error', 'Insert Product To Sheet Error: ' . $e->getMessage());
            return false;
        }
    }

    private function updateProductToSheet($id, $product)
    {
        try {

            $range = 'data-product!A:K';
            $response = $this->service->spreadsheets_values->get(
                $this->spreadsheetId,
                $range
            );

            $values = $response->getValues();
            $rowIndex = null;

            foreach ($values as $index => $row) {
                if (!empty($row) && intval($row[0]) === $id) {
                    $rowIndex = $index + 1;
                    break;
                }
            }

            if ($rowIndex) {
                // Update baris yang ada
                $updateRange = 'data-product!A' . $rowIndex . ':K' . $rowIndex;
                $body = new ValueRange([
                    'values' => [[
                        $product['id'],
                        $product['tittle'],
                        $product['partnumber'],
                        $product['sku_number'],
                        $product['stock'],
                        $product['unit'],
                        $product['description'],
                        $product['price'],
                        $product['status'],
                        $product['store_id'],
                        date('Y-m-d H:i:s') // updated_at sekarang
                    ]]
                ]);

                $this->service->spreadsheets_values->update(
                    $this->spreadsheetId,
                    $updateRange,
                    $body,
                    ['valueInputOption' => 'RAW']
                );
            }

            return true;
        } catch (Exception $e) {
            log_message('error', 'Update Product To Sheet Error: ' . $e->getMessage());
            return false;
        }
    }

    private function deleteProductFromSheet($id)
    {
        try {
            $range = 'data-product!A:K';
            $response = $this->service->spreadsheets_values->get(
                $this->spreadsheetId,
                $range
            );

            $values = $response->getValues();
            $rowIndex = null;

            foreach ($values as $index => $row) {
                if (!empty($row) && intval($row[0]) === $id) {
                    $rowIndex = $index;
                    break;
                }
            }

            if ($rowIndex !== null) {
                $spreadsheet = $this->service->spreadsheets->get($this->spreadsheetId);
                $sheetId = null;

                foreach ($spreadsheet->getSheets() as $sheet) {
                    if ($sheet->getProperties()->getTitle() == 'data-product') {
                        $sheetId = $sheet->getProperties()->getSheetId();
                        break;
                    }
                }

                if (!$sheetId) {
                    throw new Exception('Sheet data-product not found');
                }

                // Hapus baris menggunakan batchUpdate
                $batchUpdateRequest = new Google_Service_Sheets_BatchUpdateSpreadsheetRequest([
                    'requests' => [
                        new Google_Service_Sheets_Request([
                            'deleteDimension' => new Google_Service_Sheets_DeleteDimensionRequest([
                                'range' => new Google_Service_Sheets_DimensionRange([
                                    'sheetId' => $sheetId,
                                    'dimension' => 'ROWS',
                                    'startIndex' => $rowIndex,
                                    'endIndex' => $rowIndex + 1
                                ])
                            ])
                        ])
                    ]
                ]);

                $this->service->spreadsheets->batchUpdate(
                    $this->spreadsheetId,
                    $batchUpdateRequest
                );

                return true;
            }

            return false;
        } catch (Exception $e) {
            log_message('error', 'Delete Product From Sheet Error: ' . $e->getMessage());
            return false;
        }
    }
}
