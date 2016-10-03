/*
 * Copyright © 2014-2016 Tim Düsterhus <tim@bastelstu.be>
 * This work is free. You can redistribute it and/or modify it under the
 * terms of the Do What The Fuck You Want To Public License, Version 2,
 * as published by Sam Hocevar. See the COPYING file for more details.
 */

define([ 'Bastelstu.be/_Push'
       , 'WoltLabSuite/Core/Language'
       , 'WoltLabSuite/Core/User'
       , 'WoltLabSuite/Core/Ui/Notification'
       ], function (Push, Language, User, Notification) {
	"use strict";

	class NewPost {
		constructor(threadID) {
			Push
			.onMessage('be.bastelstu.wbb.pushNotification.newPost.' + threadID, this.onMessage.bind(this))
			.catch(function (err) {
				// swallow error
			})
		}

		onMessage(payload) {
			if (!payload.userID || !payload.username) return
			if (User.userId === payload.userID) return

			Notification.show(Language.get('wbb.thread.notification.newPost', payload), undefined, 'info')
		}
	}

	return NewPost
});
