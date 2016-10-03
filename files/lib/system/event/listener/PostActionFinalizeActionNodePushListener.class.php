<?php
/*
 * Copyright © 2014-2016 Tim Düsterhus <tim@bastelstu.be>
 * This work is free. You can redistribute it and/or modify it under the
 * terms of the Do What The Fuck You Want To Public License, Version 2,
 * as published by Sam Hocevar. See the COPYING file for more details.
 */

namespace wbb\system\event\listener;

/**
 * Sends notifications to users via Push
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
					$payload = [ 'userID' => (int) $post->userID
					           , 'username' => $post->username
					           ];
					\wcf\system\push\PushHandler::getInstance()->sendMessage('be.bastelstu.wbb.pushNotification.newPost.'.$post->getThread()->threadID, [ ], $payload);
				}
		}
	}
}
