<?php
namespace wbb\system\event\listener;

/**
 * Sends notifications to users via nodePush
 * 
 * @author	Tim Düsterhus
 * @copyright	2014 Tim Düsterhus
 * @license	DO WHAT THE FUCK YOU WANT TO PUBLIC LICENSE Version 2, December 2004 <http://www.wtfpl.net/about/>
 * @package	com.woltlab.wbb
 * @subpackage	system.event.listener
 */
class PostActionFinalizeActionNodePushListener implements \wcf\system\event\IEventListener {
	/**
	 * @see	\wcf\system\event\IEventListener::execute()
	 */
	public function execute($eventObj, $className, $eventName) {
		switch ($eventObj->getActionName()) {
			case 'triggerPublication':
				$objects = $eventObj->getObjects();
				
				foreach ($objects as $post) {
					\wcf\system\push\PushHandler::getInstance()->sendMessage('be.bastelstu.wbb.pushNotification.thread.'.$post->getThread()->threadID.'.newPost');
				}
		}
	}
}
