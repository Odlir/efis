<?php
/**
 * CodeIgniter
 *
 * An open source application development framework for PHP
 *
 * This content is released under the MIT License (MIT)
 *
 * Copyright (c) 2014 - 2019, British Columbia Institute of Technology
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 *
 * @package	CodeIgniter
 * @author	EllisLab Dev Team
 * @copyright	Copyright (c) 2008 - 2014, EllisLab, Inc. (https://ellislab.com/)
 * @copyright	Copyright (c) 2014 - 2019, British Columbia Institute of Technology (https://bcit.ca/)
 * @license	https://opensource.org/licenses/MIT	MIT License
 * @link	https://codeigniter.com
 * @since	Version 1.0.0
 * @filesource
 */
defined('BASEPATH') OR exit('No direct script access allowed');

/*
$lang['form_validation_required']		= 'El campo {field} es obligatorio.';
$lang['form_validation_isset']			= 'El campo {field} debe contener un valor.';
$lang['form_validation_valid_email']		= 'El campo {field} debe contener un email válido.';
$lang['form_validation_valid_emails']		= 'El campo {field} debe contener todos los emails válidos.';
$lang['form_validation_valid_url']		= 'El campo {field} debe contener una URL válida.';
$lang['form_validation_valid_ip']		= 'El campo {field} debe contener una IP válida.';
$lang['form_validation_valid_base64']		= 'The {field} field must contain a valid Base64 string.';
$lang['form_validation_min_length']		= 'El campo {field} debe ser de al menos {param} caracteres de longitud.';
$lang['form_validation_max_length']		= 'El campo {field} no puede superar los {param} caracteres de longitud.';
$lang['form_validation_exact_length']		= 'The {field} field must be exactly {param} characters in length.';
$lang['form_validation_alpha']			= 'The {field} field may only contain alphabetical characters.';
$lang['form_validation_alpha_numeric']		= 'The {field} field may only contain alpha-numeric characters.';
$lang['form_validation_alpha_numeric_spaces']	= 'The {field} field may only contain alpha-numeric characters and spaces.';
$lang['form_validation_alpha_dash']		= 'The {field} field may only contain alpha-numeric characters, underscores, and dashes.';
$lang['form_validation_numeric']		= 'The {field} field must contain only numbers.';
$lang['form_validation_is_numeric']		= 'The {field} field must contain only numeric characters.';
$lang['form_validation_integer']		= 'The {field} field must contain an integer.';
$lang['form_validation_regex_match']		= 'The {field} field is not in the correct format.';
$lang['form_validation_matches']		= 'The {field} field does not match the {param} field.';
$lang['form_validation_differs']		= 'The {field} field must differ from the {param} field.';
$lang['form_validation_is_unique'] 		= 'The {field} field must contain a unique value.';
$lang['form_validation_is_natural']		= 'The {field} field must only contain digits.';
$lang['form_validation_is_natural_no_zero']	= 'The {field} field must only contain digits and must be greater than zero.';
$lang['form_validation_decimal']		= 'The {field} field must contain a decimal number.';
$lang['form_validation_less_than']		= 'The {field} field must contain a number less than {param}.';
$lang['form_validation_less_than_equal_to']	= 'The {field} field must contain a number less than or equal to {param}.';
$lang['form_validation_greater_than']		= 'The {field} field must contain a number greater than {param}.';
$lang['form_validation_greater_than_equal_to']	= 'The {field} field must contain a number greater than or equal to {param}.';
$lang['form_validation_error_message_not_set']	= 'Unable to access an error message corresponding to your field name {field}.';
$lang['form_validation_in_list']		= 'The {field} field must be one of: {param}.';
*/

$lang['form_validation_required']		= 'El campo {field} es obligatorio.';
$lang['form_validation_isset']			= 'El campo {field} debe contener un valor.';
$lang['form_validation_valid_email']		= 'El campo {field} debe contener un email válido.';
$lang['form_validation_valid_emails']		= 'El campo {field} debe contener todos los emails válidos.';
$lang['form_validation_valid_url']		= 'El campo {field} debe contener una URL válida.';
$lang['form_validation_valid_ip']		= 'El campo {field} debe contener una IP válida.';
$lang['form_validation_valid_base64']		= 'The {field} field must contain a valid Base64 string.';
$lang['form_validation_min_length']		= 'El campo {field} debe ser de al menos {param} caracteres de longitud.';
$lang['form_validation_max_length']		= 'El campo {field} no puede superar los {param} caracteres de longitud.';
$lang['form_validation_exact_length']		= 'El campo {field} debe ser de exactamente {param} caracteres de longitud.';
$lang['form_validation_alpha']			= 'El campo {field} solo puede contener caracteres alfabéticos.';
$lang['form_validation_alpha_numeric']		= 'El campo {field} solo puede contener caracteres alfanuméricos.';
$lang['form_validation_alpha_numeric_spaces']	= 'El campo {field} solo puede contener caracteres alfanuméricos y espacios.';
$lang['form_validation_alpha_dash']		= 'El campo {field} solo puede contener caracteres alfanuméricos, guiones bajos y guiones.';
$lang['form_validation_numeric']		= 'El campo {field} solo puede contener números.';
$lang['form_validation_is_numeric']		= 'El campo {field} solo puede contener caracteres numéricos.';
$lang['form_validation_integer']		= 'El campo {field} debe contener un entero.';
$lang['form_validation_regex_match']		= 'El campo {field} no está en el formato correcto.';
$lang['form_validation_matches']		= 'El campo {field} no coincide con el campo {param}.';
$lang['form_validation_differs']		= 'El campo {field} debe ser distinto al campo {param}.';
$lang['form_validation_is_unique'] 		= 'El campo {field} debe contener un valor único.';
$lang['form_validation_is_natural']		= 'El campo {field} solo puede contener dígitos.';
$lang['form_validation_is_natural_no_zero']	= 'El campo {field} solo puede contener dígitos y debe ser mayor que cero.';
$lang['form_validation_decimal']		= 'El campo {field} debe contener un número decimal.';
$lang['form_validation_less_than']		= 'El campo {field} debe contener un número menor que {param}.';
$lang['form_validation_less_than_equal_to']	= 'El campo {field} debe contener un número menor o igual a {param}.';
$lang['form_validation_greater_than']		= 'El campo {field} debe contener un número mayor que {param}.';
$lang['form_validation_greater_than_equal_to']	= 'El campo {field} debe contener un número mayor o igual a {param}.';
$lang['form_validation_error_message_not_set']	= 'No se ha podido acceder al mensaje de error correspondiente para el campo {field}.';
$lang['form_validation_in_list']		= 'El campo {field} debe contener uno de estos: {param}.';