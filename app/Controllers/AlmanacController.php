<?php

namespace App\Controllers;

use Throwable;
use App\Models\Almanac;
use ManaPHP\Cli\Controller;
use ManaPHP\Http\Exception;

/**
 * Class AlmanacController
 * @package App\Cli\Controllers
 */
class AlmanacController extends Controller
{
    /**
     * @var string crawler url
     */
    private $_huangli_url = 'https://hi.doniai.com/api/v1.0/crawler/huangli';

    public function defaultCommand()
    {
        try {
            $response = curl_get($this->_huangli_url, [])->body;
            if ($response['code'] === 200) {
                $huangli = $response['data']['huangli_list'];
                $content1 = array_column($huangli['texts1'], 'row_data');
                $content2 = array_column($huangli['texts2'], 'row_data');
                $current_date = date('Ymd');

                if (!Almanac::exists(['current_date' => $current_date])) {
                    $almanac_db = new Almanac();
                    $almanac_db->suitable = $content1[0];
                    $almanac_db->taboo = $content1[1];
                    $almanac_db->good_luck = $content2[0];
                    $almanac_db->ferocious = $content2[1];
                    $almanac_db->current_date = $current_date;
                    $almanac_db->create();
                }
            } else {
                throw new Exception('request error');
            }
        } catch (Throwable $throwable) {
            $this->logger->error($throwable);
        }
    }
}
