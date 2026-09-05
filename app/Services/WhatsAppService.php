<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class WhatsAppService
{
    protected $token;
    protected $phoneNumberId;

    public function __construct()
    {
        $this->token         = config('services.meta_whatsapp.token');
        $this->phoneNumberId = config('services.meta_whatsapp.phone_number_id');
    }

    /**
     * Limpia y formatea el número telefónico asegurando el prefijo del país (ej: 57 para Colombia)
     */
    protected function formatearNumero(string $numero): string
    {
        $limpio = preg_replace('/[^0-9]/', '', $numero);
        if (strlen($limpio) === 10) {
            $limpio = '57' . $limpio;
        }
        return $limpio;
    }

    public function enviarMensaje(string $numero, string $nombre, string $juego, string $casino): bool
    {
        if (empty($this->token) || empty($this->phoneNumberId)) {
            Log::error('WhatsApp API Error: Token o Phone Number ID no configurados en .env / config');
            return false;
        }

        $to = $this->formatearNumero($numero);

        try {
            $response = Http::withToken($this->token)
                ->post("https://graph.facebook.com/v18.0/{$this->phoneNumberId}/messages", [
                    'messaging_product' => 'whatsapp',
                    'recipient_type'    => 'individual',
                    'to'                => $to,
                    'type'              => 'text',
                    'text'              => [
                        'preview_url' => false,
                        'body'        => "¡Felicitaciones {$nombre}! Has sido seleccionado como ganador del juego {$juego} en el casino {$casino}."
                    ],
                ]);

            if ($response->successful()) {
                Log::info("WhatsApp enviado exitosamente a {$to}");
                return true;
            }

            Log::error("Error enviando WhatsApp (HTTP {$response->status()}): " . $response->body());
            return false;

        } catch (\Exception $e) {
            Log::error('Excepción enviando WhatsApp: ' . $e->getMessage());
            return false;
        }
    }

    /**
     * Método opcional para enviar mensajes mediante Plantilla aprobada en Meta (Template)
     */
    public function enviarPlantilla(string $numero, string $nombrePlantilla, string $codigoIdioma = 'es', array $componentes = []): bool
    {
        if (empty($this->token) || empty($this->phoneNumberId)) {
            Log::error('WhatsApp API Error: Token o Phone Number ID no configurados');
            return false;
        }

        $to = $this->formatearNumero($numero);

        try {
            $payload = [
                'messaging_product' => 'whatsapp',
                'to'                => $to,
                'type'              => 'template',
                'template'          => [
                    'name'     => $nombrePlantilla,
                    'language' => ['code' => $codigoIdioma]
                ],
            ];

            if (!empty($componentes)) {
                $payload['template']['components'] = $componentes;
            }

            $response = Http::withToken($this->token)
                ->post("https://graph.facebook.com/v18.0/{$this->phoneNumberId}/messages", $payload);

            if ($response->successful()) {
                Log::info("WhatsApp Plantilla '{$nombrePlantilla}' enviada a {$to}");
                return true;
            }

            Log::error("Error enviando Plantilla WhatsApp (HTTP {$response->status()}): " . $response->body());
            return false;
        } catch (\Exception $e) {
            Log::error('Excepción enviando Plantilla WhatsApp: ' . $e->getMessage());
            return false;
        }
    }
}