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
			case 'quickReply':
			case 'create':
				$parameters = $eventObj->getParameters();
				
				\wcf\system\nodePush\NodePushHandler::getInstance()->sendMessage('be.bastelstu.wbb.pushNotification.thread.'.$parameters['data']['threadID'].'.newPost');
		}
	}
}
