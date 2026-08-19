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
            $range = $sheet . '!A2:CJ';
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
            $range = $sheet . '!A2:CJ';
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
                if (count($row) >= 88 && !empty($row[0])) {
                    $updatedAt = $row[87] ?? date('Y-m-d H:i:s');
                    if (is_string($updatedAt) && !strtotime($updatedAt)) {
                        $updatedAt = date('Y-m-d H:i:s');
                    }

                    $products[] = [
                        'id' => intval($row[0]),
                        'tittle' => $row[1] ?? 'No Title',
                        'partnumber' => $row[2] ?? 'N/A',
                        'physicnumber' => $row[3] ?? 'N/A',
                        'quality' => $row[4] ?? 'N/A',
                        'stock' => intval($row[5] ?? 0),
                        'moq' => intval($row[6] ?? 0),
                        'price' => floatval($row[7] ?? 0),
                        'price_promo' => floatval($row[8] ?? 0),
                        'price_bigsale' => floatval($row[9] ?? 0),
                        'img' => $row[10] ?? '',
                        'promo' => $row[11] ?? '',
                        'categori' => $row[12] ?? 'N/A',
                        'jenisproduct' => $row[13] ?? 'N/A',
                        'partnumber_trumecs' => $row[14] ?? 'N/A',
                        'price_old' => floatval($row[15] ?? 0),
                        'made' => $row[16] ?? 'N/A',
                        'warranty' => $row[17] ?? 'N/A',
                        'unit' => $row[18] ?? 'pcs',
                        'warrantyvendor' => $row[19] ?? 'N/A',
                        'livetime' => $row[20] ?? 'N/A',
                        'dimention' => $row[21] ?? 'N/A',
                        'packagin' => $row[22] ?? 'N/A',
                        'weight' => floatval($row[23] ?? 0),
                        'description' => $row[24] ?? 'No Description',
                        'view' => intval($row[25] ?? 0),
                        'sx' => $row[26] ?? 'N/A',
                        'sy' => $row[27] ?? 'N/A',
                        'sz' => $row[28] ?? 'N/A',
                        'px' => $row[29] ?? 'N/A',
                        'py' => $row[30] ?? 'N/A',
                        'pz' => $row[31] ?? 'N/A',
                        'brand' => $row[32] ?? 'N/A',
                        'type' => $row[33] ?? 'N/A',
                        'component' => $row[34] ?? 'N/A',
                        'status' => $row[35] ?? 'Unknown',
                        'availability_at' => $row[36] ?? 'N/A',
                        'estimated_delivery' => $row[37] ?? 'N/A',
                        'estimated_deliveryindent' => $row[38] ?? 'N/A',
                        'ppn' => floatval($row[39] ?? 0),
                        'link_tokped' => $row[40] ?? '',
                        'link_bukalapak' => $row[41] ?? '',
                        'link_shopee' => $row[42] ?? '',
                        'link_blibli' => $row[43] ?? '',
                        'area' => $row[44] ?? 'N/A',
                        'youtube' => $row[45] ?? '',
                        'brand_unit' => $row[46] ?? 'N/A',
                        'created_by' => $row[47] ?? 'System',
                        'updated_by' => $row[48] ?? 'System',
                        'tittle_en' => $row[49] ?? 'No Title',
                        'warranty_en' => $row[50] ?? 'N/A',
                        'unit_en' => $row[51] ?? 'pcs',
                        'warrantyvendor_en' => $row[52] ?? 'N/A',
                        'livetime_en' => $row[53] ?? 'N/A',
                        'packagin_en' => $row[54] ?? 'N/A',
                        'description_en' => $row[55] ?? 'No Description',
                        'tittle_ch' => $row[56] ?? 'No Title',
                        'warranty_ch' => $row[57] ?? 'N/A',
                        'unit_ch' => $row[58] ?? 'pcs',
                        'warrantyvendor_ch' => $row[59] ?? 'N/A',
                        'livetime_ch' => $row[60] ?? 'N/A',
                        'packagin_ch' => $row[61] ?? 'N/A',
                        'description_ch' => $row[62] ?? 'No Description',
                        'promo_cbd_price' => floatval($row[63] ?? 0),
                        'promo_volume' => intval($row[64] ?? 0),
                        'promo_volume_price' => floatval($row[65] ?? 0),
                        'promo_referral_price' => floatval($row[66] ?? 0),
                        'store_id' => intval($row[67] ?? 0),
                        'is_sell' => $row[68] ?? 'No',
                        'is_rent' => $row[69] ?? 'No',
                        'rent_description' => $row[70] ?? '',
                        'operator_option' => $row[71] ?? 'N/A',
                        'fuel_option' => $row[72] ?? 'N/A',
                        'rent_description_en' => $row[73] ?? '',
                        'rent_description_ch' => $row[74] ?? '',
                        'rent_time_unit' => intval($row[75] ?? 0),
                        'hour_meter' => floatval($row[76] ?? 0),
                        'minimum_rent' => intval($row[77] ?? 0),
                        'operator_price' => floatval($row[78] ?? 0),
                        'rent_price' => floatval($row[79] ?? 0),
                        'is_service' => $row[80] ?? 'No',
                        'file' => $row[81] ?? '',
                        'sku_number' => $row[82] ?? 'N/A',
                        'price_description' => $row[83] ?? '',
                        'last_medical' => $row[84] ?? 'N/A',
                        'last_education' => $row[85] ?? 'N/A',
                        'created_at' => $row[86] ?? date('Y-m-d H:i:s'),
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

            $stats = [
                'created' => 0,
                'updated' => 0,
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
                    // UPDATE: Product sudah ada di database, update semua data dari sheet
                    $ci->db->where('id', $productId);
                    $ci->db->update('product', [
                        'tittle' => $sheetProduct['tittle'],
                        'partnumber' => $sheetProduct['partnumber'],
                        'physicnumber' => $sheetProduct['physicnumber'],
                        'quality' => $sheetProduct['quality'],
                        'stock' => $sheetProduct['stock'],
                        'moq' => $sheetProduct['moq'],
                        'price' => $sheetProduct['price'],
                        'price_promo' => $sheetProduct['price_promo'],
                        'price_bigsale' => $sheetProduct['price_bigsale'],
                        'img' => $sheetProduct['img'],
                        'promo' => $sheetProduct['promo'],
                        'categori' => $sheetProduct['categori'],
                        'jenisproduct' => $sheetProduct['jenisproduct'],
                        'partnumber_trumecs' => $sheetProduct['partnumber_trumecs'],
                        'price_old' => $sheetProduct['price_old'],
                        'made' => $sheetProduct['made'],
                        'warranty' => $sheetProduct['warranty'],
                        'unit' => $sheetProduct['unit'],
                        'warrantyvendor' => $sheetProduct['warrantyvendor'],
                        'livetime' => $sheetProduct['livetime'],
                        'dimention' => $sheetProduct['dimention'],
                        'packagin' => $sheetProduct['packagin'],
                        'weight' => $sheetProduct['weight'],
                        'description' => $sheetProduct['description'],
                        'view' => $sheetProduct['view'],
                        'sx' => $sheetProduct['sx'],
                        'sy' => $sheetProduct['sy'],
                        'sz' => $sheetProduct['sz'],
                        'px' => $sheetProduct['px'],
                        'py' => $sheetProduct['py'],
                        'pz' => $sheetProduct['pz'],
                        'brand' => $sheetProduct['brand'],
                        'type' => $sheetProduct['type'],
                        'component' => $sheetProduct['component'],
                        'status' => $sheetProduct['status'],
                        'availability_at' => $sheetProduct['availability_at'],
                        'estimated_delivery' => $sheetProduct['estimated_delivery'],
                        'estimated_deliveryindent' => $sheetProduct['estimated_deliveryindent'],
                        'ppn' => $sheetProduct['ppn'],
                        'link_tokped' => $sheetProduct['link_tokped'],
                        'link_bukalapak' => $sheetProduct['link_bukalapak'],
                        'link_shopee' => $sheetProduct['link_shopee'],
                        'link_blibli' => $sheetProduct['link_blibli'],
                        'area' => $sheetProduct['area'],
                        'youtube' => $sheetProduct['youtube'],
                        'brand_unit' => $sheetProduct['brand_unit'],
                        'created_by' => $sheetProduct['created_by'],
                        'updated_by' => $sheetProduct['updated_by'],
                        'tittle_en' => $sheetProduct['tittle_en'],
                        'warranty_en' => $sheetProduct['warranty_en'],
                        'unit_en' => $sheetProduct['unit_en'],
                        'warrantyvendor_en' => $sheetProduct['warrantyvendor_en'],
                        'livetime_en' => $sheetProduct['livetime_en'],
                        'packagin_en' => $sheetProduct['packagin_en'],
                        'description_en' => $sheetProduct['description_en'],
                        'tittle_ch' => $sheetProduct['tittle_ch'],
                        'warranty_ch' => $sheetProduct['warranty_ch'],
                        'unit_ch' => $sheetProduct['unit_ch'],
                        'warrantyvendor_ch' => $sheetProduct['warrantyvendor_ch'],
                        'livetime_ch' => $sheetProduct['livetime_ch'],
                        'packagin_ch' => $sheetProduct['packagin_ch'],
                        'description_ch' => $sheetProduct['description_ch'],
                        'promo_cbd_price' => $sheetProduct['promo_cbd_price'],
                        'promo_volume' => $sheetProduct['promo_volume'],
                        'promo_volume_price' => $sheetProduct['promo_volume_price'],
                        'promo_referral_price' => $sheetProduct['promo_referral_price'],
                        'store_id' => $sheetProduct['store_id'],
                        'is_sell' => $sheetProduct['is_sell'],
                        'is_rent' => $sheetProduct['is_rent'],
                        'rent_description' => $sheetProduct['rent_description'],
                        'operator_option' => $sheetProduct['operator_option'],
                        'fuel_option' => $sheetProduct['fuel_option'],
                        'rent_description_en' => $sheetProduct['rent_description_en'],
                        'rent_description_ch' => $sheetProduct['rent_description_ch'],
                        'rent_time_unit' => $sheetProduct['rent_time_unit'],
                        'hour_meter' => $sheetProduct['hour_meter'],
                        'minimum_rent' => $sheetProduct['minimum_rent'],
                        'operator_price' => $sheetProduct['operator_price'],
                        'rent_price' => $sheetProduct['rent_price'],
                        'is_service' => $sheetProduct['is_service'],
                        'file' => $sheetProduct['file'],
                        'sku_number' => $sheetProduct['sku_number'],
                        'price_description' => $sheetProduct['price_description'],
                        'last_medical' => $sheetProduct['last_medical'],
                        'last_education' => $sheetProduct['last_education'],
                        'updated_at' => is_numeric($sheetProduct['updated_at'])
                            ? intval($sheetProduct['updated_at'])
                            : strtotime($sheetProduct['updated_at'])
                    ]);

                    if ($ci->db->affected_rows() > 0) {
                        $stats['updated']++;
                    }
                } else {
                    // CREATE: product ada di sheet tapi tidak di database
                    $ci->db->insert('product', [
                        'id' => $productId,
                        'tittle' => $sheetProduct['tittle'],
                        'partnumber' => $sheetProduct['partnumber'],
                        'physicnumber' => $sheetProduct['physicnumber'],
                        'quality' => $sheetProduct['quality'],
                        'stock' => $sheetProduct['stock'],
                        'moq' => $sheetProduct['moq'],
                        'price' => $sheetProduct['price'],
                        'price_promo' => $sheetProduct['price_promo'],
                        'price_bigsale' => $sheetProduct['price_bigsale'],
                        'img' => $sheetProduct['img'],
                        'promo' => $sheetProduct['promo'],
                        'categori' => $sheetProduct['categori'],
                        'jenisproduct' => $sheetProduct['jenisproduct'],
                        'partnumber_trumecs' => $sheetProduct['partnumber_trumecs'],
                        'price_old' => $sheetProduct['price_old'],
                        'made' => $sheetProduct['made'],
                        'warranty' => $sheetProduct['warranty'],
                        'unit' => $sheetProduct['unit'],
                        'warrantyvendor' => $sheetProduct['warrantyvendor'],
                        'livetime' => $sheetProduct['livetime'],
                        'dimention' => $sheetProduct['dimention'],
                        'packagin' => $sheetProduct['packagin'],
                        'weight' => $sheetProduct['weight'],
                        'description' => $sheetProduct['description'],
                        'view' => $sheetProduct['view'],
                        'sx' => $sheetProduct['sx'],
                        'sy' => $sheetProduct['sy'],
                        'sz' => $sheetProduct['sz'],
                        'px' => $sheetProduct['px'],
                        'py' => $sheetProduct['py'],
                        'pz' => $sheetProduct['pz'],
                        'brand' => $sheetProduct['brand'],
                        'type' => $sheetProduct['type'],
                        'component' => $sheetProduct['component'],
                        'status' => $sheetProduct['status'],
                        'availability_at' => $sheetProduct['availability_at'],
                        'estimated_delivery' => $sheetProduct['estimated_delivery'],
                        'estimated_deliveryindent' => $sheetProduct['estimated_deliveryindent'],
                        'ppn' => $sheetProduct['ppn'],
                        'link_tokped' => $sheetProduct['link_tokped'],
                        'link_bukalapak' => $sheetProduct['link_bukalapak'],
                        'link_shopee' => $sheetProduct['link_shopee'],
                        'link_blibli' => $sheetProduct['link_blibli'],
                        'area' => $sheetProduct['area'],
                        'youtube' => $sheetProduct['youtube'],
                        'brand_unit' => $sheetProduct['brand_unit'],
                        'created_by' => $sheetProduct['created_by'],
                        'updated_by' => $sheetProduct['updated_by'],
                        'tittle_en' => $sheetProduct['tittle_en'],
                        'warranty_en' => $sheetProduct['warranty_en'],
                        'unit_en' => $sheetProduct['unit_en'],
                        'warrantyvendor_en' => $sheetProduct['warrantyvendor_en'],
                        'livetime_en' => $sheetProduct['livetime_en'],
                        'packagin_en' => $sheetProduct['packagin_en'],
                        'description_en' => $sheetProduct['description_en'],
                        'tittle_ch' => $sheetProduct['tittle_ch'],
                        'warranty_ch' => $sheetProduct['warranty_ch'],
                        'unit_ch' => $sheetProduct['unit_ch'],
                        'warrantyvendor_ch' => $sheetProduct['warrantyvendor_ch'],
                        'livetime_ch' => $sheetProduct['livetime_ch'],
                        'packagin_ch' => $sheetProduct['packagin_ch'],
                        'description_ch' => $sheetProduct['description_ch'],
                        'promo_cbd_price' => $sheetProduct['promo_cbd_price'],
                        'promo_volume' => $sheetProduct['promo_volume'],
                        'promo_volume_price' => $sheetProduct['promo_volume_price'],
                        'promo_referral_price' => $sheetProduct['promo_referral_price'],
                        'store_id' => $sheetProduct['store_id'],
                        'is_sell' => $sheetProduct['is_sell'],
                        'is_rent' => $sheetProduct['is_rent'],
                        'rent_description' => $sheetProduct['rent_description'],
                        'operator_option' => $sheetProduct['operator_option'],
                        'fuel_option' => $sheetProduct['fuel_option'],
                        'rent_description_en' => $sheetProduct['rent_description_en'],
                        'rent_description_ch' => $sheetProduct['rent_description_ch'],
                        'rent_time_unit' => $sheetProduct['rent_time_unit'],
                        'hour_meter' => $sheetProduct['hour_meter'],
                        'minimum_rent' => $sheetProduct['minimum_rent'],
                        'operator_price' => $sheetProduct['operator_price'],
                        'rent_price' => $sheetProduct['rent_price'],
                        'is_service' => $sheetProduct['is_service'],
                        'file' => $sheetProduct['file'],
                        'sku_number' => $sheetProduct['sku_number'],
                        'price_description' => $sheetProduct['price_description'],
                        'last_medical' => $sheetProduct['last_medical'],
                        'last_education' => $sheetProduct['last_education'],
                        'created_at' => is_numeric($sheetProduct['created_at'])
                            ? intval($sheetProduct['created_at'])
                            : strtotime($sheetProduct['created_at']),
                        'updated_at' => is_numeric($sheetProduct['updated_at'])
                            ? intval($sheetProduct['updated_at'])
                            : strtotime($sheetProduct['updated_at'])
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
            log_message('error', 'Sync Products Error: ' . $e->getMessage());
            return [
                'success' => false,
                'error' => $e->getMessage()
            ];
        }
    }
}
