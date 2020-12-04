<?php

namespace App\Controllers;

use Throwable;
use App\Models\Ticket;
use ManaPHP\Cli\Controller;
use ManaPHP\Http\Exception;

/**
 * Class TicketController
 * @package App\Cli\Controllers
 */
class TicketController extends Controller
{
    /**
     * @var string crawler url
     */
    private $_fucai_url = 'https://hi.doniai.com/api/v1.0/crawler/fucai';

    public function defaultCommand()
    {
        try {
            $response = curl_get($this->_fucai_url, [])->body;
            if ($response['code'] === 200) {
                $ticket = $response['data']['shuangseqiu'];
                $name = $ticket['name'];
                $amount = $ticket['amount'];
                if (preg_match('/(\d+)\.?(\d+)/', $name, $match)) {
                    $phase = $match[0];
                }

                $data = array_chunk($ticket['result'], 6);
                $qianqu = implode(' ', array_column($data[0], 'title'));
                $houqu = implode(' ', array_column($data[1], 'title'));

                if (!Ticket::exists(['phase' => $phase])) {
                    $ticket_db = new Ticket();
                    $ticket_db->name = $name;
                    $ticket_db->amount = $amount;
                    $ticket_db->qianqu = $qianqu;
                    $ticket_db->houqu = $houqu;
                    $ticket_db->phase = $phase;
                    $ticket_db->create();
                }
            } else {
                throw new Exception('request error');
            }
        } catch (Throwable $throwable) {
            $this->logger->error($throwable);
        }
    }
}
