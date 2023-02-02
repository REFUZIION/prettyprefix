<?php

namespace refuziion\prettyprefix\event;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class listener implements EventSubscriberInterface
{
    public static function getSubscribedEvents()
    {
        return [
            'core.posting_modify_template_vars' => 'add_prefix_template_var',
        ];
    }

    public function add_prefix_template_var($event)
    {
        $prefixes = [
            'red' => 'Red',
            'green' => 'Green',
            'blue' => 'Blue',
        ];

        $event['page_data']['prefixes'] = $prefixes;
        $event['template_vars']['PREFIX'] = $event['page_data']['prefix'];
    }
}
