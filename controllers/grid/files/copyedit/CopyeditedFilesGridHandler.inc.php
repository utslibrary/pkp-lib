<?php

/**
 * @file controllers/grid/files/copyedit/CopyeditedFilesGridHandler.inc.php
 *
 * Copyright (c) 2014-2015 Simon Fraser University Library
 * Copyright (c) 2003-2015 John Willinsky
 * Distributed under the GNU GPL v2. For full terms see the file docs/COPYING.
 *
 * @class CopyeditedFilesGridHandler
 * @ingroup controllers_grid_files_copyedit
 *
 * @brief Handle the copyedited files grid
 */

import('lib.pkp.controllers.grid.files.fileList.FileListGridHandler');

class CopyeditedFilesGridHandler extends FileListGridHandler {
	/**
	 * Constructor
	 *  FILE_GRID_* capabilities set.
	 */
	function CopyeditedFilesGridHandler() {
		import('lib.pkp.controllers.grid.files.copyedit.CopyeditedFilesGridDataProvider');
		parent::FileListGridHandler(
			new CopyeditedFilesGridDataProvider(),
			null,
			FILE_GRID_EDIT|FILE_GRID_MANAGE|FILE_GRID_VIEW_NOTES
		);
		$this->addRoleAssignment(
			array(
				ROLE_ID_SUB_EDITOR,
				ROLE_ID_MANAGER,
				ROLE_ID_ASSISTANT
			),
			array(
				'fetchGrid', 'fetchRow', 'selectFiles'
			)
		);

		$this->setTitle('submission.copyedited');
		$this->setInstructions('editor.submission.editorial.copyeditedDescription');
	}

	//
	// Public handler methods
	//
	/**
	 * Show the form to allow the user to select files from previous stages
	 * @param $args array
	 * @param $request PKPRequest
	 * @return JSONMessage JSON object
	 */
	function selectFiles($args, $request) {
		import('lib.pkp.controllers.grid.files.copyedit.form.ManageCopyeditedFilesForm');
		$manageCopyeditedFilesForm = new ManageCopyeditedFilesForm($this->getSubmission()->getId());
		$manageCopyeditedFilesForm->initData($args, $request);
		return new JSONMessage(true, $manageCopyeditedFilesForm->fetch($request));
	}
}

?>
