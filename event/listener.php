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

use phpbb\language\language;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class listener implements EventSubscriberInterface
{
	/**
	 * @var language
	 */
	protected $language;

	/**
	 * Constructor
	 *
	 * @param \phpbb\language\language $language
	 */
	public function __construct(\phpbb\language\language $language)
	{
		$this->language = $language;
	}

    /**
	 * @return array
	 */
	public static function getSubscribedEvents():array
    {
        return [
            'core.posting_modify_template_vars' => 'add_prefix_template_var',
        ];
    }

	/**
	 * @param mixed $event
	 * @return void
	 */
	public function load_language_on_setup($event):void
	{
		$lang_set_ext = $event['lang_set_ext'];
		$lang_set_ext[] = [
			'ext_name' => 'refuziion/prettyprefix',
			'lang_set' => 'common',
		];
		$event['lang_set_ext'] = $lang_set_ext;
	}

	/**
	 * @param mixed $event
	 * @return mixed
	 */
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
