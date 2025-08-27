<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;

class Campaign extends Model {

    protected $appends = ['percentage'];

    protected $guarded = [];

    public static function fromApi(array $data)
    {
        $url = $data['url'];

        if (\str_starts_with($url, '/'))  {
            $url = 'https://tiltify.com' . $url;
        }

        return new self([
            'campaign_id' => $data['id'],
            'legacy_id' => $data['legacy_id'] ?? null,
            'name' => $data['name'],
            'url' => $url,
            'username' => Arr::get($data, 'user.slug', null),
            'avatar' => Arr::get($data, 'avatar.src', null),
            'goal' => Arr::get($data, 'goal.value', 0),
            'raised' => Arr::get($data, 'total_amount_raised.value', 0),
        ]);
    }

    public function getPercentageAttribute()
    {
        return ($this->goal > 0 && $this->raised > 0) ? number_format((($this->raised / $this->goal) * 100), 2) : 0;
    }

    public function getCustomPercentage(int $goal)
    {
        return ($goal > 0 && $this->raised > 0) ? number_format((($this->raised / $goal) * 100), 2) : 0;
    }

}
