<?php
class FromRender {

	private $_fieldList = array();
	private static $_formStructure = NULL;
	private static $_requiredSymol = '<span class="required">*</span>';
	private static $_ = '<span class="required">*</span>';

	public function __construct(&$fieldList) {
		$this->_fieldList = $fieldList;
	}

	private function InputText(&$key, &$inputTypeParams) {
		$_showRequired = NULL;
		$_validation = NULL;

		if ($inputTypeParams['required'] == true) {
			$_showRequired = '<span class="required">*</span>';
			$_validation .= 'data-parsley-required=true ';
		}
		if ($inputTypeParams['fieldType'] == 'url') {
			$_validation .= 'data-parsley-type="url" ';
		} else if ($inputTypeParams['fieldType'] == 'email') {
			$_validation .= 'data-parsley-type="email" ';
		} else if ($inputTypeParams['fieldType'] == 'number') {
			$_validation .= 'data-parsley-type="number" ';
		} else {
			$_validation .= 'data-parsley-pattern="^[a-zA-Z0-9\ \s]+$" ';
		}
		if ($inputTypeParams['remoteValidate'] == true) {
			//$_validation .= 'data-ajax-name="remoteValidator" data-parsley-remote-options=\'{ "type": "POST",  "data": { "field": "' . $key . '" } }\' data-parsley-remote-validator="validateSitename" data-parsley-remote="1" data-parsley-trigger="blur" data-parsley-remote-message="" ';
		}

		self::$_formStructure .= '<div class="form-group">
														    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="' . $key . '">' . $inputTypeParams['labelTitle'] . ' ' . $_showRequired . '
														    </label>
														    <div class="col-md-6 col-sm-6 col-xs-12">
														        <input type="' . $inputTypeParams['fieldType'] . '" id="' . $key . '" name="' . $key . '" value="' . $inputTypeParams['fieldValue'] . '" class="form-control col-md-7 col-xs-12" ' . $_validation . '>
														    </div>
															</div>';
	}

	private function InputDatePicker(&$key, &$inputTypeParams) {
		$_showRequired = NULL;
		$_validation = NULL;

		if ($inputTypeParams['required'] == true) {
			$_showRequired = '<span class="required">*</span>';
			$_validation .= 'data-parsley-required=true ';
		}

		if ($inputTypeParams['remoteValidate'] == true) {
			$_validation .= 'data-ajax-name="remoteValidator" data-parsley-remote-options=\'{ "type": "POST",  "data": { "field": "' . $key . '" } }\' data-parsley-remote-validator="validateSitename" data-parsley-remote="1" data-parsley-trigger="blur" data-parsley-remote-message="" ';
		}

		self::$_formStructure .= '<div class="form-group">
														    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="' . $key . '">' . $inputTypeParams['labelTitle'] . ' ' . $_showRequired . '
														    </label>
														    <div class="col-md-6 col-sm-6 col-xs-12">
														        <input type="' . $inputTypeParams['fieldType'] . '" id="' . $key . '" name="' . $key . '" value="' . $inputTypeParams['fieldValue'] . '" class="date-picker form-control col-md-7 col-xs-12" ' . $_validation . '>
														    </div>
															</div>';
	}

	private function InputHiddenText(&$key, &$inputTypeParams) {
		$_showRequired = NULL;
		$_validation = NULL;

		if (!empty($inputTypeParams['required']) && $inputTypeParams['required'] == true) {
			$_showRequired = '<span class="required">*</span>';
			$_validation .= 'required ';
		}

		if (!empty($inputTypeParams['required']) && $inputTypeParams['remoteValidate'] == true) {
			$_validation .= 'data-ajax-name="remoteValidator" data-parsley-remote-options=\'{ "type": "POST",  "data": { "field": "' . $key . '" } }\' data-parsley-remote-validator="validateSitename" data-parsley-remote="1" data-parsley-trigger="blur" data-parsley-remote-message="" ';
		}

		self::$_formStructure .= '<input type="' . $inputTypeParams['fieldType'] . '" id="' . $key . '" name="' . $key . '" ' . $_validation . ' value="' . $inputTypeParams['fieldValue'] . '" readonly>';
	}

