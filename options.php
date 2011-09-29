<div class="wrap">
  <h2>Kiss Metrics</h2>

  <form method="post" action="options.php">

    <?php wp_nonce_field('update-options'); ?>
    <?php settings_fields('kissmetrics'); ?>

    <table class="form-table">
      <tr valign="top">
        <th scope="row">Your API Key:</th>
        <td><input type="text" name="kissmetrics_api_key" value="<?php echo get_option('kissmetrics_api_key'); ?>" /></td>
      </tr>
    </table>

    <input type="hidden" name="action" value="update" />

    <p class="submit">
      <input type="submit" class="button-primary" value="<?php _e('Save Changes') ?>" />
    </p>

  </form>
</div>
