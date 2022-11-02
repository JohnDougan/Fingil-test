<?php


namespace app;

class Validator
{
    private $states = [
        'any' => 'Любой',
        'new' => 'Новый',
        'open' => 'Открытый',
        'close' => 'Закрытый'
    ];
    private $counts = [
        '25' => '25',
        '50' => '50',
        '100' => '100'
    ];

    private $defaults = [
        'state' => 'any',
        'count' => '25'
    ];

    public function validate(array $data): array
    {
        $return = [];
        if (count($data) > 0) {
            foreach ($data as $key => $item) {
                $methodName = $this->prepareMethodName($key);
                if (method_exists($this, $methodName) && $validated = $this->$methodName($item)) {
                    $return[$key] = $validated;
                }
            }
        }
        return $return;
    }

    private function validateState($data)
    {
        if (array_key_exists($data, $this->states)) return $data;
        return $this->defaults['state'];
    }

    private function validateCount($data)
    {
        if (array_key_exists($data, $this->counts)) return $data;
        return $this->defaults['count'];
    }

    private function validateNumber($data)
    {
        if (is_numeric($data)) return $data;
        return false;
    }

    private function validateCreate_date_begin($data)
    {
        return $this->validateDate($data);
    }

    private function validateCreate_date_end($data)
    {
        return $this->validateDate($data);
    }

    private function validateExpire_date_begin($data)
    {
        return $this->validateDate($data);
    }

    private function validateExpire_date_end($data)
    {
        return $this->validateDate($data);
    }

    private function validateDate($data)
    {
        if (preg_match("#^[0-9]{4}\-[0-9]{2}\-[0-9]{2}$#", $data)) {
            $data = explode("-", $data);
            $data = mktime(0, 0, 0, $data[1], $data[2], $data[0]);
            return date('Y-m-d', $data);
        }
        return false;
    }

    private function prepareMethodName($name):string
    {
        return 'validate' . ucfirst(str_replace('-', '_', $name));
    }

    public function getStates():array
    {
        return $this->states;
    }
}