<?php

function pets_data_file()
{
    return __DIR__ . '/pets_data.json';
}

function load_pets()
{
    $file = pets_data_file();
    if (!file_exists($file)) {
        $default = [
            [
                'id' => 1,
                'name' => 'Bella',
                'type' => 'Dog',
                'age' => 2,
                'description' => 'Friendly and playful mixed-breed dog looking for an active family.',
            ],
            [
                'id' => 2,
                'name' => 'Milo',
                'type' => 'Cat',
                'age' => 3,
                'description' => 'Calm indoor cat who loves sunny windowsills and quiet homes.',
            ],
            [
                'id' => 3,
                'name' => 'Luna',
                'type' => 'Dog',
                'age' => 1,
                'description' => 'Energetic puppy who is learning basic commands and loves toys.',
            ],
        ];
        save_pets($default);
        return $default;
    }

    $json = file_get_contents($file);
    $data = json_decode($json, true);
    if (!is_array($data)) {
        $data = [];
    }
    return $data;
}

function save_pets(array $pets)
{
    $file = pets_data_file();
    file_put_contents($file, json_encode($pets, JSON_PRETTY_PRINT));
}

$pets = load_pets();
