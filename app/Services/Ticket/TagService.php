<?php

namespace App\Services\Ticket;

use App\Models\Ticket\Tag;
use App\Services\BaseService;

class TagService extends BaseService
{
    /**
     * Delimiter used when splitting or joining tags
     */
    const DELIMITER = ',';

    /**
     * Create a ticket tag or find if exists
     *
     * @param string $name
     * @return mixed
     */
    public function createOrFind($name)
    {
        $tag = Tag::firstOrCreate([
            'name' => ucwords($name),
        ]);

        return $tag;
    }

    /**
     * Create multiple tags and assign to ticket
     *
     * @param string $tags
     * @param Ticket $ticket
     * @return mixed
     */
    public function createMultipleAndAssignToTicket($tags, $ticket)
    {
        $models = [];
        $parsedTags = $this->split($tags);

        foreach ($parsedTags as $tag) {
            $models[] = $this->createOrFind($tag);
        }

        return $ticket->tags()->saveMany($models);
    }

    /**
     * Split the tags into an array
     *
     * @param string $tags
     * @return array
     */
    public function split($tags)
    {
        return explode(self::DELIMITER, $tags);
    }

    /**
     * Join the tags into a string
     *
     * @param array $tags
     * @return string
     */
    public function join($tags)
    {
        return implode(self::DELIMITER, $tags);
    }
}
