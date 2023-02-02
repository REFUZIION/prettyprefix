<?php
/**
 *
 * Pretty Topic Prefixes. An extension for the phpBB Forum Software package.
 *
 * @copyright (c) 2023, Diederik Veenstra <REFUZIION>, https://refuzion.nl
 * @license GNU General Public License, version 2 (GPL-2.0)
 *
 */

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
            'red' => 'PRETTYPREFIX_RED',
            'green' => 'PRETTYPREFIX_GREEN',
            'blue' => 'PRETTYPREFIX_BLUE',
        ];

        $event['page_data']['prefixes'] = $prefixes;
        $event['template_vars']['S_PRETTYPREFIX'] = true;

		return $event;
	}
}