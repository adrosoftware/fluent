<?php

namespace AdroSoftware\Fluent\Builders\Traits;

use AdroSoftware\Fluent\Buildable;
use AdroSoftware\Fluent\Builders\Delay;

trait Queueable
{
    /**
     * @var Buildable[]
     */
    protected $queued = [];

    /**
     * @param Buildable $buildable
     */
    protected function queue(Buildable $buildable)
    {
        $this->queued[spl_object_hash($buildable)] = $buildable;
    }

    /**
     * @param Buildable     $buildable
     * @param callable|null $callback
     */
    public function callbackAndQueue(Buildable $buildable, callable $callback = null)
    {
        $this->callIfCallable($callback, $buildable);

        $this->queue($buildable);
    }

    /**
     * Execute the build process for all queued buildables.
     */
    public function build()
    {
        /** @var Buildable[] $delayed */
        $delayed = [];

        foreach ($this->getQueued() as $buildable) {
            if ($buildable instanceof Delay) {
                $delayed[] = $buildable;
            } else {
                $buildable->build();
            }
        }

        foreach ($delayed as $buildable) {
            $buildable->build();
        }
    }

    /**
     * @return \AdroSoftware\Fluent\Buildable[]
     */
    public function getQueued()
    {
        return $this->queued;
    }

    /**
     * Call the callable... only if it is really one.
     *
     * @param callable|null $callback
     * @param mixed         $builder
     *
     * @return void
     */
    protected function callIfCallable($callback, $builder)
    {
        if (is_callable($callback)) {
            $callback($builder);
        }
    }
}
