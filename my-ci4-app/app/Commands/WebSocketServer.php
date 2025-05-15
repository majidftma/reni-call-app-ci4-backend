<?php
namespace App\Commands;

use CodeIgniter\CLI\BaseCommand;
use CodeIgniter\CLI\CLI;
use Ratchet\Server\IoServer;
use Ratchet\Http\HttpServer;
use Ratchet\WebSocket\WsServer;
use App\Controllers\SignalingServer;

class WebSocketServer extends BaseCommand
{
    protected $group = 'Server';
    protected $name = 'websocket:run';
    protected $description = 'Runs the WebSocket signaling server';

    public function run(array $params)
    {
        $port = $params['port'] ?? 8080;
        CLI::write("Starting WebSocket server on port $port...");

        $server = IoServer::factory(
            new HttpServer(
                new WsServer(
                    new SignalingServer()
                )
            ),
            $port
        );
        $server->run();
    }
}