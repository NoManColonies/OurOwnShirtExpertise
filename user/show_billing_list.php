<?php
require_once('../.confiq/confiq.php');
$session = session_auth_check($connect);
if ($session['session_valid'] && $session['auth_key_valid']) {
  $retreive_all_billinglist = $connect->query("select * from billinglist where status='pending'");
  if (!empty($retreive_all_billinglist->num_rows)) {
    while ($billing_row = $retreive_all_billinglist->fetch_assoc()) {
      ?>
      <div class="tabcontent__field">
        <span class="tabcontent__user">
          <p>User: <?php echo $billing_row['userid']; ?></p>
        </span>
        <span class="tabcontent__key">
          <p>Key: <?php echo $billing_row['keyhash']; ?></p>
        </span>
        <span class="tabcontent__action">
          <button class="button__icon button__blue" name="view" data-key="<?php echo $billing_row['keyhash']; ?>"><i class="fas fa-eye"></i>View</button>
          <button class="button__icon button__green" name="approve" data-key="<?php echo $billing_row['keyhash']; ?>"><i class="fas fa-stamp"></i>Approve</button>
          <button class="button__icon button__dark" name="decline" data-key="<?php echo $billing_row['keyhash']; ?>"><i class="fas fa-money-bill-wave"></i>Refund</button>
        </span>
      </div>
      <?php
    }
  } else {
    ?>
    <p class="cart__no__result">No billing list found. :(</p>
    <?php
  }
} else {
  echo "";
}
$connect->close();
?>
