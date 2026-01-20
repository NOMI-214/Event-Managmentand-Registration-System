<?php

namespace App\Controllers;

class Debug extends BaseController
{
    public function writeTest()
    {
        // Try writing into the app logs directory
        $path = WRITEPATH . 'logs/reg_debug.log';
        $message = date('c') . " - debug write test\n";
        $ok = @file_put_contents($path, $message, FILE_APPEND);

        return $ok ? "written" : "failed to write";
    }

    public function registerTest($eventId = null)
    {
        // Accept POST data and insert directly into registrations for debugging
        if ($this->request->getMethod() !== 'post') {
            return $this->response->setStatusCode(405)->setBody('Method Not Allowed');
        }

        $data = [
            'event_id' => $eventId ?: $this->request->getPost('event_id'),
            'name' => $this->request->getPost('name'),
            'email' => $this->request->getPost('email'),
            'phone' => $this->request->getPost('phone'),
        ];

        try {
            $db = \Config\Database::connect();
            $builder = $db->table('registrations');
            $ok = $builder->insert($data);
            if ($ok) {
                $id = $db->insertID();
                @file_put_contents(WRITEPATH . 'logs/reg_debug.log', date('c') . " - debug_register_inserted id={$id} data=" . json_encode($data) . PHP_EOL, FILE_APPEND);
                return $this->response->setBody('inserted:' . $id);
            }
        } catch (\Exception $e) {
            @file_put_contents(WRITEPATH . 'logs/reg_debug.log', date('c') . " - debug_register_exception " . $e->getMessage() . PHP_EOL, FILE_APPEND);
            return $this->response->setStatusCode(500)->setBody('error');
        }

        return $this->response->setStatusCode(400)->setBody('failed');
    }
}
