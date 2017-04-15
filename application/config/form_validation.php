<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------
| Form Validation Rules
|Add form validation rules here
|Refer to documentation for more details
| -------------------------------------------------------------------
*/
$config = array(
                 'edit_profile' => array(
                                    array(
                                            'field' => 'middlename',
                                            'label' => 'Middle name',
                                            'rules' => 'trim|max_length[50]|xss_clean|strip_tags'
                                         ),
                                    array(
                                            'field' => 'dob',
                                            'label' => 'Date of Birth',
                                            'rules' => 'trim|required|xss_clean|strip_tags' //date check
                                         ),
                                    array(
                                            'field' => 'sex',
                                            'label' => 'Sex',
                                            'rules' => 'trim|required|xss_clean|strip_tags'
                                         ),
                                    array(
                                            'field' => 'mobile',
                                            'label' => 'Mobile',
                                            'rules' => 'trim|max_length[15]|xss_clean|strip_tags'
                                         ),
                                    /*array(
                                            'field' => 'address1',
                                            'label' => 'Address Line 1',
                                            'rules' => 'trim|required|max_length[50]|xss_clean|strip_tags'
                                         ),
                                    array(
                                            'field' => 'address2',
                                            'label' => 'Address Line 2',
                                            'rules' => 'trim|max_length[50]|xss_clean|strip_tags'
                                         ),
                                    array(
                                            'field' => 'city',
                                            'label' => 'City',
                                            'rules' => 'trim|required|max_length[50]|xss_clean|strip_tags'
                                         ),
                                    array(
                                            'field' => 'state',
                                            'label' => 'State',
                                            'rules' => 'trim|required|max_length[50]|xss_clean|strip_tags'
                                         ),
                                    array(
                                            'field' => 'country',
                                            'label' => 'Country',
                                            'rules' => 'trim|required|max_length[50]|xss_clean|strip_tags'
                                         ),
                                    array(
                                            'field' => 'zipcode',
                                            'label' => 'Pincode',
                                            'rules' => 'trim|max_length[11]|xss_clean|strip_tags'
                                         ),
                                    array(
                                            'field' => 'nationality',
                                            'label' => 'Nationality',
                                            'rules' => 'trim|required|max_length[50]|xss_clean|strip_tags'
                                         ),
                                    array(
                                            'field' => 'language_preferred',
                                            'label' => 'Preferred Language',
                                            'rules' => 'trim|max_length[50]|xss_clean|strip_tags'
                                         ),
                                    array(
                                            'field' => 'profile_pic',
                                            'label' => 'Profile Picture',
                                            'rules' => 'trim|xss_clean|strip_tags'		//make acc to upload
                                         ),
                                    */array(
                                            'field' => 'linkedin',
                                            'label' => 'Linked In',
                                            'rules' => 'trim|xss_clean|strip_tags'
                                         ),
                                    array(
                                            'field' => 'facebook',
                                            'label' => 'Facebook',
                                            'rules' => 'trim|xss_clean|strip_tags'
                                         )
                                    ),
                'employee_update_other' => array(
									array(
                                            'field' => 'new_header_id',
                                            'label' => 'New Header',
                                            'rules' => 'trim|xss_clean'
                                         ), 
									array(
                                            'field' => 'new_header_value',
                                            'label' => 'New Header Value',
                                            'rules' => 'trim|xss_clean'
                                         ),
									)
               );