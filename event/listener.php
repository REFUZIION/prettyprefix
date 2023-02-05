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

use phpbb\template\template;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class listener implements EventSubscriberInterface
{
    /** @var template */
    protected $template;

    /**
     * listener constructor.
     * @param template $template
     */
    public function __construct(template $template)
    {
        $this->template = $template;
		$this->template->set_style('refuziion/prettyprefix', 'ext/refuziion/prettyprefix/styles/');
    }

    /**
     * @return array
     */
    public static function getSubscribedEvents()
    {
        return [
            'core.posting_modify_template_vars' => 'modify_template_vars',
        ];
    }

    /**
     * @param \phpbb\event\data $event
     */
    public function modify_template_vars(\phpbb\event\data $event)
    {
        $this->template->assign_vars([
            'S_PRETTY_TOPIC_PREFIX' => true,
            'PRETTY_PREFIX_RED' => 'Red',
            'PRETTY_PREFIX_GREEN' => 'Green',
            'PRETTY_PREFIX_BLUE' => 'Blue',
        ]);

		$this->template->set_filenames([
			'prettyprefix' => 'prettyprefix.html',
		]);

		$this->template->assign_display('prettyprefix');
    }
}