	private function InputRadio(&$key, &$inputTypeParams) {
		$_showRequired = NULL;
		$_validation = NULL;
		$radioButtonGrp = NULL;

		if ($inputTypeParams['required'] == true) {
			$_showRequired = '<span class="required">*</span>';
			$_validation .= 'required';
		}

		if ($inputTypeParams['remoteValidate'] == true) {
			$_validation .= 'data-ajax-name="remoteValidator" data-parsley-remote-options=\'{ "type": "POST",  "data": { "field": "' . $key . '" } }\' data-parsley-remote-validator="validateSitename" data-parsley-remote="1" data-parsley-trigger="blur" data-parsley-remote-message=""';
		}
		foreach ($inputTypeParams['radioButton'] as $attribProperty => $attribValue) {
			if (empty($inputTypeParams['fieldValue'])) {
				$defaultActive = ($attribValue['checked'] == 'checked') ? 'active' : '';
			} else {
				($inputTypeParams['fieldValue'] == $attribValue['val']) ? (list($defaultActive, $checked) = array('active', 'checked')) : (list($defaultActive, $checked) = array('', ''));
			}

			$radioButtonGrp .= '<label class="btn btn-default ' . $defaultActive . '" >
            <input type="radio" name="' . $key . '" value="' . $attribValue['val'] . '" ' . $attribValue['checked'] . ' data-parsley-errors-container="#error-' . $key . '" ' . $_validation . '> &nbsp; ' . $attribValue['label'] . ' &nbsp;
        </label>';
		}
		self::$_formStructure .= '<div class="form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="' . $key . '">' . $inputTypeParams['labelTitle'] . ' ' . $_showRequired . '</label>
                                  <div class="col-md-6 col-sm-6 col-xs-12">
                                      <div class="btn-group" data-toggle="buttons">
                                      	' . $radioButtonGrp . '
                                      </div>
                                      <div id="error-' . $key . '"></div>
                                  </div>
                              </div>';
	}

	private function InputCheckbox(&$key, &$inputTypeParams) {

	}

	private function InputTextArea(&$key, &$inputTypeParams) {
		$_showRequired = NULL;
		$_validation = NULL;
		$radioButtonGrp = NULL;

		if ($inputTypeParams['required'] == true) {
			$_showRequired = '<span class="required">*</span>';
			$_validation .= 'required';
		}

		if ($inputTypeParams['remoteValidate'] == true) {
			$_validation .= 'data-ajax-name="remoteValidator" data-parsley-remote-options=\'{ "type": "POST",  "data": { "field": "' . $key . '" } }\' data-parsley-remote-validator="validateSitename" data-parsley-remote="1" data-parsley-trigger="blur" data-parsley-remote-message=""';
		}

		self::$_formStructure .= '<div class="form-group">
														    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="' . $key . '">' . $inputTypeParams['labelTitle'] . ' ' . $_showRequired . '
														    </label>
														    <div class="col-md-6 col-sm-6 col-xs-12">
														        <textarea id="' . $key . '" name="' . $key . '" value="' . $inputTypeParams['fieldValue'] . '" class="form-control col-md-7 col-xs-12" ' . $_validation . ' style="width: 100%; overflow: hidden; word-wrap: break-word; resize: horizontal; height: 87px;"></textarea>
														    </div>
															</div>';
	}

	private function InputTextAreaEditor(&$key, &$inputTypeParams) {
		$_showRequired = NULL;
		$_validation = NULL;
		$radioButtonGrp = NULL;

		if ($inputTypeParams['required'] == true) {
			$_showRequired = '<span class="required">*</span>';
			$_validation .= 'required';
		}

		if ($inputTypeParams['remoteValidate'] == true) {
			$_validation .= 'data-ajax-name="remoteValidator" data-parsley-remote-options=\'{ "type": "POST",  "data": { "field": "' . $key . '" } }\' data-parsley-remote-validator="validateSitename" data-parsley-remote="1" data-parsley-trigger="blur" data-parsley-remote-message=""';
		}

		self::$_formStructure .= '<div class="form-group">
														    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="' . $key . '">' . $inputTypeParams['labelTitle'] . ' ' . $_showRequired . '
														    </label>
														    <div class="col-md-9 col-sm-9 col-xs-12">
														        <textarea id="' . $key . '" name="' . $key . '" value="' . $inputTypeParams['fieldValue'] . '" class="form-control col-md-7 col-xs-12 show-editor" data-parsley-errors-container="#error-' . $key . '" ' . $_validation . ' style="width: 100%; overflow: hidden; word-wrap: break-word; resize: horizontal; height: 87px;"></textarea>
														        <div id="error-' . $key . '"></div>
														    </div>

															</div>';
	}

