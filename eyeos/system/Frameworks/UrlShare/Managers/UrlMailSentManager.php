<?php
/*
*                 eyeos - The Open Source Cloud's Web Desktop
*                               Version 2.0
*                   Copyright (C) 2007 - 2010 eyeos Team
*
* This program is free software; you can redistribute it and/or modify it under
* the terms of the GNU Affero General Public License version 3 as published by the
* Free Software Foundation.
*
* This program is distributed in the hope that it will be useful, but WITHOUT
* ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS
* FOR A PARTICULAR PURPOSE.  See the GNU Affero General Public License for more
* details.
*
* You should have received a copy of the GNU Affero General Public License
* version 3 along with this program in the file "LICENSE".  If not, see
* <http://www.gnu.org/licenses/agpl-3.0.txt>.
*
* See www.eyeos.org for more details. All requests should be sent to licensing@eyeos.org
*
* The interactive user interfaces in modified source and object code versions
* of this program must display Appropriate Legal Notices, as required under
* Section 5 of the GNU Affero General Public License version 3.
*
* In accordance with Section 7(b) of the GNU Affero General Public License version 3,
* these Appropriate Legal Notices must retain the display of the "Powered by
* eyeos" logo and retain the original copyright notice. If the display of the
* logo is not reasonably feasible for technical reasons, the Appropriate Legal Notices
* must display the words "Powered by eyeos" and retain the original copyright notice.
* */

class UrlMailSentManager implements IUrlMailSentManager {
	private static $Instance = null;
	private static $Logger = null;
	private $provider = null;

	protected function __construct() {}

	public static function getInstance() {
		if (self::$Instance === null) {
			$thisClass = __CLASS__;
			self::$Instance = new $thisClass;
			self::init();
		}
		return self::$Instance;
	}

	protected static function init() {
		self::$Logger = Logger::getLogger('system.frameworks.UrlShare.UrlMailSentManager');
	}

	protected function getProvider() {
		if ($this->provider === null) {
			$this->provider = UrlMailSentSqlProvider::getInstance();
		}
		return $this->provider;
	}

	public function createMailSent(IUrlMailSent $mailSent) {
		try {
			$this->getProvider()->createMailSent($mailSent);
			return $mailSent;
		} catch (Exception $e) {
			self::$Logger->error('Error while creating UrlMailSent');
			throw $e;
		}
	}
	public function updateMailSent(IUrlMailSent $mailSent) {
		try {
			$this->getProvider()->updateMailSent($mailSent);
			self::$Logger->info('UrlMailSent Updated: ' . $mailSent);
			return $mailSent;
		} catch (Exception $e) {
			self::$Logger->error('Error while updating UrlMailSent');
			throw $e;
		}
	}
	public function deleteMailSent(IUrlMailSent $mailSent) {
		try {
			$this->getProvider()->deleteMailSent($mailSent);
			self::$Logger->info('UrlMailSent Deleted: ' . $mailSent);
		} catch (Exception $e) {
			self::$Logger->error('Error while deleting UrlMailSent');
			throw $e;
		}
	}
	public function searchMailSent(IUrlMailSent $mailSent) {
		try {
			$returnMailSent = $this->getProvider()->searchMailSent($mailSent);
			self::$Logger->info('UrlMailSent searched: ' . $returnMailSent);
			return $returnMailSent;
		} catch (Exception $e) {
			self::$Logger->error('Error while searching UrlMailSent');
			throw $e;
		}
	}
}

?>