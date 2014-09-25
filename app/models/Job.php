<?php

class Job extends Eloquent
{
    const STATE_PENDING = 1;
    const STATE_PUBLISHED = 2;
    const STATE_DECLINED = 3;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'jobs';

    protected static $_states = array(
        self::STATE_PUBLISHED => 'Published',
        self::STATE_PENDING => 'Pending',
        self::STATE_DECLINED => 'Declined',
    );

    protected static $_statesSlugs = array(
        self::STATE_PUBLISHED => 'published',
        self::STATE_PENDING => 'pending',
        self::STATE_DECLINED => 'declined',
    );


    public function scopePublished($query)
    {
        return $query->where('state', self::STATE_PUBLISHED);
    }

    public function scopePending($query)
    {
        return $query->where('state', self::STATE_PENDING);
    }

    public function scopeDeclined($query)
    {
        return $query->where('state', self::STATE_DECLINED);
    }

    public function publish()
    {
        $this->attributes['state'] = self::STATE_PUBLISHED;
    }

    public function decline()
    {
        $this->attributes['state'] = self::STATE_DECLINED;
    }

    public static function getStates()
    {
        return self::$_states;
    }

    public static function getHumanReadableState($state)
    {
        if (isset(self::$_states[$state])) {
            return self::$_states[$state];
        }

        return '';
    }

    public static function getStateSlug($state)
    {
        if (isset(self::$_statesSlugs[$state])) {
            return self::$_statesSlugs[$state];
        }

        return '';
    }
}