	private function InputSelect(&$key, &$inputTypeParams) {
		$_showRequired = NULL;
		$_validation = NULL;

		if ($inputTypeParams['required'] == true) {
			$_showRequired = '<span class="required">*</span>';
			$_validation .= 'required';
		}

		if ($inputTypeParams['remoteValidate'] == true) {
			$_validation .= 'data-ajax-name="remoteValidator" data-parsley-remote-options=\'{ "type": "POST",  "data": { "field": "' . $key . '" } }\' data-parsley-remote-validator="validateSitename" data-parsley-remote="1" data-parsley-trigger="blur" data-parsley-remote-message=""';
		}
		foreach ($inputTypeParams['selectOptions'] as $key1 => $val1) {
			($key1 == $inputTypeParams['fieldValue']) ? $selected = 'selected' : $selected = '';
			$option_list .= '<option value="' . $key1 . '" ' . $selected . '>' . $val1 . '</option>';
		}
		self::$_formStructure .= '<div class="form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="' . $key . '">' . $inputTypeParams['labelTitle'] . ' ' . $_showRequired . '
                                  </label>
                                  <div class="col-md-6 col-sm-6 col-xs-12">
                                      <select name="' . $key . '" id="' . $key . '" class="selct_single_registration_template form-control" tabindex="-1" style="width: 100%" data-parsley-errors-container="#error-' . $key . '" ' . $_validation . '>
                                          ' . $option_list . '
                                      </select>
                                      <div id="error-' . $key . '"></div>
                                  </div>
                              </div>';
	}

	private function InputMultiSelect(&$key, &$inputTypeParams) {
		$_showRequired = NULL;
		$_validation = NULL;
		$option_list = NULL;

		if ($inputTypeParams['required'] == true) {
			$_showRequired = '<span class="required">*</span>';
			$_validation .= 'required';
		}

		if ($inputTypeParams['remoteValidate'] == true) {
			$_validation .= 'data-ajax-name="remoteValidator" data-parsley-remote-options=\'{ "type": "POST",  "data": { "field": "' . $key . '" } }\' data-parsley-remote-validator="validateSitename" data-parsley-remote="1" data-parsley-trigger="blur" data-parsley-remote-message=""';
		}
		foreach ($inputTypeParams['selectOptions'] as $list => $optionParams) {
			(in_array($optionParams['val'], $inputTypeParams['fieldValue']) === true) ? $selected = 'selected' : $selected = '';
			$option_list .= '<option value="' . $optionParams['val'] . '" ' . $selected . '>' . $optionParams['opt'] . '</option>';
		}
		self::$_formStructure .= '<div class="form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="' . $key . '">' . $inputTypeParams['labelTitle'] . ' ' . $_showRequired . '
          </label>
          <div class="col-md-6 col-sm-6 col-xs-12">
              <select multiple="multiple" name="' . $key . '[]" id="' . $key . '" class="multiselect form-control" data-parsley-errors-container="#error-' . $key . '" ' . $_validation . '>
                  ' . $option_list . '
              </select>
              <div id="error-' . $key . '"></div>
          </div>
      </div>';
	}

	private function InputFile(&$key, &$inputTypeParams) {
		$_showRequired = NULL;
		$_validation = NULL;

		if ($inputTypeParams['required'] == true) {
			$_showRequired = '<span class="required">*</span>';
			$_validation .= 'required';
		}
		self::$_formStructure .= '<div class="form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="' . $key . '">' . $inputTypeParams['labelTitle'] . ' ' . $_showRequired . '
          </label>
          <div class="col-md-9 col-sm-9 col-xs-12">
          		<div name="' . $key . '" uploadingfor="' . $key . '" id="' . $key . '" class="form-control custom_fileupload" >UPLOAD ' . $inputTypeParams['labelTitle'] . '</div>
              <div id="error-' . $key . '"></div>
          </div>
      </div>';
	}

	public function getForm() {
		foreach ($this->_fieldList as $key => $value) {
			switch ($value['inputType']) {
				case 'text':
					$this->InputText($key, $value);
					break;
				case 'date':
					$this->InputDatePicker($key, $value);
					break;
				case 'radio':
					$this->InputRadio($key, $value);
					break;
				case 'checkbox':
					$this->InputCheckbox($key, $value);
					break;
				case 'textarea':
					$this->InputTextArea($key, $value);
					break;
				case 'editor':
					$this->InputTextAreaEditor($key, $value);
					break;
				case 'select':
					$this->InputSelect($key, $value);
					break;
				case 'multiselect':
					$this->InputMultiSelect($key, $value);
					break;
				case 'file':
					$this->InputFile($key, $value);
					break;
				case 'hidden':
					$this->InputHiddenText($key, $value);
					break;
				default:
					break;
			}
		}
		return self::$_formStructure;
	}

}

?>
