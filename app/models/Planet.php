<?php

class Planet extends Eloquent {

    protected $fillable = array(
        'sector',
        'level',
        'star',
        'system',
        'planet',
        'biome',
        'x',
        'y',
        'version',
        'os',
        'comment',
        'user_id',
    );

    public static $sectors = array(
        'alpha' => 'Alpha',
        'beta'  => 'Beta',
        'gamma' => 'Gamma',
        'delta' => 'Delta',
        'x'     => 'X',
    );

    public static $bioms = array(
        'arid'          => 'Arid',
        'asteroid'      => 'Asteroid Fields',
        'desert'        => 'Desert',
        'forest'        => 'Forest',
        'grasslands'    => 'Grasslands',
        'jungle'        => 'Jungle',
        'magma'         => 'Magma',
        'moon'          => 'Moon',
        'savannah'      => 'Savannah',
        'snow'          => 'Snow',
        'tentacle'      => 'Tentacle',
        'tundra'        => 'Tundra',
        'volcano'       => 'Volcano',
    );

    public static $versions = array(
        'enraged_koala' => 'Enraged Koala',
    );

    public static $oses = array(
        'windows'   => 'Windows',
        'linux'     => 'Linux',
        'mac'       => 'Mac OS',
    );

    public static function getValidationRules() {
        $validation = array(
            'level'     => 'required|integer|min:1|max:10',
            'star'      => 'required',
            'system'    => 'required',
            'planet'    => 'required',
            'x'         => 'required|integer',
            'y'         => 'required|integer',
            'comment'   => 'required',
        );

        $validation['sector']   = 'required|in:' . implode(',', array_keys(self::$sectors));
        $validation['biome']    = 'required|in:' . implode(',', array_keys(self::$bioms));
        $validation['version']  = 'required|in:' . implode(',', array_keys(self::$versions));
        $validation['os']       = 'required|in:' . implode(',', array_keys(self::$oses));

        return $validation;
    }

    public function author() {
        return $this->belongsTo('User', 'user_id');
    }
}
