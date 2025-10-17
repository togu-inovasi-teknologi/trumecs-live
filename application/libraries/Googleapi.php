<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

use Google\Client;

class Googleapi
{

    public function __construct()
    {
        putenv('GOOGLE_APPLICATION_CREDENTIALS=asset/insite/trumecs-5196753dedf8.json');
        $this->client = new Google\Client();
        $this->client->useApplicationDefaultCredentials();
        $this->client->addScope(Google\Service\Drive::DRIVE);
        $this->service = new Google\Service\Sheets($this->client);

        define('SPREADSHEETID', '1Vcjpx8EIJTs5pG438f10VMxSyq7gP4xE33bv0hwdEPc');
        define('APIKEY', '');
    }

    public function read($sheet, $range)
    {


        $range = $sheet . '!' . $range;
        $response = $this->service->spreadsheets_values->get(SPREADSHEETID, $range);
        $values = $response->getValues();
        return $values;
    }

    public function write($sheet, $range, $value = null)
    {
        $service = new Google\Service\Sheets($this->client);

        $range = $sheet . '!' . $range;
        $values = [$value];
        $body = new Google_Service_Sheets_ValueRange([
            'values' => $values
        ]);
        $params = [
            'valueInputOption' => "RAW"
        ];
        $response = $this->service->spreadsheets_values->update(SPREADSHEETID, $range, $body, $params);
        $values = $response->getUpdatedCells();
        return $values;
    }
}
