<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PianoController extends Controller
{
    private $nats = [
        'C',
        'D',
        'E',
        'F',
        'G',
        'A',
        'B'
    ];

    private $twelve_tones = [
        "C-nat",
        "C-sharp",
        "D-nat",
        "D-sharp",
        "E-nat",
        "F-nat",
        "F-sharp",
        "G-nat",
        "G-sharp",
        "A-nat",
        "A-sharp",
        "B-nat",
    ];

    private $black_keys = [
        "C-sharp",
        "D-sharp",
        "F-sharp",
        "G-sharp",
        "A-sharp",
    ];

    private $maj_scale_pattern = [0, 2, 4, 5, 7, 9, 11];
    private $min_scale_pattern = [0, 2, 3, 5, 7, 8, 10];
    public $root;
    public $scale;

    public function show($rootNote='')
    {
        return view('piano.show'); //->with(['rootNote' => $rootNote]);
    }

    public function pianoProcess (Request $request)
    {
        // dump($request->all());
        $params = $request->all();
        $request->validate([
            'root' => [
                'required',
                'alpha'
            ],
            'root_opts' => 'required',
            'scale_type' => 'required'
        ]);

        $raw_root = strtoupper($params['root']);
        if (!in_array($raw_root, $this->nats)) {
            return view('piano.show')->with([
                'inputs' => $params,
                'root_error' => $raw_root.' is not a musical note.'
            ]);
        }

        $root_mod = $params['root_opts'];
        if ($params['scale_type'] == 'minor') {
            $scale = $this->min_scale_pattern;
        } else {
            $scale = $this->maj_scale_pattern;
        }

        $inNats = in_array(strtoupper($raw_root), $this->nats);

        $root = $this->findRoot($raw_root, $root_mod);
        $scale_highlights = $this->deriveScale($root, $scale);

        return view('piano.show')->with([
            'rootNote' => $root,
            'rootMod' => $root_mod,
            'scaleType' => $params['scale_type'],
            'highlights' => $scale_highlights,
            'twelve_tones' => $this->twelve_tones,
            'black_keys' => $this->black_keys,
            'inputs' => $params,
        ]);

    }

    private function findRoot($note, $opt)
    {
        $twelve_tones = $this->twelve_tones;

        $scale_max = sizeof($twelve_tones);

        // normalizes to the natural note before applying sharp or flat modifier
        $rindex = array_search($note . '-nat', $twelve_tones);

        if ($opt == 'sharp') {
            $offset = +1;
        } elseif ($opt == 'flat') {
            $offset = -1;
        } else {
            $offset = 0;
        }

        if ($rindex + $offset >= $scale_max) {
            // because #sharp modifier can only increase index by 1,
            // it's safe to hard-code a 0 if the index >= $scale_max
            // in order to wrap around
            $ix = 0;
        } elseif ($rindex + $offset < 0) {
            // sets index to reference last element in $twelve_tones
            // to wrap around the other direction if flat modifier
            // is causing overflow
            $ix = $scale_max-1;
        } else {
            $ix = $rindex + $offset;
        }

        return $twelve_tones[$ix];
    }

    private function deriveScale($root, $pattern)
    {
        $twelve_tones = $this->twelve_tones;
        $scale_max = sizeof($twelve_tones);

        $final_scale = [];

        $start = array_search($root, $twelve_tones);
        foreach ($pattern as $scale_pos) {
            $note = $start + $scale_pos;
            if ($note < $scale_max) {
                $final_scale[] = $twelve_tones[$note];
            } else { // if the index overflows:
                $note -= $scale_max; // wrap around to the beginning
                $final_scale[] = $twelve_tones[$note];
            }
        }

        return $final_scale;
    }

}
