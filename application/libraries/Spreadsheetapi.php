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
                'Physic Number',
                'Quality',
                'Stock',
                'MOQ',
                'Price',
                'Price Promo',
                'Price Big Sale',
                'Img',
                'Promo',
                'Categori',
                'Jenis Product',
                'Part Number Trumecs',
                'Price Old',
                'Made',
                'Warranty',
                'Unit',
                'Warranty Vendor',
                'Livetime',
                'Dimention',
                'Packagin',
                'Weight',
                'Description',
                'View',
                'SX',
                'SY',
                'SZ',
                'PX',
                'PY',
                'PZ',
                'Brand',
                'Type',
                'Component',
                'Status',
                'Avaibility At',
                'Estimated Delivery',
                'Estimated Delivery Indent',
                'PPN',
                'Link Tokped',
                'Link Bukalapak',
                'Link Shopee',
                'Link Blibli',
                'Area',
                'Youtube',
                'Brand Unit',
                'Created By',
                'Updated By',
                'Tittle En',
                'Warranty En',
                'Unit En',
                'Warranty Vendor En',
                'Livetime En',
                'Packagin En',
                'Description En',
                'Tittle Ch',
                'Warranty Ch',
                'Unit Ch',
                'Warranty Vendor Ch',
                'Livetime Ch',
                'Packagin Ch',
                'Description Ch',
                'Promo CBD Price',
                'Promo Volume',
                'Promo Volume Price',
                'Promo Referral Price',
                'Store ID',
                'Is Sell',
                'Is Rent',
                'Rent Description',
                'Operator Option',
                'Fuel Option',
                'Rent Description En',
                'Rent Description Ch',
                'Real Time unit',
                'Hour Meter',
                'Minimum Rent',
                'Operator Price',
                'Rent Price',
                'Is Service',
                'File',
                'SKU Number',
                'Price Description',
                'Last Medical',
                'Last Education',
                'Created At',
                'Updated At'
            ];

            $data = [];
            $data[] = $headers;

            foreach ($products as $product) {
                $data[] = [
                    $product->id ?? 0,
                    $product->tittle ?? 'No Title',
                    $product->partnumber ?? 'N/A',
                    $product->physicnumber ?? 'N/A',
                    $product->quality ?? 'N/A',
                    $product->stock ?? 0,
                    $product->moq ?? 0,
                    $product->price ?? 0,
                    $product->price_promo ?? 0,
                    $product->price_bigsale ?? 0,
                    $product->img ?? '',
                    $product->promo ?? '',
                    $product->categori ?? 'N/A',
                    $product->jenisproduct ?? 'N/A',
                    $product->partnumber_trumecs ?? 'N/A',
                    $product->price_old ?? 0,
                    $product->made ?? 'N/A',
                    $product->warranty ?? 'N/A',
                    $product->unit ?? 'pcs',
                    $product->warrantyvendor ?? 'N/A',
                    $product->livetime ?? 'N/A',
                    $product->dimention ?? 'N/A',
                    $product->packagin ?? 'N/A',
                    $product->weight ?? 0,
                    $product->description ?? 'No Description',
                    $product->view ?? 0,
                    $product->sx ?? 'N/A',
                    $product->sy ?? 'N/A',
                    $product->sz ?? 'N/A',
                    $product->px ?? 'N/A',
                    $product->py ?? 'N/A',
                    $product->pz ?? 'N/A',
                    $product->brand ?? 'N/A',
                    $product->type ?? 'N/A',
                    $product->component ?? 'N/A',
                    $product->status ?? 'Unknown',
                    $product->availability_at ?? 'N/A',
                    $product->estimated_delivery ?? 'N/A',
                    $product->estimated_deliveryindent ?? 'N/A',
                    $product->ppn ?? 0,
                    $product->link_tokped ?? '',
                    $product->link_bukalapak ?? '',
                    $product->link_shopee ?? '',
                    $product->link_blibli ?? '',
                    $product->area ?? 'N/A',
                    $product->youtube ?? '',
                    $product->brand_unit ?? 'N/A',
                    $product->created_by ?? 'System',
                    $product->updated_by ?? 'System',
                    $product->tittle_en ?? 'No Title',
                    $product->warranty_en ?? 'N/A',
                    $product->unit_en ?? 'pcs',
                    $product->warrantyvendor_en ?? 'N/A',
                    $product->livetime_en ?? 'N/A',
                    $product->packagin_en ?? 'N/A',
                    $product->description_en ?? 'No Description',
                    $product->tittle_ch ?? 'No Title',
                    $product->warranty_ch ?? 'N/A',
                    $product->unit_ch ?? 'pcs',
                    $product->warrantyvendor_ch ?? 'N/A',
                    $product->livetime_ch ?? 'N/A',
                    $product->packagin_ch ?? 'N/A',
                    $product->description_ch ?? 'No Description',
                    $product->promo_cbd_price ?? 0,
                    $product->promo_volume ?? 0,
                    $product->promo_volume_price ?? 0,
                    $product->promo_referral_price ?? 0,
                    $product->store_id ?? 0,
                    $product->is_sell ?? 'No',
                    $product->is_rent ?? 'No',
                    $product->rent_description ?? '',
                    $product->operator_option ?? 'N/A',
                    $product->fuel_option ?? 'N/A',
                    $product->rent_description_en ?? '',
                    $product->rent_description_ch ?? '',
                    $product->rent_time_unit ?? 0,
                    $product->hour_meter ?? 0,
                    $product->minimum_rent ?? 0,
                    $product->operator_price ?? 0,
                    $product->rent_price ?? 0,
                    $product->is_service ?? 'No',
                    $product->file ?? '',
                    $product->sku_number ?? 'N/A',
                    $product->price_description ?? '',
                    $product->last_medical ?? 'N/A',
                    $product->last_education ?? 'N/A',
                    $product->created_at ?? date('Y-m-d H:i:s'),
                    $product->updated_at ?? date('Y-m-d H:i:s'),
                ];
            }

            $range = $sheet . '!A1:CJ';
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
                if (count($row) >= 11 && !empty($row[0])) {
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

            foreach ($sheetProducts as $sheetProduct) {
                $productId = $sheetProduct['id'];

                if (empty($productId) || $productId == 0) {
                    $stats['skipped']++;
                    continue;
                }

                if (isset($dbProductsMap[$productId])) {
                    $dbProduct = $dbProductsMap[$productId];
                    $sheetUpdated = strtotime($sheetProduct['updated_at']);
                    $dbUpdated = strtotime($dbProduct['updated_at']);

                    if ($sheetUpdated > $dbUpdated) {
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
                    $ci->db->insert('product', [
                        'id' => $productId,
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

            $stats['total_db_after'] = $stats['total_db_before'] + $stats['created'];

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
