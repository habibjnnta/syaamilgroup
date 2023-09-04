<?php

namespace App\Lib;

use App\Broadcast;
use App\Permission;
use App\Role;
use App\Siswa;
use GuzzleHttp\Client;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;

class Whatsapp
{

  protected $client;
  protected $host;
  protected $version;
  protected $token;
  protected $request_phone_id;

  const PATH = [
    // var1=host, var2=version, var3=phone_number
    'sent_message' => '%s/%s/%s/messages',
  ];

  public function __construct()
  {
    $this->client = new Client();
    $this->host = env('WHATSAPP_HOST');
    $this->version = env('WHATSAPP_VERSION_API');
    $this->token = env('WHATSAPP_TOKEN');
    $this->request_phone_id = env('WHATSAPP_REQUEST_PHONE_ID');
  }

  public function sendMessage(Broadcast $broadcast, $phone_number)
  {
    // $url = $this->makeURL();
    // $headers = $this->makeHeader();
    // $body = $this->makeBody($broadcast, $phone_number);
    // try {
    //   $response = Http::withHeaders($headers)
    //               ->post($url, $body);
    //   return true;
    // } catch (\Throwable $th) {

    //   return false;
    // }
  }

  protected function makeURL()
  {
      return sprintf(static::PATH['sent_message'], $this->host, $this->version, $this->request_phone_id);
  }

  protected function makeHeader()
  {
      return [
          "Authorization" => "Bearer " . $this->token,
          "Content-Type" => "application/json",
      ];
  }

  public function ch(Broadcast $broadcast, $phone_number)
  {
    return [
      "messaging_product" => "whatsapp",
      "to" => $phone_number,
      "type" => "template",
      "template" => [
        "name" => "announcement",
        "language" => [
          "code" => "id"
        ],
        "components" =>
        [
          [
            "type" => "body",
            "parameters" => [
              [
                "type" => "text",
                "text" => $broadcast->tanggal,
              ],
              [
                "type" => "text",
                "text" => $broadcast->acara,
              ],
              [
                "type" => "text",
                "text" => $broadcast->himbauan,
              ],
            ]
          ]
        ]
      ],
    ];
  }

  public function sentNotifNewRegister($phone_number, Siswa $siswa)
  {
    $http = Http::withHeaders($this->makeHeader())
      ->post($this->makeURL(), $this->newRegisterMessage($phone_number, $siswa));
    return $http->body();
  }

  protected function newRegisterMessage($phone_number, Siswa $siswa)
  {
    return [
      "messaging_product" => "whatsapp",
      "to" => $phone_number,
      "type" => "template",
      "template" => [
        "name" => "new_register_student",
        "language" => [
          "code" => "id"
        ],
        "components" =>
        [
          [
            "type" => "body",
            "parameters" => [
              [
                "type" => "text",
                "text" => "Nama : {$siswa->nama_anak}, Ibu : {$siswa->nama_ibu}, No HP : {$siswa->no_hp}",
              ],
            ]
          ]
        ]
      ],
    ];
  }

  protected function makeBody(Broadcast $broadcast, $phone_number)
  {
    switch ($broadcast->template) {
      case 'announcement':
        return '{
                    "messaging_product": "whatsapp",
                    "to": "' . $phone_number . '",
                    "type": "template",
                    "template": {
                      "name": "announcement",
                      "language": {
                        "code": "id"
                      },
                      "components": [
                        {
                          "type": "body",
                          "parameters": [
                            {
                              "type": "text",
                              "text": "' . $broadcast->tanggal . '"
                            },
                            {
                              "type": "text",
                              "text": "' . $broadcast->acara . '"
                            },
                            {
                              "type": "text",
                              "text": "' . $broadcast->himbauan . '"
                            }
                          ]
                        }
                      ]
                    }
                  }';
        break;

      case 'announcement_outing':
        return '{
                    "messaging_product": "whatsapp",
                    "to": "' . $phone_number . '",
                    "type": "template",
                    "template": {
                      "name": "announcement_outing",
                      "language": {
                        "code": "id"
                      },
                      "components": [
                        {
                          "type": "body",
                          "parameters": [
                            {
                              "type": "text",
                              "text": "' . $broadcast->tanggal . '"
                            },
                            {
                              "type": "text",
                              "text": "' . $broadcast->acara . '"
                            },
                            {
                              "type": "text",
                              "text": "' . $broadcast->lokasi . '"
                            },
                            {
                              "type": "text",
                              "text": "' . $broadcast->himbauan . '"
                            }
                          ]
                        }
                      ]
                    }
                  }';
        break;

      default:
        # code...
        break;
    }
  }
}
