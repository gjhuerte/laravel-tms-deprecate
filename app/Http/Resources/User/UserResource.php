<?php

namespace App\Http\Resources\User;

use App\Models\User\User;
use League\Fractal\Manager;
use League\Fractal\Resource\Collection;
use App\Transformers\User\UserTransformer;
use League\Fractal\Serializer\DataArraySerializer;
use League\Fractal\Pagination\IlluminatePaginatorAdapter;

class UserResource
{

    private $user;
    private $hasPaginator = false;
    private $userCollection;

    /**
     * Constructor class
     */
    public function __construct()
    {
        $this->manager = new Manager;
        $this->user = new User;
    }

    /**
     * Paginate the output of user
     *
     * @param  $count
     * @return mixed
     */
    public function paginate($count = 10)
    {
        $this->user = $this->user->paginate($count);
        $this->hasPaginator = true;

        return $this;
    }

    /**
     * Create a new  collection
     *
     * @return mixed
     */
    public function createCollection()
    {
        $user = $this->user;

        if ($this->hasPaginator) {
            $user = $this->user->getCollection();
        }

        $this->userCollection = new Collection(
            $user,
            new UserTransformer
        );

        return $this;
    }

    /**
     * Return the output as API
     *
     * @return object
     */
    public function transform()
    {
        $this->createCollection();

        if ($this->hasPaginator) {
            $output = $this->userCollection
                ->setPaginator(
                    new IlluminatePaginatorAdapter($this->user)
                );
        }

        $output = $this->manager
            ->createData($output)
            ->toJson();

        return $output;
    }
}
