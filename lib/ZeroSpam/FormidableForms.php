<?php
class ZeroSpam_FormidableForms extends ZeroSpam_Plugin {
  public function run() {
    add_filter( 'frm_validate_entry', array( $this, 'ff_validate' ), 20, 2 );
  }

  /**
   * Validate Formidable Forms form submissions.
   *
   * Validates the Formidable Forms (https://wordpress.org/plugins/formidable/)
   * form submission, and flags the form submission as invalid if the zero-spam
   * post data isn't present.
   *
   * @since  2.0.0
   *
   */
  public function ff_validate( $errors, $values ) {

    if  ( ! zerospam_is_valid() ) {
      do_action( 'zero_spam_found_spam_ff_form_submission' );

      $errors['spam'] = __( $this->settings['spammer_msg_ff'], 'zerospam' );

      if ( ! empty(  $this->settings['log_spammers'] ) &&  $this->settings['log_spammers'] ) {
        zerospam_log_spam( 'ff' );
      }

    }

    return $errors;
  }
}
