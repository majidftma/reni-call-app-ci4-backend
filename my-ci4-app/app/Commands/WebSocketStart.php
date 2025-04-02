<?php
namespace App\Commands;

use CodeIgniter\CLI\BaseCommand;
use CodeIgniter\CLI\CLI;
use Ratchet\Http\HttpServer;
use Ratchet\Server\IoServer;
use Ratchet\WebSocket\WsServer;
use App\Controllers\WebSocketServer;

class WebSocketStart extends BaseCommand
{
    protected $group = 'WebSocket';
    protected $name = 'websocket:start';
    protected $description = 'Start the WebSocket server';

    public function run(array $params)
    {
        CLI::print("Starting WebSocket Server...\n");

        $server = IoServer::factory(
            new HttpServer(
                new WsServer(
                    new WebSocketServer()
                )
            ),
            8080 // WebSocket port
        );

        $server->run();
    }
}
