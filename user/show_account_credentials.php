<?php
require_once('../.confiq/confiq.php');
if (session_restore_result($connect)['session_valid']) {
  $retreive_usercredentials = $connect->query("select * from usercredentials where userid='".$_SESSION['current_userid']."'");
  if (!empty($retreive_usercredentials->num_rows)) {
    $row = $retreive_usercredentials->fetch_assoc();
    $retreive_userbasicdata = $connect->query("select * from userbasicdata where did=".$row['uid']);
    if (!empty($retreive_userbasicdata->num_rows)) {
      $data_row = $retreive_userbasicdata->fetch_assoc();
      ?>
      <form action="" method="post" id="credentials__change" class="tabcontent__field">
        <div class="group__left">
          <div class="input__icon">
            <input type="text" class="input__glow" required name="cname" placeholder="Your full name" value="<?php echo $row['username']; ?>">
            <div class="icon__snap__field">
              <div class="icon__snap__field__relative">
                <i class="fas fa-user-alt fa-lg fa-fw input__snap" aria-hidden="true"></i>
              </div>
            </div>
          </div>
          <div class="input__icon">
            <input type="text" class="input__glow" required name="clastname" placeholder="Your lastname" value="<?php echo $row['userlastname']; ?>">
            <div class="icon__snap__field">
              <div class="icon__snap__field__relative">
                <i class="fas fa-users fa-lg fa-fw input__snap" aria-hidden="true"></i>
              </div>
            </div>
          </div>
          <div class="input__icon">
            <input type="email" class="input__glow" required name="cemail" placeholder="Your email address"  value="<?php echo $data_row['emailaddress']; ?>">
            <div class="icon__snap__field">
              <div class="icon__snap__field__relative">
                <i class="fas fa-envelope fa-lg fa-fw input__snap" aria-hidden="true"></i>
              </div>
            </div>
          </div>
          <div class="input__icon">
            <input type="text" class="input__glow" required name="cphonenumber" placeholder="Your phone number" value="<?php echo $data_row['phonenumber']; ?>">
            <div class="icon__snap__field">
              <div class="icon__snap__field__relative">
                <i class="fas fa-phone-alt fa-lg fa-fw input__snap" aria-hidden="true"></i>
              </div>
            </div>
          </div>
          <div class="input__icon">
            <input type="text" class="input__glow" required name="cpostcode" placeholder="Your postcode" value="<?php echo $data_row['postnum']; ?>">
            <div class="icon__snap__field">
              <div class="icon__snap__field__relative">
                <i class="fas fa-shipping-fast fa-lg fa-fw input__snap" aria-hidden="true"></i>
              </div>
            </div>
          </div>
        </div>
        <div class="group__right">
          <div class="input__icon">
            <input type="text" class="input__glow" required name="caddress1" placeholder="Your home address" value="<?php echo $data_row['primaryaddress']; ?>">
            <div class="icon__snap__field">
              <div class="icon__snap__field__relative">
                <i class="fas fa-house-user fa-lg fa-fw input__snap" aria-hidden="true"></i>
              </div>
            </div>
          </div>
          <div class="input__icon">
            <input type="text" class="input__glow" name="caddress2" placeholder="Optional home address" value="<?php echo $data_row['secondaryaddress']; ?>">
            <div class="icon__snap__field">
              <div class="icon__snap__field__relative">
                <i class="fas fa-house-user fa-lg fa-fw input__snap" aria-hidden="true"></i>
              </div>
            </div>
          </div>
          <div class="input__icon">
            <input type="text" class="input__glow" required name="ccity" placeholder="City you lived in" value="<?php echo $data_row['city']; ?>">
            <div class="icon__snap__field">
              <div class="icon__snap__field__relative">
                <i class="fas fa-building fa-lg fa-fw input__snap" aria-hidden="true"></i>
              </div>
            </div>
          </div>
          <div class="input__icon">
            <input type="text" class="input__glow" required name="cstate" placeholder="State you lived in" value="<?php echo $data_row['state']; ?>">
            <div class="icon__snap__field">
              <div class="icon__snap__field__relative">
                <i class="fas fa-city fa-lg fa-fw input__snap" aria-hidden="true"></i>
              </div>
            </div>
          </div>
          <div class="input__icon">
            <input type="text" class="input__glow" required name="cprovince" placeholder="Province you lived in" value="<?php echo $data_row['province']; ?>">
            <div class="icon__snap__field">
              <div class="icon__snap__field__relative">
                <i class="fas fa-city fa-lg fa-fw input__snap" aria-hidden="true"></i>
              </div>
            </div>
          </div>
        </div>
        <div class="group__group__center">
          <button type="submit" class="button__icon button__blue" id="basicdata" style="margin-top: 1em"><i class="fas fa-file-signature"></i>Submit change</button>
        </div>
      </form>
      <?php
    }
  }
}
?>
